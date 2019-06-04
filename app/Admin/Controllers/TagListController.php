<?php

namespace App\Admin\Controllers;

use App\Model\AgeModel;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Model\WxuserModel;

use App\Model\Wechat;
class TagListController extends Controller
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
            ->header('粉丝管理')
            ->description('标签展示')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AgeModel);
        $grid->id('Id');
        $grid->tag_name('标签名称');
        $grid->lable_id('标签id');
        //$grid->add_time('Add time');
        $grid->add_time('添加时间')->display(function($date){
            return date('Y-m-d H:i',$date);
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        if(empty($id)){
            echo "无法查询";die;
        }else{

        }
        $s_id=$id;
        $data=WxuserModel::all();
        //dd($data);
        return view('admin/WX/Tagdetail',compact('data','s_id'));
    }
    public function taglist(){
        $openid=$_GET['openid'];
        $t_id=$_GET['t_id'];
        //echo $t_id;
        //dd($openid);
        $res=AgeModel::where(['id'=>$t_id])->value('lable_id');
        //dd($res);
        $access_token = Wechat::token();
        $url="https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token={$access_token}";
        $post_data='{ "openid_list" : ['.$openid.'],  "tagid" : '.$res.'}';
      // dd($post_data);
        //$post_data=json_encode($post_data,JSON_UNESCAPED_UNICODE);
        //dd($post_data);
       $res=$this->curlPost($url,$post_data);
       // dd($res);
        $res1=json_decode($res,true);
       // dd($res);
       if($res1['errcode']==0){
           echo "1";
       }else{
            echo "2";
        }
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AgeModel);

        $form->text('tag_name', 'Tag name');
        $form->number('lable_id', 'Lable id');
        $form->number('add_time', 'Add time');

        return $form;
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
