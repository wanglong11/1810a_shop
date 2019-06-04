<form action="Textfodder" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputEmail1">素材名称</label>
        <input type="text" class="form-control" name="Textname" aria-describedby="emailHelp" placeholder="Enter email" width="11111">
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">上传文件</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="headloge"
               value="{{csrf_token()}}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">媒体格式</label>
        <select class="form-control" id="exampleFormControlSelect1" name="Media format">
            <option value="image" >图片</option>
            <option value="video " >视频</option>
            <option value="voice">音频</option>

        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">素材类型</label>
        <select class="form-control" id="exampleFormControlSelect1" name="perpetual">
            <option value="1" >获取临时素材</option>
            <option value="2" >获取永久素材</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>