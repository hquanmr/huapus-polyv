<?php
require_once __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use hquanmr\HuapusPolyv\Application;

$config = [
    'appSecret' => '',
    'userId' => '',
    'appId' => ''
];

$log = new Logger('HuapusPolyv'); // create a log channel
$date = date('Y-m-d'); //'app/logs/sql_'.$date.'.log'  路径以及日志文件名
$log->pushHandler(new StreamHandler(__DIR__ . '/Logs/HuapusPolyv_' . $date . '.log', Logger::DEBUG)); //Logger::DEBUG 日志级别

$app = new Application($config, $log);
// print_r($app->channels->create([
//     "basicSetting" => [
//         'name' => 'test——ios2',
//         'channelPasswd' => '123456',
//         'scene' => 'alone',
//         'coverImg' => 'alone',  //封面
//         'publisher' => 'alone', //主持人
//         'desc' => 'alone',
//         'startTime' => 1627897569000, //直播开始时间，13位毫秒级时间戳
//         'scene' => 'alone',
//     ],
//     "playbackSetting" => [
//         "globalSettingEnabled"=>"Y",
//         "playbackEnabled" => "Y",
//         "type" => "single",
//         "origin" => "vod",
//     ],
//     "teacher" => [
//         "nickname" => "张MR",
//         "actor" => "清华大学高级教授",
//         "avatar" => "https://huapu-1304269921.cos.ap-guangzhou.myqcloud.com/tpl/296c48c3c9842654077fb242399591e3.jpg"
//     ],
//     "roles" => [[
//         "nickname" => "张MR1",
//         "actor" => "清华大学高级教授",
//         "role" => "Assistant"
//     ], [
//         "nickname" => "张MR2",
//         "actor" => "清华大学高级教授",
//         "role" => "Assistant"
//     ]]

// ]));


// print_r($app->channels->recordConvert([
//     "channelId" => '2454323',
//     "fileIds" => 'f6cdfe89e7e21494275b0c68ff85f34f,4ff5f784c61b44812529fe522c748a3c',
//     "fileName" => '测试1',
// ]));



// print_r($app->channels->getRecordFiles([
//     "userId" => 'c77a8dcde9'
// ],2454323));

// print_r($app->channels->playbackadd([ 转存后不需要添加
//     "channelId" => "2454323",
//     "vid" => "c77a8dcde9d739e7293c9a3a6031529c_c",
//     "listType" => "vod",
// ]));

// print_r($app->channels->playbackset([
//     "channelId" => "2454323",
//     "playbackEnabled" => "Y",
//     "type" => "single",
//     "origin" => "vod",
//     "videoId" => "1a519503da",//zheg id 是视频库的id 还要在走一次接口
// ]));





// print_r($app->channelsGoods->create( ["channelId" => 2455969],[
//     "name" => "测试添加产品1",
//     "status" => "1",
//     "linkType" => 11,
//     "mobileAppLink" => "goods?id=461&video_title=\"跃迁：从管理者到卓越领导者[潘鹏]\"",
//     "productDesc" => "ssss",
//     "cover" => "https://huapu-1304269921.cos.ap-guangzhou.myqcloud.com/tpl/296c48c3c9842654077fb242399591e3.jpg",
//     "realPrice" => 88.88,
//     "price" => 99,
//    "productType"=> "normal",
// ]));


// print_r($app->channelsGoods->update( ["channelId" => 2443292],[
//     "productId"=> "42453",
//     "name" => "测试添加课程",
//     "status" => "1",
//     "linkType" => 11,
//     "mobileAppLink" => "goods?id=461&video_title=\"跃迁：从管理者到卓越领导者[潘鹏]\"",
//     "productDesc" => "ssss",
//     "cover" => "https://huapu-1304269921.cos.ap-guangzhou.myqcloud.com/tpl/296c48c3c9842654077fb242399591e3.jpg",
//     "realPrice" => 88.88,
//     "price" => 199,
//    "productType"=> "normal",
// ]));


// print_r($app->renovation->upload(
//     ["type" => 'warmImage'], //每次只能传一个 上面返回的链接用到下面来 
//     [
//         'file' => fopen(__DIR__ . '/0.jpg', 'r')
//     ]
// ));


// print_r($app->renovation->update(
//     ["coverImage" => 'http://liveimages.videocc.net/uploaded/images/2021/08/g11750e7j7.jpg'],2455803
   
// ));








// print_r($app->channelsGoods->delete(["channelId" => 2443292, "productId" => "42454"]));
