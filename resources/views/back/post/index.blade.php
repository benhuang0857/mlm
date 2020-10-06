@extends('layouts.backlayout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="form-element segments-page">
        <!-- Main content -->
        <div class="content">
            <div class="row">
				<div class="col-6 px-2">
					<a class="btn waves-effect button-full" href="{{url('/admin/post/create')}}"><i class="fas fa-plus"></i>創建消息</a>
				</div>
			</div>
            <table class="table">
                <thead>
                    <tr>
                    <th>圖片</th>
                    <th>標題</th>
                    <th>時間</th>
                    <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($POSTS as $POST)
                    <tr>
                        <td><img src="{{url('/storage/images/postimage/'.$POST->image.'')}}" style="max-width:120px" class="img elevation-2" alt="Product Image"></td>
                        <td>
                            {{$POST->name}}
                        </td>
                        <td>
                            {{$POST->created_at}}
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" style="margin-bottom:5px; width:80px" href="{{url('/admin/post/'.$POST->id.'/edit')}}">編輯</a>
                            <form action="{{url('/admin/post/'.$POST->id.'/delete')}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button style="width:80px" class="btn btn-danger btn-sm" type="submit">刪除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
