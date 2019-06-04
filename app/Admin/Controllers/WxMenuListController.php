<?php

namespace App\Admin\Controllers;

use App\Model\MenuModel;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class WxMenuListController extends Controller
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
            ->header('菜单管理')
            ->description('菜单展示')
            ->body($this->grid())
             ->row($this->shows())//提交按钮
            ;
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
        $grid = new Grid(new MenuModel);

        $grid->id('Id');
        $grid->menu_name('菜单名称');
        $grid->menu_type('菜单类型');
        $grid->key('key');
        $grid->parent_id('父级类型');


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
        $show = new Show(MenuModel::findOrFail($id));

        $show->id('Id');
        $show->menu_name('Menu name');
        $show->menu_type('Menu type');
        $show->key('Key');


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new MenuModel);

        $form->text('menu_name', 'Menu name');
        $form->text('menu_type', 'Menu type');
        $form->text('key', 'Key');
       // $form->submit('submit');

        return $form;
    }
    /**
     *展示提交按钮
     */
    public function shows(){
        return view('admin/tools/button');
    }





}
