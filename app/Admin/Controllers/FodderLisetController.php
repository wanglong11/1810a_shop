<?php

namespace App\Admin\Controllers;

use App\Model\FodderModel;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class FodderLisetController extends Controller
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
            ->description('素材展示')
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
        $grid = new Grid(new FodderModel);
        $data=FodderModel::get();
        foreach($data as $k=>$v){
            if(time()-$v['created_at']>3*24*3600){
                FodderModel::where('id',$v['id'])->delete();
            }
        }
        $grid->id('素材图片id');
        $grid->type('文件类型');
        $grid->Textname('文件名称');
        $grid->media_id('Media id');
        $grid->Mediaformat('媒体格式');
        $grid->created_at('关注时间')->display(function($date){
            return date('Y-m-d H:i',$date);
        });
       // $grid->img('图片')->image('http://1809wangweilong.comcto.com');
        $grid->img('Url')->display(function($url){
            $ext=substr($url,-3);
            if($ext=='mp3'){
                return '<audio controls autoplay>
                            <source src="/'.$url.'">
                        </audio>';
            }elseif($ext=='mp4'){
                return '<video controls autoplay  width=450;height=150>
                             <source src="/'.$url.'">
                        </video>';
            }elseif($ext=='jpeg' || $ext=='png'){
                return '<img src="/'.$url.'" width=200>';
            }
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
        $show = new Show(FodderModel::findOrFail($id));

        $show->id('Id');
        $show->type('Type');
        $show->media_id('Media id');
        $show->created_at('Created at');
        $show->img('Img');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new FodderModel);

        $form->text('type', 'Type');
        $form->text('media_id', 'Media id');
        $form->image('img', 'Img');

        return $form;
    }
}
