<?php
/**
 *Author:Syskey
 *Date:2021/12/30
 *Time:17:03
 **/


namespace EasyVod;


use EasyVod\Units\FunctionUnit;

class SourceCollect implements Collect
{
    private $domin;
    private $typeconfig;

    public function __construct($domin, $typeconfig = [])
    {
        $this->domin = $domin;
        $this->typeconfig = $typeconfig;
    }

    public function VodMultiRank()
    {
        // TODO: Implement VodMultiRank() method.
    }

    public function VodMultiList()
    {
        // TODO: Implement VodMultiList() method.
    }

    public function VodRank()
    {
        // TODO: Implement VodRank() method.
    }

    public function VodList()
    {
        // TODO: Implement VodList() method.
    }

    public function VodSearch(array $params = [])
    {
        $vodlists = [];
        $params = ["wd" => $params["key"] ?? ""];
        $url = $this->domin . "?" . http_build_query($params);
        $result = FunctionUnit::http_request($url);
        $resultdata = FunctionUnit::ContentParse($result);
        if (isset($resultdata["type"]) && $resultdata["type"] == "xml") {
            $iddatas = $resultdata["data"];
            $ids = [];
            foreach ($iddatas->list->children() as $vod) {
                $ids[] = (string)$vod->id;
            }
            if (count($ids) > 0) {
                $url = $this->domin . "?" . http_build_query(["ids" => implode(",", $ids), "ac" => "videolist"]);
                $result = FunctionUnit::http_request($url);
                $datas = FunctionUnit::ContentParse($result);
                if (!FunctionUnit::blank($datas["data"])) {
                    foreach ($datas["data"]->list->children() as $data) {
                        $vodlist["url"] = FunctionUnit::UrlParse("sourceids/" . (string)$data->id);
                        $vodlist["img"] = (string)$data->pic ?? "";
                        $vodlist["title"] = (string)$data->name ?? "ew";
                        $vodlist["episode"] = (string)$data->note ?? "";
                        $vodlist["kind"] = (string)$data->type ?? "";
                        $vodlist["desc"] = (string)$data->des ?? "";
                        $vodlist["channel"] = (string)$data->type ?? "未知";
                        $vodlist["year"] = (string)$data->year ?? "2021";
                        $vodlist["score"] = rand(5, 9) . "." . rand(0, 9);
                        $vodlist["pay"] = $data["pay"] ?? 0;
                        $vodlists[] = $vodlist;
                    }
                }
            }
        } elseif (isset($resultdata["type"]) && $resultdata["type"] == "json") {
            $iddatas = $resultdata["data"];
            $ids = [];
            foreach ($iddatas["list"] as $vod) {
                $ids[] = $vod["vod_id"];
            }
            if (count($ids) > 0) {
                $url = $this->domin . "?" . http_build_query(["ids" => implode(",", $ids), "ac" => "videolist"]);
                $result = FunctionUnit::http_request($url);
                $datas = FunctionUnit::ContentParse($result);
                if (!FunctionUnit::blank($datas["data"])) {
                    foreach ($datas["data"]["list"] as $data) {
                        $vodlist["url"] = FunctionUnit::UrlParse("sourceids/" . $data["vod_id"]);
                        $vodlist["img"] = $data["vod_pic"] ?? "";
                        $vodlist["title"] = $data["vod_name"] ?? "ew";
                        $vodlist["episode"] = $data["vod_remarks"] ?? "";
                        $vodlist["kind"] = $data["vod_class"] ?? "";
                        $vodlist["desc"] = $data["vod_content"] ?? "";
                        $vodlist["channel"] = $data["type_name"] ?? "未知";
                        $vodlist["year"] = $data["vod_pubdate"] ?? "2021";
                        $vodlist["score"] = rand(5, 9) . "." . rand(0, 9);
                        $vodlist["pay"] = $data["pay"] ?? 0;
                        $vodlists[] = $vodlist;
                    }
                }
            }
        }
        return $vodlists;
    }

    public function VodPlay(array $params = [])
    {
        list($cat, $id) = explode("/", FunctionUnit::UrlParse($params["url"], false));
        $url = $this->domin . "?" . http_build_query(["ids" => $id, "ac" => "videolist"]);
        $result = FunctionUnit::http_request($url, "get");
        $info = [];
        $play = [];
        $resultdata = FunctionUnit::ContentParse($result);
        if (isset($resultdata["type"]) && $resultdata["type"] == "xml") {
            $detail = ((array)$resultdata["data"]->list->children())["video"];
            $info = ["title" => (string)$detail->name, "img" => (string)$detail->pic, "director" => (string)$detail->director, "actor" => (string)$detail->actor, "area" => (string)$detail->area, "kind" => (string)$detail->type, "desc" => (string)$detail->des];
            $play = FunctionUnit::PlayParse((string)$detail->dl->dd,(string)$detail->dl->dd->attributes()->flag);
        }elseif (isset($resultdata["type"]) && $resultdata["type"] == "json"){
            $detail = $resultdata["data"]["list"][0];
            $info = ["title" => $detail["vod_name"], "img" => $detail["vod_pic"], "director" => $detail["vod_director"], "actor" => $detail["vod_actor"], "area" => $detail["vod_area"], "kind" => $detail["vod_class"], "desc" => $detail["vod_content"]];
            $play = FunctionUnit::PlayParse($detail["vod_play_url"],$detail["vod_play_from"]);
        }
        return ["info" => $info, "play" => $play];
    }

    public function VodBanner()
    {
        // TODO: Implement VodBanner() method.
    }
}