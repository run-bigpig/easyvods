<?php
/**
 *Author:Syskey
 *Date:2021/12/30
 *Time:16:08
 **/


namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Models\EvSource;
use EasyVod\Facades\EasyVodFacade as Ev;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 首页
     */
    public function Index()
    {
        if (!file_exists(base_path("center/install.lock"))){
            return redirect("/install");
        }
        $listconfig = [
            ["channel" => "mv", "kind" => "all", "area" => "all", "pageno" => 1, "size" => 24],
            ["channel" => "tv", "kind" => "all", "area" => "all", "pageno" => 1, "size" => 24],
            ["channel" => "va", "kind" => "all", "area" => "all", "pageno" => 1, "size" => 24],
            ["channel" => "ct", "kind" => "all", "area" => "all", "pageno" => 1, "size" => 24],
        ];
        $vodlist = Ev::VodMultiList($listconfig);
        $bannerlist = Ev::VodBanner(["channel" => "mv"]);
        $ranklist = Ev::VodMultiRank();
        $vodtypename = ["mv" => "电影", "tv" => "电视剧", "va" => "综艺", "ct" => "动漫"];
        return view(webconfig("template") . ".views.index", ["vodlist" => $vodlist, "bannerlist" => $bannerlist, "ranklist" => $ranklist, "vodtypename" => $vodtypename]);
    }


    /**
     * @param $channel
     * @param $kind
     * @param $area
     * @param $year
     * @param $pageno
     * @return \Illuminate\View\View|\Laravel\Lumen\Application
     * 列表页
     */
    public function List($channel, $kind, $area, $year, $pageno)
    {
        $params = ["channel" => $channel, "kind" => $kind, "area" => $area, "year" => $year, "pageno" => $pageno, "size" => 24];
        $vodlist = Ev::VodList($params);
        $params["vodlist"] = $vodlist;
        return view(webconfig("template") . ".views.show", $params);
    }

    /**
     * @param $url
     * @return \Illuminate\View\View|\Laravel\Lumen\Application
     * 播放页
     */
    public function Play($url)
    {
        $nowplay = ["nowtype" => "", "nowaddress" => "", "nowurl" => "", "nowplay" => ""];
        if (strpos($url, "evnowplay@") !== FALSE) {
            list($mark, $nowtype, $nowurl, $nowaddress) = explode("@", $url);
            $nowplay["nowtype"] = $nowtype;
            $nowplay["nowaddress"] = base64_decode_plus($nowaddress);
            $nowplay["nowurl"] = $nowurl;
            $nowplay["nowplay"] = checkeraddress($nowplay["nowaddress"]);
            if (strpos($nowurl, "sourceids") !== false) {
                list($sourceid, $nowurl) = explode("$", $nowurl);
                $source = EvSource::find($sourceid);
                Ev::init(["type" => "source", "domin" => $source->url]);
            }
            $vod = Ev::VodPlay(["url" => $nowurl]);
        } else {
            $nowurl = $url;
            if (strpos($url, "sourceids") !== false) {
                list($sourceid, $url) = explode("$", $url);
                $source = EvSource::find($sourceid);
                Ev::init(["type" => "source", "domin" => $source->url]);
            }
            $vod = Ev::VodPlay(["url" => $url]);
            if (count($vod["play"]) > 0) {
                $nowplay["nowtype"] = $vod["play"][0]["type"];
                $nowplay["nowaddress"] = $vod["play"][0]["list"][0]["address"];
                $nowplay["nowurl"] = $nowurl;
                $nowplay["nowplay"] = checkeraddress($nowplay["nowaddress"]);
            }
        }

        return view(webconfig("template") . ".views.play", ["vodinfo" => $vod["info"], "vodplay" => $vod["play"], "nowplay" => $nowplay]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View|\Laravel\Lumen\Application
     * 搜索页
     */
    public function Search(Request $request)
    {
        $kw = $request->input("cz");
        if ($request->input("sourceid", false)) {
            $source = EvSource::find($request->input('sourceid'));
            Ev::init(["type" => "source", "domin" => $source->url]);
        }
        $vodlist = Ev::VodSearch(['key' => $kw]);
        return view(webconfig("template") . ".views.search", ["vodlist" => $vodlist, "kw" => $kw, "sourceid" => $request->input("sourceid", "")]);
    }

}
