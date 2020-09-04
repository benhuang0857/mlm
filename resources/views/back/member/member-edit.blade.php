@extends('layouts.backlayout')

@section('content')
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
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
                            <h3 class="card-title">修改會員資料</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="/admin/members/{{$MEM->id}}/update" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">會員姓名</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="會員姓名" value="{{$MEM->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nickname">會員暱稱</label>
                                        <input type="text" class="form-control" id="nickname" name="nickname" placeholder="會員暱稱" value="{{$MEM->nickname}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="AvatarImage">會員照片</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="AvatarImage" name="AvatarImage">
                                                <label class="custom-file-label" for="AvatarImage">Choose file</label>
                                            </div>
                                        </div>
                                        <img src="/storage/images/avatar/{{$MEM->image}}" id="AvatarImage_tag" class="img elevation-2" style="max-width:120px" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">會員Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{$MEM->email}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">會員電話</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{$MEM->phone}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">會員地址</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{$MEM->address}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="fb_account">會員臉書帳號</label>
                                        <input type="text" class="form-control" id="fb_account" name="fb_account" value="{{$MEM->fb_account}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="ig_account">會員IG帳號</label>
                                        <input type="text" class="form-control" id="ig_account" name="ig_account" value="{{$MEM->ig_account}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="milage">里程數</label>
                                        <input type="number" class="form-control" id="milage" name="milage" value="{{$MEM->milage}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="role">會員身分</label>
                                        <select class="form-control" id="role" name="role" required>
                                            @if ($MEM->role == "一般會員")
                                            <option selected value="一般會員">一般會員</option>
                                            <option value="管理員">管理員</option>
                                            <option value="最高權限管理員">最高權限管理員</option>
                                            @elseif($MEM->role == "管理員")
                                            <option value="一般會員">一般會員</option>
                                            <option selected value="管理員">管理員</option>
                                            <option value="最高權限管理員">最高權限管理員</option>
                                            @else
                                            <option value="一般會員">一般會員</option>
                                            <option value="管理員">管理員</option>
                                            <option selected value="最高權限管理員">最高權限管理員</option>
                                            @endif
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="password">會員新密碼</label>
                                        <input id="password" type="password" class="form-control" name="password">
                                    </div>

                                    <div class="form-group">
                                        <label for="leader_id">指派領導</label>
                                        <select class="form-control" id="leader_id" name="leader_id">
                                            @foreach ($LEADERS as $LEADER)
                                            <option <?php if($MEM->leader_id == $LEADER->id) echo "selected"?> value="{{$LEADER->id}}">{{$LEADER->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                <button type="submit" class="btn btn-primary">送出</button>
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
    <script src='{{ asset('dist/js/select2.min.js') }}'></script>
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

        $("#leader_id").select2({
            selectOnClose: true
        });
    </script>

@endsection
