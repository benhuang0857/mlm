@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="form-element segments-page">
        <div class="content">
            <form role="form" action="{{url('/admin/update')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">您的姓名</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="您的姓名" value="{{$USER->name}}">
                    </div>
                    <div class="form-group">
                        <label for="nickname">您的暱稱</label>
                        <input type="text" class="form-control" id="nickname" name="nickname" placeholder="暱稱" value="{{$USER->nickname}}">
                    </div>
                    <div class="form-group">
                        <label for="AvatarImage">您的照片</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="AvatarImage" name="AvatarImage">
                                <label class="custom-file-label" for="AvatarImage">Choose file</label>
                            </div>
                        </div>
                        <img src="{{url('/storage/images/avatar/'.$USER->image.'')}}" id="AvatarImage_tag" class="img elevation-2" style="max-width:65%; margin-top:10px;display: block;margin-left:auto;margin-right:auto" />
                    </div>
                    <div class="form-group">
                        <label for="email">您的Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$USER->email}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">您的電話</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{$USER->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="address">您的地址</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{$USER->address}}">
                    </div>
                    <div class="form-group">
                        <label for="password">新密碼</label>
                        <input id="password" type="password" class="form-control" name="password">
                    </div>
                    <button type="submit" class="btn waves-effect button-full">更新</button>
                </div>
                
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
                    $('#AvatarImage_tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#AvatarImage").change(function(){
            readURL(this);
        });
    </script>

@endsection
