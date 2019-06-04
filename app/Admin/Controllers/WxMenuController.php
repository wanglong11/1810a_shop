<?php
namespace App\Admin\Controllers;
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
use App\Model\MenuModel;
class WxMenuController extends Controller
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
            ->description('菜单添加')
            ->row($this->add());
            //->body(view('admin/WX/menu'));

    }
    /**
     * 到添加添加页面select
        */
    public function add(){
        $where=[
            'parent_id'=>0
        ];
        $res=MenuModel::where($where)->get()->toArray();
        //dd($res);
        return view('admin/WX/menu',compact('res'));
    }
    /**
     * 菜单素材添加
    */
    public function Menuadd(Request $request){
        //微信素材名称
       // $r=$request->all();
        //dd($r);
        $menu_name=$request->menu_name;//菜单名称
        $menu_type=$request->menu_type;//菜单类型
        $key=$request->key;//菜单key
        $parent_id=$request->parent_id;//是否是顶级分类

//        echo"$menu_name";
//        echo"$menu_type";
//        dd($key);
//
             $data=[
                    'menu_name'=>$menu_name,
                    'menu_type'=>$menu_type,
                    'key'=>$key,
                    'parent_id'=> $parent_id
                   ];
        $res= MenuModel::insertGetId($data);

        if($res){
            echo "添加成功";
            echo $res;
            header("Refresh:2,url=http://1809wangweilong.comcto.com/admin/MenuList");
        }else{
            echo"添加失败";
            //header("Refresh:2,url=/");
        }
    }
    /**
     * 一键同步微信菜单
    */

//    public function  synchronization(){
//        $access_token=Wechat::token();
//        $url= 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token;
//        //dump($url);die;
//        $data= MenuModel::all()->toArray();//从数据库读取数据
//        //接口数据
//        $post_arr=[];
//        foreach ($data as $k=>$v){
//            if($v['menu_type']=='click'){
//                $post_arr['button'][]=[
//
//                    'type'=>$v['menu_type'],
//                    'name'=>$v['menu_name'],
//                    'key'=> $v['key'],
//
//                ];
//            }else{
//                $post_arr['button'][]=[
//
//                    'type'=>$v['menu_type'],
//                    'name'=>$v['menu_name'],
//                      //""=>$v['key'],
//                    "url"=>$v['key'],
//
//                ];
//            }
//
//        }
//        //var_dump($post_arr);
//
//        $json_str=json_encode($post_arr, JSON_UNESCAPED_UNICODE);//JSON_UNESCAPED_UNICODE（中文不转为unicode ，对应的数字 256）
//        //dd($json_str);die;
//        //发生请求
//        $client= new Client();
//        $responce=$client->request('POST',$url,[
//            'body'=>$json_str
//        ]);
//
//        //dd($responce);die;
//        //处理响应
//        $res_str=$responce->getBody();
//        echo $res_str;
//        echo "一键同步微信成功";
//
//
//
//    }
      //

    /**
     * 一键同步微信菜单
     **/
    public function synchronization(){
        $access_token=Wechat::token();
        $url= 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token;
        //dump($url);die;
        //$data= MenuModel::all()->toArray();//从数据库读取数据
        $data = MenuModel::where(['parent_id'=>0])->get()->toArray();//查询一级菜单
        //dd($data);
        //通过一级菜单查出二级
        $post_arr=[];
        $typeArr = ['click'=>'key','view'=>'url','location_select'=>'key']; //菜单类型
        foreach ($data as $k=>$v){
          $re= MenuModel::where(['parent_id'=>$v['id']])->get()->toArray();//查询二级菜单
           // dd($re);
            if($re){
                $childData = MenuModel::where(['id'=>$v['id']])->update(['menu_type'=>'','key'=>'']);//根据一级菜单id对应修改清空
                //否者就是二级菜单
                    $post_arr['button'][$k]['name'] = $v['menu_name'];//添加名称
                    //$menu_data['button'][$key]['sub_button'] = [];
                    //通过一级菜单查出二级
                    foreach ($re as $key => $value) {
                        $post_arr['button'][$k]['sub_button'][] = [
                            'type'=> $value['menu_type'],
                            'name'=> $value['menu_name'],
                            $typeArr[$value['menu_type']] => $value['key']
                        ];
                    }

            }else{
                //否者就是一级菜单
                //一级菜单下没有二级菜单的
                $post_arr['button'][] = [
                    'type'=> $v['menu_type'],
                    'name'=> $v['menu_name'],
                    $typeArr[$v['menu_type']] => $v['key']
                ];
            }
        }
       //dd($post_arr);
        $json_str=json_encode($post_arr, JSON_UNESCAPED_UNICODE);//JSON_UNESCAPED_UNICODE（中文不转为unicode ，对应的数字 256）
        //dd($json_str);die;
        //发生请求
        $client= new Client();
        $responce=$client->request('POST',$url,[
            'body'=>$json_str
        ]);

        //dd($responce);die;
        //处理响应
        $res_str=$responce->getBody();
        echo $res_str;
        echo "一键同步微信成功";


    }


}