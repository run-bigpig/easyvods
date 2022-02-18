<?php
/**
 *Author:Syskey
 *Date:2021/11/25
 *Time:12:31
 **/


namespace EasyVod;

use EasyVod\Units\FunctionUnit;

class QhCollect implements Collect
{
    private $domin;
    private $typeconfig;

    public function __construct($domin, $typeconfig)
    {
        $this->domin = is_null($domin) ? "https://api.web.360kan.com/v1" : $domin;
        $this->typeconfig = is_null($typeconfig) ? [
            "channel" => ["mv" => 1, "tv" => 2, "va" => 3, "ct" => 4],
            "type" => [
                "mv" => [
                    "kind" => [
                        "all" => "",
                        "comedy" => "喜剧",
                        "love" => "爱情",
                        "action" => "动作",
                        "terrorist" => "恐怖",
                        "science" => "科幻",
                        "crime" => "犯罪",
                        "fantasy" => "奇幻",
                        "war" => "战争",
                        "animation" => "动画",
                        "suspense" => "悬疑",
                        "art" => "文艺",
                        "record" => "记录",
                        "biography" => "传记",
                        "singdance" => "歌舞",
                        "history" => "历史",
                        "other" => "其他"
                    ],
                    "area" => [
                        "all" => "",
                        "china" => "大陆",
                        "hongkong" => "香港",
                        "taiwan" => "台湾",
                        "korea" => "韩国",
                        "japan" => "日本",
                        "french" => "法国",
                        "britain" => "英国",
                        "germany" => "德国",
                        "thailand" => "泰国",
                        "india" => "印度",
                        "america" => "美国",
                        "other" => "其他"
                    ],
                    "year" => [
                        "all" => "",
                        "2007" => 2007,
                        "2008" => 2008,
                        "2009" => 2009,
                        "2010" => 2010,
                        "2011" => 2011,
                        "2012" => 2012,
                        "2013" => 2013,
                        "2014" => 2014,
                        "2015" => 2015,
                        "2016" => 2016,
                        "2017" => 2017,
                        "2018" => 2018,
                        "2019" => 2019,
                        "2020" => 2020,
                        "2021" => 2021,
                        "other" => "lt_year"
                    ]
                ],
                "tv" => [
                    "kind" => [
                        "all" => "",
                        "love" => "言情",
                        "plot" => "剧情",
                        "comedy" => "喜剧",
                        "suspense" => "悬疑",
                        "city" => "都市",
                        "idol" => "偶像",
                        "ancient" => "古装",
                        "war" => "军事",
                        "police" => "警匪",
                        "history" => "历史",
                        "motivational" => "励志",
                        "myth" => "神话",
                        "spy" => "谍战",
                        "youth" => "青春",
                        "home" => "家庭",
                        "action" => "动作",
                        "scenario" => "情景",
                        "wuxia" => "武侠",
                        "science" => "科幻",
                        "other" => "其他"
                    ],
                    "area" => [
                        "all" => "",
                        "china" => "内地",
                        "hongkong" => "香港",
                        "taiwan" => "台湾",
                        "korea" => "韩国",
                        "japan" => "日本",
                        "french" => "法国",
                        "britain" => "英国",
                        "germany" => "德国",
                        "thailand" => "泰国",
                        "india" => "印度",
                        "america" => "美国",
                        "singapore" => "新加披",
                        "other" => "其他"
                    ],
                    "year" => [
                        "all" => "",
                        "2007" => 2007,
                        "2008" => 2008,
                        "2009" => 2009,
                        "2010" => 2010,
                        "2011" => 2011,
                        "2012" => 2012,
                        "2013" => 2013,
                        "2014" => 2014,
                        "2015" => 2015,
                        "2016" => 2016,
                        "2017" => 2017,
                        "2018" => 2018,
                        "2019" => 2019,
                        "2020" => 2020,
                        "2021" => 2021,
                        "other" => "lt_year"
                    ]
                ],
                "va" => [
                    "kind" => [
                        "all" => "",
                        "talk" => "脱口秀",
                        "reality" => "真人秀",
                        "funny" => "搞笑",
                        "draft" => "选秀",
                        "gossip" => "八卦",
                        "interview" => "访谈",
                        "emotion" => "情感",
                        "life" => "生活",
                        "party" => "晚会",
                        "music" => "音乐",
                        "workplace" => "职场",
                        "food" => "美食",
                        "fashion" => "时尚",
                        "game" => "游戏",
                        "child" => "少儿",
                        "sports" => "体育",
                        "event" => "纪实",
                        "edu" => "科教",
                        "quyi" => "曲艺",
                        "singdance" => "歌舞",
                        "economic" => "财经",
                        "car" => "汽车",
                        "broadcast" => "播报",
                        "other" => "其他"
                    ],
                    "area" => [
                        "all" => "",
                        "china" => "大陆",
                        "hongkong" => "香港",
                        "taiwan" => "台湾",
                        "eu" => "欧美",
                        "japan" => "日本",
                    ],
                    "year" => [
                        "all" => "",
                        "2007" => 2007,
                        "2008" => 2008,
                        "2009" => 2009,
                        "2010" => 2010,
                        "2011" => 2011,
                        "2012" => 2012,
                        "2013" => 2013,
                        "2014" => 2014,
                        "2015" => 2015,
                        "2016" => 2016,
                        "2017" => 2017,
                        "2018" => 2018,
                        "2019" => 2019,
                        "2020" => 2020,
                        "2021" => 2021,
                        "other" => "lt_year"
                    ]
                ],
                "ct" => [
                    "kind" => [
                        "all" => "",
                        "blood" => "热血",
                        "science" => "科幻",
                        "girl" => "美少女",
                        "magic" => "魔幻",
                        "classic" => "经典",
                        "motivational" => "励志",
                        "child" => "少儿",
                        "adventure" => "冒险",
                        "funny" => "搞笑",
                        "reason" => "推理",
                        "love" => "恋爱",
                        "cure" => "治愈",
                        "fantasy" => "幻想",
                        "school" => "校园",
                        "animal" => "动物",
                        "zero" => "机战",
                        "qingzi" => "亲子",
                        "childrensong" => "儿歌",
                        "movement" => "运动",
                        "suspense" => "悬疑",
                        "monster" => "怪物",
                        "war" => "战争",
                        "puzzle" => "益智",
                        "fairytale" => "童话",
                        "compete" => "竞技",
                        "action" => "动作",
                        "society" => "社会",
                        "friendship" => "友情",
                        "realpeople" => "真人版",
                        "movie" => "电影版",
                        "ova" => "OVA版",
                        "tv" => "TV版",
                        "newanime" => "新番动画",
                        "finishanime" => "完结动画"
                    ],
                    "area" => [
                        "all" => "",
                        "china" => "大陆",
                        "america" => "美国",
                        "japan" => "日本",
                    ],
                    "year" => [
                        "all" => "",
                        "2007" => 2007,
                        "2008" => 2008,
                        "2009" => 2009,
                        "2010" => 2010,
                        "2011" => 2011,
                        "2012" => 2012,
                        "2013" => 2013,
                        "2014" => 2014,
                        "2015" => 2015,
                        "2016" => 2016,
                        "2017" => 2017,
                        "2018" => 2018,
                        "2019" => 2019,
                        "2020" => 2020,
                        "2021" => 2021,
                        "other" => "lt_year"
                    ]
                ],

            ]
        ] : $typeconfig;
    }

