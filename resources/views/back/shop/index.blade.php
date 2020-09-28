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
        <div class="row">
            @foreach ($PRODUCTS as $PRODUCT)
            <div class="col-md-3">
                <div class="card mb-3 box-shadow">
                <img class="card-img-top" src="/storage/images/productimage/{{$PRODUCT->image}}" style="max-height: 350px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_172e7131c6e%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_172e7131c6e%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                <div class="card-body">
                    <h5 class="card-text">{{$PRODUCT->name}}</h5>
                    <h5 class="card-text">
                        <?php
                            $level = auth()->user()->level;
                            $itemCategory = $PRODUCT->category;
                            $resultLevel = '';
                            
                            $objs = json_decode($level, JSON_UNESCAPED_UNICODE);
                                                    
                            foreach ($objs as $key => $value) {
                                if($key == $itemCategory)
                                {
                                    $resultLevel = $value;
                                }
                            }
                        ?>
                        @switch($resultLevel)
                            @case("三星總經銷")
                            {{$PRODUCT->a_price}}
                                @break
                            @case("二星區顧問")
                            {{$PRODUCT->b_price}}
                                @break
                            @case("一星級顧問")
                            {{$PRODUCT->c_price}}
                                @break
                            @case("白金級顧問")
                            {{$PRODUCT->d_price}}
                                @break
                            @case("黃金級顧問")
                            {{$PRODUCT->e_price}}
                                @break
                            @case("尊榮級顧問")
                            {{$PRODUCT->f_price}}
                                @break
                            @default
                        @endswitch
                    </h5>
                    <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <form action="/admin/add-to-cart/{{$PRODUCT->id}}" method="POST">
                            {{ csrf_field() }}
                            <input type="number" name="number" value="1" min="1">
                            
                            <input type="submit" class="btn btn-sm btn-outline-secondary" value="加入購物車">
                        </form>
                        
                    </div>
                    </div>
                </div>
                </div>
            </div>    
            @endforeach        
        </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
