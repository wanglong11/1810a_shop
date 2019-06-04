<?php

namespace App\Http\Controllers\WX;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Wechat;
use GuzzleHttp\Client;
use DB;
use App\UserModel;
use App\GoodsModel;
use App\Model\ImageTextModel;
use App\Model\SynthesizeModel;
use App\Model\PirceModel;
use App\Model\PreferentialModel;
use Illuminate\Support\Facades\Redis;
class WxLoveController extends Controller
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
        //echo $_GET['echostr'];
        $echosrt=isset($_GET['echostr']) ? $_GET['echostr'] : "";
        if(!empty($echosrt)){
            echo $_GET['echostr'];
        }
    }

    public function wxEven()
    {
        $text = file_get_contents('php://input');
        $time = date('Y-m-d H:i:s');
        $str = $time . $text . "\n";
        is_dir('logs') or mkdir('logs', 0777, true);
        file_put_contents("logs/wx_con.log", $str, FILE_APPEND);//存入日志
        //接受微信服务器推送
        $data = simplexml_load_string($text);
        //dd($data);
        $openid = $data->FromUserName;  //用户ID
        $wx_id = $data->ToUserName;//公众号ID
        $event = $data->Event;//事件类型
        $app = $data->ToUserName;//公众号ID
        $msg_type = $data->MsgType;//消息类型
        $event_key=$data->EventKey;
        //dd($event_key);
        if ($event == 'subscribe') {
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
                <![CDATA[' . '你好欢迎回来 ' . ']]>
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
                 <![CDATA[' . '你好欢迎关注 ' . ']]></Content>
                 </xml>';

            }

        }
       // $msg_type = $data->MsgType;//消息类型
        //dd($msg_type);
        if ($msg_type=='event'&&$event=='CLICK') {
            //根据菜单key值判断输出的内容
            if ($data->EventKey == 'answer') {//点击答题
                $act_name = '答题';
                $this->insertact($data->FromUserName, $act_name);
                $content = ImageTextModel::inRandomOrder()->value('tag_name');
                $this->responseText($data, $str = $content);
            } elseif ($data->EventKey == 'mygrade') {//点击成绩单

                //dd($content);
                $correct_answer=SynthesizeModel::where(['openid'=>$openid])
                    ->orderBy('id', 'desc')
                    ->value('is_type');
                //dd($correct_answer);
                //获取到该题的正确答案
                if($correct_answer=='1'){
                    $content='你共答对1道题,打错0道';
                }elseif($correct_answer=='2') {
                    $content='你共答对0道题,打错1道';

                }
                $this->responseText($data, $str = $content);
            }

        }
        //回复文本消息
        if ($data->MsgType == 'text') {
            //得到用户所发的留言
            $font = trim($data->Content);
            //dd($font);
            //查询单前用户上一步的信息
            $act_name=$this->selectAct($data->FromUserName);
            //dd($act_name);
            if ($act_name == '答题') {
                //echo "111";
                //查询到用户题目
                $content = ImageTextModel::inRandomOrder()->value('tag_name');
                //将题目入库
               $this->insertLoveContent($openid, $font,$content);//入库记录
                //在数据库查询判断是否正确
                $content=DB::table('topic-synthesize')
                    ->where(['openid'=>$openid])
                    ->orderBy('id', 'desc')
                    ->value('content');//在答题表查一下题目
                $act_name=DB::table('topic-synthesize')
                    ->where(['openid'=>$openid])
                    ->orderBy('id', 'desc')
                    ->value('act_name');//在答题表查一下用户答得答案
                //到题目表判断该题目的正确性
              $correct_answer=ImageTextModel::where(['tag_name'=>$content])->value('correct_answer');//获取到该题的正确答案
                if($correct_answer!=$act_name){//提示抱歉回答错误
                    $content='抱歉回答错误';
                    $this->responseText($data, $str = $content);
                }else{//恭喜你回答正确
                    $content='恭喜你回答正确';
                    $this->responseText($data, $str = $content);
                }



            }


        }

    }
    //查询单前用户上一步的信息
    public function selectAct($openid){//根据openid作为条件进行倒序取一条数据
        $actData=DB::table('act')
            ->where(['openid'=>$openid])
            ->orderBy('act_id', 'desc')
            ->first();

            return $actData->act_name;


    }
    /**
     * 将题目入库
     * @return [type] [description]
     */
    public function insertLoveContent($openid,$font,$content)
    {
        //查询题库表条件题目要得到该题正确答案做个判断添加字段
       $userInfo= ImageTextModel::where(['tag_name'=>$content])->value('correct_answer');//数据库里该题目的正确答案
        //dd($userInfo);
        if($userInfo!=$font){
            $is_type=2;
        }else{
            $is_type=1;
        }
        //dd($is_type);
        $insertData=[
            'openid'=>$openid,//用户标识
            'act_name'=>$font,//该用户选项
            'content'=>$content,//题目
            'is_type'=>$is_type//区分该用户答案的对错1对2错
        ];
        $resq= DB::table('topic-synthesize')->insert($insertData);
       // dd($resq);
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
                        [
                            'type'=>'view',
                            'name'=>'点击抽奖',
                            'url'=>'http://1809wangweilong.comcto.com/award'
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
    //点击抽奖页面
    public function award(){
        return view('admin/WX/award');
    }
    //点击抽奖
    public function awardAdd(){
        $total=PirceModel::inRandomOrder()->value('price_num');//优惠数量
        $win1 = floor((0.1*$total));
        $other = $total-$win1;
        $return = array();
        for ($i=0;$i<$win1;$i++)
        {
            $return[] = '恭喜你中奖了';
        }
        for ($n=0;$n<$other;$n++)
        {
            $return[] = '谢谢惠顾';
        }
        shuffle($return);
       // dd($return);

        $return[array_rand($return)]=trim($return[array_rand($return)]);
        //dd($return[array_rand($return)]) ;
       echo $return[array_rand($return)];
        if(!$return[array_rand($return)]=='恭喜你中奖了'){



        }else{
            $res1= PirceModel::inRandomOrder()->first()->toArray();//从数据库随机一条优惠劵
            //dd($res1);
            $data=[
                'price_name'=>$res1['price_name'],
                'price_condition'=>$res1['price_condition'],
                'price_punishment'=>$res1['price_punishment'],
                'valid_time'=>$res1['valid_time']
            ];
            $res2=PreferentialModel::insertGetId($data);

        }

    }
/**
 * 点击查看优惠劵列表
**/
    public function awardList(){

        $goodsInfo=PreferentialModel::limit(3)->get()->toArray();
        //dd($goodsInfo);
        return view('admin/WX/awardList',compact('goodsInfo'));


    }

}
