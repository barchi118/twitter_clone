@if (isset($timelines))
    @foreach ($timelines as $timeline)
    <div class="row border-bottom pt-3 pb-1">
          <div class="col-1 ">
            <a href="{{ url('users/'.$timeline->user->id) }}" class="">
              <img src="{{ asset('storage/profile_image/' .$timeline->user->profile_image ) }}"
              class="rounded-circle " width="50" height="50">
            </a>
          </div>
          <div class="col-md-11 pl-5">
            <p class="mb-0" style="font-weight:bold;">
                {{ $timeline->user->name }}
                <small class="text-secondary"@ {{ $timeline->user->screen_name }}></small>
                <small class="text-secondary">{{  $timeline->created_at->format('Y-m-d H:i') }}</small>
            </p>
            @if($timeline->text == null)
            @else
            <p class="text-left">{{$timeline->text}}</p>
            @endif
            @if($timeline->text_image == null)
            @else
            <div class="">
              <a href="{{ asset('storage/text_images/'.$timeline->text_image ) }}" data-lightbox="group">
                <img src="{{ asset('storage/text_images/'.$timeline->text_image) }}"
                class="rounded " style=" object-fit: cover;width:100%;height:200px;" alt="">
              </a>
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
    @endforeach
@endif
