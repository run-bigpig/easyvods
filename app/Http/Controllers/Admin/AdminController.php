<?php
/**
 *Author:Syskey
 *Date:2021/12/30
 *Time:17:58
 **/


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\EvConfig;
use App\Models\EvLink;
use App\Models\EvPlayer;
use App\Models\EvSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function Index()
    {
        return view("easyvod.views.index");
    }

    //后台首页显示
    public function Console()
    {
        $source = EvSource::count();
        $link = EvLink::count();
        $player = EvPlayer::count();
        $number = rand(20000, 40000);
        return view("easyvod.views.console", ["source" => $source, "link" => $link, "player" => $player, "number" => $number]);
    }

    //网站基础配置
    public function WebConfig(Request $request)
    {
        if ($request->isMethod("get")) {
            $defaultconfig = ["name" => "easyvod", "logo" => "https://s3.bmp.ovh/imgs/2021/12/2b10e5863ed2cfae.png", "icp" => "xxxx", "email" => "admin@admin.com", "keywords" => "easyvod", "content" => "easyvod", "tj" => "xxxx", "notice" => "测试公告", "cache" => 1, "method" => "qihu", "template" => "dyxs", "status" => 1];
            $config = EvConfig::first();
            if (blank($config)) {
                EvConfig::Create($defaultconfig);
                $config = json_decode(json_encode($defaultconfig));
            }
            return view("easyvod.views.config", ["config" => $config]);
        }
        $config = $request->post();
        $res = EvConfig::first()->update($config);
        if ($res) {
            if ($config["method"] != webconfig("method") || $config["template"] != webconfig("template")) {
                Cache::flush();
            }
            Cache::forever("webconfig", json_encode($config));
            return response()->json(["code" => 0, "msg" => "更新成功"]);
        }
        return response()->json(["code" => 0, "msg" => "更新失败"]);
    }

    //友情链接
    public function Link(Request $request)
    {
        if ($request->isMethod("get")) {
            return view("easyvod.views.link");
        }
        $action = $request->input("action");
        switch ($action) {
            case "list":
                $query["where"] = $request->input("where");
                return EvLink::List($query);
                break;
            case "add":
                return EvLink::AddData($request->post());
                break;
            case "update":
                return EvLink::UpdateData($request->post());
                break;
            case "delete":
                return EvLink::DeleteData($request->post());
                break;
            default:
                return response()->json(["code" => 1, "msg" => "无效的执行动作"]);
        }
    }

    //播放器
    public function Player(Request $request)
    {
        if ($request->isMethod("get")) {
            $playerarr = config("ev.playertype");
            $players = EvSource::get()->pluck("type")->toArray();
            foreach ($players as $player) {
                $playerarr = array_merge($playerarr, mb_stripos($player, "#") === false ? [$player] : explode("#", $player));
            }
            return view("easyvod.views.player", ["playerarr" => $playerarr]);
        }
        $action = $request->input("action");
        switch ($action) {
            case "list":
                $query["where"] = $request->input("where");
                return EvPlayer::List($query);
                break;
            case "add":
                return EvPlayer::AddData($request->post());
                break;
            case "update":
                return EvPlayer::UpdateData($request->post());
                break;
            case "delete":
                return EvPlayer::DeleteData($request->post());
                break;
            default:
                return response()->json(["code" => 1, "msg" => "无效的执行动作"]);
        }
    }

    //资源站
    public function Source(Request $request)
    {
        if ($request->isMethod("get")) {
            return view("easyvod.views.source");
        }
        $action = $request->input("action");
        switch ($action) {
            case "list":
                $query["where"] = $request->input("where");
                return EvSource::List($query);
                break;
            case "add":
                $checker = $this->CheckSource($request->post());
                if ($checker["state"] === false) {
                    return response()->json($checker["msg"]);
                }
                $createdata = $request->post();
                $createdata["type"] = $checker["msg"];
                return EvSource::AddData($createdata);
                break;
            case "update":
                $checker = $this->CheckSource($request->post());
                if ($checker["state"] === false) {
                    return response()->json($checker["msg"]);
                }
                $updatedata = $request->post();
                $updatedata["type"] = $checker["msg"];
                return EvSource::UpdateData($updatedata);
                break;
            case "delete":
                return EvSource::DeleteData($request->post());
                break;
            default:
                return response()->json(["code" => 1, "msg" => "无效的执行动作"]);
        }
    }


    //检测资源站是否符合要求
    private function CheckSource($data)
    {
        $api = $data["url"] . "?wd=复仇者联盟";
        $result = curl_get($api);
        if (mb_strpos($result, "复仇者联盟") === FALSE) {
            return ["state" => false, "msg" => ["code" => 1, "msg" => "当前API不符合要求,请更换"]];
        }
        $playertype = false;
        $resultdata = ContentParse($result);
        if (isset($resultdata["type"]) && $resultdata["type"] == "xml") {
            $iddatas = $resultdata["data"];
            $ids = [];
            foreach ($iddatas->list->children() as $vod) {
                $ids[] = (string)$vod->id;
            }
            if (count($ids) > 0) {
                $url = $data["url"] . "?" . http_build_query(["ids" => implode(",", $ids), "ac" => "videolist"]);
                $result = curl_get($url);
                $datas = ContentParse($result);
                if (!blank($datas["data"])) {
                    $vod = ((array)$datas["data"]->list->children())["video"][0];
                    $playertype = (string)$vod->dl->dd->attributes()->flag;
                }
            }
        } elseif (isset($resultdata["type"]) && $resultdata["type"] == "json") {
            $iddatas = $resultdata["data"];
            $ids = [];
            foreach ($iddatas["list"] as $vod) {
                $ids[] = $vod["vod_id"];
            }
            if (count($ids) > 0) {
                $url = $data["url"] . "?" . http_build_query(["ids" => implode(",", $ids), "ac" => "videolist"]);
                $result = curl_get($url);
                $datas = ContentParse($result);
                if (!blank($datas["data"])) {
                    $vod = $datas["data"]["list"][0];
                    $playertype = $vod["vod_play_from"];
                }
            }
        }
        if (!$playertype) {
            return ["state" => false, "msg" => ["code" => 1, "msg" => "当前API没有播放器标识"]];
        }
        $typearr = mb_stripos($playertype, ",") !== false ? explode(",", $playertype) : explode("$$$", $playertype);
        return ["state" => true, "msg" => implode("#", $typearr)];
    }

    //网站缓存刷新
    public function WebCache(Request $request)
    {
        if ($request->isMethod("get")) {
            return view("easyvod.views.cache");
        }
        $urls = $request->post('urls');
        foreach ($urls as $url) {
            if ($url == "*") {
                Cache::flush();
                $config = EvConfig::first();
                Cache::forever("webconfig", json_encode($config));
                break;
            }
            Cache::forget(md5(trim($url, "/")));
        }
        return response()->json(["code" => 0, "msg" => "更新成功"]);
    }
}
