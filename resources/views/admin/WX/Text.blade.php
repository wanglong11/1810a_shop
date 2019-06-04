<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta charset="utf-8">	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" href="https://static.jianshukeji.com/hcode/images/favicon.ico">
    <style>
        /* css 代码  */
    </style>
    <script src="https://code.highcharts.com.cn/jquery/jquery-1.8.3.min.js"></script>
    <script src="https://code.highcharts.com.cn/highcharts/highcharts.js"></script>
    <script src="https://code.highcharts.com.cn/highcharts/highcharts-more.js"></script>
    <script src="https://code.highcharts.com.cn/highcharts/modules/exporting.js"></script>
    <script src="https://img.hcharts.cn/highcharts-plugins/highcharts-zh_CN.js"></script>
</head>
<body>
<div id="container" style="min-width: 310px; max-width: 600px; height: 400px; margin: 0 auto"></div>
</body>
</html>
<script>

    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'waterfall'
            },
            title: {
                text: '2016 年某公司人员变动情况'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'USD'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: '<b>{point.y}</b>人 {point.label}'
            },
            series: [{
                upColor: 'green',
                borderWidth: 0,
                minPointLength: 5,
                color: 'red',
                data: [{
                    name: 'Q1.2015',
                    color: '#66B3FF',
                    label: '初创团队',
                    y: 5
                }, {
                    name: 'Q2.2015',
                    y: 2
                }, {
                    name: 'Q3.2015',
                    y: -1
                }, {
                    name: '15年总数',
                    isIntermediateSum: true,
                    color: '#006CEE'
                }, {
                    name: 'Q1.2016',
                    y: 5,
                    label: '团队扩招',
                    color: 'yellow'
                }, {
                    name: 'Q2.2016',
                    y: 1
                },{
                    name: 'Q3 & Q4',
                    y: 0,
                    color: '#000'
                }, {
                    name: '16年总数',
                    color: '#006CEE',
                    isSum: true
                },{
                    name: 'Q1.2017',
                    y:2
                },{
                    name: '总数',
                    isSum: true,
                    color: Highcharts.getOptions().colors[1]
                }],
                dataLabels: {
                    enabled: true,
                    style: {
                        color: '#FFFFFF',
                        fontWeight: 'bold',
                        textShadow: '0px 0px 3px black'
                    }
                },
                pointPadding: 0
            }]
        });
    });

</script>