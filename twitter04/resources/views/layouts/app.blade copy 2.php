<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <!--Font awsome -->
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

  <!-- Styles -->
  <!-- ハンバーガーメニュー用 -->
  <link href="{{ asset('css/hanbagar.css') }}" rel="stylesheet">
  <style>
  .sidebar_fixed {
    position: fixed;
    top: 20px;
    right:10px;
  }
  .sidebar_content {
    margin-bottom: 100px;
  }

  select{
    -webkit-appearance: none;
  }
</style>

</head>

<body>

  <!-- スマホ -->
  <main class="">
    <div class=" d-sm-none">
      @yield('content')
    </div>
  </main>

  <!-- タブレット -->
  <main class="">
    <div class=" d-none d-sm-block d-lg-none container-fluid">
      <div class="row">
        <!-- タブレットサイドバー -->
        <div class=" position-fixed col-2 text-right border-right"style=" height:100%;z-index:2; " >
          <p class="pt-4"><i class="fab fa-twitter fa-2x text-dark"></i></p>
          <a  href="{{ url('tweets') }}"><i class="fas fa-home fa-2x pt-5 text-dark" ></i></a>
          @guest
          <p style="font-size:10px;"  class=" pt-5 text-dark"　><a href="http://stg-portfolio.work/main" style="font-size:8px;" class="text-dark">プロフィールサイト</a></p>
          <p style="font-size:8px;"><a href="https://www.wantedly.com/users/130963693}" class="text-dark">Wantedly</a></p>

          @else
          <p><a href="{{ url('users/' .auth()->user()->id) }}" class=""><i class="fas fa-id-card fa-2x pt-4 text-dark" ></i></a></p>
          <p><a href="{{asset('users')}}" class=""><i class="fas fa-users fa-2x pt-4 text-dark" ></i></a></p>
          <p style="font-size:10px;"  class=" pt-4 text-dark"　><a href="http://stg-portfolio.work/main" style="font-size:8px;" class="text-dark">プロフィールサイト</a></p>
          <p style="font-size:8px;"><a href="https://www.wantedly.com/users/130963693}" class="text-dark">Wantedly</a></p>
          <p><a class="btn btn-primary rounded-circle mt-4" href={{asset('tweets/create')}} role="button ">
            <i class="fas fa-plus fa-2x  " ></i>
            @endguest
          </a></p>


          <div class="" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto ">
              <!-- Authentication Links -->
              @guest
              <li class="nav-item">
                <p><a href="{{ route('login') }}" class="text-dark">ログイン</a></p>
              </li>
              @if (Route::has('register'))
              <li class="nav-item">
                <p><a href="{{ route('register') }}" class="text-dark">新規登録</a></p>
              </li>
              @endif
              @else
              <li class="nav-item dropdown 　 dropright" style="bottom:-300px;">
                <a style="display-style:n;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  <img src="{{ asset('storage/profile_image/' .auth()->user()->profile_image) }}"
                  class=" rounded-circle" width="50" height="50">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('@'.auth()->user()->screen_name.'からログアウト') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
            @endguest
          </ul>
        </div>
      </div>
      <!-- タブレットメイン -->
      <div class="col-10 offset-2 px-0">
        @yield('content')

      </div>
    </div>
  </div>
</main>

<!-- pc -->
<main class="">
  <div class=" d-none d-lg-block  container-fluid">
    <div class="row">
    <!-- pc左サイドバー -->
      <div  class=" position-fixed col-3 border-right  "style=" height:100%;z-index:2; " >
      <div class="center-block">
      <ul style="list-style:none;">
        <li class="">
          <p class="pt-4"><i class="fab fa-twitter fa-2x text-dark"></i></p>
        </li>
        <li>
          <p><a  href="{{ url('tweets') }}"><i class="fas fa-home fa-2x pt-5 text-dark" ></i>
          <strong class="pl-1 text-dark" style="font-size:24px;font-weight:bold;">ホーム</strong>
          </a></p>
        </li>
        <li>
          <p><a  href="{{ url('users') }}"><i class="fas fa-users fa-2x pt-4 text-dark" ></i>
          <strong class="pl-1 text-dark" style="font-size:24px;font-weight:bold;">ユーザー一覧</strong>
          </a></p>
        </li>
        @guest
        @else
        <li>
          <p><a href="{{ url('users/' .auth()->user()->id) }}" class="">
            <i class="fas fa-id-card fa-2x pt-4 text-dark" ></i>
            <strong class="pl-1 text-dark" style="font-size:24px;font-weight:bold;">プロフィール</strong>
          </a></p>
        </li>
        <li class="text-center">
          <p><a class="btn  d-block btn-primary mt-4" href="{{asset('tweets/create')}}" role="button ">
            <strong>ツイートする</strong>
          </a></p>
        </li>
        @endguest
        <li>
            <h style="font-size:14px;"  class=" pt-5 text-dark "　><a href="http://stg-portfolio.work/main"  class="text-dark">プロフィールサイト</a></h>
        </li>
        <li>
          <p style="font-size:14px;"><a href="https://www.wantedly.com/users/130963693}" class="text-dark">Wantedly</a></p>
        </li>
        @guest
          <li class="nav-item">
            <p><a href="{{ route('login') }}" class="text-dark">ログイン</a></p>
          </li>
          @if (Route::has('register'))
          <li class="nav-item">
            <p><a href="{{ route('register') }}" class="text-dark">新規登録</a></p>
          </li>
          @endif
          @else
          <li class=" dropdown 　 dropright" style="bottom:-300px;">
            <a  id="navbarDropdown" class=" dropdown-toggle "  style=""
            role="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="true" v-pre>
              <img src="{{ asset('storage/profile_image/' .auth()->user()->profile_image) }}"
              class=" rounded-circle float-left " width="75  " height="75">
              <p class="">{{'　'.auth()->user()->name}}</p>
              <p>{{'@'.auth()->user()->screen_name}}</p>
            </a>
            
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('@'.auth()->user()->screen_name.'からログアウト') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
              </div>
            </li>
          @endguest
      </ul>
      </div>

      </div>
      <div class="col-6 offset-3 px-0">
        @yield('content')
      </div>
      <!-- 右サイドバー -->
      </div>
        <div  class="text-dark  text-left sidebar_fixed sidebar_content offset-9  col-3 bg-dark　"style=" height:100%; " >
          <ul class="list-group">
            <li class="list-group-item list-group-item-primary">今どうしてる？</li>
            <li class="list-group-item">
              <strong class="pb-0">コロナウィルス対策</strong></br>
              <small class=""　style="font-size:8px;">新型コロナウイルス（SARS-CoV-2）が引き起こす新型コロナウイルス感染症（COVID-19）に関する情報をつぶやきます。可能な限りフェアな情報収集と正確な情報配信に努めますが情報の正確性を保証するものではありません当サイトは内閣官房新型コロナウイルス感染症対策推進室が運用しています。</small>
            </li>
            <li class="list-group-item">
            <strong>隅田川花火大会</strong></br>
            <small>今夜東京近郊3ヵ所で花火が打ち上がる「隅田川花火大会」生放送</small>
            </li>

          </ul>

          <p><small class="text-secondary" style="font-size:11px;">利用規約
プライバシーポリシー
Cookie
広告情報
© 2020 Chitter, Inc.</small></p>
      </div>
    </div> 
    
  </div>
</main>


<!-- Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
