-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-01-04 15:49:43
-- 服务器版本： 8.0.24
-- PHP 版本： 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `easyvods`
--

-- --------------------------------------------------------

--
-- 表的结构 `ev_admins`
--

CREATE TABLE `ev_admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '账号名称',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `nowloginip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '当前登录IP',
  `nowlogintime` datetime DEFAULT NULL COMMENT '当前登录时间',
  `lastloginip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '上次登录IP',
  `lastlogintime` datetime DEFAULT NULL COMMENT '上次登录时间',
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'token',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `ev_admins`
--

INSERT INTO `ev_admins` (`id`, `name`, `password`, `nowloginip`, `nowlogintime`, `lastloginip`, `lastlogintime`, `api_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '172.18.36.101', '2022-01-04 15:45:11', '172.18.36.101', '2022-01-04 15:44:16', 'iJDFAAitdsuecra2KuZw', '2021-12-29 15:43:06', '2022-01-04 15:45:11');

-- --------------------------------------------------------

--
-- 表的结构 `ev_configs`
--

CREATE TABLE `ev_configs` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'EasyVod' COMMENT '网站名称',
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '网站logo',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin@easyvods.com' COMMENT '站长邮箱',
  `icp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ICP',
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'easyvod' COMMENT '网站关键字',
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'easyvod' COMMENT '网站描述',
  `tj` mediumtext COLLATE utf8mb4_unicode_ci COMMENT '统计代码',
  `notice` mediumtext COLLATE utf8mb4_unicode_ci,
  `cache` tinyint DEFAULT NULL COMMENT '全站缓存 0关闭 1开启',
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'qihu' COMMENT '目标站',
  `template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dyxs' COMMENT '模板',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '网站状态 0关闭 1开启',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `ev_configs`
--

INSERT INTO `ev_configs` (`id`, `name`, `logo`, `email`, `icp`, `keywords`, `content`, `tj`, `notice`, `cache`, `method`, `template`, `status`, `created_at`, `updated_at`) VALUES
(1, 'easyvod', 'https://s3.bmp.ovh/imgs/2021/12/eea0b5ca2ab633cf.png', 'admin@admin.com', 'xxxx', 'easyvod', 'easyvod', 'xxxx', '测试一下公告', 0, 'qihu', 'dyxs', 1, '2021-12-29 23:28:39', '2022-01-04 15:10:02');

-- --------------------------------------------------------

--
-- 表的结构 `ev_links`
--

CREATE TABLE `ev_links` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '友链名称',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '友链地址',
  `sort` int NOT NULL COMMENT '排序 数字越大越靠前',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '状态 0隐藏 1开启',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `ev_links`
--

INSERT INTO `ev_links` (`id`, `name`, `url`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(2, '百度', 'http://www.baidu.com', 99, 1, '2021-12-30 23:32:45', '2021-12-30 23:32:45');

-- --------------------------------------------------------

--
-- 表的结构 `ev_players`
--

CREATE TABLE `ev_players` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '播放器名称',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '播放器地址',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '播放器分类',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `ev_players`
--

INSERT INTO `ev_players` (`id`, `name`, `url`, `type`, `created_at`, `updated_at`) VALUES
(2, '乐视视频解析', 'https://api.okjx.cc:3389/jx.php?url=', 'le', '2021-12-30 11:15:07', '2022-01-01 19:32:23'),
(3, '腾讯解析', 'https://api.okjx.cc:3389/jx.php?url=', 'qq', '2021-12-30 11:15:21', '2022-01-01 19:32:28'),
(6, '爱奇艺解析', 'https://api.okjx.cc:3389/jx.php?url=', 'iqiyi', '2021-12-30 15:52:46', '2022-01-01 19:32:47'),
(7, '乐多播放器', 'https://api.ldjx.cc/wp-api/ifr.php?vid=', 'leduo', '2021-12-31 14:33:50', '2021-12-31 14:33:50'),
(8, 'pptv解析', 'https://api.okjx.cc:3389/jx.php?url=', 'pptv', '2022-01-01 19:33:03', '2022-01-01 19:33:03'),
(9, '芒果解析', 'https://api.okjx.cc:3389/jx.php?url=', 'mgtv', '2022-01-01 19:33:15', '2022-01-01 19:33:15'),
(10, '搜狐解析', 'https://api.okjx.cc:3389/jx.php?url=', 'sohu', '2022-01-01 19:33:27', '2022-01-01 19:33:27'),
(11, '酷点播放器', 'http://jx.kujiexi.net/m3u8.php?url=', 'kdm3u8', '2022-01-01 20:47:29', '2022-01-01 21:13:15');

-- --------------------------------------------------------

--
-- 表的结构 `ev_sources`
--

CREATE TABLE `ev_sources` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '资源站名称',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '资源站api地址',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'xml' COMMENT 'api类型 xml/json',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '状态 0关闭 1开启',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `ev_sources`
--

INSERT INTO `ev_sources` (`id`, `name`, `url`, `type`, `status`, `created_at`, `updated_at`) VALUES
(2, '酷客资源站', 'https://api.kuapi.cc/api.php/provide/vod/at/xml/', 'kdm3u8', 1, '2021-12-30 11:58:32', '2021-12-31 12:36:52'),
(3, '想看资源站', 'https://m3u8.xiangkanapi.com/provide/vod/', 'xkyun#xkm3u8', 1, '2021-12-30 15:08:29', '2021-12-31 12:36:41'),
(8, '乐多资源站', 'http://cj.leduocaiji.com/inc/api.php', 'leduo', 1, '2021-12-31 12:27:55', '2021-12-31 15:03:14');

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_12_29_142401_create_ev_admins_table', 1),
(3, '2021_12_29_143334_create_ev_links_table', 1),
(4, '2021_12_29_143419_create_ev_sources_table', 1),
(5, '2021_12_29_144432_create_ev_players_table', 1),
(6, '2021_12_29_143327_create_ev_configs_table', 2);

--
-- 转储表的索引
--

--
-- 表的索引 `ev_admins`
--
ALTER TABLE `ev_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`) USING BTREE;

--
-- 表的索引 `ev_configs`
--
ALTER TABLE `ev_configs`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `ev_links`
--
ALTER TABLE `ev_links`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `ev_players`
--
ALTER TABLE `ev_players`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `player` (`type`) USING BTREE;

--
-- 表的索引 `ev_sources`
--
ALTER TABLE `ev_sources`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `ev_admins`
--
ALTER TABLE `ev_admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `ev_configs`
--
ALTER TABLE `ev_configs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `ev_links`
--
ALTER TABLE `ev_links`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `ev_players`
--
ALTER TABLE `ev_players`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `ev_sources`
--
ALTER TABLE `ev_sources`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
