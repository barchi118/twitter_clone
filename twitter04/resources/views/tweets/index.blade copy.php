@extends('layouts.app')

@section('content')

<!-- ヘッダー -->
<div class="fixed-top  bg-white py-3  border-bottom d-sm-none">
  <nav class="row d-flex justify-content-between" >
    <!-- ハンバーガー中身 -->
    <div id="nav-drawer col-2　 ">
      <input id="nav-input" type="checkbox" class="nav-unshown ">
      <label id="nav-open" for="nav-input" class=" ml-4 pl-2">
        <img src="{{ asset('storage/profile_image/' .auth()->user()->profile_image) }}"
        class=" rounded-circle" width="50" height="50">

      </label>
      <label class="nav-unshown" id="nav-close" for="nav-input"></label>
      <div id="nav-content" class="">
        <h3 style="font-weight:bold; border-bottom:2px; " class=" border-bottom border-dark py-3 pl-3 ">アカウント情報</h3>
        <div class="pl-3">
          <img src="{{ asset('storage/profile_image/' .auth()->user()->profile_image) }}"
          class=" rounded-circle" width="50" height="50">
        </div>
        <div class="pl-3">
          <p　style="font-weight:bold;">
            {{auth()->user()->name}}</br>{{'@'.auth()->user()->screen_name}}
          </p>
          <p>
            <span style="font-weight:bold;">{{$follow_count}}</span><small class="text-secondary" >フォロー中</small>　　
            <span style="font-weight:bold;">{{$follower_count}}</span><small class="text-secondary">フォロワー</small>
          </p>
          <p><a href="{{ url('users/' .auth()->user()->id) }}" class="text-dark"><i class="fas fa-id-card " ></i>　プロフィール</a></p>
          <p><a href="{{asset('users')}}" class="text-dark"><i class="fas fa-users " ></i>　ユーザー</a></p>
          <p><a href="http://stg-portfolio.work/main" class="text-dark">プロフィールサイト</a></p>
          <p><a href="https://www.wantedly.com/users/130963693}" class="text-dark">Wantedly</a></p>
        </div>
        <p class="border-top border-dark">
          <a href="{{ route('logout') }}" class="text-dark pl-3" style="font-weight:bold;  "
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          {{ __('@'.auth()->user()->screen_name.'からログアウト') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
      </p>
    </div>
    <!-- ハンバーガー中身　ここまで -->
  </div>
  <div class="col-2">
    <a href="#top"><i class="fas fa-home fa-2x" ></i></a>
  </div>
  <div class="col-2">
    <!-- <i class="fas fa-home fa-2x" ></i> -->
  </div>
  </nav>
</div>



<!-- ツイートボタン -->
<div class="fixed-bottom d-sm-none" style="">
  <div class="d-flex justify-content-end p-4">
    <a class="btn btn-primary rounded-circle " href={{asset('tweets/create')}} role="button ">
      <i class="fas fa-plus fa-2x p-2" ></i>
    </a>
  </div>
</div>

<!-- タブレットヘッダー -->
<div class=" ">
  <div class="fixed-top  d-none d-sm-block d-lg-none container-fluid">
    <div class="row">
      <div class="col-2">

      </div>
      <div class="col-10 bg-white border py-3">
        <h2　style="font-weight:bold;"><strong>ホーム</strong></h2>
      </div>
      </div>
  </div>
</div>

<!-- ｐｃヘッダー -->
<div class=" ">
  <div class="fixed-top   d-none d-lg-block  container-fluid">
    <div class="row">
      <div class="col-3">

      </div>
      <div class="col-6 bg-white border py-3">
        <h2 style="font-weight:bold;"><strong>ホーム</strong></h2>
      </div>
      </div>
  </div>
</div>
<!-- ツイート -->
<!-- タイムライン -->
<div class="pt-5 mt-3 px-0" id="">
  @if (isset($timelines))
  @foreach ($timelines as $timeline)
  <div class="container border">
    <div class="row pt-3 pb-1">
      <div class="col-2">
        <a href="{{ url('users/' .$timeline->user->id) }}" class="">
          <img src="{{ asset('storage/profile_image/' .$timeline->user->profile_image) }}"
          class="rounded-circle " width="50" height="50">
        </a>
      </div>
      <div class="col-10">
        <p class="mb-0">{{ $timeline->user->name }}
          <small class="text-secondary">@ {{ $timeline->user->screen_name }}</small>
          <small class="text-secondary">{{  $timeline->created_at->format('Y-m-d H:i') }}</small>
        </p>
        @if($timeline->text == null)
        @else
        <p class="text-left">{!! nl2br(e($timeline->text)) !!}</p>
        @endif
        @if($timeline->text_image == null)
        @else
        <div class="">
          <img src="{{ asset('storage/text_images/' .$timeline->text_image) }}"
          class="rounded " style=" object-fit: cover;width:100%;height:200px;" alt="">
        </div>
        @endif
        <!-- ツイートフッター -->
        <div class="py-0 text-left d-flex pl-0 justify-content-between bg-white ">
          @if ($timeline->user->id === Auth::user()->id)
          <div class="dropdown mr-3 d-flex align-items-center">
            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-fw"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <form method="POST" action="{{ url('tweets/' .$timeline->id) }}" class="mb-0">
                @csrf
                @method('DELETE')

                <a href="{{ url('tweets/' .$timeline->id .'/edit') }}" class="dropdown-item">編集</a>
                <button type="submit" class="dropdown-item del-btn">削除</button>
              </form>
            </div>
          </div>
          @endif
          <div class="mr-3 d-flex align-items-center">
            <a href="{{ url('tweets/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
            <p class="mb-0 text-secondary">{{ count($timeline->comments) }}</p>
          </div>
          <div class="d-flex align-items-center">
            @if (!in_array($user->id, array_column($timeline->favorites->toArray(), 'user_id'), TRUE))
            <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
              @csrf

              <input type="hidden" name="tweet_id" value="{{ $timeline->id }}">
              <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
            </form>
            @else
            <form method="POST" action="{{ url('favorites/' .array_column($timeline->favorites->toArray(), 'id', 'user_id')[$user->id]) }}" class="mb-0">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
            </form>
            @endif
            <p class="mb-0 text-secondary">{{ count($timeline->favorites) }}</p>
          </div>
        </div>
        <!-- ツイートフッター ここまで-->
      </div>
    </div>
  </div>

  @endforeach
  @endif



  @endsection
