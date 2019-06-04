<?php

namespace App\Admin\Controllers;

use App\Model\OrcodeModel;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class QrcodeListController extends Controller
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
            ->header('微信关注渠道')
            ->description('微信关注渠道展示')
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
        $grid = new Grid(new OrcodeModel);

        $grid->id('Id');
        $grid->ditch_name('渠道名称');
        $grid->ditch_identifying('渠道标识');
        $grid->codePath('二维码')->view('content');
        $grid->number('关注人数');

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
        $show = new Show(OrcodeModel::findOrFail($id));

        $show->id('Id');
        $show->ditch_name('Ditch name');
        $show->ditch_identifying('Ditch identifying');
        $show->codePath('CodePath');
        $show->number('Number');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new OrcodeModel);

        $form->text('ditch_name', 'Ditch name');
        $form->text('ditch_identifying', 'Ditch identifying');
        $form->text('codePath', 'CodePath');
        $form->number('number', 'Number');

        return $form;
    }
}
