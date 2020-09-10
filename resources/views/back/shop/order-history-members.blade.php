@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header border-transparent">
            <h3 class="card-title">您的下線訂單</h3>

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
                    <th scope="row"><a href="/admin/order-history/{{$ORDER->id}}">ORD{{$ORDER->user_id}}{{$ORDER->id}}</a></th>
                    <td>{{$ORDER->name}}</td>
                    <td>
                        <span   <?php 
                                if ($ORDER->status == '完成訂購')
                                    echo "class='badge badge-success'";
                                elseif ($ORDER->status == '取消訂單')
                                    echo "class='badge badge-danger'";
                                elseif ($ORDER->status == '已通知店家')
                                    echo "class='badge badge-info'";
                                ?>  
                                style="padding:10px">{{$ORDER->status}}
                            </span>
                    </td>
                    <td>{{$ORDER->totalprice}}</td>
                    <td>{{date('Y-m-d', strtotime($ORDER->created_at))}}</td>
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

@endsection
