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
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <div class="card-header">
                            <h3 class="card-title">修改商品</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="/admin/product/{{$PRODUCT->id}}/update" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="ProductName">商品名稱</label>
                                        <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="商品名稱" value="{{$PRODUCT->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="ProductImage">商品照片</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="ProductImage" name="ProductImage">
                                                <label class="custom-file-label" for="ProductImage">Choose file</label>
                                            </div>
                                        </div>
                                        <img src="/storage/images/productimage/{{$PRODUCT->image}}" id="ProductImage_tag" class="img elevation-2" style="max-width:120px" />
                                    </div>
                                    <div class="form-group">
                                        <label for="ProductDescription">描述</label>
                                        <textarea type="text" class="form-control" id="ProductDescription" name="ProductDescription">{{$PRODUCT->description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="Product_A_Price">三星級經銷價格</label>
                                        <input type="text" class="form-control" id="Product_A_Price" name="Product_A_Price" value="{{$PRODUCT->	a_price}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Product_B_Price">二星級顧問價格</label>
                                        <input type="text" class="form-control" id="Product_B_Price" name="Product_B_Price" value="{{$PRODUCT->	b_price}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Product_C_Price">一星級顧問價格</label>
                                        <input type="text" class="form-control" id="Product_C_Price" name="Product_C_Price" value="{{$PRODUCT->	c_price}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Product_D_Price">白金級顧問價格</label>
                                        <input type="text" class="form-control" id="Product_D_Price" name="Product_D_Price" value="{{$PRODUCT->	d_price}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Product_E_Price">黃金級顧問價格</label>
                                        <input type="text" class="form-control" id="Product_E_Price" name="Product_E_Price" value="{{$PRODUCT->	e_price}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Product_F_Price">尊榮級顧問價格</label>
                                        <input type="text" class="form-control" id="Product_F_Price" name="Product_F_Price" value="{{$PRODUCT->	f_price}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Category">產品分類</label>
                                        <select class="form-control" id="Category" name="Category" required>
                                            @if ($PRODUCT->category == "美妝")
                                            <option selected value="美妝">美妝</option>
                                            <option value="保健">保健</option>
                                            @else
                                            <option value="美妝">美妝</option>
                                            <option selected value="保健">保健</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#ProductImage_tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#ProductImage").change(function(){
            readURL(this);
        });
    </script>

@endsection
