<div class="row sticky-top ">
    <div class="col-12 bg-white border-bottom py-3 ">
    <div class=" d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center">
    <!-- ハンバーガーメニュー -->
    <div class="d-block d-sm-none">
      <div id="nav-drawer">
      <input id="nav-input" type="checkbox" class="nav-unshown">
      @guest
      <label id="nav-open" for="nav-input"><img src=""
      class=" rounded-circle  " width="40  " height="40"></label>
      @else
      <label id="nav-open" for="nav-input"><img src="{{ asset('storage/profile_image/' .auth()->user()->profile_image) }}"
      class=" rounded-circle  " width="40  " height="40"></label>
      @endguest
      <label class="nav-unshown" id="nav-close" for="nav-input"></label>
      <!-- ハンバーガーメニュー中身 -->
      <div id="nav-content">
        <h3 style="font-weight:bold; border-bottom:2px; " class=" border-bottom border-dark py-3 pl-3 ">
        アカウント情報
        </h3>
        <div class="pl-3">
          <img src="{{ asset('storage/profile_image/' .auth()->user()->profile_image) }}"
          class=" rounded-circle" width="50" height="50">
        </div>
        <div class="pl-3">
          <p style="font-weight:bold;">
            {{auth()->user()->name}}</br>{{'@'.auth()->user()->screen_name}}
          </p>
          <p>
            <span style="font-weight:bold;">{{$follow_count}}</span><small class="text-secondary" >フォロー中</small>　　
            <span style="font-weight:bold;">{{$follower_count}}</span><small class="text-secondary">フォロワー</small>
          </p>
          <p><a href="{{ url('users/' .auth()->user()->id) }}" class="text-dark"><i class="fas fa-id-card " ></i>　プロフィール</a></p>
          <p ><a href="{{asset('users')}}" class="text-dark"><i class="fas fa-users " ></i>　ユーザー</a></p>
          <p ><a href="{{asset('')}}" class="text-dark"><i class="fas fa-search " ></i>　キーワード検索</a></p>

        </div>
        <div class="pl-3 border-top border-dark">
          <p style="font-weight:bold;">
            外部サイト
          </p>
          <p><a href="http://stg-portfolio.work/main" class="text-dark">ポートフォリオ</a></p>
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
      <!-- ハンバーガーメニューなかみここまで -->
  </div>
      </div>
      <!-- ハンバーガーメニューここまで -->
      <strong class="" style="font-size:16px;">
        　{{ $message }}
      </strong>
    </div>
      <i class="far fa-star "></i>
    </div>
    </div>
</div>
<!-- スマホハンバーガーメニュー用 -->