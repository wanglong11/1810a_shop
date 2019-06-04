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
use App\Model\FodderModel;
use App\Model\Wechat;
class WxTextController extends Controller
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
        ->header('素材管理')
        ->description('素材添加')
        ->body(view('admin/WX/fodder'));

}


    public function Textadd(Request $request){
        // dd($request->all());
        //dd($perpetual);   //微信素材名称
        $Textname=$request->Textname;//素材名称
        $perpetual=$request->perpetual;//素材类型
        $Mediaformat=$request->Media_format;//媒体格式
       // dd($Mediaformat);
        //dump($Textname);
        //文件上传
        $file=$this->uplode($request,'headloge');
       //dd($file);
        $access_token = Wechat::token();
        //dd($access_token);
        /**
         * 获取图片素材
        */
        if($perpetual=="1" && $Mediaformat=='image'){
            $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token={$access_token}&type=image";//获取临时素材
            $img=$file;
            //dd($img);
            $imgPath = new \CURLFile($img); //通过CURLFile处理
            //dd($imgPath);
            $post_data = [
                'media' => $imgPath  //素材路径
            ];
            //dd($post_data);
//发请求
            $res = $this->curlPost($url, $post_data);
            $res= json_decode($res,true);
            //dd($res);

            $img=$res['img']= $img;//图片路径
            $Textname=$res['Textname']=$Textname;//文件名称
            $media_id=$res['media_id'];//media_id
            $created_at=$res['created_at'];//添加时间
            $type=$res['type'];//文件类型
            $Mediaformat=$res['Mediaformat']=$Mediaformat;//添加媒体格式
            //dd($res);
            $data=[
                'img'=>$img,
                'media_id'=>$media_id,
                'created_at'=>$created_at,
                'type'=>$type,
                'Textname'=>$Textname,
                'Mediaformat'=>$Mediaformat,
            ];

        }elseif($perpetual=="2" && $Mediaformat='image'){
            $url="https://api.weixin.qq.com/cgi-bin/material/add_material?access_token={$access_token}&type=image";//获取永久素材
            $img=$file;
            //dd($img);
            $imgPath = new \CURLFile($img); //通过CURLFile处理
            //dd($imgPath);
            $post_data = [
                'media' => $imgPath  //素材路径
            ];
            //dd($post_data);
//发请求
            $res = $this->curlPost($url, $post_data);
            $res= json_decode($res,true);
            //dd($res);
            $img=$res['img']= $img;//图片路径
            $Textname=$res['Textname']=$Textname;//文件名称
            $media_id=$res['media_id'];//media_id
            //$created_at=$res['created_at'];//添加时间
            //$type=$res['type'];//文件类型
            $Mediaformat=$res['Mediaformat']=$Mediaformat;//添加媒体格式
            //dd($res);
            $data=[
                'img'=>$img,
                'media_id'=>$media_id,
                'Mediaformat'=>$Mediaformat,
                'Textname'=>$Textname,
            ];


        } elseif($perpetual=="1" && $Mediaformat=='video' ){//获取视频素材
            $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token={$access_token}&type=video";//获取临时素材
            //dd($url);
            $img=$file;
            //dd($img);
            $imgPath = new \CURLFile($img); //通过CURLFile处理
            //dd($imgPath);
            $post_data = [
                'media' => $imgPath  //素材路径
            ];
            //发请求
            $res = $this->curlPost($url, $post_data);
            $res= json_decode($res,true);
            //dd($res);

            $img=$res['img']= $img;//视频路径
            $Textname=$res['Textname']=$Textname;//文件名称
            $media_id=$res['media_id'];//media_id
            $created_at=$res['created_at'];//添加时间
            $type=$res['type'];//文件类型
            $Mediaformat=$res['Mediaformat']=$Mediaformat;//添加媒体格式
            //dd($res);
            $data=[
                'img'=>$img,
                'media_id'=>$media_id,
                'created_at'=>$created_at,
                'type'=>$type,
                'Textname'=>$Textname,
                'Mediaformat'=>$Mediaformat,
            ];
        }elseif($perpetual=="2" && $Mediaformat=='video'){//否者就是获取永久的视频素材
          echo "111";
        }elseif($perpetual=="1" && $Mediaformat=='voice'){//判断素材音频
          // echo "111";die;
            $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token={$access_token}&type=voice";//获取临时素材
            //dd($url);
            $img=$file;
            //dd($img);
            $imgPath = new \CURLFile($img); //通过CURLFile处理
            //dd($imgPath);
            $post_data = [
                'media' => $imgPath  //素材路径
            ];
            //发请求
            $res = $this->curlPost($url, $post_data);
            $res= json_decode($res,true);
            dd($res);

            $img=$res['img']= $img;//音频路径
            $Textname=$res['Textname']=$Textname;//文件名称
            $media_id=$res['media_id'];//media_id
            $created_at=$res['created_at'];//添加时间
            $type=$res['type'];//文件类型
            $Mediaformat=$res['Mediaformat']=$Mediaformat;//添加媒体格式
            dd($res);
            $data=[
                'img'=>$img,
                'media_id'=>$media_id,
                'created_at'=>$created_at,
                'type'=>$type,
                'Textname'=>$Textname,
                'Mediaformat'=>$Mediaformat,
            ];

        }else{ //否者就是获取永久的音频

        }


//素材路径 必须是绝对路径
        //$img = "\phpstudy2018\PHPTutorial\WWW\benchi.jpg";
        // $img = "\Users\Administrator\Desktop\4K美图\3-1Q02Q156250-L.jpg";
        $res= FodderModel::insertGetId($data);
        //dd($res);
        if($res){
            echo "添加成功";
            header("Refresh:2,url=http://1809wangweilong.comcto.com/admin/Textadmin");
        }else{
            echo"添加失败";
            header("Refresh:2,url=/");
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
    /**文件上传*/
    public function uplode(Request $request,$filename){
        //dd($filename);
        //你可以使用 hasFile 方法判断文件在请求中是否存在,使用 isValid 方法判断文件在上传过程中是否出错：
        if ($request->hasFile($filename) && $request->file($filename)->isValid()) {
            $photo = $request->file($filename);
            $store_result = $photo->store('uploads');
            return $store_result;

        }
        exit('未获取到上传文件或上传过程出错');
    }


}
