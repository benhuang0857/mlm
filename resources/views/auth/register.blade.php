@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">新增下線會員</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">會員資料</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">姓名</label>

                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                                <label for="nickname" class="col-md-4 control-label">暱稱</label>

                                <div class="col-md-12">
                                    <input id="nickname" type="text" class="form-control" name="nickname" value="{{ old('nickname') }}" autofocus>

                                    @if ($errors->has('nickname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nickname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">手機</label>

                                <div class="col-md-12">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('line_id') ? ' has-error' : '' }}">
                                <label for="line_id" class="col-md-4 control-label">LINE ID</label>

                                <div class="col-md-12">
                                    <input id="line_id" type="text" class="form-control" name="line_id" value="{{ old('line_id') }}" autofocus>

                                    @if ($errors->has('line_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('line_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">聯絡地址</label>

                                <div class="col-md-12">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fb_account') ? ' has-error' : '' }}">
                                <label for="fb_account" class="col-md-4 control-label">臉書帳號</label>

                                <div class="col-md-12">
                                    <input id="fb_account" type="text" class="form-control" name="fb_account" value="{{ old('fb_account') }}" autofocus>

                                    @if ($errors->has('fb_account'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fb_account') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ig_account') ? ' has-error' : '' }}">
                                <label for="ig_account" class="col-md-4 control-label">IG帳號</label>

                                <div class="col-md-12">
                                    <input id="ig_account" type="text" class="form-control" name="ig_account" value="{{ old('ig_account') }}" autofocus>

                                    @if ($errors->has('ig_account'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ig_account') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('authorization_code') ? ' has-error' : '' }}">
                                <label for="authorization_code" class="col-md-4 control-label">授權碼</label>

                                <div class="col-md-12">
                                <input id="authorization_code" type="text" class="form-control" name="authorization_code" value="{{str_pad(Auth::user()->id,5,'0',STR_PAD_LEFT)}}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                <label for="avatar">大頭照</label>
                                <input type="file" class="form-control-file" id="avatar" name="avatar">
                                <img src="" id="avatar_tag" class="img elevation-2" style="max-width:120px" />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                <label for="role">會員身分</label>
                                <select class="form-control" id="role" name="role" required>
                                    @if (Auth::user()->role == "一般會員")
                                    <option selected value="一般會員">一般會員</option>
                                    <option value="管理員">管理員</option>
                                    <option value="最高權限管理員">最高權限管理員</option>
                                    @elseif(Auth::user()->role == "管理員")
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
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">密碼</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">確認密碼</label>

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <div class="col-md-12">
                                <label for="leader_id">指派領導</label>
                                <select class="form-control" id="leader_id" name="leader_id">
                                    <?php
                                        use App\Models\User;
                                        $USERS = User::all();
                                    ?>
                                    @foreach ($USERS as $USER)
                                    <option value="{{$USER->id}}">{{$USER->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="remarks" class="col-md-4 control-label">備註</label>

                                <div class="col-md-12">
                                    <textarea class="form-control" id="remarks" name="remarks" rows="4">
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        建立帳號
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='{{ asset('dist/js/select2.min.js') }}'></script>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#avatar_tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#avatar").change(function(){
            readURL(this);
        });

        $("#leader_id").select2({
            selectOnClose: true
        });
        
        var randomstring = Math.random().toString(36).slice(-8);
        $('#password').val(randomstring);
        $('#password-confirm').val(randomstring);
    </script>
@endsection
