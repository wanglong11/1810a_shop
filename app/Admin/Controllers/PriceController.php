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
use App\Model\PirceModel;
use App\Model\Wechat;
class PriceController extends Controller
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
            ->header('优惠价管理')
            ->description('优惠价添加')
            ->body(view('admin/WX/price'));

    }


    public function Priceadd(Request $request){
        $price_name=$request->price_name;//优惠劵名称
        $price_num=$request->price_num;//惠劵数量
        $price_condition=$request->price_condition;//惠劵使用的条件【元】
        $price_punishment=$request->price_punishment;//惠劵的减免金额【元】
        //dd($price_name);
        $data=[
            'price_name'=>$price_name,
            'price_num'=>$price_num,
            'price_condition'=>$price_condition,
            'price_punishment'=>$price_punishment,
            'addtime'=>time()

        ];
        $res= PirceModel::orderBy('id', 'desc')
            ->value('addtime');
        //dd($res);
        if(time()-$res<86400){
            echo "很遗憾！一天只能添加一天优惠劵";die;
        }else{
            $res= PirceModel::insertGetId($data);
            //dd($res);
            if($res){
                echo "添加成功";
                //header("Refresh:2,url=http://1809wangweilong.comcto.com/admin/Textadmin");
            }else{
                echo"添加失败";
                // header("Refresh:2,url=/");
            }
            //dd($res);
        }




    }



}
