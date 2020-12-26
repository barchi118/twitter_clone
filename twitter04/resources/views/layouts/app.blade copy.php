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
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style>
.sidebar_fixed {
  position: fixed;
  top: 20px;
  right:10px;
}
.sidebar_content {
  margin-bottom: 100px;
}
</style>

</head>

<body>
  <div id="app">
    <!-- <nav class="navbar  navbar-light bg-white shadow-sm fixed-top" style="width:100%;">
      <div class="container ">
        <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{asset('img/icon.svg')}}" alt="" height="40px">
          Chibatter
        </a>
    </div>
  </nav> -->



  <main class="">
    <div class="container-fluid">
      <div class="row">

      <!-- left-sidebar -->
        <div class="d-sm-none pt-1 col-3 px-1 bg-secondary position-fixed" id="sticky-sidebar" style="height:100%;">
          <div class="list-group pb-5  text-right">

        </a>
            <a href="{{url('tweets/')}}" class="p-3 text-light">
              <i class="fas fa-home fa-2x" ></i>Home
            </a>
            <a href="{{ url('users') }}" class="text-light p-3"><i class="fas fa-users fa-2x" ></i>Users</a>            
            @guest
            @else
              <a href="{{ url('users/' .auth()->user()->id) }}" class="text-light p-3">
                <i class="fas fa-id-card fa-2x" ></i>Profile
              </a>
            @endguest
            <a href="{{ url('tweets/create') }}" class="p-3 text-light"><i class="fas fa-plus-circle fa-2x"></i>Tweet</a>
          </div>
          <ul class="navbar-nav ml-auto  pt-5 text-right mr-4" >
            <!-- Authentication Links -->
            @guest
            <li class="nav-item ">
              <a class=" btn btn-primary " href="{{ route('login') }}">{{ __('　Login ') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item mt-2 " >
              <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <!-- 追加 -->

            <li class="nav-item pt-5">
              <a href="{{ url('users/' .auth()->user()->id) }}" class="">
                <img src="{{ asset('storage/profile_image/' .auth()->user()->profile_image) }}" class=" rounded-circle" width="50" height="50">
              </a>
            </li>
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ auth()->user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a href="{{ route('logout') }}" class="dropdown-item"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
          @endguest
        </ul>

      </div>
      <!-- main-content -->
      <div class="col-md-6  col-xs-12 offset-3  px-1 border-right border-left" id="main">
        @yield('content')
      </div>

      <!-- right-sidebar -->
      <div class="col-3 pt-1 sidebar_fixed sidebar_content d-none d-lg-none d-xl-block">  
      <!-- ログイン方法 -->
      <div class="card  ">
<ul class="list-group ">
  <li class="list-group-item list-group-item-dark text-white">ログイン方法</li>
  <li class="list-group-item">ログインアドレス</li>
  <li class="list-group-item">test2@test.com</li>
  <li class="list-group-item">パスワード</li>
  <li class="list-group-item">12345678</li>
</ul>
    <!-- プロフィールサイト -->
    <div class="card-body text-center">
    Chiba's Profile
    <img src="{{asset('img/profile-site.png')}}" alt="" class="img-thumbnail">
    <a href="http://shirokuma.sakura.ne.jp/chibasite/main"
     class="btn btn-outline-primary my-2 text-center" role="button" aria-pressed="true">
        サイトへ
    </a>
  </div>
</div>

      </div>
    </div>
  </div>

          <!-- <ul class="list-group pt-3">
            <li class="list-group-item list-group-item-primary">オススメユーザー</li>
            <li class="list-group-item pb-0">
            <a href="{{ url('users/1' ) }}">
              <img src="{{ asset('storage/profile_image/' .$user->find(1)->profile_image) }}"
              class=" rounded-circle float-left " width="50 " height="50">
              <span class="text-dark ml-2">//{{$user->find(1)->name}}</span>
              <p class="text-secondary pl-2">//{{//'@'.$user->find(1)->screen_name}}</p>
            </a>
            </li>
            <li class="list-group-item">
              <a href="{{ url('users/2' ) }}">
                <img src="{{ asset('storage/profile_image/' .$user->find(2)->profile_image) }}"
                class=" rounded-circle float-left " width="50 " height="50">
                <span class="text-dark ml-2">//{{$user->find(2)->name}}</span>
                <p class="text-secondary pl-2">//{{'@'.$user->find(2)->screen_name}}</p>
              </a>
            </li>
            <li class="list-group-item">
              <a href="{{ url('users/3' ) }}">
                <img src="{{ asset('storage/profile_image/' .$user->find(3)->profile_image) }}"
                class=" rounded-circle float-left " width="50 " height="50">
                <span class="text-dark ml-2">//{{$user->find(3)->name}}</span>
                <p class="text-secondary pl-2">//{{'@'.$user->find(3)->screen_name}}</p>
              </a>
            </li>
            <li class="list-group-item">
              <a href="{{ url('users/4' ) }}">
                <img src="{{ asset('storage/profile_image/' .$user->find(4)->profile_image) }}"
                class=" rounded-circle float-left " width="50 " height="50">
                <span class="text-dark ml-2">//{{$user->find(4)->name}}</span>
                <p class="text-secondary pl-2">//{{'@'.$user->find(4)->screen_name}}</p>
              </a>
            </li>
          </ul> -->



</main>
<!-- Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
