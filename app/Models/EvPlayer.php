<?php
/**
 *Author:Syskey
 *Date:2021/12/29
 *Time:19:09
 **/


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class EvPlayer extends Model
{

    protected $fillable = ["name","url","type"];

    public static function List($query)
    {
        $pageNum = $query["page"] ?? 1;
        $limit = $query["limit"] ?? 1000;
        $where = blank($query["where"] ?? null) ? false : $query["where"];
        $page = $pageNum - 1;
        if ($page != 0) {
            $page = $limit * $page;
        }
        $count = 0;
        $data = [];
        $dataobj = self::when($where, function ($q) use ($where) {
            return $q->where($where);
        });
        $count = $dataobj->count();
        $data = $dataobj->offset($page)->limit($limit)->get();
        return response()->json(['code' => 0, 'msg' => '获取成功', 'count' => $count, 'data' => $data]);
    }

    public static function AddData($data)
    {
        $createdata["name"] = $data["name"] ?? "easyvod";
        $createdata["url"] = $data["url"] ?? "http://www.baidu.com";
        $createdata["type"] = $data["type"] ?? "m3u8";
        $res = self::Create($createdata);
        if ($res) {
            return response()->json(["code" => 0, "msg" => "创建成功"]);
        }
        return response()->json(["code" => 1, "msg" => "创建失败"]);
    }

    public static function UpdateData($data)
    {
        $id = $data["id"];
        $updatedata["name"] = $data["name"] ?? "easyvod";
        $updatedata["url"] = $data["url"] ?? "http://www.baidu.com";
        $updatedata["type"] = $data["type"] ?? "m3u8";
        $res = self::find($id)->update($updatedata);
        if ($res) {
            return response()->json(["code" => 0, "msg" => "更新成功"]);
        }
        return response()->json(["code" => 1, "msg" => "更新失败"]);
    }

    public static function DeleteData($data)
    {
        $id = $data["id"];
        $res = self::find($id)->delete();
        if ($res) {
            return response()->json(["code" => 0, "msg" => "删除成功"]);
        }
        return response()->json(["code" => 1, "msg" => "删除失败"]);
    }

}
