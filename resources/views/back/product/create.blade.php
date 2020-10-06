@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="form-element segments-page">

        <!-- Main content -->
        <div class="content">
            <form role="form" action="{{url('/admin/product/create/store')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="ProductName">商品名稱</label>
                        <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="商品名稱" required>
                    </div>
                    <div class="form-group">
                        <label for="ProductImage">商品照片</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="ProductImage" name="ProductImage" required>
                                <label class="custom-file-label" for="ProductImage">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                            </div>
                        </div>
                        <img src="" id="ProductImage_tag" class="img elevation-2" style="max-width:65%; margin-top:10px;display: block;margin-left:auto;margin-right:auto" />
                    </div>
                    <div class="form-group">
                        <label for="ProductDescription">描述</label>
                        <textarea type="text" class="form-control" id="ProductDescription" name="ProductDescription" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Product_A_Price">三星總經銷價格</label>
                        <input type="text" class="form-control" id="Product_A_Price" name="Product_A_Price" required>
                    </div>
                    <div class="form-group">
                        <label for="Product_B_Price">二星區顧問價格</label>
                        <input type="text" class="form-control" id="Product_B_Price" name="Product_B_Price" required>
                    </div>
                    <div class="form-group">
                        <label for="Product_C_Price">一星級顧問價格</label>
                        <input type="text" class="form-control" id="Product_C_Price" name="Product_C_Price" required>
                    </div>
                    <div class="form-group">
                        <label for="Product_D_Price">白金級顧問價格</label>
                        <input type="text" class="form-control" id="Product_D_Price" name="Product_D_Price" required>
                    </div>
                    <div class="form-group">
                        <label for="Product_E_Price">黃金級顧問價格</label>
                        <input type="text" class="form-control" id="Product_E_Price" name="Product_E_Price" required>
                    </div>
                    <div class="form-group">
                        <label for="Product_F_Price">尊榮級顧問價格</label>
                        <input type="text" class="form-control" id="Product_F_Price" name="Product_F_Price" required>
                    </div>
                    <div class="form-group">
                        <label for="Category">產品分類</label>
                        <select class="form-control" id="Category" name="Category" required required>
                            @foreach ($CATEGORY as $category)
                            <option value="{{$category->name}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <button type="submit" class="btn waves-effect button-full">創建商品</button>
                </div>
            </form>
            
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
