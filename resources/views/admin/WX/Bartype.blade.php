<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>微信渠道展示条形图</title>
</head>
<body>
<!-- 图表容器 DOM -->
<div id="container" style="width: 600px;height:400px;"></div>
<!-- 引入 highcharts.js -->
<script src="http://cdn.highcharts.com.cn/highcharts/highcharts.js"></script>
<script>
    // 图表配置
    var options = {
        chart: {
            type: 'bar'                       //指定图表的类型，默认是折线图（line）
        },
        title: {
            text: '微信渠道展示条形图'                 // 标题
        },
        xAxis: {
            {{--categories: [{{$a}}]   // x 轴分类--}}
            categories: [<?php echo $a?>]   // x 轴分类
        },
        yAxis: {
            title: {
                text: '渠道关注人数展示'                // y 轴标题
            }
        },
        series: [{                              // 数据列
            name: '关注人数',                        // 数据列名
            data: [<?php echo $b?>]             // 数据
        }]
    };
    // 图表初始化函数
    var chart = Highcharts.chart('container', options);
</script>
</body>
</html>
