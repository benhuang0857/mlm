@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">結帳</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
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
                            <!-- /.card-body -->
                            <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right">送出訂單</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <h4>總金額：$ {{$TOTALPRICE}}</h4>
                </div>
                <!-- /.col-md-6 -->
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
