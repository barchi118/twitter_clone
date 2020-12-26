<div class="col-sm-2 col-md-2 col-lg-2 pl-lg-5 col-xl-3 px-0  mx-0 d-none d-sm-block ">
    <div class="sticky-top  ">
        <ul class=" ">
            <li>
                <a href="{{ url('guests') }}"><i class="fab fa-twitter fa-2x text-dark pt-2"></i></a>
            </li>
            <li class="">
                @guest
                <a class="text-dark d-flex"  href="{{ url('guests') }}">
                @else
                <a class="text-dark d-flex"  href="{{ url('tweets') }}">
                @endguest
                <i class="fas fa-home fa-2x pt-4 " ></i>
                <strong style="font-size:21px;"
                class="d-none d-xl-block   mt-4">　ホーム</strong>
                </a>
            </li>
            <li>
                <a class="text-dark d-flex"  href="{{ url('tweets') }}">
                <i class="fas fa-search fa-2x pt-4 " ></i>
                <strong style="font-size:21px;"
                class="d-none d-xl-block   mt-4">　キーワード検索</strong>
                </a>
            </li>
            <li>
                <a class="text-dark d-flex"  href="">
                <i class="fas fa-bell fa-2x pt-4 " ></i>
                <strong style="font-size:21px;"
                class="d-none d-xl-block   mt-4">　お知らせ</strong>
                </a>
            </li>
            <li>
                <a class="text-dark d-flex"  href="">
                <i class="fas fa-envelope fa-2x pt-4 " ></i>
                <strong style="font-size:21px;"
                class="d-none d-xl-block   mt-4">　メッセージ</strong>
                </a>
            </li>
            @guest
            @else
            <li>
                <a class="text-dark d-flex"  href="{{asset('users/')}}">
                <i class="fas fa-users fa-2x pt-4 " ></i>
                <strong style="font-size:21px;"
                class="d-none d-xl-block   mt-4">　全ユーザー</strong>
                </a>
            </li>
            <li>
                <a class="text-dark d-flex"  href="{{asset('users/'.auth()->user()->id)}}">
                <i class="far fa-id-card fa-2x pt-4 " ></i>
                <strong style="font-size:21px;"
                class="d-none d-xl-block   mt-4">　プロフィール</strong>
                </a>
            </li>
            @endguest
            <li>
                <a class="text-dark d-flex"  href="https://www.wantedly.com/users/130963693">
                <i class="far fa-sticky-note fa-2x pt-4 " ></i>
                <strong style="font-size:21px;"
                class="d-none d-xl-block   mt-4">　Wantedly</strong>
                </a>
            </li>
            <li>
                <a class="text-dark d-flex"  href="http://stg-portfolio.work/main">
                <i class="far fa-id-badge fa-2x pt-4 " ></i>
                <strong style="font-size:21px;"
                class="d-none d-xl-block   mt-4">　ポートフォリオ</strong>
                </a>
            </li>
            @guest
            @else
            <li>
                <a class=" text-dark d-flex"  href="{{asset('tweets/create')}}">
                <i class="fas  fa-plus fa-2x pt-4 " ></i>
                <strong style="font-size:21px;"
                class="d-none d-xl-block   mt-4">　ツイートする</strong>
                </a>
            </li>
            @endguest
        </ul>
        <!-- ログイン関連 -->
        <ul class=" mt-5 pt-5 ">
            @guest
            <li class="">
            <a class=" text-dark d-flex"  href="{{ route('login') }}">
                <i class="fas  fa-sign-in-alt fa-2x pt-4 " ></i>
                <strong style="font-size:21px;"
                class="d-none d-xl-block   mt-4">　ログインする</strong>
                </a>
          </li>
          @if (Route::has('register'))
          <li class="">
            <a class=" text-dark d-flex"  href="{{ route('register') }}">
                <i class="far fa-registered  fa-2x pt-4 " ></i>
                <strong style="font-size:21px;"
                class="d-none d-xl-block   mt-4">　ユーザー登録する</strong>
                </a>
          </li>
          </li>
          @endif
            @else
            <li class=" pt-5">
            <div type="button" class="" data-toggle="tooltip" data-placement="top" title="">
                
            </div>
            <!--  -->
            <p>
  <a class="" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
    <img src="{{ asset('storage/profile_image/' .auth()->user()->profile_image) }}"
                class=" rounded-circle  " width="50  " height="50">
  </a>
</p>
<div class="row center-block">
  <div class="col-12">
    <div class="collapse multi-collapse" id="multiCollapseExample1">
      <div class="card text-center" style="width:150px;">
      <a class="text-dark" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); 
                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
      </div>
    </div>
  </div>
</div>
            </li>
            @endguest
        </ul>
        
    </div>
</div>
