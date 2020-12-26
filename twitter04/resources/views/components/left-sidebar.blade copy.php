<div class="col-md-1 col-lg-2 px-0  mx-0">
    <div class="sticky-top  ">
        <ul class="text-center ">
            <li>
                <a href="{{ url('guests') }}"><i class="fab fa-twitter fa-2x text-dark pt-2"></i></a>
            </li>
            <li>
                <a  href="{{ url('tweets') }}"><i class="fas fa-home fa-2x pt-4 text-dark" ></i></a>
                <span class="d-none d-lg-block d-xl-none">ホーム</span>
            </li>
            <li>
                <a  href="{{ url('tweets') }}"><i class="fas fa-search fa-2x pt-4 text-dark" ></i></a>
            </li>
            <li>
                <a  href=""><i class="fas fa-bell fa-2x pt-4 text-dark" ></i></a>
            </li>
            <li>
                <a  href=""><i class="fas fa-envelope fa-2x pt-4 text-dark" ></i></a>
            </li>
            <li>
                <a  href="https://www.wantedly.com/users/130963693"><i class="far fa-sticky-note fa-2x pt-4 text-dark" ></i></a>
            </li>
            <li>
                <a  href="http://stg-portfolio.work/main"><i class="far fa-id-badge fa-2x pt-4 text-dark" ></i></a>
            </li>
            @guest
            <li>
                <a  href="{{ url('guests') }}"><i class="fas fa-users fa-2x pt-4 text-dark" ></i></a>
            </li>
            @else
            <li>
                <a href="{{asset('users')}}" class=""><i class="fas fa-users fa-2x pt-4 text-dark" ></i></a>
            </li>
            <li>
                <a href="{{ url('users/' .auth()->user()->id) }}" class=""><i class="fas fa-id-card fa-2x pt-4 text-dark" ></i></a>
            </li>
            <li>
                <a class="" href={{asset('tweets/create')}} role="button ">
                    <i class="fas fa-plus fa-2x  pt-4" ></i>
                </a>
            </li>
            @endguest
        </ul>
        <!-- ログイン関連 -->
        <ul class=" mt-5 pt-5 text-center">
            @guest
            <li class="nav-item">
            <a href="{{ route('login') }}" class="text-dark"><i class="fas fa-sign-in-alt fa-2x  "></i></a>
          </li>
          @if (Route::has('register'))
          <li class="nav-item">
            <a href="{{ route('register') }}" class="text-dark"><i class="far fa-registered fa-2x pt-4"></i></a>
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
                class=" rounded-circle  " width="75  " height="75">
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
