<?php

namespace App\Http\Controllers\WX;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Model\Wechat;
use Illuminate\Support\Facades\Cache;
use App\Model\pUserModel;
class LoginController extends Controller
{
    //展示登录
    public function index(){
        $openid1=Session::pull('openid');
        //dd($openid1);
        //dd($openid1);
//        if(empty($openid)){//如果没有网页授权就让他网页授权
//            header("Refresh:2,url=/binding");
//            die("你必须先进行网页授权,2秒后自动跳回网页授权页面");
//        }

        return view('admin/tools/Login/login',compact('openid1'));
    }
    //网页授权
    public function binding(){
        return view('admin/WX/binding');
    }
    /**
     * ajax控制模板消息发送
     *
    */
    public function news(Request $request){
        $openid=$request->openid;

        $code=md5(time().rand(111,999));
        $code=substr($code,28);
        $access_token = Wechat::token();
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={$access_token}";

        $post_data='{
           "touser":"'.$openid.'",
           "template_id":"UiO6OexWgQiEBaAbi69fbsMpcXZqbY0tPnrnCdopDTA",
           "url":"http://weixin.qq.com/download",
           "data":{

                   "name":{
                       "value":"王威龙",
                       "color":"#173177"
                   },
                   "code": {
                       "value":"'.$code.'",
                       "color":"#173177"
                   },
                   "time": {
                       "value":"5分钟",
                       "color":"#173177"
                   }
           }
       }';
        $res = Wechat::curlPost($url, $post_data);
                //var_dump($res);
         $res=json_decode($res,true);
        if($res['errcode']==0){
            echo "1";
        }else{
            echo "2";
        }
    }

/**
 * pc端微信扫码登录页面
*/
    public function ewn(){
        //创建二维码
        $c_id=md5(time().rand(1000,9999));
        //dd($c_id);
        $url="http://1809wangweilong.comcto.com/wechatAuth?c_id=".$c_id;
       //dd($url);
      return view('admin/tools/Login/ewn',[
          'url'=>$url,
          'c_id'=>$c_id,
          ]);
    }

    /**
     * 手机网页授权
     *
    */
        public function wechatAuth(Request $request){
            $openid=Wechat::getOpenid();//网页授权
            $id=$request->input('c_id');
            Cache::put($id,$openid,120);
            return '扫码授权成功,请等待电脑端响应';
        }

    /**
     * 检测是否跳转
     */
    public function checkWeachLogin(Request $request){
        //echo 11;die;
        $id=$request->input('c_id');
        //dd($id);
        $openid = Cache::get($id);//取缓存

        //dd($openid);
        //通过openid查询数据库ok
        if($openid){//有openid查询数据库
            $adminInfo=pUserModel::where(['openid'=>$openid])->first()->toArray();
            session(['adminInfo'=>$adminInfo]);//存储到session中
            $returnMsg=[
                'ret'=>1,
                'msg'=>'登陆成功'
            ];
            return json_encode($returnMsg);
        }

        $returnMsg=[
            'ret'=>2,
            'msg'=>'登陆失败'
        ];
        return json_encode($returnMsg);



    }




    }