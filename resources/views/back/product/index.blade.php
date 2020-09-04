@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">商品</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <a class="btn btn-info" style="margin-bottom:5px" href="/admin/product/create"><i class="fas fa-plus"></i>創建商品</a>
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <!-- /.card-header -->
                            <table class="table">
                            <thead>
                                <tr>
                                <th>圖片</th>
                                <th>品名</th>
                                <th>價格</th>
                                <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($PRODUCTS as $PRODUCT)
                                <tr>
                                    <td><img src="/storage/images/productimage/{{$PRODUCT->image}}" style="max-width:120px" class="img elevation-2" alt="Product Image"></td>
                                    <td>
                                        {{$PRODUCT->name}}
                                        <small class="badge badge-warning"><i class="fas fa-filter"></i>{{'  '.$PRODUCT->category}}</small>
                                    </td>
                                    <td>
                                        {{$PRODUCT->a_price}}</br>{{$PRODUCT->b_price}}</br>{{$PRODUCT->c_price}}</br>{{$PRODUCT->d_price}}</br>{{$PRODUCT->e_price}}</br>{{$PRODUCT->f_price}}</br>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" style="margin-bottom:5px" href="/admin/product/{{$PRODUCT->id}}/edit">編輯</a>
                                        <form action="/admin/product/{{$PRODUCT->id}}/delete" method="POST">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-danger" type="submit">刪除</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
