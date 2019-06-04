<!DOCTYPE html>
<html>
<head>
    <title>主页</title>
</head>
<body>

    <table border="1">
        <tr>
            <td style="display: none"><input type="text" value="{{$s_id}}" class="t_id"></td>
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



<button id="btn">添加粉丝</button>
{{--<input type="submit" value="点我发送" id="btn">--}}
</body>
</html>
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script>

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

    //点击发送
    $('#btn').click(function(){
        var opid=$('.d');
        var text=$('#text').val();
        var t_id=$('.t_id').prop('value');
        //console.log(t_id);
        var openid='';
        opid.each(function(res){
            if($(this).prop('checked')==true) {
                openid += '"'+$(this).parent('td').attr('openid') + '"'+',';
            }
        })
       // openid='"'+openid+'"';
         //console.log(openid);
        openid=openid.substr(0,openid.length-1);
        //console.log(openid);
        if(openid==''){
            alert('请选择要发送的人');
            return false;
        }
//
        $.ajax({
            url : '/admin/makeTag',
            data:{openid:openid,t_id:t_id},
            type:'get',
            dataType:'json',
            success:function(res){
                if(res=='1'){
                    alert("分配成功");
                }else{
                    alert("分配失败");
                }
            }
        })
    })








</script>