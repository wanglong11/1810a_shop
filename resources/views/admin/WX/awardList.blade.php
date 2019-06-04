<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<table>
    @foreach ($goodsInfo as $k=>$v)
    <tr>
        <td>{{$v['price_name']}}</td>
    </tr>
    <tr>
        <td>{{$v['price_condition']}}</td>
    </tr>
    <tr>
        <td>
    {{$v['price_punishment']}}
        </td>
    </tr>
    <tr>
        <td>{{$v['valid_time']}}</td>
    </tr>
    @endforeach
</table>
</body>
</html>