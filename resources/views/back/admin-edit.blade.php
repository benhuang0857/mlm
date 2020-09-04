@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">更新資訊</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <div class="card-header">
                            <h3 class="card-title">修改</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="/admin/update" method="POST" enctype="multipart/form-data">
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
                                        <img src="/storage/images/avatar/{{$USER->image}}" id="AvatarImage_tag" class="img elevation-2" style="max-width:120px" />
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
                                        <label for="fb_account">臉書帳號</label>
                                        <input type="text" class="form-control" id="fb_account" name="fb_account" value="{{$USER->fb_account}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="ig_account">IG帳號</label>
                                        <input type="text" class="form-control" id="ig_account" name="ig_account" value="{{$USER->ig_account}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-md-4 control-label">新密碼</label>
                                        <input id="password" type="password" class="form-control" name="password">
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.col-md-12 -->
                </div>
            
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
