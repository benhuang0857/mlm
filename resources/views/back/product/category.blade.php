@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="form-element segments-page">

        <!-- Main content -->
        <div class="content">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">目前商品分類</h3>
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
                            <form role="form" action="{{url('/admin/product/category/delete/'.$category->id.'')}}" method="POST" enctype="multipart/form-data">
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
            </div>

            <form role="form" action="{{url('/admin/product/category/store')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">新增商品分類</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="CategoryName">分類達標數量</label>
                            <input type="text" class="form-control" id="CategoryName" name="CategoryName" placeholder="名稱" required>
                        </div>
                        <div class="form-group">
                            <label for="a_level">A級達標數量</label>
                            <input type="number" class="form-control" id="a_level" name="a_level" placeholder="數量" required>
                        </div>
                        <div class="form-group">
                            <label for="b_level">B級達標數量</label>
                            <input type="number" class="form-control" id="b_level" name="b_level" placeholder="數量" required>
                        </div>
                        <div class="form-group">
                            <label for="c_level">C級達標數量</label>
                            <input type="number" class="form-control" id="c_level" name="c_level" placeholder="數量" required>
                        </div>
                        <div class="form-group">
                            <label for="d_level">D級達標數量</label>
                            <input type="number" class="form-control" id="d_level" name="d_level" placeholder="數量" required>
                        </div>
                        <div class="form-group">
                            <label for="e_level">E級達標數量</label>
                            <input type="number" class="form-control" id="e_level" name="e_level" placeholder="數量" required>
                        </div>
                        <div class="form-group">
                            <label for="f_level">F級達標數量</label>
                            <input type="number" class="form-control" id="f_level" name="f_level" placeholder="數量" required>
                        </div>

                        <div class="form-group">
                            <label for="a_name">A級別名</label>
                            <input type="text" class="form-control" id="a_name" name="a_name" required>
                        </div>
                        <div class="form-group">
                            <label for="b_name">B級別名</label>
                            <input type="text" class="form-control" id="b_name" name="b_name" required>
                        </div>
                        <div class="form-group">
                            <label for="c_name">C級別名</label>
                            <input type="text" class="form-control" id="c_name" name="c_name" required>
                        </div>
                        <div class="form-group">
                            <label for="d_name">D級別名</label>
                            <input type="text" class="form-control" id="d_name" name="d_name" required>
                        </div>
                        <div class="form-group">
                            <label for="e_name">E級別名</label>
                            <input type="text" class="form-control" id="e_name" name="e_name" required>
                        </div>
                        <div class="form-group">
                            <label for="f_name">F級別名</label>
                            <input type="text" class="form-control" id="f_name" name="f_name" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn waves-effect button-full">送出</button>
                    </div>
                </div>
                
            </form>
            
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
