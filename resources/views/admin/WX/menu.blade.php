<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form action="menuadd" method="get" enctype="multipart/form-data">
    菜单名称<input type="text" name="menu_name"><br><br>
    <div class="form-group">
                <label for="exampleFormControlSelect1">父级菜单</label>
                <select class="form-control" id="exampleFormControlSelect1" name="parent_id">
        <option value="0" >父级</option>
        @foreach ($res as $k=>$v)
            <option value="{{$v['id']}}" >{{$v['menu_name']}}</option>
            @endforeach
            </select>
        </div>
    菜单类型<input type="radio" value="click" name="menu_type"> click
           <input type="radio" value="location_select" name="menu_type">location_select

            <input type="radio" value="view" name="menu_type">view <br><br>

    菜单地址 <input type="text" name="key"> <br><br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>