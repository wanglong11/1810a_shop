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
use App\Model\ImageTextModel;
use App\Model\Wechat;
class TextController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('图文管理')
            ->description('图文添加')
            ->body(view('admin/WX/image-Text'));

    }


    public function indexs(Request $request){

        $tag_name=$request->tag_name;//题目
        $answer_A=$request->answer_A;//答案A
        $answer_B=$request->answer_B;//答案B
        $correct_answer=$request->correct_answer;//正确答案
        //组装数据
         $data=[
             'tag_name'=>$tag_name,
             'answer_A'=>$answer_A,
             'answer_B'=>$answer_B,
             'correct_answer'=>$correct_answer,
         ];
        $res=  ImageTextModel::insertGetId($data);//执行添加
        //dd($res);
        if($res){
            echo "题目添加成功";
            //header("Refresh:2,url=http://1809wangweilong.comcto.com/admin/Textadmin");
        }else{
            echo"题目添加失败";
            //header("Refresh:2,url=/");
        }
        //dd($res);



    }
    /**
     *素材处理
     **/
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
