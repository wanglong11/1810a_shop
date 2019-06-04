<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>女孩</title>
</head>
<body>
</body>
</html>
<script src="http://res2.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/qrcode.js"></script>
<script>
    wx.config({
        //debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: "{{$jsconfig['appId']}}", // 必填，公众号的唯一标识
        timestamp: "{{$jsconfig['timestamp']}}", // 必填，生成签名的时间戳
        nonceStr: "{{$jsconfig['nonceStr']}}", // 必填，生成签名的随机串
        signature: "{{$jsconfig['signature']}}",// 必填，签名
        jsApiList: ['updateAppMessageShareData'] // 必填，需要使用的JS接口列表
    });
    wx.ready(function () {   //需在用户可能点击分享按钮前就先调用
            wx.updateAppMessageShareData({
                title: '女孩', // 分享标题
                desc: '漂亮的', // 分享描述
                link: 'http://1809wangweilong.comcto.com', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: 'http://1809wangweilong.comcto.com/images/logo.jpg', // 分享图标
                success: function () {
                    alert('分享成功');
                }
            })
       // wx.hideAllNonBaseMenuItem();隐藏所有非基础按钮接口


        });

</script>