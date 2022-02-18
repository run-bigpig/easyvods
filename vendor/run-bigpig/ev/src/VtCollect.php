<?php
/**
 *Author:Syskey
 *Date:2021/11/25
 *Time:14:27
 **/


namespace EasyVod;


use EasyVod\Units\FunctionUnit;
use QL\QueryList;

class VtCollect implements Collect
{
    private $domin;
    private $typeconfig;
    private $ql;

    public function __construct($domin, $typeconfig)
    {
        $this->domin = is_null($domin) ? "http://www.dmkan.com" : $domin;
        $this->typeconfig = is_null($typeconfig) ? [
            "channel" => ["mv" => "movie", "tv" => "tv", "va" => "show", "ct" => "comic"],
            "type" => [
                "mv" => [
                    "kind" => [
                        "all" => "all",
                        "comedy" => 1,
                        "love" => 2,
                        "action" => 3,
                        "terrorist" => 4,
                        "science" => 5,
                        "crime" => 7,
                        "fantasy" => 8,
                        "war" => 9,
                        "animation" => 11,
                        "suspense" => 10,
                        "art" => 12,
                        "record" => 14,
                        "biography" => 15,
                        "singdance" => 16,
                        "history" => 18,
                        "other" => "other"
                    ],
                    "area" => [
                        "all" => "all",
                        "china" => 1,
                        "hongkong" => 2,
                        "taiwan" => 9,
                        "korea" => 4,
                        "japan" => 5,
                        "french" => 6,
                        "britain" => 7,
                        "germany" => 8,
                        "thailand" => 10,
                        "india" => 11,
                        "america" => 3,
                        "other" => "other"
                    ],
                    "year" => [
                        "all" => "all",
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
                        "other" => "other"
                    ]
                ],
                "tv" => [
                    "kind" => [
                        "all" => "all",
                        "love" => 1,
                        "comedy" => 3,
                        "suspense" => 4,
                        "city" => 5,
                        "idol" => 6,
                        "ancient" => 7,
                        "war" => 8,
                        "police" => 9,
                        "history" => 10,
                        "motivational" => 16,
                        "myth" => 17,
                        "spy" => 18,
                        "cantonese" => 19,
                        "action" => 15,
                        "scenario" => 14,
                        "wuxia" => 11,
                        "science" => 12,
                        "courte" => 13,
                        "other" => "other"
                    ],
                    "area" => [
                        "all" => "all",
                        "china" => 1,
                        "hongkong" => 5,
                        "taiwan" => 3,
                        "korea" => 4,
                        "japan" => 6,
                        "britain" => 8,
                        "thailand" => 9,
                        "america" => 7,
                        "singapore" => 2,
                        "other" => "other"
                    ],
                    "year" => [
                        "all" => "all",
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
                        "other" => "other"
                    ]
                ],
                "va" => [
                    "kind" => [
                        "all" => "all",
                        "funny" => 7,
                        "draft" => 1,
                        "gossip" => 2,
                        "interview" => 3,
                        "emotion" => 4,
                        "life" => 5,
                        "party" => 6,
                        "music" => 8,
                        "fashion" => 9,
                        "game" => 10,
                        "child" => 11,
                        "sports" => 12,
                        "event" => 13,
                        "edu" => 14,
                        "quyi" => 15,
                        "singdance" => 16,
                        "economic" => 17,
                        "car" => 18,
                        "broadcast" => 19,
                        "other" => "other"
                    ],
                    "area" => [
                        "all" => "all",
                        "china" => 1,
                        "hongkong" => 6,
                        "taiwan" => 2,
                        "eu" => 5,
                        "japan" => 4,
                        "korea" => 3,
                        "other" => "other"
                    ],
                    "year" => [
                        "all" => "all",
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
                        "other" => "other"
                    ]
                ],
                "ct" => [
                    "kind" => [
                        "all" => "all",
                        "blood" => 1,
                        "youth" => 25,
                        "girl" => 3,
                        "magic" => 10,
                        "adult" => 20,
                        "loli" => 24,
                        "child" => 12,
                        "adventure" => 8,
                        "funny" => 6,
                        "boyto" => 26,
                        "love" => 2,
                        "girlto" => 27,
                        "fantasy" => 7,
                        "school" => 5,
                        "animal" => 11,
                        "zero" => 14,
                        "qingzi" => 13,
                        "movement" => 4,
                        "suspense" => 9,
                        "monster" => 15,
                        "war" => 17,
                        "puzzle" => 16,
                        "fairytale" => 23,
                        "compete" => 21,
                        "action" => 28,
                        "society" => 18,
                        "friendship" => 19,
                        "realpeople" => 29,
                        "movie" => 32,
                        "ova" => 75,
                        "tv" => 31,
                        "newanime" => 33,
                        "finishanime" => 34,
                        "other" => "other",
                    ],
                    "area" => [
                        "all" => "all",
                        "china" => 1,
                        "america" => 2,
                        "japan" => 3,
                        "other" => "other",
                    ],
                    "year" => [
                        "all" => "all",
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
                        "other" => "other"
                    ]
                ],
            ]
        ] : $typeconfig;
        $this->ql = new QueryList();
    }

