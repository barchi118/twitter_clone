@extends('layouts.app')

@section('content')


<div class="container " style=" clear: both;">
<a href="{{ route('tweets.index')}}"><i class="fas fa-arrow-left pt-3 pl-3"></i></a>
    <div class="row pt-3 pb-1 d-flex bd-highlight">
      <div class="col-5 mr-auto pl-4 bd-highlight">
            <img src="{{asset('storage/profile_image/'.$user->profile_image) }}" alt="プロフィール画像" class="rounded-circle" width="75" height="75">
      </div>
      <div class="col-4 bd-highlight">
        @if ($user->id === Auth::user()->id)
          <a href="{{ url('users/' .$user->id .'/edit') }}" class="btn btn-outline-primary">変更</a>
          @else
          @if ($is_following)
          <form action="{{ route('unfollow', [$user->id]) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button type="submit" class="btn btn-danger">フォロー中</button>
          </form>
          @else
          <form action="{{ route('follow', [$user->id]) }}" method="POST">
            {{ csrf_field() }}

            <button type="submit" class="btn btn-outline-primary">フォロー</button>
          </form>
          @endif


          @endif
      </div>
      <!-- プロフィール -->
      <div class="col-12 pl-4">
      <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
        <span class="text-secondary">{{ $user->screen_name }}</span>
                  @if ($is_followed)
          <span class="mt-2 px-1 bg-secondary text-light" style="font-size:8px;">フォローされています</span>
          @endif
        <p>{{ $user->profile_introduct }}</p>
        <p><strong>{{ $follow_count}}</strong><small>フォロー</small>　<strong>{{ $follower_count }}</strong><small>フォロワー</small></p>
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


<div class="tab-content">
  <!-- ツイート -->
  <div class="tab-pane active card" id="home" role="tabpanel" aria-labelledby="home-tab">
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
  </div>


  <!-- media -->
  <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    @foreach ($timelines as $timeline)
    @if($timeline->text_image == null)
    @else

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
    @endif
    @endforeach
  </div>

  <!-- いいね一覧 -->
  <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">

      @foreach ($favorites_tweet_ids as $favorites_tweet_id)
     <div class="card">
      <div class="card-haeder p-3 w-100 d-flex">
        <img 
        src="{{ asset('storage/profile_image/' .$all_users->find($tweets->find($favorites_tweet_id->tweet_id)->user_id)->profile_image) }}" class="rounded-circle" width="50" height="50">
        <div class="ml-2 d-flex flex-column flex-grow-1">
          <p class="mb-0">
            {{ $all_users->find($tweets->find($favorites_tweet_id->tweet_id)->user_id)->name }}
          </p>
          <a href="{{$all_users->find($tweets->find($favorites_tweet_id->tweet_id)->user_id)->id}}" 
          class="text-secondary">
            {{$all_users->find($tweets->find($favorites_tweet_id->tweet_id)->user_id)->screen_name}}
          </a>
        </div>
        <div class="d-flex justify-content-end flex-grow-1">
          <p class="mb-0 text-secondary">
            {{ $tweets->find($favorites_tweet_id->tweet_id)->created_at->format('Y-m-d H:i') }}
          </p>
        </div>
      </div>
      abcdefg
      <div class="card-body">
        {{$tweets->find($favorites_tweet_id->tweet_id)->text}}
        @if($tweets->find($favorites_tweet_id->tweet_id)->text_image == null)
        @else
        <img style="width:150px;height:150px;"  alt=""
        src="{{ asset('storage/text_images/' .$tweets->find($favorites_tweet_id->tweet_id)->text_image)}}" >
        
        @endif
      </div>
    </div>
    <div class="card-footer py-1 d-flex justify-content-end bg-white">
        @if ($all_users->find($tweets->find($favorites_tweet_id->tweet_id)->user_id)->id === Auth::user()->id)
        <div class="dropdown mr-3 d-flex align-items-center">
          <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-fw"></i>編集
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <form method="POST" action="{{ url('tweets/' .$timeline->id) }}" class="mb-0">
              @csrf
              @method('DELETE')

              <a href="{{ url('tweets/' .$all_users->find($tweets->find($favorites_tweet_id->tweet_id)->user_id)->id .'/edit') }}" class="dropdown-item">編集</a>
              <button type="submit" class="dropdown-item del-btn">削除</button>
            </form>
          </div>
        </div>

                <div class="mr-3 d-flex align-items-center">
          <a href="{{ url('tweets/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i>コメント</a>
          <p class="mb-0 text-secondary"></p>
        </div>
        @endif
        </div>

@endforeach

</div> <!-- tab-paneエンド  -->







</div>
<!-- <script>
$(function () {
$('#myTab li:last-child a').tab('show')
})
</script> -->
@endsection
