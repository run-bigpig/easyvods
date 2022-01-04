## 用例
````
<?php

require_once "vendor/autoload.php";

use EasyVod\Facades\EasyVodFacade as Ev;
$intconfig = ["type"=>"qihu"];
Ev::init($intconfig);//初始化采集器

$listconfig = ["channel"=>"mv","kind"=>"comedy","area"=>"china","year"=>"2021","size"=>"35","pageno"=>1];

Ev::VodList($listconfig);//获取视频列表

$playconfig = ["url"=>"va/xxxxx.html"];
Ev::VodPlay($playconfig);//获取对应的视频播放信息

$searchconfig = ["key"=>"复仇者"];
Ev::VodSearch($searchconfig);//获取搜索列表

$bannerconfig = ["channel"=>"mv"];
Ev::VodBanner($bannerconfig);//获取不同频道的banner

````
## 配置详解

#### intconfig(初始化配置)

参数名 | 注释 | 例子
---|---|---
type | 采集器分类 | qihu/weitang
domin | 目标domin,可不填 | https://api.web.360kan.com/v1
typeconfig | 分类配置 | 可不填

#### listconfig(列表配置)
参数名 | 注释 | 例子
---|---|---
channel | 频道 | mv:电影 tv:电视 va:综艺 ct:动漫
kind | 分类名称 | 看下例
area | 地区 | 可不填
year | 年份 | 可不填
size | 每页大小(只在360kan中生效) | 可不填
pageno | 页码 | 1

##### kind(详解)
频道|分类 | 中文解释
---|---|---
mv|all|全部
mv|comedy|喜剧
mv|love|爱情
mv|action|动作
mv|terrorist|恐怖
mv|science|科幻
mv|crime|犯罪
mv|fantasy|奇幻
mv|war|战争
mv|animation|动画
mv|suspense|悬疑
mv|art|文艺
mv|record|记录
mv|biography|传记
mv|singdance|歌舞
mv|history|历史
mv|other|其他
tv|all|全部
tv|love|言情
tv|plot|剧情
tv|comedy|喜剧
tv|suspense|悬疑
tv|city|都市
tv|idol|偶像
tv|ancient|古装
tv|war|军事
tv|police|警匪
tv|history|历史
tv|motivational|励志
tv|myth|神话
tv|spy|谍战
tv|youth|青春
tv|home|家庭
tv|action|动作
tv|scenario|情景
tv|wuxia|武侠
tv|science|科幻
tv|other|其他
va|all|全部
va|talk|脱口秀
va|reality|真人秀
va|funny|搞笑
va|draft|选秀
va|gossip|八卦
va|interview|访谈
va|emotion|情感
va|life|生活
va|party|晚会
va|music|音乐
va|workplace|职场
va|food|美食
va|fashion|时尚
va|game|游戏
va|child|少儿
va|sports|体育
va|event|纪实
va|edu|科教
va|quyi|曲艺
va|singdance|歌舞
va|economic|财经
va|car|汽车
va|broadcast|播报
va|other|其他
ct|all|全部
ct|blood|热血
ct|science|科幻
ct|girl|美少女
ct|magic|魔幻
ct|classic|经典
ct|motivational|励志
ct|child|少儿
ct|adventure|冒险
ct|funny|搞笑
ct|reason|推理
ct|love|恋爱
ct|cure|治愈
ct|fantasy|幻想
ct|school|校园
ct|animal|动物
ct|zero|机战
ct|qingzi|亲子
ct|childrensong|儿歌
ct|movement|运动
ct|suspense|悬疑
ct|monster|怪物
ct|war|战争
ct|puzzle|益智
ct|fairytale|童话
ct|compete|竞技
ct|action|动作
ct|society|社会
ct|friendship|友情
ct|realpeople|真人版
ct|movie|电影版
ct|ova|OVA版
ct|tv|TV版
ct|newanime|新番动画
ct|finishanime|完结动画

##### area(详解)
地区 | 中文解释
---|---
all|全部
china|内地/大陆/中国
hongkong|香港
taiwan|台湾
korea|韩国
japan|日本
french|法国
britain|英国
germany|德国
thailand|泰国
india|印度
america|美国
singapore|新加披
other|其他
#### playconfig(播放页配置)
参数 | 注释|例子
---|---|---
url|列表返回结果中的url|va/xxxxxx.html

#### searchconfig(搜索配置)
参数 | 注释|例子
---|---|---
key|搜索关键字|我的姐姐

#### bannerconfig(轮播配置)
参数 | 注释|例子
---|---|---
channel|频道|mv tv va ct



