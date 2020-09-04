@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">購物車</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">品名</th>
                                <th scope="col">數量</th>
                                <th scope="col">價格</th>
                                <th scope="col">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (Session::has('cart'))
                                @foreach ($PRODUCTS as $PRODUCT)
                                    <tr>
                                    <th scope="row">1</th>
                                    <td>{{$PRODUCT['item']['name']}}</td>
                                    <td>{{$PRODUCT['qty']}}</td>
                                    <td>{{$PRODUCT['price']}}</td>
                                    <td>
                                        <a href="/admin/cart/delete/{{$PRODUCT['item']['id']}}" class="btn btn-danger" type="submit">刪除</a>
                                    </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                <td>尚未添加任何品項</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                <td>X</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.col-md-6 -->
            </div>
            @if (isset($TOTALPRICE))
            <div class="row">
                <div class="col-sm-12 col-md-12 col-md-offset-3 col-sm-offset-3 text-right">
                    <strong><h3>總金額：{{$TOTALPRICE}}</h3></strong>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-md-offset-3 col-sm-offset-3 text-right">
                    <a href="/admin/shop/checkout" class="btn btn-success" type="submit">繼續結帳</a>
                </div>
            </div>
            @endif
            
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
