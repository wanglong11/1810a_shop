<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/**
 *接受微信推送事件
 **/
//Route::get('/index','WX\WxController@index');

//Route::post('/index','WX\WxController@wxEven');
//获取access_token
//Route::get('/token','WX\WxController@token');
//上传临时素材接口
Route::post('/material','WX\WxController@material');

//Route::get('/create_menu','WX\WxController@createMent');//创建公众号菜单

//模板消息接口
Route::get('/information','WX\WxController@information');
//消息群发
Route::get('/mass','WX\WxController@mass');
//用户标签管理
Route::get('/lable','WX\WxController@lable');//添加用户标签

/**删除token方法*/
Route::get('aa','WX\WxController@aa');

//这是个新的连接
//事例表白墙的事例
//Route::get('/love','WX\WxLoveController@index');

Route::post('/love','WX\WxLoveController@wxEven');
Route::get('/create_menu','WX\WxLoveController@createMent');//创建公众号菜单
//点击抽奖
Route::get('/awardAdd','WX\WxLoveController@awardAdd');

Route::get('/awardList','WX\WxLoveController@awardList');//点击查看优惠劵列表

//点击抽奖页面
Route::get('/award','WX\WxLoveController@award');







//测试网页授权
Route::get('/auth','WX\AuthController@index');
//网页授权回调地址
Route::get('/authorization','WX\AuthController@auth');

Route::get('/cc','WX\AuthController@aa');
//520表白页面
Route::get('/loves','WX\AuthController@loves');

//登录注册页面
Route::get('/login','WX\LoginController@index');
//微信菜单个人中心绑定授权页面
Route::get('/binding','WX\LoginController@binding');
//通过ajax发送模板消息
Route::get('/news','WX\LoginController@news');
//点击此处微信扫码登录
Route::get('/Ewn','WX\LoginController@ewn');
//检测是否扫码登录

//测试crontab
Route::get('crontab','WX\crontabController@del');//删除未支付订单超过半小时的东西


//md5加密解密
Route::any('/md5','WX\crontabController@md5');


//扫码登录网页授权
Route::get('/wechatAuth','WX\LoginController@wechatAuth');
//检测是否跳转
Route::get('/checkWeachLogin','WX\LoginController@checkWeachLogin');
//js-sdk测试
Route::get('/jsdk','WX\JsdkController@getJsConfig');



//测试掉接口
Route::get('/port','WX\JsdkController@port');

//微信测试支付
Route::get('/pay/text','WX\WxPayController@test');//微信支付
Route::post('/weixin/pay/notify','WX\WxPayController@notify');//微信回调


