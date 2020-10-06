@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="form-element segments-page">
        <div class="card">
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
                    <th scope="row"><a href="{{url('/admin/order-history/'.$ORDER->id.'')}}">ORD{{$ORDER->user_id}}{{$ORDER->id}}</a></th>
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
                                    <a style="width:80px" class="btn btn-primary btn-sm" href="#" onclick="cancelOrder({{$ORDER->id}})">取消</a>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <a style="width:80px" class="btn btn-danger btn-sm" href="#" onclick="deleteOrder({{$ORDER->id}})">刪除</a>
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
