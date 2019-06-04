<?php

namespace App\Admin\Controllers;
use App\WxTextModel;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Http\Requests\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
use App\Model\Wechat;
use App\Model\OrcodeModel;

class QrcodeController extends Controller
{
    use HasResourceActions;


    public function index(Content $content){
        //echo "11";die;
       // $data=DB::table('wxuser')->get();
        return $content
            ->header('微信关注渠道管理')
            ->description('微信关注渠道添加')
            ->body(view('admin/WX/Qrcode'));
    }
    public function AddQrcode(Request $request){
        $ditch_name=$request->ditch_name;//渠道名称
        $ditch_identifying=$request->ditch_identifying;//渠道标识
        //dump($ditch_name);
        //dump($ditch_identifying);die;
        $access_token = Wechat::token();//获取access_token
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$access_token}";
//        $post_data = '
//        {"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": $ditch_identifying}}}
//        ';
//        $post_data = '{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id":'.$ditch_identifying.' }}}';
        $post_data=[
          'expire_seconds'=>'604800' ,
            'action_name'=>'QR_SCENE',
            'action_info'=>[
                'scene'=>[
                    'scene_id'=> $ditch_identifying,//渠道标识
                ],
            ],
        ];
        //dd($post_data);
        $post_data=json_encode($post_data);//转化成字符串
        $res = $this->curlPost($url,$post_data);
        //dd($res);
        $res = json_decode($res,true);
        //dd($res);
        $ticket = $res['ticket'];
        //通过ticket 换取二维码
        $codePath = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={$ticket}";//获取二维码的路径
        //dd($codePath);
     //拿到关注人数
        $data=[
            'ditch_name'=> $ditch_name,
            'ditch_identifying'=>$ditch_identifying,
            'codePath'=>$codePath,
        ];
        $res= OrcodeModel::insertGetId($data);
        //dd($res);
        echo "添加成功";

    }
    public function QrcodeList(){
        //echo "1111";
        $res= OrcodeModel::get()->toArray();
        //dd($res);
        return view('admin/WX/QrcodeList',compact('res'));

    }
    //发请求
    public function curlPost($url,$post_data)
    {
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL,$url);
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
public function Bartype(){
    $res= OrcodeModel::all()->toArray();
//    $res1="select cate_name count(*) from goods join cate goods.cate_id=cate.cate_id group by goods.cate_id having count(*)>2";查询该商品的数量
    //dd($res);
    $str_name='';
    //$str_number='';
    $str_number='';
    foreach($res as $k=>$v){
       $str_name.="'".$v['ditch_name']."'".",";
        $str_number.=$v['number'].",";
    }

    $a=rtrim($str_name,",");
    $b=rtrim($str_number,",");
   //echo $a;
   //dd($b);
    return view('admin/WX/Bartype',compact('a','b'));
}
    //数据图表类型测试
public function Text(){
    return view('admin/WX/Text');
}
    //数据图表类型测试美金
    public function usd(){
        return view('admin/WX/usd');
    }

}
