@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="form-element segments-page">
        <div class="card">
            <div class="card-header border-transparent">
              <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fa fa-shopping-bag"></i> 魔后訂單
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    寄件人
                    <address>
                      <strong>姓名：{{$LEADER->name}}</strong><br>
                      寄件位置：{{$LEADER->address}}<br>
                      電話: {{$LEADER->phone}}<br>
                      Email: {{$LEADER->email}}
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    收件人
                    <address>
                      <strong>姓名：{{$ORDER->name}}</strong><br>
                      收件位置：{{$ORDER->address}}<br>
                      電話: {{$ORDER->phone}}<br>
                      Email: {{$ORDER->email}}
                    </address>
                  </div>
                </div>
                <!-- /.row -->
  
                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th>編號</th>
                        <th>商品名稱</th>
                        <th>數量</th>
                        <th>價格</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $i=1;?>
                        @foreach ($CART->items as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item['item']['name']}}</td>
                            <td>{{$item['qty']}}</td>
                            <td>${{$item['price']}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
  
                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-6">
                    <p class="lead">付款方式:</p>
                    <img style="width:70px" src="{{ url('/storage/images/productimage/unnamed.jpg') }}">
  
                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                      貨到付款或是面交，請收到訂購單時，在跟您的用戶進行聯絡。
                    </p>
                  </div>
                  <!-- /.col -->
                  <div class="col-6">
                    <p class="lead">成立時間: {{$ORDER->created_at}}</p>
  
                    <div class="table-responsive">
                      <table class="table">
                        <tbody><tr>
                          <th style="width:50%">總計:</th>
                          <td>${{$TOTALPRICE}}</td>
                        </tr>
                        <tr>
                          <th>稅金 (0%)</th>
                          <td>$0</td>
                        </tr>
                        <tr>
                          <th>運費:</th>
                          <td>$0</td>
                        </tr>
                        <tr>
                          <th>價格:</th>
                          <td>${{$TOTALPRICE}}</td>
                        </tr>
                      </tbody></table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
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
                        <form class="form-horizontal" method="POST" action="{{url('/admin/order-history/'.$ORDER->id.'/update')}}">
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