    public function VodList(array $params = [])
    {
        $vodlists = [];
        $query = ["pageno" => $params["pageno"] ?? 1, "catid" => FunctionUnit::ParseConfig($this->typeconfig, $params["channel"]), "rank" => "rankhot", "area" => FunctionUnit::ParseConfig($this->typeconfig, $params["channel"], "area", $params["area"]), "cat" => FunctionUnit::ParseConfig($this->typeconfig, $params["channel"], "kind", $params["kind"]), "year" => FunctionUnit::ParseConfig($this->typeconfig, $params["channel"], "year", $params["year"]), "size" => $params["size"] ?? 35, "act" => $params["act"] ?? ""];
        $url = $this->domin . "/filter/list?" . http_build_query($query);
        $result = FunctionUnit::http_request($url, "get");
        $datas = json_decode($result, 1);
        if ($datas && $datas["errno"] == 0&&!empty($datas["data"])) {
            foreach ($datas["data"]["movies"] as $data) {
                $vodlist["url"] = FunctionUnit::UrlParse($query["catid"] . "/" . $data["id"]);
                $vodlist["img"] = $data["cdncover"] ?? "";
                $vodlist["title"] = $data["title"] ?? "easyvod";
                $vodlist["episode"] = $data["upinfo"] ?? "";
                $vodlist["year"] = $data["year"] ?? "2021";
                $vodlist["score"] = rand(5, 9) . "." . rand(0, 9);
                $vodlist["pay"] = $data["payment"] ?? 0;
                $vodlists[] = $vodlist;
            }
        }
        return $vodlists;
    }

