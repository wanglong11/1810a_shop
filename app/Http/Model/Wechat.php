<?php
namespace App\Model;

use Illuminate\Support\Facades\Redis;
/**
 * 微信核心功能
 **/
class Wechat{
    const appId = 'wx8905ee114db2d1b7';
    const appSecret = '737daeab4bc0c465173d01518ff765b1';
    /**
     *获取微信accesstoken
     * access_token是公众号的全局唯一接口调用凭据，
     */
    public  static function token()
    {
        $key = "access_toke";
        $data = Redis::get($key);
        if($data){

        }else{
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx8905ee114db2d1b7&secret=737daeab4bc0c465173d01518ff765b1";
            $response = file_get_contents($url);
            $arr = json_decode($response, true);//转化成数组
//        print_r($arr);
            redis::set($key, $arr['access_token']); //存入access_token
            redis::expire($key, 3600);
            $data = $arr['access_token'];
        }
        return $data;



    }
    /**
     * 获取用户信息
     */
    public static function getUserInfo($openid)
    {
        $access_token=Wechat::token();
        //dd($access_token);
        //$access_token=$this->
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid=".$openid."&lang=zh_CN";
        //dd($url);
        //
        $data = file_get_contents($url);
       //dd($data);
       // echo"11";die;
        $u = json_decode($data,true);
       // dd($u);
        return $u;
    }
        //Http请求
    public static function  curlPost($url, $post_data){
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        return $data;
    }

    /**
     * 微信网页授权 获取openid
     * @return [type] [description]
     */
    public static function getOpenid()
    {
        //从session里取 openid
        $openid = session('openid');
        if(!empty($openid)){
            //如果有openid 正常返回
            return $openid;
        }
        //没有 再去访问微信授权流程 获取openid
        $SERVER_NAME = $_SERVER['HTTP_HOST'];  //获取域名
        $REQUEST_URI = $_SERVER['REQUEST_URI']; //获取参数
        //var_dump($_SERVER);die;
        $redirect_uri = urlencode('http://' . $SERVER_NAME . $REQUEST_URI);  //动态组装一个回调地址
        $code = request('code');
        if (! $code) {
            // 网页授权当scope=snsapi_userinfo时才会提示是否授权应用
            $autourl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".self::appId."&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_base&state=123#wechat_redirect";
            //echo $autourl;die;
            header("location:$autourl");
        } else {
            // 获取openid
            $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".self::appId."&secret=".self::appSecret."&code=$code&grant_type=authorization_code";
            $row = file_get_contents($url);
            $row = json_decode($row,true);
            $openid = $row['openid'];
            //获取到openid之后 存session
            session(['openid'=>$openid]);
            return $openid;
        }
    }

    /**
     * 获取 微信 jsapi ticket
     * @return bool
     */
   public  static function  getJsapiTicket()
   {
       $key = 'wx_jsapi_ticket';
       $ticket = Redis::get($key);      //获取ticket
       if ($ticket) {
           return $ticket;       //有缓存直接返回
       } else {       //没有缓存就存
           //$access_token = getWxAccessToken();
           $access_token = Wechat::token();
           $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . $access_token . '&type=jsapi';
           $ticket_info = json_decode(file_get_contents($url), true);
           if (isset($ticket_info['ticket'])) {     //判断ticket_info真实存在性
               Redis::set($key, $ticket_info['ticket']);   //有ticket 就存入redis中
               Redis::expire($key, 3600);
               return $ticket_info['ticket'];
           } else {    //否者就false
               return false;
           }
       }

   }
}