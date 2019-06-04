<?php

namespace App\Http\Controllers\WX;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Model\Wechat;
class JsdkController extends Controller
{
    //js-sdk算法
    public function getJsConfig(){
        //设置签名
        $nonceStr = Str::random(10);  //随机字符串
        $ticket = Wechat::getJsapiTicket();  //获取ticket
        $timestamp = time();    //获取单前时间
        $current_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
        //    [HTTP_HOST] => 1809wangweilong.comcto.com获取当前路径  [REQUEST_URI] => /weixin/jssdk 获取控制器名方法名
        //echo '<pre>';print_r($_SERVER);echo '</pre>';die;

        $string1 = "jsapi_ticket=$ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$current_url";
        //. 签名 对所有待签名参数按照字段名的ASCII 码从小到大排序（字典序）后，使用URL键值对的格式（即key1=value1&key2=value2…）拼接成字符串string1：
        $sign = sha1($string1); //对string1进行sha1签名
        //dd($sign);
        $js_config = [
            'appId' => env('APPID'),        //公众号APPID
            'timestamp' => $timestamp,
            'nonceStr' => $nonceStr,   //随机字符串
            'signature' => $sign,                      //签名
        ];
        $data = [
            'jsconfig'  => $js_config
        ];
        //dd($data);
        return view('admin/WX/jssdk',$data);




    }
    /**
     *  测试连接老师的url添加入库
    **/
    public function port(){
        $name='杜甫';
        $age='100';
        $sing=md5($name.$age."10a");
        //dd($sing);
        $url="Http://47.105.106.201/crontab.php?name={$name}&age={$age}&sign={$sing}";
        dd($url);
        $res=file_get_contents($url);
        //$arr = json_decode($res, true);


    }

public function aa(){

    return false;
}

}
