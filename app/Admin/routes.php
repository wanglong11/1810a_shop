<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('/fodder', WxTextController::class);//微信素材页面
    Route::post('fodder','WxTextController@index');//微信获取素材添加模板
    Route::post('Textfodder','WxTextController@Textadd');//微信素材添加执行
    $router->resource('/Textadmin', FodderLisetController::class);//素材展示

    $router->resource('/menu', WxMenuController::class);//微信菜单页面
     Route::post('menu','WxMenuController@index');//微信菜单添加页面
    Route::any('menuadd','WxMenuController@Menuadd');//微信菜单添加执行
    $router->resource('/MenuList', WxMenuListController::class);//菜单展示
    Route::any('shows','WxMenuController@synchronization');//微信菜单一键同步
    $router->resource('/weixin', WxController::class);//微信用户展示
    Route::get('/messageAss','WxController@add');//
    $router->resource('/Qrcode', QrcodeController::class);//微信渠道生成二维码
    Route::get('/Qrcode','QrcodeController@index');//微信渠道生成二维添加页面
    Route::post('AddQrcode','QrcodeController@AddQrcode');//微信渠道生成二维添加
    Route::get('QrcodeList','QrcodeController@QrcodeList');//微信渠道展示

    $router->resource('/NewQrcodeList', QrcodeListController::class);//微信渠道展示好看

    Route::get('/Bartype','QrcodeController@Bartype');//微信渠道展示条形图
    Route::get('/text','QrcodeController@Text');//数据图表类型测试
    Route::get('/usd','QrcodeController@usd');//数据图表类型测试美金

    Route::get('/tag', 'WxController@tag');//创建标签html
    Route::get('/tagadd','WxController@tagAdd');//执行添加
    $router->resource('/tagList', TagListController::class);//标签展示
    //Route::post('taglist','TagListController@taglist');//添加标签粉色
   // Route::match(['get','post'],'/admin/makeTag',"TagListController@taglist");//总价格
    Route::get('/makeTag', 'TagListController@taglist');//创建标签html


    $router->resource('/info', InfoController::class);//资产管理

    //微信测试图文管理
    $router->resource('/image-text', TextController::class);//图文管理
    //微信测试图文管理添加
    Route::get('/image-TextAdd','TextController@indexs');//微信资源添加执行

//优惠卷添加
$router->resource('/price', PriceController::class);//优惠价
Route::get('/priceAdd','PriceController@Priceadd');//优惠劵添加执行





});