    public function VodMultiList(array $paramslist = [])
    {
        $vodlists = [];
        $url = [];
        foreach ($paramslist as $params) {
            $query = ["pageno" => $params["pageno"] ?? 1, "catid" => FunctionUnit::ParseConfig($this->typeconfig, $params["channel"]), "rank" => "rankhot", "area" => FunctionUnit::ParseConfig($this->typeconfig, $params["channel"], "area", $params["area"]), "cat" => FunctionUnit::ParseConfig($this->typeconfig, $params["channel"], "kind", $params["kind"]), "year" => $params["year"] ?? "", "size" => $params["size"] ?? 35, "act" => $params["act"] ?? ""];
            $url[$params["channel"]] = $this->domin . "/filter/list?" . http_build_query($query);
        }
        $results = FunctionUnit::http_multi($url);
        foreach ($results as $key => $result) {
            $datas = json_decode($result, 1);
            if ($datas && $datas["errno"] == 0&&!empty($datas["data"])) {
                $temp = [];
                foreach ($datas["data"]["movies"] as $data) {
                    $vodlist["url"] = FunctionUnit::UrlParse(FunctionUnit::ParseConfig($this->typeconfig, $key) . "/" . $data["id"]);
                    $vodlist["img"] = $data["cdncover"] ?? "";
                    $vodlist["title"] = $data["title"] ?? "easyvod";
                    $vodlist["episode"] = $data["upinfo"] ?? "";
                    $vodlist["year"] = $data["year"] ?? "2021";
                    $vodlist["score"] = rand(5, 9) . "." . rand(0, 9);
                    $vodlist["pay"] = $data["payment"] ?? 0;
                    $temp[] = $vodlist;
                }
                $vodlists[$key] = $temp;
            }
        }
        return $vodlists;
    }

    public function VodRank(array $params = [])
    {
        $vodlists = [];
        $catids = ["mv"=>2,"tv"=>3,"va"=>4,"ct"=>5];
        $catid = $catids[$params["channel"]??"mv"];
        $url = $this->domin."/rank?".http_build_query(["cat"=>$catid]);
        $result = FunctionUnit::http_request($url, "get");
        $datas = json_decode($result, 1);
        if ($datas && $datas["errno"] == 0&&!empty($datas["data"])) {
            foreach ($datas["data"] as $data) {
                $vodlist["url"] = FunctionUnit::UrlParse($data["cat"] . "/" . $data["ent_id"]);
                $vodlist["img"] = $data["cover"] ?? "";
                $vodlist["title"] = $data["title"] ?? "easyvod";
                $vodlist["episode"] = $data["upinfo"] ?? "";
                $vodlist["year"] = $data["year"] ?? "2021";
                $vodlist["score"] = rand(5, 9) . "." . rand(0, 9);
                $vodlist["pay"] = $data["vip"] ?? 0;
                $vodlists[] = $vodlist;
            }
        }
        return $vodlists;
    }

    public function VodMultiRank(array $params = [])
    {
        $vodlists = [];
        $urls = [];
        $catids = ["mv"=>2,"tv"=>3,"va"=>4,"ct"=>5];
        foreach ($catids as $key=>$catid){
            $urls[$key] = $this->domin."/rank?".http_build_query(["cat"=>$catid]);
        }
        $results = FunctionUnit::http_multi($urls);
        foreach ($results as $key=>$result){
            $datas = json_decode($result, 1);
            if ($datas && $datas["errno"] == 0&&!empty($datas["data"])) {
                $temp = [];
                foreach ($datas["data"] as $data) {
                    $vodlist["url"] = FunctionUnit::UrlParse($data["cat"] . "/" . $data["ent_id"]);
                    $vodlist["img"] = $data["cover"] ?? "";
                    $vodlist["title"] = $data["title"] ?? "easyvod";
                    $vodlist["episode"] = $data["upinfo"] ?? "";
                    $vodlist["year"] = $data["year"] ?? "2021";
                    $vodlist["score"] = rand(5, 9) . "." . rand(0, 9);
                    $vodlist["pay"] = $data["vip"] ?? 0;
                    $temp[] = $vodlist;
                }
                $vodlists[$key] = $temp;
            }
        }
        return $vodlists;
    }

