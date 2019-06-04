<!DOCTYPE html>
<html>
<head>
    <title>主页</title>
</head>
<body>

<div class="user_div" style="display:none">
    <table border="1">
        <tr>
            <td><input type="checkbox" id="c"></td>
            <td width="50" align="center"> id</td>
            <td width="250" align="center">关注时间</td>
            <td width="50" align="center">用户性别</td>
        </tr>
        @foreach($data as $k=>$v)
            <tr>
                <td openid="{{$v->openid}}"><input type="checkbox" class="d"></td>
                <td width="50" align="center"> {{$v->nickname}}</td>
                <td width="250" align="center">{{date('Y-m-d H:i',$v->subscribe_time)}}</td>
                <td width="250" align="center">
                    @if ($v->sex == 1)
                        男
                    @else
                        女
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</div>
<div class="tag">
    <table border="1">
       <tr>
           <td><input type="checkbox" id="c1"></td>
           <td width="50" align="center"> 标签名称</td>
           <td width="250" align="center">关注时间</td>
           <td width="50" align="center">标签id</td>
       </tr>

        @foreach($data1 as $key=>$value)
            <tr>
                <td id="{{$value->id}}"><input type="checkbox" class="d1"></td>
                <td width="50" align="center"> {{$value->tag_name}}</td>
                <td width="250" align="center">{{date('Y-m-d H:i',$value->add_time)}}</td>
                <td width="250" align="center">{{$value->lable_id}}</td>
            </tr>
            @endforeach
    </table>


</div>

<form action="">
    <select name="" id="" class="user">
        <option value="2" class="user2">用户标签管理</option>
        <option value="1" class="user1">根据OpenID列表群发</option>
        <option value="3"></option>
    </select>
</form>
<p>请选择要发送的内容:<input type="text" id="text"></p>
<button id="btn">点我发送</button>
{{--<input type="submit" value="点我发送" id="btn">--}}
</body>
</html>
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script>
    //
    $('.user').on('change',function(){
        //alert($);
        var src=$(".user1").attr('value');
        var src1=$(".user2").attr('value');
        //console.log(src);
       // console.log(src1);
        if(src=='1'){
            $('.user_div').show();
        }else{
            $('.user_div').hide();
        }

        // $(".bg_div").show();

    });
    //判断根据openid群发
    $('#c').click(function(){
        var type=$('#c').prop('checked');
        $('.d').prop('checked',type);
    })
    //全选
    $('.d').click(function(){
        if($(this).prop('checked')==false){
            $('#c').prop('checked',false);
        }
    })

    //判断标签
    $('#c1').click(function(){
        var type=$('#c1').prop('checked');
        $('.d1').prop('checked',type);
    })

    //全选
    $('.d1').click(function(){
        if($(this).prop('checked')==false){
            $('#c1').prop('checked',false);
        }
    })
    //点击发送
    $('#btn').click(function(){
        var opid=$('.d');//
       // console.log(opid);
        var s_id=$('.d1');
        var text=$('#text').val();
        var id='';
        var openid='';
        opid.each(function(res){
            if($(this).prop('checked')==true) {
                openid += $(this).parent('td').attr('openid')+ ',' ;
            }
        })
        //console.log(openid);
        s_id.each(function(res){
            if($(this).prop('checked')==true) {
                id += $(this).parent('td').attr('id') ;
            }
        })
        //console.log(id);
        openid=openid.substr(0,openid.length-1);
        //console.log(openid);
//        if(openid==''){
//            alert('请选择要发送的人');
//            return false;
//        }
//        if(text==''){
//            alert('请输入发送的内容');
//            return false;
//        }
        $.ajax({
           // url : 'messageAss?openid='+openid+'&text='+text,
            url : '/admin/messageAss',
            data:{openid:openid,id:id,text:text},
            type:'get',
            dataType:'json',
            success:function(res){
                if(res=='1'){
                    alert("发送成功");
                }else{
                    alert("发送失败");
                }
            }
        })
    })








</script>