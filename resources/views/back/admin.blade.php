@extends('layouts.backlayout') 
@section('content')
<!-- Content Wrapper. Contains page content -->
@if (!empty(Cookie::get('MSG')))
<section class="col-lg-12 connectedSortable ui-sortable">
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p><i class="icon fas fa-check"></i> {{Cookie::get('MSG')}}!</p>
    </div>
</section>
@endif

<!-- slide -->
<div class="slide">
    <div class="slide-show-home owl-carousel owl-theme">
        @foreach ($POSTS as $POST)
        <div class="slide-content">
            <div class="mask"></div>
            <img src="{{url('/storage/images/postimage/'.$POST->image.'')}}" alt="">
            <div class="intro-caption">
                <h2>{{$POST->title}}</h2>
                <p>{{$POST->body}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- end slide -->

<div class="contact segments-page">
    <div class="container">
        
        <div class="contact-contents b-shadow">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="{{url('/storage/images/avatar/'.$USER->image.'')}}" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{$USER->name}}</h3>

            <p class="text-muted text-center">{{$USER->nickname}}</p>

            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                <p class="text-danger text-xl">
                <i class="fa fa-star"></i>
                等級
                </p>
                <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                    <span class="text-muted">
                    <?php
                    $objs = json_decode($LEVEL,JSON_UNESCAPED_UNICODE);
                    
                    foreach ($objs as $key => $value) {
                        echo $key.":";
                        foreach ($CATEGORIES as $CATEGORIE) {
                            if ($CATEGORIE->name == $key)
                            {
                                switch ($value) {
                                    case 'A':
                                        echo $CATEGORIE->a_name;
                                        break;
                                    case 'B':
                                        echo $CATEGORIE->b_name;
                                        break;
                                    case 'C':
                                        echo $CATEGORIE->c_name;
                                        break;
                                    case 'D':
                                        echo $CATEGORIE->d_name;
                                        break;
                                    case 'E':
                                        echo $CATEGORIE->e_name;
                                        break;
                                    default:
                                        echo $CATEGORIE->f_name;
                                        break;
                                }
                            }
                        }
                        echo '</br>';
                    }
                    ?>
                    </span>
                </span>
                </p>
            </div>
            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                <p class="text-danger text-xl">
                <i class="fa fa-users"></i>
                線下會員人數
                </p>
                <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                    {{$OUTPUTS}} 人
                </span>
                <span class="text-muted"></span>
                </p>
            </div>
            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                <p class="text-danger text-xl">
                <i class="fa fa-envelope"></i>
                電郵
                </p>
                <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                    {{$USER->email}}
                </span>
                <span class="text-muted"></span>
                </p>
            </div>
            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                <p class="text-danger text-xl">
                <i class="fa fa-mobile"></i>
                您的行動
                </p>
                <p class="d-flex flex-column text-right">
                <span class="font-weight-bold">
                    {{$USER->phone}}
                </span>
                <span class="text-muted"></span>
                </p>
            </div>

            <a href="{{url('/admin/edit')}}" class="btn waves-effect button-full"><b>修改資訊</b></a>
        </div>

        <div class="wrap-title">
            
        </div>
        <div class="contact-contents b-shadow">  
            <?php
                $objs = json_decode($LEVEL,JSON_UNESCAPED_UNICODE);
                $levelUpNum = 0;
            ?>
            @foreach ($objs as $key => $value)
                <?php $catNum = 0;?>
                @foreach ($RESULT as $r)
                
                    <?php
                    if ($r['category'] == $key)
                    {
                        $catNum = max($catNum, $r['qty']);
                    }
                    ?>
                    
                @endforeach
                @foreach ($CATEGORIES as $category)
                    <?php
                        $categoryName = $category->name;
                        if($key == $categoryName)
                        {
                            if($value == 'A')
                            {
                                $levelUpNum = $category->a_level;
                            }

                            if($value == 'B')
                            {
                                $levelUpNum = $category->b_level;
                            }

                            if($value == 'C')
                            {
                                $levelUpNum = $category->c_level;
                            }

                            if($value == 'D')
                            {
                                $levelUpNum = $category->d_level;
                            }

                            if($value == 'E')
                            {
                                $levelUpNum = $category->e_level;
                            }

                            if($value == 'F')
                            {
                                $levelUpNum = $category->f_level;
                            }
                        }
                    ?>
                @endforeach
                <div class="progress-group">
                    <?php 
                        $style = ($catNum/$levelUpNum)*100;
                    ?>
                    {{$key}}等級：
                    <?php
                        foreach ($CATEGORIES as $CATEGORIE) {
                            if ($CATEGORIE->name == $key)
                            {
                                switch ($value) {
                                    case 'A':
                                        echo $CATEGORIE->a_name;
                                        break;
                                    case 'B':
                                        echo $CATEGORIE->b_name;
                                        break;
                                    case 'C':
                                        echo $CATEGORIE->c_name;
                                        break;
                                    case 'D':
                                        echo $CATEGORIE->d_name;
                                        break;
                                    case 'E':
                                        echo $CATEGORIE->e_name;
                                        break;
                                    default:
                                        echo $CATEGORIE->f_name;
                                        break;
                                }
                            }
                        }
                    ?>
                    <span class="float-right"><b>{{$catNum}}/{{$levelUpNum}}</span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style=width:<?php echo $style?>%></div>
                    </div>
                </div>
                @if ($catNum >= $levelUpNum)
                <form id="levelUp" action="{{url('/admin/levelup/'.$key.'/'.$value.'')}}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-outline-warning btn-block">晉升</button>
                </form>                
                @endif
                
            @endforeach
        </div>
    </div>
</div>

@endsection
