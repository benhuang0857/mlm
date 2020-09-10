@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header border-transparent">
            <h3 class="card-title">您的歷史訂單</h3>

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
                    <th>編號</th>
                    <th>收件人</th>
                    <th>狀態</th>
                    <th>金額</th>
                    <th>日期</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($ORDERS as $ORDER)
                    <tr>
                    @if ($ORDER->status != '刪除訂單')
                    <th scope="row"><a href="/admin/order-history/{{$ORDER->id}}">ORD{{$ORDER->user_id}}{{$ORDER->id}}</a></th>
                    <td>{{$ORDER->name}}</td>
                    <td><span   <?php 
                                if ($ORDER->status == '完成訂購')
                                    echo "class='badge badge-success'";
                                elseif ($ORDER->status == '取消訂單')
                                    echo "class='badge badge-danger'";
                                elseif ($ORDER->status == '已通知店家')
                                    echo "class='badge badge-info'";
                                ?>  
                                style="padding:10px">{{$ORDER->status}}</span></td>
                    <td>{{$ORDER->totalprice}}</td>
                    <td>{{date('Y-m-d', strtotime($ORDER->created_at))}}</td>
                    <td>
                        <?php
                            if ($ORDER->status == '已通知店家')
                            {
                                ?>
                                    <a class="btn btn-primary btn-block" href="#" onclick="cancelOrder({{$ORDER->id}})">取消訂單</a>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <a class="btn btn-danger btn-block" href="#" onclick="deleteOrder({{$ORDER->id}})">刪除訂單</a>
                                <?php
                            }                            
                        ?>
                    </td>
                    @endif
                    </tr>
                @endforeach
                </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->

    <script type="text/javascript">
        function cancelOrder(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/admin/order-history/'+id+'/cancel',
                success:function(res){   
                    alert('取消成功');             
                    setTimeout(function(){
                        window.location.reload(1);
                    }, 1000);
                }
            });
        };

        function deleteOrder(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/admin/order-history/'+id+'/delete',
                success:function(res){       
                    alert('刪除成功');         
                    setTimeout(function(){
                        window.location.reload(1);
                    }, 1000);
                }
            });
        };
    </script>

@endsection
