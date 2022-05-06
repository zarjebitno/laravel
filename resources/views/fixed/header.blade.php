<header class="market-header header">
  <div class="container-fluid">
      <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="{{ @route('home') }}"><img src="{{ @asset('assets/images/shared/logo.png') }}" alt=""></a>
          <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav mr-auto">
                  @foreach ($navbar as $navItem)
                    @if(!$navItem->isAdmin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ @route($navItem->route_href) }}">{{ $navItem->route_name }}</a>
                        </li>
                    @elseif($navItem->isAdmin && Auth::user() && Auth::user()->user_role == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ @route($navItem->route_href) }}">{{ $navItem->route_name }}</a>
                            </li>
                    @endif
                  @endforeach
              </ul>
              <div class="login d-flex align-items-center">
                @auth
                    <a href="{{ @route('users.index') }}" class="d-block mr-4 nav-item text-light">
                        User area
                    </a>
                    <form action="{{ @route('logout') }}" class="form-inline" method="POST">
                        @csrf
                        <button type="submit" class="nav-link">Logout</button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login.index') }}" class="nav-link">Login</a>
                @endguest
              </div>
          </div>
      </nav>
  </div><!-- end container-fluid -->
</header><!-- end market-header -->