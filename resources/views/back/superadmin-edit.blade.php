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
                            <form role="form" action="/admin/edit/{{$USER->id}}/update" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">您的姓名</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="商品名稱" value="{{$USER->name}}">
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
                                        <label for="authorization_code">授權碼</label>
                                        <input type="text" class="form-control" id="authorization_code" name="authorization_code" value="{{$USER->authorization_code}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="level">等級</label>
                                        <input type="text" class="form-control" id="level" name="level" value="{{$USER->level}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="milage">里程數</label>
                                        <input type="text" class="form-control" id="milage" name="milage" value="{{$USER->milage}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="leader_name">上級領導</label>
                                        <input type="text" class="form-control" id="leader_name" name="leader_name" value="">
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
