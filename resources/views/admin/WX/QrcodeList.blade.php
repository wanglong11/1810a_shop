<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<script src="http://cdn.highcharts.com.cn/highcharts/highcharts.js"></script>
<body>
<table border="1">
    <tr>
        <td width="50" align="center"> id</td>
        <td width="250" align="center">渠道名称</td>
        <td width="50" align="center">渠道标识</td>
        <td width="250" align="center">二维码</td>
        <td width="250" align="center">关注人数</td>
    </tr>


    @foreach($res as $k=>$v)
        <tr>
            <td width="50" align="center"> {{$v['id']}}</td>
            <td width="250" align="center">{{$v['ditch_name']}}</td>
            <td width="250" align="center">{{$v['ditch_identifying']}}</td>
            <td width="250" align="center" >
                <img class='click_img' src="{{$v['codePath']}}" alt="" width="180" height="180" ></td>
            <td width="50" align="center"> {{$v['number']}}人</td>
        </tr>
    @endforeach
</table>
<div class="bg_div" style="display:none;background: #ccc;width:100%;height: 100%;position: absolute;top:0;left:0;opacity: 0.8;text-align: center;padding-top: 10%">
    <div class="close_div" style="padding-left: 20%">
        <b>关闭</b>
    </div>
    <img src="" style="width: 300px">
</div>
</body>
</html>

<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script>
    //alert($);
    $('.click_img').on('click',function(){
        // alert($);//选中谁操作谁
        //背景层出来
        $(".bg_div").show();
        //获取到点击的img标签路径
        var src = $(this).attr("src");
        //console.log(src);
        //替换img里面的src路径
        $(".bg_div img").attr('src',src);
    });
    //点击关闭时隐藏背景层
    $('.close_div').on('click',function(){
        $(".bg_div").hide();
    });









</script>