    public function VodList(array $params = [])
    {
        $vodlists = [];
        $query = ["pageno" => $params["pageno"] ?? 1, "channel" => FunctionUnit::ParseConfig($this->typeconfig, $params["channel"]), "area" => FunctionUnit::ParseConfig($this->typeconfig, $params["channel"], "area", $params["area"]), "kind" => FunctionUnit::ParseConfig($this->typeconfig, $params["channel"], "kind", $params["kind"]), "year" => FunctionUnit::ParseConfig($this->typeconfig, $params["channel"], "year", $params["year"]), "pay" => "all", "callback" => "vtlist"];
        $url = $this->domin . "/data/v/get_program_list.php" . "?" . http_build_query($query);
        $result = FunctionUnit::http_request($url);
        $datas = FunctionUnit::jsonp_decode($result, 1);
        if ($datas && isset($datas["list"])) {
            foreach ($datas["list"] as $data) {
                $vodlist["url"] = FunctionUnit::UrlParse($data["url"] ?? "");
                $vodlist["img"] = $data["img"] ?? "";
                $vodlist["title"] = $data["title"] ?? "easyvod";
                $vodlist["episode"] = $data["episode"] ?? "";
                $vodlist["pay"] = $data["pay"] ?? 0;
                $vodlist["year"] = $data["year"] ?? "2021";
                $vodlist["score"] =  rand(5, 9) . "." . rand(0, 9);
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
            $query = ["pageno" => $params["pageno"] ?? 1, "channel" => FunctionUnit::ParseConfig($this->typeconfig, $params["channel"]), "area" => FunctionUnit::ParseConfig($this->typeconfig, $params["channel"], "area", $params["area"]), "kind" => FunctionUnit::ParseConfig($this->typeconfig, $params["channel"], "kind", $params["kind"]), "year" => $params["year"] ?? "all", "pay" => "all", "callback" => "vtlist"];
            $url[$params["channel"]] = $this->domin . "/data/v/get_program_list.php" . "?" . http_build_query($query);
        }
        $results = FunctionUnit::http_multi($url);
        foreach ($results as $key => $result) {
            $datas = FunctionUnit::jsonp_decode($result, 1);
            if ($datas && isset($datas["list"])) {
                $temp = [];
                foreach ($datas["list"] as $data) {
                    $vodlist["url"] = FunctionUnit::UrlParse($data["url"] ?? "");
                    $vodlist["img"] = $data["img"] ?? "";
                    $vodlist["title"] = $data["title"] ?? "ew";
                    $vodlist["episode"] = $data["episode"] ?? "";
                    $vodlist["pay"] = $data["pay"] ?? 0;
                    $vodlist["year"] = $data["year"] ?? "2021";
                    $vodlist["score"] =  rand(5, 9) . "." . rand(0, 9);
                    $temp[] = $vodlist;
                }
                $vodlists[$key] = $temp;
            }
        }
        return $vodlists;
    }

    public function VodRank(array $params = [])
    {
        $ranklists = [];
        $channel = $params["channel"] ?? "mv";
        $blockid = ["mv" => "movie", "tv" => "tv", "va" => "show", "ct" => "comic"];
        $url = $this->domin . "/data/v/get_index_data.php?callback=rank&ch=" . (isset($blockid[$channel]) ? $blockid[$channel] : "movie");
        $result = FunctionUnit::http_request($url, "get");
        $datas = FunctionUnit::jsonp_decode($result, 1);
        if (isset($datas["modules"])) {
            foreach ($datas["modules"][1]["blocks"][0]["block_item"] as $data) {
                $ranklist = [];
                $ranklist["url"] = FunctionUnit::UrlParse($data["url"] ?? "");
                $ranklist["title"] = $data["title"] ?? "easyvod";
                $ranklist["img"] = $data["img"] ?? "";
                $ranklist["episode"] = $data["episode"] ?? "";
                $ranklist["year"] = $data["year"] ?? "2021";
                $ranklist["score"] =  rand(5, 9) . "." . rand(0, 9);
                $ranklist["pay"] = $data["pay"] ?? 0;
                $ranklists[] = $ranklist;
            }
        }
        return $ranklists;
    }

    public function VodMultiRank()
    {
        $ranklists = [];
        $urls = [];
        $blockids = ["mv" => "movie", "tv" => "tv", "va" => "show", "ct" => "comic"];
        foreach ($blockids as $key => $blockid) {
            $urls[$key] = $this->domin . "/data/v/get_index_data.php?callback=rank&ch=" . $blockid;
        }
        $results = FunctionUnit::http_multi($urls);
        foreach ($results as $key => $result) {
            $datas = FunctionUnit::jsonp_decode($result, 1);
            if (isset($datas["modules"])) {
                $temp = [];
                foreach ($datas["modules"][1]["blocks"][0]["block_item"] as $data) {
                    $ranklist = [];
                    $ranklist["url"] = FunctionUnit::UrlParse($data["url"] ?? "");
                    $ranklist["title"] = $data["title"] ?? "easyvod";
                    $ranklist["img"] = $data["img"] ?? "";
                    $ranklist["episode"] = $data["episode"] ?? "";
                    $ranklist["year"] = $data["year"] ?? "2021";
                    $ranklist["score"] =  rand(5, 9) . "." . rand(0, 9);
                    $ranklist["pay"] = $data["pay"] ?? 0;
                    $temp[] = $ranklist;
                }
                $ranklists[$key] = $temp;
            }
        }

        return $ranklists;
    }

    public function VodPlay(array $params = [])
    {
        $url = $this->domin . FunctionUnit::UrlParse($params["url"], false) . ".html";
        $qlhtml = $this->ql->get($url);
        $inforules = [
            "range" => null,
            "rules" => [
                "title" => [".program .program-title", "text"],
                "img" => [".program .poster>img", "src"],
                "director" => ["#host>.info-all", "_val"],
                "actor" => ["#actor>.info-all", "_val"],
                "area" => ["#area", "text"],
                "kind" => ["#kind", "text"],
                "desc" => ["#intro>.info-all", "_val"]
            ]
        ];
        $infodata = $qlhtml->range($inforules["range"])->rules($inforules["rules"])->removeHead()->queryData();
        if (strpos($params["url"], "movie") !== FALSE) {
            $playrules = [
                "range" => ".action>.action-box",
                "rules" => [
                    "type" => ["", "id"],
                    "list" => [".program-play-btn-box", "html"]
                ]
            ];
            $listrules = [
                "range" => "a",
                "rules" => [
                    "episode" => ["", "id", "", function ($coment) {
                        return str_replace("program-play-btn-", "", $coment);
                    }],
                    "address" => ["", "href"]
                ]
            ];
        } else {
            $playrules = [
                "range" => ".content>.episodes",
                "rules" => [
                    "type" => ["", "id", "", function ($coment) {
                        return str_replace("-episode", "", $coment);
                    }],
                    "list" => [".video-list", "html"]
                ]
            ];
            $listrules = [
                "range" => ".video-item",
                "rules" => [
                    "episode" => ["a>div", "text"],
                    "address" => ["a", "href"]
                ]
            ];
        }
        $playdata = $qlhtml->range($playrules["range"])->rules($playrules["rules"])->removeHead()->queryData(function ($item) use ($listrules) {
            $item['list'] = $this->ql->html($item["list"])->range($listrules["range"])->rules($listrules["rules"])->queryData();
            return $item;
        });
        return ["info" => $infodata, "play" => $playdata];
    }

    public function VodBanner(array $params = [])
    {
        $bannerlists = [];
        $channel = $params["channel"] ?? "mv";
        $blockid = ["mv" => "movie", "tv" => "tv", "va" => "show", "ct" => "comic"];
        $url = $this->domin . "/data/v/get_index_data.php?callback=banner&ch=" . (isset($blockid[$channel]) ? $blockid[$channel] : "movie");
        $result = FunctionUnit::http_request($url, "get");
        $datas = FunctionUnit::jsonp_decode($result, 1);
        if (isset($datas["modules"])) {
            foreach ($datas["modules"][0]["blocks"][0]["banner_item"] as $data) {
                $bannerlist = [];
                $bannerlist["url"] = FunctionUnit::UrlParse($data["url"] ?? "");
                $bannerlist["title"] = $data["title"] ?? "easyvod";
                $bannerlist["img"] = $data["img"] ?? "";
                $bannerlists[] = $bannerlist;
            }
        }
        return $bannerlists;
    }

    public function VodSearch(array $params = [])
    {
        $vodlists = [];
        $params = ["keyword" => $params["key"] ?? "", "host" => "www.dmkan.com", "callback" => "search"];
        $url = $this->domin . "/data/s/get_search_result.php?" . http_build_query($params);
        $result = FunctionUnit::http_request($url, "get");
        $datas = FunctionUnit::jsonp_decode($result, 1);
        if (!FunctionUnit::blank($datas)) {
            foreach ($datas as $data) {
                $vodlist["url"] = FunctionUnit::UrlParse($data["programUrl"] ?? "");
                $vodlist["img"] = $data["poster"] ?? "";
                $vodlist["title"] = $data["title"] ?? "ew";
                $vodlist["episode"] = $data["max_episode"] ?? "";
                $vodlist["kind"] = isset($data["kinds"]) ? implode("/", $data["kinds"]) : "";
                $vodlist["desc"] = $data["intro"] ?? "";
                $vodlist["channel"] = $data["channel"] ?? "未知";
                $vodlist["year"] = $data["pubyear"] ?? "2021";
                $vodlist["score"] =  rand(5, 9) . "." . rand(0, 9);
                $vodlist["pay"] = $data["pay"] ?? 0;
                $vodlists[] = $vodlist;
            }
        }
        return $vodlists;
    }
}