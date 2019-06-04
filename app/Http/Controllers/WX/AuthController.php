<?php

namespace App\Http\Controllers\WX;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Wechat;
use App\Model\ThirdModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redis;
use Cache;
class AuthController extends Controller
{
    public function index(Request $request){
        //var_dump($_SERVER);die;
        $id=$request->input('c_id');
          $openid=session('openid');
        //dd($openid);
        if(empty($openid)){
            $redirect_uri=urlEncode("http://1809wangweilong.comcto.com/authorization");
            $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx8905ee114db2d1b7&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
            header("location:".$url);
        }

        return view('admin/WX/binding');

    }
    /**
     * 接受绑定管理账号
     */
public function aa(Request $request){

    $bigding_name=$request->bigding_name;
    $bigding_pwd=$request->bigding_pwd;
    $bigding_pwd=md5($bigding_pwd);
    $openid=session('openid');
    $res=\DB::table('p_user')->where(['bigding_name'=>$bigding_name,'bigding_pwd'=>$bigding_pwd])->update(['openid'=>$openid]);
    if($res){
        echo "绑定成功2秒后自动跳回登录页面";
        header("Refresh:2,url=/login");
    }else{
        echo "绑定失败";
    }


}
/**
 * 网页授权
**/
    public function auth(Request $request){

        $code = $_GET['code']; //获取code
       // dd($code);
    $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx8905ee114db2d1b7&secret=737daeab4bc0c465173d01518ff765b1&code={$code}&grant_type=authorization_code";
         $response=json_decode(file_get_contents($url),true);
       // dd($data);
        $access_token = $response['access_token']; //获取access_token
        $openid2 = $response['openid'];//获取openid
        //把openid存储到session中
        //dd($openid2);
        //新的东西把openid存储到redis里面


            //session('openid',$openid2);
       // Session::put('openid', $openid2);
        //$openid1=Session::pull('openid');
        //dd($openid1);
        session(['openid'=>$openid2]);//把openid存储到session样式为数组格式
        return redirect('/auth');



        //获取用户信息
//        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';
//        $user_info = json_decode(file_get_contents($url), true);
//        //dd($user_info);
//        $local_user = ThirdModel::where(['openid' => $openid])->first();
//        if ($local_user) {
//            //用户之前关注过
//            echo '欢迎回来' . $user_info['nickname'];
//            header("Refresh:2,url=/loves");
//        } else {
//            //用户信息入库
//            $u_info = [
//                'openid' => $user_info['openid'],//用户openid
//                'nickname' => $user_info['nickname'],//用户名
//                'sex'=>$user_info['sex'],//用户性别
//                'city'=>$user_info['city'],//用户所在城市
//                'province'=>$user_info['province'],//用户所在的省
//                'country'=>$user_info['country'],//用户所在国家
//                'headimgurl' => $user_info['headimgurl'],//用户头像链接
//            ];
//            $id = ThirdModel::insertGetId($u_info);
//            echo '欢迎登录有惊喜' . $user_info['nickname'];
//            header("Refresh:2,url=/loves");
//        }
     }


    /**
     * 表白页面展示
     */
    public function loves(){
        return view('admin/WX/index');
    }




}
