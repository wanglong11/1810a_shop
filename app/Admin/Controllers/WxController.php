<?php

namespace App\Admin\Controllers;

use App\UserModel;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use DB;
use GuzzleHttp\Client;
use App\Model\Wechat;
use App\WxTextModel;
use App\Http\Requests\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Model\FodderModel;
use App\Model\AgeModel;
class WxController extends Controller
{
    use HasResourceActions;


    public function index(Content $content){
        //echo "11";die;
        //查询tag表
        $data1=DB::table('tag')->get();

        //查询wxuser
        $data=DB::table('wxuser')->get();
        return $content
            ->header('用户管理')
            ->description('群发消息')
            ->body(view('admin/WX/message',compact('data','data1')));
    }
    //群发消息处理
    public function Add(){
        $id=$_GET['id'];//标签id
        $openid=$_GET['openid'];
        $text=$_GET['text'];//文本消息
        //echo $text;
        //echo $openid;
       //dd($id);
        $access_token=Wechat::token();
        $client=new Client();
         if(empty($id=='')){//根据option 列表群发
             $res=AgeModel::where(['id'=>$id])->first()->toArray();
             $tag_id=$res['lable_id'];//标签id
             //dd($tag_id);
           $url="https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token={$access_token}";
//             $post_data='{
//           "filter":{
//              "is_to_all":false,
//              "tag_id":'.$tag_id.'
//           },
//           "text":{
//              "content":'.$text.'
//           },
//            "msgtype":"text"
//        }';
             $post_data=[
               "filter"=>[
                "is_to_all"=>false,
                   "tag_id"=>$tag_id
               ],
                 "text"=>[
                    "content"=>$text,
                 ],
                 "msgtype"=>"text",



             ];
             //dd($post_data);
             $post_data=json_encode($post_data,JSON_UNESCAPED_UNICODE);
             $res=$this->curlPost($url,$post_data);
             //dd($res);
             $res1=json_decode($res,true);
             //dd($res);
             if($res1['errcode']==0){
                 echo "1";
             }else{
                 echo "2";
             }

            // dd($res);
         }else{//简单群发
             $openid=explode(',',$openid);
            // dd($openid);
             $arr=[
                 'touser' => $openid,
                 'msgtype' => 'text',
                 'text' => [
                     'content'=>$text
                 ]
             ];
             //dd($arr);
             $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
             $url="https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token={$access_token}";
             $response=$client->request('POST',$url,[
                 'body'=>$str
             ]);
             $res_str=$response->getBody();
             echo $res_str;
             $res3=json_decode($res_str,true);
             //判断错误信息
             //dd($response);
             if($res3['errcode']==0){
                 echo "1";
             }else{
                 echo "2";
             }


         }



    }
   //标签添加html页面
    public function tag(){
        return view('admin/WX/Tag');
    }
    //标签添加处理
    public function tagAdd(Request $request){
       $tag_name=$request->tag_name;//标签名称
        //dd($tag_name);
        $access_token = Wechat::token();
        $url="https://api.weixin.qq.com/cgi-bin/tags/create?access_token={$access_token}";//添加
        $post_data=[
          'tag'=>[
             'name'=>$tag_name
          ]  ,
        ];
        $post_data=json_encode($post_data,JSON_UNESCAPED_UNICODE);
        $res=$this->curlPost($url,$post_data);
        $res1=json_decode($res,true);
        //var_dump($res);
        //print_r($res);die;
       // dd($res1);
        $data=[
            'tag_name'=>$res1['tag']['name'],
            'lable_id'=>$res1['tag']['id'],
            'add_time'=>time()
        ];
        $res=AgeModel::insert($data);
        //dd($res);
        echo "添加成功";
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

}
