<?php
/**
 *Author:Syskey
 *Date:2021/11/25
 *Time:14:30
 **/

namespace EasyVod\Facades;

use EasyVod\Factory;

class EasyVodFacade
{
    private static $ev;

    /**
     * @param string[] $config
     */
    public static function init($config = ["type" => "qihu"])
    {
        static::$ev = Factory::factory($config);
    }

    /**
     * @param array $params
     * @return mixed
     * 获取视频列表
     */
    public static function VodList(array $params = [])
    {
        return static::$ev->VodList($params);
    }

    /**
     * @param array $params
     * @return mixed
     * 同时获取多个不同频道的视频列表
     */
    public static function VodMultiList(array $params = [])
    {
        return static::$ev->VodMultiList($params);
    }

    /**
     * @param array $params
     * @return mixed
     * 获取视频列表
     */
    public static function VodRank(array $params = [])
    {
        return static::$ev->VodRank($params);
    }

    /**
     * @param array $params
     * @return mixed
     * 获取视频列表
     */
    public static function VodMultiRank(array $params = [])
    {
        return static::$ev->VodMultiRank($params);
    }



    /**
     * @param array $params
     * @return mixed
     * 获取播放页或者详情页内容
     */
    public static function VodPlay(array $params = [])
    {
        return static::$ev->VodPlay($params);
    }

    /**
     * @param array $params
     * @return mixed
     * 获取视频banner
     */
    public static function VodBanner(array $params = [])
    {
        return static::$ev->VodBanner($params);
    }

    /**
     * @param array $params
     * @return mixed
     * 获取搜索数据
     */
    public static function VodSearch(array $params = [])
    {
        return static::$ev->VodSearch($params);
    }

}