<?php
/**
 *Author:Syskey
 *Date:2021/11/25
 *Time:14:24
 **/


namespace EasyVod;


class Factory
{
    public static function factory($config)
    {
        $type = $config["type"];
        $domin = $config["domin"] ?? null;
        $typeconfig = $config["typeconfig"] ?? null;
        if ($type instanceof Collect) {
            return $type;
        } else {
            switch ($type) {
                case "qihu":
                    return new QhCollect($domin, $typeconfig);
                    break;
                case "weitang":
                    return new VtCollect($domin, $typeconfig);
                    break;
                case "source":
                    return new SourceCollect($domin,$typeconfig);
                    break;
                default:
                   throw new \RuntimeException("instance not is exits");
            }
        }
    }
}