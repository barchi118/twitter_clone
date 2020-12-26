@extends('layouts.app')

@section('content')
<div class="container border">
@php
  $message = "全ユーザー";
  @endphp
  <x-nav :message="$message" />
<!-- メインコンテンツ -->
@foreach ($all_users as $user)
    <div class="row border-bottom pt-3 pb-1">
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

@endforeach
    <div class="my-4 d-flex justify-content-center">
        {{ $all_users->links() }}
    </div>
</div>
@endsection