@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">歷史訂單</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="display: block;">
              <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>商品名稱</th>
                    <th>數量</th>
                    <th>單價</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1;?>
                    @foreach ($CART->items as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$item['item']['name']}}</td>
                        <td>{{$item['qty']}}</td>
                        <td>{{$item['price']}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix" style="display: block;">
                <div class="col-sm-12 col-md-12 col-md-offset-3 col-sm-offset-3 text-right">
                    <strong>訂購資訊：{{$ORDER->name}}</strong>
                </div>
                <div class="col-sm-12 col-md-12 col-md-offset-3 col-sm-offset-3 text-right">
                    <strong>訂購人電話：{{$ORDER->phone}}</strong>
                </div>
                <div class="col-sm-12 col-md-12 col-md-offset-3 col-sm-offset-3 text-right">
                    <strong>收件位置：{{$ORDER->address}}</strong>
                </div>
                <div class="col-sm-12 col-md-12 col-md-offset-3 col-sm-offset-3 text-right">
                    <strong>訂單狀態：{{$STATUS}}</strong>
                </div>
                <div class="col-sm-12 col-md-12 col-md-offset-3 col-sm-offset-3 text-right">
                    <strong>訂單價格：{{$TOTALPRICE}}</strong>
                </div>
            </div>
            <!-- /.card-footer -->
        </div>
        @if ($ORDER->leader_id == auth()->user()->id)
        <!-- Main content -->
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">修改狀態</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="/admin/order-history/{{$ORDER->id}}/update">
                            {{ csrf_field() }}
                            <div class="card-body">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">收件人姓名</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" name="inputName" value="{{$ORDER->name}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">收件人Email</label>
                                <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="{{$ORDER->email}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPhone" class="col-sm-2 col-form-label">收件人電話</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPhone" name="inputPhone" value="{{$ORDER->phone}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputAdress" class="col-sm-2 col-form-label">收件人地址</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputAdress" name="inputAdress" value="{{$ORDER->address}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputStatus" class="col-sm-2 col-form-label">訂單狀態</label>
                                <div class="col-sm-10">
                                <select class="form-control" id="inputStatus" name="inputStatus" required>
                                    @if ($ORDER->status == "已通知店家")
                                    <option selected value="已通知店家">已通知店家</option>
                                    <option value="完成訂購">完成訂購</option>
                                    <option value="取消訂單">取消訂單</option>
                                    @elseif ($ORDER->status == "完成訂購")
                                    <option value="已通知店家">已通知店家</option>
                                    <option selected value="完成訂購">完成訂購</option>
                                    <option value="取消訂單">取消訂單</option>
                                    @else
                                    <option value="已通知店家">已通知店家</option>
                                    <option value="完成訂購">完成訂購</option>
                                    <option selected value="取消訂單">取消訂單</option>
                                    @endif
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPay" class="col-sm-2 col-form-label">是否付款</label>
                                <div class="col-sm-10">
                                <select class="form-control" id="inputPay" name="inputPay" required>
                                    @if ($ORDER->pay == 0)
                                    <option selected value="0">否</option>
                                    <option value="1">是</option>
                                    @else
                                    <option value="0">否</option>
                                    <option selected value="1">是</option>
                                    @endif
                                </select>
                                </div>
                            </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right">更新訂單</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            
        </div>
        <!-- /.content -->
        @endif
    </div>
    <!-- /.content-wrapper -->

@endsection
