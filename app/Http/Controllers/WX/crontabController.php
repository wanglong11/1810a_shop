<?php

namespace App\Http\Controllers\WX;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class crontabController extends Controller
{
    /**
     * 删除未支付超过一个半个小时的订单
     **/
    public function del(){
        //echo "111";
        $res=\DB::table('p_orders')->get()->toArray();
        //dd($res);
        foreach ($res as $k=>$v){
            if(time()-$v->add_time>1800 && $v->is_pay==0){
                //设置为删除状态
                $res1=\DB::table('p_orders')->where(['id'=>$v->id])->update(['is_delete'=>1]);
            }
        }
    }
    public function md5(){
       $a='111';
        $b=md5($a);
//        dd($b);
        $c=OracleMD5($b);
            dd($c);



    }

}
