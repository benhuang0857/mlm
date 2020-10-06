@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="form-element segments-page">
        <!-- Main content -->
        <div class="content">
            <div class="row">
				<div class="col-6 px-2">
					<a class="btn waves-effect button-full" href="{{url('/admin/product/create')}}"><i class="fas fa-plus"></i>創建商品</a>
				</div>
				<div class="col-6 px-2">
					<a class="btn waves-effect button-full" href="{{url('/admin/product/category')}}"><i class="fas fa-plus"></i>創建商品分類</a>
				</div>
			</div>
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
                        <td><img src="{{url('/storage/images/productimage/'.$PRODUCT->image.'')}}" style="max-width:120px" class="img elevation-2" alt="Product Image"></td>
                        <td>
                            {{$PRODUCT->name}}
                            <small class="badge badge-warning"><i class="fas fa-filter"></i>{{'  '.$PRODUCT->category}}</small>
                        </td>
                        <td>
                            {{$PRODUCT->a_price}}</br>{{$PRODUCT->b_price}}</br>{{$PRODUCT->c_price}}</br>{{$PRODUCT->d_price}}</br>{{$PRODUCT->e_price}}</br>{{$PRODUCT->f_price}}</br>
                        </td>
                        <td>
                            <a class="btn btn-primary" style="margin-bottom:5px" href="{{url('/admin/product/'.$PRODUCT->id.'/edit')}}">編輯</a>
                            <form action="{{url('/admin/product/'.$PRODUCT->id.'/delete')}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button class="btn btn-danger" type="submit">刪除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
