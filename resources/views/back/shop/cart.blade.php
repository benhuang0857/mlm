@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="form-element segments-page">
        <!-- Main content -->
        <div class="content">
            @if (Session::has('cart'))
                <div class="container">
                    <div class="cart b-shadow">
                        @foreach ($PRODUCTS as $PRODUCT)
                            <div class="cart-product">
                                <a style="float:right" href="{{url('/admin/cart/delete/'.$PRODUCT['item']['id'].'')}}"><i class="fa fa-window-close fa-2x"></i></a>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="contents">
                                            <img src="{{url('/storage/images/productimage/'.$PRODUCT['item']['image'].'')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-6 px-2">
                                        <div class="contents">
                                            <a href="">{{$PRODUCT['item']['name']}}</a>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="contents remove">
                                            <a href=""><i class="fa fa-remove"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="contents">
                                            <p>價格</p>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="contents">
                                            <p class="price">${{$PRODUCT['price']}}</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="contents">
                                            <p>數量</p>
                                        </div>
                                    </div>
                                    <div class="col-6 px-2">
                                        <div class="contents">
                                            <input type="number" value="{{$PRODUCT['qty']}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                        <a href="{{url('/admin/shop/checkout')}}" class="btn button-full" type="submit">繼續結帳</a>
                    </div>
                </div>
            @else
                <i class="fa-7x fa fa-shopping-cart" style="width: 100%;display: inline-block;text-align:center"></i>
                <p style="font-size:15px;width: 100%;display: inline-block;text-align:center">購物車內尚無商品</p>
            @endif
            
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
