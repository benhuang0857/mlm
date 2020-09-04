@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header border-transparent">
            <h3 class="card-title">所有會員</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="display: block;">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">搜尋</span>
                </div>
                <input type="text" id="search-member" class="form-control" placeholder="搜尋..." aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="table-responsive">
                <table class="table m-0">
                <thead>
                <tr>
                    <th>授權碼</th>
                    <th>姓名</th>
                    <th>Email</th>
                    <th>電話</th>
                    <th>里程數</th>
                    <th>動作</th>
                </tr>
                </thead>
                <tbody id="dynamic-row">
                @foreach ($OUTPUTS as $OUTPUT)
                    <tr>
                    <th scope="row">{{$OUTPUT->authorization_code}}</th>
                    <td>{{$OUTPUT->name}}</td>
                    <td>{{$OUTPUT->email}}</td>
                    <td>{{$OUTPUT->phone}}</td>
                    <td>{{$OUTPUT->milage}}</td>
                    <th>
                        <a class="btn btn-primary" style="margin-bottom:5px;display: block;" href="/admin/members/{{$OUTPUT->id}}">編輯</a>
                        <a href="#" class="btn btn-danger" style="margin-bottom:5px;display: block;" onclick="callAjax({{$OUTPUT->id}})">刪除</a>
                    </th>
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
        $('body').on('keyup', '#search-member', function(){
            var searchQ = $(this).val();
            
            $.ajax({
                method: 'POST',
                url: '/admin/allmembers/search',
                dataType: 'json',
                data: {
                    '_token': '{{csrf_token()}}',
                    searchQ: searchQ
                },

                success: function(res){
                    var tableRow = '';
                    $('#dynamic-row').html('');
                    $.each(res, function(index, value){
                        $tableRow = '<tr><th scope="row">'+value.authorization_code+'</th><td>'+
                        value.name+'</td><td>'+value.email+'</td><td>'+value.phone+'</td><td>'+
                        value.milage+'</td><th><a class="btn btn-primary" style="margin-bottom:5px;display: block;" href="/admin/members/'+
                        value.id+'">編輯</a><a href="#" class="btn btn-danger" style="margin-bottom:5px;display: block;" onclick="callAjax('+value.id+')">刪除</a></th></tr>';
                        $('#dynamic-row').append($tableRow);
                    });
                }
            });

        });
        function callAjax(articleId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                type: 'POST',
                url: '/admin/members/'+articleId+'/delete',
                data: {_method: 'DELETE'},

                success:function(res){
                    window.location.href = '/admin/members';
                }
            })
        }
    </script>
@endsection
