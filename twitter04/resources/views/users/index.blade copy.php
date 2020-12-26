@extends('layouts.app')

@section('content')

<!-- スマホヘッダー -->
 <div class="container border fixed-top d-sm-none">
    <div class="row pt-3 pb-1">
      <div class="col-4">
<a href="{{ route('tweets.index')}}"><i class="fas fa-arrow-left"></i></a>
      </div>
      <div class="col-6">
      <strong>ユーザー一覧</strong>
      </div>
      </div>
      </div>

<!-- タブレットヘッダー -->
<div class=" ">
  <div class="fixed-top  d-none d-sm-block d-lg-none container-fluid">
    <div class="row">
      <div class="col-2">

      </div>
      <div class="col-10 bg-white border py-3">
        <h2　style="font-weight:bold;"><strong>ユーザー一覧</strong></h2>
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
        <h2　style="font-weight:bold;"><strong>ユーザー一覧</strong></h2>
      </div>
      </div>
  </div>
</div>

<div class="pt-5"></div>
<!-- メイン -->
@foreach ($all_users as $user)
 <div class="container border-bottom ">
    <div class="row pt-3 pb-1">
      <div class="col-3">
        
            <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50">

      </div>
      <div class="col-9">
        <div class="row">
        <div class="col-7">
        <p class="mb-0">{{ $user->name }}</p>
                                <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->screen_name }}</a>
@if (auth()->user()->isFollowed($user->id))
                                <div class="">
                                    <small class="px-1 bg-secondary text-light" style="font-size:8px;">フォローされています</small>
                                </div>
                            @endif
                            <p>{{$user->profile_introduct}}</p>
      </div>
      <div class="col-5">
         @if (auth()->user()->isFollowing($user->id))
                                    <form action="{{ route('unfollow', [$user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-primary btn-sm" style="font-size:8px;font-wight:bold;">フォロー中</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', [$user->id]) }}" method="POST">
                                        {{ csrf_field() }}

                                        <button type="submit" class="btn btn-outline-primary btn-sm" style="font-size:8px;font-wight:bold;">フォロー</button>
                                    </form>
                                @endif

      </div>

      </div>

      </div>
      </div>
      </div>
        @endforeach
        <div class="my-4 d-flex justify-content-center">
            {{ $all_users->links() }}
        </div>
@endsection