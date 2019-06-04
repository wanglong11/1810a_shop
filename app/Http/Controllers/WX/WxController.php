<?php

namespace App\Http\Controllers\WX;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserModel;
use Illuminate\Support\Facades\Redis;
use App\Model\Wechat;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use App\Model\FodderModel;
use DB;
use App\Model\OrderUserModel;
use App\Model\OrcodeModel;
use App\Model\panaModel;

class WxController extends Controller
{
    /**
     *
     *开发者通过检验signature对请求进行校验（下面有校验方式）。
     *
     * 若确认此次GET请求来自微信服务器，请原样返回echostr参数内容，则接入生效，成为开发者成功
     *
     * 微信接口
     */
    public function index()
    {

        echo $_GET['echostr'];

    }

    /**
     * 微信开发的一些小功能
     **/
    public function wxEven()
    {
        $text = file_get_contents('php://input');
        $time = date('Y-m-d H:i:s');
        $str = $time . $text . "\n";
        is_dir('logs') or mkdir('logs', 0777, true);
        file_put_contents("logs/wx_event.log", $str, FILE_APPEND);//存入日志
        //接受微信服务器推送
        $data = simplexml_load_string($text);
        $openid = $data->FromUserName;  //用户ID
        $wx_id = $data->ToUserName;//公众号ID
        $event = $data->Event;//事件类型
        $app = $data->ToUserName;//公众号ID
        $msg_type = $data->MsgType;//消息类型
        //dd($data);die;
        //echo "111";
        //判断搜索天气
        if (strpos($data->Content, '+天气')) {   //自动搜索天气信息
            $city = explode('+', $data->Content)[0];//字符串类型
            //dd($city);
            //$url = "https://free-api.heweather.net/s6/weather/now?parameters&location=" . $city . "&key=HE1905052019041491";
            //$url="https://free-api.heweather.net/s6/weather/now?key=HE1905060958181055&location=$city";//调接口
            $url = "http://api.k780.com/?app=weather.today&weaid=" . $city . "&appkey=42239&sign=3b3b0bb20409785f5a16cd0c640baf1c&format=json";
            //dd($url);
            $res = file_get_contents($url);
            //dd($res);
            $arr = json_decode($res, true);
            //dd($arr);
            if ($arr['success'] !== '1') { //判断城市是否正确
                // echo "111";
                echo $response_xml = '<xml>
                     <ToUserName><![CDATA[' . $openid . ']]></ToUserName>
                    <FromUserName><![CDATA[' . $app . ']]></FromUserName>
                     <CreateTime>' . time() . '</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[' . '错了大哥，请输入正确信息' . ']]></Content>
                     </xml>';
            } else {
                //echo"11";die;
                $days = $arr['result']['days'];// 日期
                $citynm = $arr['result']['citynm'];//地区
                $temperature = $arr['result']['temperature']; /*当日温度区间*/
                $temperature_curr = $arr['result']['temperature_curr'];/*当前温度*/
                $humidity = $arr['result']['humidity'];/*湿度*/
                $weather = $arr['result']['weather']; /*天气*/
                $wind = $arr['result']['wind'];/*风向*/
                $winp = $arr['result']['winp'];/*风力*/
                $humi_high = $arr['result']['humi_high'];/*最大湿度*/
                $str = "日期：" . $days . "\n" . "地区:" . $citynm . "\n" . "当日温度区间:" . $temperature . "\n" .
                    "湿度:" . $humidity . "\n" . "天气状况:" . $weather . "\n" . "风向:" . $wind . "\n" .
                    "风力:" . $winp . "\n" . "最大湿度:" . $humi_high . "\n";
                echo $response_xml = '<xml>
                     <ToUserName><![CDATA[' . $openid . ']]></ToUserName>
                    <FromUserName><![CDATA[' . $app . ']]></FromUserName>
                     <CreateTime>' . time() . '</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[' . $str . ']]></Content>
                     </xml>';
                //echo "$response_xml";die;
            }

        }
        if ($event == 'subscribe') {
            //echo "11";die;
            $event_key=$data->EventKey;
            $event_key=substr($event_key,8,11);
            //dd($event_key);
            //dd($event_key);
             if($event_key==''){
                 //扫码关注事件
                 //echo '11';die;
                 //根据openid判断用户是否已存在
                 $local_user = UserModel::where(['openid' => $openid])->first();
                 file_put_contents("logs/wx_event.log", $local_user, FILE_APPEND);
                 if ($local_user) {
                     //用户之前关注过
                     echo '<xml>
                <ToUserName>
                <![CDATA[' . $openid . ']]>
                </ToUserName>
                <FromUserName><![CDATA[' . $wx_id . ']]>
                </FromUserName><CreateTime>' . time() . '
                </CreateTime><MsgType>
                <![CDATA[text]]>
                </MsgType><Content>
                <![CDATA[' . '欢迎回来 ' . $local_user['nickname'] . '回复1:你真帅,回复2:有惊喜,查询天气:例如:北京+天气' . ']]>
                </Content>
                </xml>';
                 } else {
                     //获取用户信息
                     //$u = $this->getUserInfo($openid);
                     $u = Wechat::getUserInfo($openid);
                     //$z=Wechat::getUserInfo();
                     //echo '111';
                     //用户信息入库
                     $u_info = [
                         'openid' => $u['openid'],
                         'nickname' => $u['nickname'],
                         'sex' => $u['sex'],
                         'headimgurl' => $u['headimgurl'],
                         'subscribe_time' => $u['subscribe_time'],
                     ];
                     $id = UserModel::insertGetId($u_info);
                     //$id = WxUserModel::insertGetId($u_info);
                     echo '<xml>
                 <ToUserName>
                 <![CDATA[' . $openid . ']]>
                 </ToUserName>
                 <FromUserName>
                 <![CDATA[' . $wx_id . ']]></FromUserName>
                 <CreateTime>' . time() . '</CreateTime>
                 <MsgType><![CDATA[text]]></MsgType>
                 <Content>
                 <![CDATA[' . '欢迎关注 ' . $u['nickname'] . '回复1:你真帅,回复2:有惊喜,查询天气:例如:北京+天气' . ']]></Content>
                 </xml>';

                 }
             }else{
                // echo "111";die;
                 //否者就是扫描带参数的二维码
                 //$access_token=Wechat::token();
                // dd($access_token);

                 $a = Wechat::getUserInfo($openid);
                 //用户信息入库
                //dd($a);
                 $u_info = [
                     'openid' => $a['openid'],
                     'nickname' => $a['nickname'],
                     'sex' => $a['sex'],
                     'headimgurl' => $a['headimgurl'],
                     'subscribe_time' => $a['subscribe_time'],
                     'qr_scene'=>$a['qr_scene'],
                 ];
                 //获取二维码扫描用户信息入库
                 $id =OrderUserModel::insertGetId($u_info);
                 //dd($id);
                 //$res=OrcodeModel::where(['ditch_identifying'=>$event_key])->first()->number;
                 //dd($res);
                 //$number=$res+1;
                 //dd($number);
                  //$dtat=OrcodeModel::where(['ditch_identifying'=>$event_key])->update(['number'=>$number]);
                 //dd($data);
                // $data=OrcodeModel::where(['ditch_identifying'=>$event_key])->increment('number');
                 $data=DB::table('p_orcode')->where(['ditch_identifying'=>$event_key])->increment('number');

             }


        }elseif($event=='unsubscribe'){//如果取消关注的话

            //查询一下
                     $res1=OrderUserModel::where(['openid'=>$openid])->first()->qr_scene;
                     //dd($res1);

            //$dt=OrcodeModel::where(['ditch_identifying'=>$res1])->first()->number;
            //$number1=$dt-1;
            //dd($number1);
            $data=OrcodeModel::where(['ditch_identifying'=>$res1])->decrement('number');
           // dd($data);
            $res1=OrderUserModel::where(['openid'=>$openid])->delete();//删除

        } elseif ($data->Content == '1') {
            echo '<xml>
             <ToUserName><![CDATA[' . $openid . ']]></ToUserName>
           <FromUserName><![CDATA[' . $wx_id . ']]></FromUserName>
            <CreateTime>' . time() . '</CreateTime>
               <MsgType><![CDATA[text]]></MsgType>
           <Content><![CDATA[你真帅]]></Content>
         </xml>';
        } elseif ($data->Content == '2') {
            echo '<xml>
             <ToUserName><![CDATA[' . $openid . ']]></ToUserName>
           <FromUserName><![CDATA[' . $wx_id . ']]></FromUserName>
            <CreateTime>' . time() . '</CreateTime>
               <MsgType><![CDATA[text]]></MsgType>
           <Content><![CDATA[请您不要着急，我非常理解您的心情，我们一定会竭尽全力为您解决的]]></Content>
         </xml>';
        }  elseif ($msg_type == 'image') {
            $goodsInfo=FodderModel::orderByRaw("RAND()")->get();//
            //dd($media_id);
            foreach($goodsInfo as $k=>$v) {
                echo '<xml>
              <ToUserName><![CDATA[' . $openid . ']]></ToUserName>
              <FromUserName><![CDATA[' . $wx_id . ']]></FromUserName>
              <CreateTime>' . time() . '</CreateTime>
              <MsgType><![CDATA[image]]></MsgType>
              <Image>
                <MediaId><![CDATA['.$v['media_id'].']]></MediaId>
              </Image>
            </xml>';
            }

        } elseif($msg_type=='event'&&$event=='CLICK'){//如果是菜单点击类型
            //根据菜单key值判断输出的内容
            if($data->EventKey=='V1001_GOOD'){//点击发表白
                //记录当前用户行为
                $act_name='点击发表白';
                $this->insertact($data->FromUserName,$act_name);
                $this->responseText($data,$str='请输入要表白人的名称偶');
            }elseif($data->EventKey=='V1001_001'){//点击查表白
                //记录当前用户行为
                $act_name='点击查表白';
                $this->insertact($data->FromUserName,$act_name);

                $this->responseText($data,$str='请输入要查询人的名称偶');

            }

        }
        //回复文本消息
        if($data->MsgType=='text'){
            //得到用户所发的留言
            $font =trim($data->Content);
            //查询单前用户上一步的信息
            $act_name=$this->selectAct($data->FromUserName);
            //根据上一次用户操作的不同 执行响应处理
            if($act_name=='点击发表白'){
                //将表白人入库
                $insertData=[
                    'openid'=>$openid,
                    'username'=>$font,
                    'content'=>''
                ];
                DB::table('love')->insert($insertData);
                //记录当前用户行为
                $act_name='输入表白名称';
                $this->insertact($data->FromUserName,$act_name);
                //表白人得姓名
                $this->responseText($data,$str='请输入要表白的内容');
            }elseif($act_name=='输入表白名称'){
                //将表白内容入库
                $this->insertLoveContent($openid,$font);//修改
                //回复文本
                $this->responseText($data,$str='表白成功');
            }
            if($act_name=='点击查表白'){
                //查询当前用户是否有表白
                $lovemsg = $this->selectLove($font);
                //回复文本
                //$this->responseText($xmlObj,$lovemsg);
                $this->responseText($data,$str='表白成功');
            }

        }

    }

    /**
     * 查询表白
     * @return [type] [description]
     */
    public function selectLove($username)
    {
        $loveData = DB::table('love')
            ->where(['username'=>$username])
            ->get()->toArray();
        $msg = "没人给他表白";
        if(!empty($loveData)){
            //var_dump($loveData);die;
            //如果有人给该用户表白 显示表白次数 和内容
            $msg = "查询用户：".$username." 被表白次数:".count($loveData)." 表白内容为:\r\n";
            foreach ($loveData as $key => $value) {
                $msg .= $value->content."\r\n";
            }
        }
        return $msg;

    }

    //查询单前用户上一步的信息
    public function selectAct($openid){//根据openid作为条件进行倒序取一条数据
        $actData=DB::table('act')
            ->where(['openid'=>$openid])
            ->orderBy('act_id', 'desc')
            ->first();
        if($actData &&(time()-$actData->add_time)<30){
            return $actData->act_name;
        }

    }
    ////记录当前用户行为
    public function insertact($openid,$act_name){
       // $openid=$data->FromUserName;
        $insertData=[
            'openid'=>$openid,
            'act_name'=>$act_name,
            'add_time'=>time()
        ];
        DB::table('act')->insert($insertData);
    }
    /**
     * 将表白内容入库
     * @return [type] [description]
     */
    public function insertLoveContent($openid,$content)
    {
        //找到当前openid最后一次表白的用户 更改其表白内容
        $loveData = DB::table('love')
            ->where(['openid'=>$openid])
            ->orderBy('love_id','desc')
            ->first();
        $love_id = $loveData->love_id;
        //更改
        DB::table('love')->where(['love_id'=>$love_id])->update(['content'=>$content]);
    }
    //xml回复文本
    public function responseText($data,$str){
        echo '<xml>
             <ToUserName><![CDATA[' .$data->FromUserName . ']]></ToUserName>
           <FromUserName><![CDATA[' .$data->ToUserName . ']]></FromUserName>
            <CreateTime>' . time() . '</CreateTime>
               <MsgType><![CDATA[text]]></MsgType>
           <Content><![CDATA['.$str.']]></Content>
         </xml>';
    }
    /**
     * 创建自定义菜单创建接口
     */
    public function createMent(){
        $access_token=Wechat::token();
        $url= 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token;
        //dump($url);die;

        //接口数据
        $post_arr=[
            'button' => [

                [
                    'name'=>'表白墙',
                    'sub_button'=> [

                        [
                            'type'=>'click',
                            'name'=> '要表白',
                            'key'=> 'V1001_GOOD',
                        ],
                        [
                            'type'=>'click',
                            'name'=> '查询表白',
                            'key'=> 'V1001_001',
                        ],

                    ],

                ],
                [
                    'name'=>'用户中心',
                    'sub_button'=> [

                        [
                            'type'=>'view',
                            'name'=>'绑定账号',
                            'url'=>'http://1809wangweilong.comcto.com/auth'
                        ],
                        [
                            'type'=>'view',
                            'name'=>'个人中心',
                            'url'=>'https://pvp.qq.com/'
                        ],

                    ],

                ],
                [
                    "name"=>"发送位置",
                    "type"=> "location_select",
                    "key"=> "rselfmenu_2_0"


                ],
            ],
        ];
        $json_str=json_encode($post_arr, JSON_UNESCAPED_UNICODE);//JSON_UNESCAPED_UNICODE（中文不转为unicode ，对应的数字 256）
        //dd($json_str);die;
        //发生请求
        $client= new Client();
        $responce=$client->request('POST',$url,[
            'body'=>$json_str
        ]);
        //dd($responce);die;
        //处理响应
        $res_str=$responce->getBody();
        echo $res_str;
        //判断错误信息
//        if($res_str>['errcode']>0){
//
//        }else{
//            echo '错误';
//        }






    }

    /**
     *测试上传临时素材接口
     */
    public function material()
    {

        $access_token = Wechat::token();
        //dd($access_token);
        //$url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token={$access_token}&type=image";
        $url="https://api.weixin.qq.com/cgi-bin/material/add_material?access_token={$access_token}&type=image";
        //dd($url);
//素材路径 必须是绝对路径
       // $img = "\Users\Administrator\Desktop\4K美图\3-1Q02Q156250-L.jpg";
        //$img="/wwwroot/1810/public/21F8DDA41E61DE6E.jpg";
         $img="/wwwroot/1810/public/3-1Q02Q156250-L.jpg";
        //dd($img);
        $imgPath = new \CURLFile($img); //通过CURLFile处理
        //dd($imgPath);
        $post_data = [
            'media' => $imgPath  //素材路径
        ];
        //dd($post_data);
        //发请求
        $res = $this->curlPost($url, $post_data);
        //dd($res);
       $res= json_decode($res,true);
        //dd($res);

        $media_id=$res['media_id'];
        dd($media_id);
        die;
    }
    /**
     * 模板消息接口
     */
    public function information(){
      //echo"111";

        $access_token = Wechat::token();
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={$access_token}";
       // $url="https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token={$access_token}";
        //https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=ACCESS_TOKEN
         $post_data='{
           "touser":"ojOMz5vve_NeK-jQJkpKdTJx-O5I",
           "template_id":"aiHv2iO5A710LINySHPHTgzBed9sFWkmCRmwqje2Krg",
           "url":"http://www.baidu.com",
           "data":{
                   "name": {
                       "value":"王威龙",
                       "color":"#173177"
                   },
                    "code": {
                       "value":"1111",
                       "color":"#173177"
                   },
                   "time": {
                       "value":"5分钟",
                       "color":"#173177"
                   }


           }
       }';


      $res=$this->curlPost($url,$post_data);
        var_dump($res);





    }
    //消息群发
    public function mass(){
        $content=panaModel::inRandomOrder()->value('content');
        $res=trim($content);
        //dd($res);
        $access_token = Wechat::token();
        //$url="https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token={$access_token}";根据OpenID列表群发
        $url="https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token={$access_token}";
        //$url="https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token={$access_token}";
       // 根据标签进行群发
//         $post_data='{
//          "touser":[
//          "ojOMz5rhQ7IXhr8XNoKyPYNV5wj8",
//          "ojOMz5vve_NeK-jQJkpKdTJx-O5I"
//        ],
//        "msgtype": "text",
//    "text": { "content": "你好啊！老友"}
//}';

        $post_data='{
   "filter":{
      "is_to_all":true,
      "tag_id":2
   },
   "text":{
      "content":"'.$content.'"
   },
    "msgtype":"text"
}';
        $res=$this->curlPost($url,$post_data);
        var_dump($res);

    }
    //用户标签管理 添加用户标签
    public function lable(){
        $access_token = Wechat::token();
        //dd($access_token);
       //$url="https://api.weixin.qq.com/cgi-bin/tags/create?access_token={$access_token}";//添加
       $url="https://api.weixin.qq.com/cgi-bin/tags/get?access_token={$access_token}";//获取
        //$url="https://api.weixin.qq.com/cgi-bin/tags/delete?access_token={$access_token}";//删除
//        $url="https://api.weixin.qq.com/cgi-bin/tags/update?access_token={$access_token}";//修改
        $url="https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token={$access_token}";
        //$post_data='{   "tag" : {     "name" : "广东"//标签名   } }';
        $post_data='{
        "tagid" : 111,
          "next_openid":""//第一个拉取的OPENID，不填默认从头开始拉取
          }';
//        $post_data=[
//          'tag'=>[
//             'name'=>"牛月闯"
//          ]  ,
//        ];
//        $post_data='{"tags":[{"id":2,"name":"星标组","count":0},{"id":100,"name":"广东","count":0},{"id":101,"name":"\\u5c71\\u4e1c","count":0},{"id":102,"name":"\\u5e7f\\u4e1c","count":0},{"id":103,"name":"\\u641e\\u5f97","count":0},{"id":104,"name":"\\u5f97","count":0},{"id":105,"name":"好得","count":0},{"id":106,"name":"牛月闯","count":0}]}';
        //$post_data='{   "tag":{        "id" : 100   } }';
//        $post_data=[
//            'tag'=>[
//                'id'=>'106'
//            ]
//        ];
        $post_data=json_encode($post_data,JSON_UNESCAPED_UNICODE);
        $res=$this->curlPost($url,$post_data);
        var_dump($res);
    }

    //Http请求
    public function curlPost($url, $post_data)
    {
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

    /**删除token缓存*/
    public function aa(){
        $access_token = Wechat::token();
        redis ::del($access_token);
    }
}
