@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="form-element segments-page">

        <!-- Main content -->
        <div class="content">
            <form role="form" action="{{url('/admin/post/'.$POST->id.'/edit/update')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="PostName">文章名稱</label>
                        <input type="text" class="form-control" id="PostName" name="PostName" value="{{$POST->title}}" placeholder="文章名稱" required>
                    </div>
                    <div class="form-group">
                        <label for="PostImage">文章照片</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="PostImage" name="PostImage">
                                <label class="custom-file-label" for="PostImage">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                            </div>
                        </div>
                        <img src="{{url('/storage/images/postimage/'.$POST->image.'')}}" id="PostImage_tag" class="img elevation-2" style="max-width:65%; margin-top:10px;display: block;margin-left:auto;margin-right:auto" />
                    </div>
                    <div class="form-group">
                        <label for="PostDescription">內容</label>
                        <textarea type="text" class="form-control" id="PostDescription" name="PostDescription" required>{{$POST->body}}</textarea>
                    </div>
                    <button type="submit" class="btn waves-effect button-full">更新文章</button>
                </div>
                <!-- /.card-body -->
            </form>
            
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#PostImage_tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#PostImage").change(function(){
            readURL(this);
        });
    </script>

@endsection
