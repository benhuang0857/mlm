@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="form-element segments-page">
        <!-- Main content -->
        <div class="content">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">訂單資料</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{url('/admin/shop/checkout/submit')}}">
                    {{ csrf_field() }}
                    <div class="card-body">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">收件人姓名</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="inputName" value="{{$USER->name}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">收件人Email</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="{{$USER->email}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPhone" class="col-sm-2 col-form-label">收件人電話</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPhone" name="inputPhone" value="{{$USER->phone}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAdress" class="col-sm-2 col-form-label">收件人地址</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputAdress" name="inputAdress" value="{{$USER->address}}" required>
                        </div>
                    </div>
                    </div>
                    <div class="total-pay b-shadow">
                        <div class="row">
                            <div class="col-8">
                                <div class="contents">
                                    <h5>總金額：</h5>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="contents content-right">
                                    <h5>${{$TOTALPRICE}}</h5>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn waves-effect button-full">送出訂單</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
