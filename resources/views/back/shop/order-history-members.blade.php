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
                    @if ($ORDER->status != '刪除訂單')
                        <tr>
                            <th scope="row"><a href="{{url('/admin/order-history/'.$ORDER->id.'')}}">ORD{{$ORDER->user_id}}{{$ORDER->id}}</a></th>
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
                            <td><a class="btn btn-primary" href="{{url('/admin/order-history/'.$ORDER->id.'')}}">編輯</a></td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->

@endsection
