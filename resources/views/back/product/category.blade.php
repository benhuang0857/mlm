@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">商品分類</h1>
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
                            <h3 class="card-title">新增商品分類</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table m-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>產品分類名稱</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody id="dynamic-row">
                                @foreach ($CATEGORY as $category)
                                    <tr>
                                    <th scope="row">#</th>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        <form role="form" action="/admin/product/category/delete/{{$category->id}}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger">刪除</button>
                                        </form>
                                    </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                </table>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{url('/admin/product/category/store')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="CategoryName">分類名稱</label>
                                        <input type="text" class="form-control" id="CategoryName" name="CategoryName" placeholder="名稱" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="a_level">三星級經銷達標數量</label>
                                        <input type="number" class="form-control" id="a_level" name="a_level" placeholder="數量" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="b_level">二星級顧問達標數量</label>
                                        <input type="number" class="form-control" id="b_level" name="b_level" placeholder="數量" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="c_level">一星級顧問達標數量</label>
                                        <input type="number" class="form-control" id="c_level" name="c_level" placeholder="數量" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="d_level">白金級顧問達標數量</label>
                                        <input type="number" class="form-control" id="d_level" name="d_level" placeholder="數量" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="e_level">黃金級顧問達標數量</label>
                                        <input type="number" class="form-control" id="e_level" name="e_level" placeholder="數量" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="f_level">尊榮級顧問達標數量</label>
                                        <input type="number" class="form-control" id="f_level" name="f_level" placeholder="數量" required>
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
@endsection