    public function VodPlay(array $params = [])
    {
        list($cat, $id) = explode("/", FunctionUnit::UrlParse($params["url"], false));
        $url = $this->domin . "/detail?" . http_build_query(["cat" => $cat, "id" => $id]);
        $result = FunctionUnit::http_request($url, "get");
        $data = json_decode($result, 1);
        $info = [];
        $play = [];
        if ($data && $data["errno"] == 0) {
            $detail = $data["data"];
            $info = ["title" => $detail["title"], "img" => $detail["cdncover"], "director" => implode("/", $detail["director"]), "actor" => implode("/", $detail["actor"]), "area" => implode("/", $detail["area"]), "kind" => implode("/", $detail["moviecategory"]), "desc" => $detail["description"]];
            if (in_array($cat, [2,3,4])) {
                $playurl = [];
                if (isset($detail["allupinfo"]) && !empty($detail["allupinfo"])) {
                    foreach ($detail["allupinfo"] as $site => $end) {
                        $playurl[$site] = $this->domin . "/detail?" . http_build_query(["cat" => $cat, "id" => $id, "start" => 1, "end" => (int)$end - 1, "site" => $site]);
                    }
                    $playdatas = FunctionUnit::http_multi($playurl);
                    foreach ($playdatas as $type => $playdata) {
                        $playdataarr = json_decode($playdata, 1);
                        if ($playdataarr["errno"] != 0) {
                            continue;
                        }
                        $temp["type"] = $type;
                        $templist = [];
                        if ($cat==3){
                            foreach ($playlistdata = $playdataarr["data"]["defaultepisode"] as $link) {
                                $templist[] = ["episode" => $link["pubdate"], "address" => $link["url"]];
                            }
                        }else{
                            foreach ($playdataarr["data"]["allepidetail"][$type] as $link) {
                                $templist[] = ["episode" => $link["playlink_num"], "address" => $link["url"]];
                            }
                        }
                        $temp["list"] = $templist;
                        $play[] = $temp;
                    }
                }
            } else {
                foreach ($detail["playlinksdetail"] as $type => $link) {
                    $temp["type"] = $type;
                    $temp["list"] = [["episode" => $link["site"], "address" => $link["default_url"]]];
                    $play[] = $temp;
                }
            }
        }
        return ["info" => $info, "play" => $play];
    }

    public function VodBanner(array $params = [])
    {
        $bannerlists = [];
        $channel = $params["channel"] ?? "mv";
        $blockid = ["mv" => 99, "tv" => 503, "va" => 227, "ct" => 79];
        $url = $this->domin . "/block?blockid=" . (isset($blockid[$channel]) ? $blockid[$channel] : 99);
        $result = FunctionUnit::http_request($url, "get");
        $datas = json_decode($result, 1);
        if ($datas && $datas["errno"] == 0) {
            foreach ($datas["data"]["lists"] as $data) {
                $bannerlist = [];
                $bannerlist["url"] = FunctionUnit::UrlParse($data["cat"] . "/" . $data["ent_id"]);
                $bannerlist["title"] = $data["title"] ?? "easyvod";
                $bannerlist["img"] = $data["pic_lists"][0]["url"] ?? "";
                $bannerlists[] = $bannerlist;
            }
        }
        return $bannerlists;
    }

    public function VodSearch(array $params = [])
    {
        $vodlists = [];
        $params = ["kw" => $params["key"] ?? "", "pageno" => $params["pageno"] ?? 1];
        $url = "https://api.so.360kan.com/index?" . http_build_query($params);
        $result = FunctionUnit::http_request($url, "get");
        $datas = json_decode($result, 1);
        if ($datas && $datas["code"] == 0) {
            foreach ($datas["data"]["longData"]["rows"] as $data) {
                $vodlist["url"] = FunctionUnit::UrlParse($data["cat_id"] . "/" . $data["en_id"]);
                $vodlist["img"] = $data["cover"] ?? "";
                $vodlist["title"] = $data["titleTxt"] ?? "easyvod";
                $vodlist["episode"] = $data["upinfo"] ?? 0;
                $vodlist["kind"] = isset($data["tag"])?implode("/",$data["tag"]):"";
                $vodlist["channel"] = $data["cat_name"]??"未知";
                $vodlist["desc"] = $data["description"]??"";
                $vodlist["year"] = $data["year"] ?? "2021";
                $vodlist["score"] = rand(5, 9) . "." . rand(0, 9);
                $vodlist["pay"] = $data["vip"] ?? 0;
                $vodlists[] = $vodlist;
            }
        }
        return $vodlists;
    }
}