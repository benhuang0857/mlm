@extends('layouts.backlayout') @section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">歡迎 {{$USER->name}}</h1>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- center col (We are only adding the ID to make the widgets sortable)-->
                @if (!empty(Cookie::get('MSG')))
                <section class="col-lg-12 connectedSortable ui-sortable">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p><i class="icon fas fa-check"></i> {{Cookie::get('MSG')}}!</p>
                    </div>
                </section>
                @endif
                
                <!-- center col -->

                <!-- Left col -->
                <section class="col-lg-5 connectedSortable ui-sortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">您的資訊</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-block btn-default" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="/storage/images/avatar/{{$USER->image}}" alt="User profile picture">
                        </div>
        
                        <h3 class="profile-username text-center">{{$USER->name}}</h3>
        
                        <p class="text-muted text-center">{{$USER->nickname}}</p>
        
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                            <b>電郵：</b> <a class="float-right">{{$USER->email}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>行動：</b> <a class="float-right">{{$USER->phone}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>地址：</b> <a class="float-right">{{$USER->address}}</a>
                            </li>
                        </ul>
        
                        <a href="/admin/edit" class="btn btn-primary btn-block"><b>修改資訊</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </section>
                <!-- /.Left col -->

                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-7 connectedSortable ui-sortable">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">基本信息</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-block btn-default" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-warning text-xl">
                            <i class="icon ion-ribbon-b"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                            <span class="font-weight-bold">
                                <span class="text-muted">
                                <?php
                                $objs = json_decode($LEVEL,JSON_UNESCAPED_UNICODE);
                                
                                foreach ($objs as $key => $value) {
                                    echo $key.":".$value."</br>";
                                }
                                ?>
                                </span>
                            </span>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                            <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                            <span class="font-weight-bold">
                                {{$OUTPUTS}} 人
                            </span>
                            <span class="text-muted">線下會員人數</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        </div>
                    </div>
                </section>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    function callAjax() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/admin/levelup',

            success:function(res){
                $.get(this.href, function(html) {
                    html = '<div class="modal " style="opacity: 1;webkit-box-shadow:none !important; box-shadow:none !important;background:none !important; color:#FFF !important;text-align: center !important; width:100%; height:50%; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);">'
                        +'<div class="modal-image" style="opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);">'
                        +'<i class="icon ion-ribbon-b text-warning" style="font-size: 5rem!important;"></i>'
                        +'</div>'
                        +'<h1 style="opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);">恭喜!</h1>'
                        +'<p style="opacity: 1;font-size:16px !important; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);">升級成功</p>'
                        +'</div>';
                    $(html).appendTo('body').modal({
                        fadeDuration: 3
                    });
                    
                });                
                setTimeout(function(){
                    window.location.reload(1);
                }, 3000);
            }
        });
    };
</script>

@endsection
