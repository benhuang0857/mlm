@extends('layouts.backlayout')

@section('content')
    <style>
        .tree,
        .tree ul,
        .tree li {
            list-style: none;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .tree {
            margin: 0 0 1em;
            text-align: center;
        }

        .tree,
        .tree ul {
            display: table;
        }

        .tree ul {
            width: 100%;
        }

        .tree li {
            display: table-cell;
            padding: .5em 0;
            vertical-align: top;
        }

        .tree li:before {
            outline: solid 1px #666;
            content: "";
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
        }

        .tree li:first-child:before {
            left: 50%;
        }

        .tree li:last-child:before {
            right: 50%;
        }

        .tree code,
        .tree span {
            /*border: solid .1em #666;
            border-radius: .2em;*/
            display: inline-block;
            /*margin: 0 .2em .5em;*/
            padding: .2em .5em;
            position: relative;
        }

        .tree ul:before,
        .tree code:before,
        .tree span:before {
            outline: solid 1px #666;
            content: "";
            height: .5em;
            left: 50%;
            position: absolute;
        }

        .tree ul:before {
            top: -.5em;
        }

        .tree code:before,
        .tree span:before {
            top: -.55em;
        }

        .tree>li {
            margin-top: 0;
        }

        .tree>li:before,
        .tree>li:after,
        .tree>li>code:before,
        .tree>li>span:before {
            outline: none;
        }        
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="collapse-page segments-page">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body p-0" style="display: block; margin:auto;">
                @if (!empty($LEADER))
                    <ul class="tree">
                        <div class="image">
                            <img src="{{url('/storage/images/avatar/'.$LEADER->image.'')}}" class="img-circle elevation-2" style="width:80px;height:80px" alt="User Image">
                        </div>
                        <p>直屬姓名：{{$LEADER->name}}<br>{{$LEADER->nickname}}</br></p>
                @endif
                {!!$TREE!!}
            </div>
        </div>
    </div>

@endsection
