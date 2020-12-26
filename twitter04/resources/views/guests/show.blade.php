@extends('layouts.app')

@section('content')


<div class="card mb-3">
  <div class="d-inline-flex">
    <div class="p-3 d-flex flex-column">
      <img src="{{asset('storage/profile_image/'.$user->profile_image) }}" alt="プロフィール画像" class="rounded-circle" width="100" height="100">
      <div class="mt-3 d-flex flex-column">
        <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
        <span class="text-secondary">{{ $user->screen_name }}</span>
      </div>
    </div>
    <div class="p-3 d-flex flex-column justify-content-between">
      <div class="d-flex">
        <div>



          <p>{{ $user->profile_introduct }}</p>
        
        </div>
      </div>
      <div class="d-flex justify-content-end">
        <div class="p-2 d-flex flex-column align-items-center">
          <p class="font-weight-bold">ツイート</p>
          
        </div>
        <div class="p-2 d-flex flex-column align-items-center">
          <p class="font-weight-bold">フォロー</p>
       
        </div>
        <div class="p-2 d-flex flex-column align-items-center">
          <p class="font-weight-bold">フォロワー</p>
      
        </div>
      </div>
    </div>
  </div>
</div>


<!-- tab選択 -->
<ul class="nav nav-tab " id="myTab" role="tablist"　>
  <li class="nav-item  ">
    <a class="nav-link active flex-fill" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">ツイート</a>
  </li>
  <li class="nav-item">
    <a class="nav-link flex-fill" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">メディア</a>
  </li>
  <li class="nav-item">
    <a class="nav-link flex-fill" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">いいね</a>
  </li>
</ul>


@endsection
