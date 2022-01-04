<?php
/**
 *Author:Syskey
 *Date:2021/10/19
 *Time:14:40
 **/

function config_path($path = '')
{
    return app()->configPath($path);
}

//后台资源路径
function ev_admin($asset)
{
    return "/center/" . ltrim($asset, "/");
}

//前台资源路径
function ev_index($asset)
{
    return "/templates/" . ltrim($asset, "/");
}

function ev_route(string $name, array $params)
{
    return route($name, $params, false);
}

function base64_endcode_plus(string $string)
{
    $endstr = base64_encode($string);
    return str_replace("/", "evs", $endstr);
}

function base64_decode_plus(string $endstr)
{
    $decstr = str_replace("evs", "/", $endstr);
    return base64_decode($decstr);
}

function nowplay(string $nowtype, string $nowaddress, string $nowurl)
{
    return route("index.play", ["url" => "evnowplay@{$nowtype}@{$nowurl}@" . base64_endcode_plus($nowaddress)], false);
}
//翻页计算
function ev_page($pg)
{
    $num = $pg / 5;
    if (is_int($num)) {
        $star = $pg;
        $end = 5 * ($num + 1);
    } else {
        $star = intval($num) == 0 ? 1 : intval($num) * 5;
        $end = 5 * (intval($num) + 1);
    }

    return ['start' => $star, 'end' => $end];
}
//判断当前字符串是xml还是json
function IsXmlOrJson($str)
{
    if (is_xml($str)) {
        return "xml";
    } elseif (is_json($str)) {
        return "json";
    } else {
        return false;
    }
}
//判断当前字符串是否为xml
function is_xml($str)
{
    $xml_parser = xml_parser_create();
    if (!xml_parse($xml_parser, $str, true)) {
        xml_parser_free($xml_parser);
        return false;
    }
    return true;
}

//判断当前字符串是否为json
function is_json($str)
{
    $data = json_decode($str);
    if ($data && is_object($data)) {
        return true;
    }
    return false;
}

function curl_get($url, $proxy = "")
{
    $testurl = $url;
    $conputer_user_agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36";
    $mobile_user_agent = "Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345d Safari/600.1.4";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $testurl);
    //代理
    if ($proxy) {
        $proxy = array_filter(explode(":", $proxy));
        curl_setopt($ch, CURLOPT_PROXY, $proxy[0]);
        curl_setopt($ch, CURLOPT_PROXYPORT, $proxy[1]);
    }
    //参数为1表示传输数据，为0表示直接输出显示。
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, $conputer_user_agent);
    //参数为0表示不带头文件，为1表示带头文件
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $output = curl_exec($ch);
    $error_code = curl_errno($ch);
    $curl_info = curl_getinfo($ch);
    $host = parse_url($curl_info['url'])['host'] ?? "";
    $port = parse_url($curl_info['url'])['port'] ?? 80;
    curl_close($ch);
    if ($error_code || (!$output && $curl_info['http_code'] != 200)) {
        return json_encode(['status' => 1001, 'errno' => $error_code, "info" => "通讯失败", "host" => $host . ":" . $port]);
    }
    return $output;
}

function webconfig($key)
{
    if (\Illuminate\Support\Facades\Cache::has("webconfig")) {
        $config = json_decode(\Illuminate\Support\Facades\Cache::get("webconfig"), 1);
        return $config[$key] ?? "";
    }
    return "";
}

//检测播放地址
function checkeraddress($address)
{
    if (stripos($address, "http") !== false) {
        $urls = parse_url($address);
        $newurl = sprintf("%s://%s%s",$urls["scheme"]??"http",$urls["host"], $urls["path"]);
    } else {
        $newurl = $address;
    }
    $newurlarr = explode("slicetype", $newurl);
    $nowplay = config("ev.defaultplayer") . $newurlarr[0];
    $players = \App\Models\EvPlayer::get();
    foreach ($players as $player) {
        $playertype = in_array($player->type,config("ev.playertype"))?".{$player->type}.":$player->type;
        if (strpos($newurl, $playertype) !== false) {
            $nowplay = $player->url . $newurlarr[0];
            break;
        }
    }
    return $nowplay;
}

function ev_link()
{
    return \App\Models\EvLink::where(["status" => 1])->orderBy("sort", "desc")->get()->toArray();
}

function ev_source()
{
    return \App\Models\EvSource::where(["status" => 1])->get()->toArray();
}

//解析资源站的内容
function ContentParse($html)
{
    $htmltype = IsXmlOrJson($html);
    if ($htmltype == "xml") {
        $xml = @simplexml_load_string($html, null, LIBXML_NOCDATA);
        if (empty($xml)) {
            $labelRule = '<pic>' . "(.*?)" . '</pic>';
            $labelRule = '/' . str_replace('/', '\/', $labelRule) . '/is';
            preg_match_all($labelRule, $html, $temparr);
            $ec = false;
            foreach ($temparr[1] as $dd) {
                if (strpos($dd, '[CDATA') === false) {
                    $ec = true;
                    $ne = '<pic>' . '<![CDATA[' . $dd . ']]>' . '</pic>';
                    $html = str_replace('<pic>' . $dd . '</pic>', $ne, $html);
                }
            }
            if ($ec) {
                $xml = @simplexml_load_string($html, null, LIBXML_NOCDATA);
            }
            if (empty($xml)) {
                return ['code' => 1002, 'msg' => 'XML格式不正确'];
            }
        }
        return ["type" => "xml", "data" => $xml];
    } elseif ($htmltype == "json") {
        return ["type" => "json", "data" => json_decode($html, 1)];
    } else {
        return ['code' => 1002, 'msg' => '无效得数据类型'];
    }
}
