<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>注册登录界面js特效炫酷切换代码</title>
    <meta name="keywords" content="注册登录界面" />
    <meta name="description" content="注册登录界面。" />
    <meta name="author" content="php中文网" />
    <meta name="copyright" content="php中文网" />
    <link type="text/css" rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="materialContainer">
    <div class="box">
        <div class="title">登录</div>
        <div class="input">
            <label for="name">用户名</label>
            <input type="text" name="name" id="name">
            <span class="spin"></span>
        </div>
        <div class="input">
            <label for="pass">密码</label>
            <input type="password" name="pass" id="pass">
            <span class="spin"></span>
        </div>
        <div class="input">
            <img src="/images/0.jpg" width="70" height="70" class='click_img'>
        </div>
        <div class="input">
            <input type="hidden" value="ojOMz5vve_NeK-jQJkpKdTJx-O5I" id="openid">
            <input type="password" name="pass" id="pass">
            <input type="button" style="height:32px;width:120px;" value="发送验证码" onclick="sendCode(this)" class="fend"/>
        </div>
        <div class="bg_div" style="display:none;background: #ccc;width:100%;height: 100%;position: absolute;top:0;left:0;opacity: 0.8;text-align: center;padding-top: 10%">
            <div class="close_div" style="padding-left: 20%">
                <b>关闭</b>
            </div>
            <img src="" style="width: 300px">
        </div>

        <div class="button login">
            <button><span>立即登录</span> <i class="fa fa-check"></i></button>
        </div>
        <a href="" class="pass-forgot">忘记密码？</a>
        <a href="/Ewn" class="pass-forgot">点击此处微信扫描登录</a>
    </div>
    <div class="overbox">
        <div class="material-button alt-2"><span class="shape"></span></div>
        <div class="title">注册</div>
        <div class="input">
            <label for="regname">用户名</label>
            <input type="text" name="regname" id="regname">
            <span class="spin"></span>
        </div>
        <div class="input">
            <label for="regpass">密码</label>
            <input type="password" name="regpass" id="regpass">
            <span class="spin"></span>
        </div>
        <div class="input">
            <label for="reregpass">确认密码</label>
            <input type="password" name="reregpass" id="reregpass">
            <span class="spin"></span>
        </div>
        <div class="button">
            <button><span>下一步</span></button>
        </div>
    </div>
</div>
<script type="text/javascript" src='js/jquery-1.10.2.min.js'></script>
<script type="text/javascript" src="js/index.js"></script>
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
    var clock = '';
    var nums = 60;
    var btn;
    function sendCode(thisBtn)
    {
        btn = thisBtn;
        btn.disabled = true; //将按钮置为不可点击
        btn.value = nums+'秒后可重新获取';
        clock = setInterval(doLoop, 1000); //一秒执行一次
    }
    function doLoop()
    {
        nums--;
        if(nums > 0){
            btn.value = nums+'秒后可重新获取';
        }else{
            clearInterval(clock); //清除js定时器
            btn.disabled = false;
            btn.value = '点击发送验证码';
            nums = 30; //重置时间
        }
    }
    $('.fend').on('click',function(){
         //var openid=$("#openid").arrt("value");
       var openid= $(" input[ type='hidden' ] ").val();
        //console.log(openid);
        //根据openid通过ajax发送消息模板
        $.ajax({
            url : '/news',
            data:{openid:openid},
            type:'get',
            dataType:'json',
            success:function(res){
                console.log(res);
                if(res=='1'){
                    alert("发送成功注意查收");
                }else{
                    alert("发送失败");
                }
        }
        })






        
    })








</script>
