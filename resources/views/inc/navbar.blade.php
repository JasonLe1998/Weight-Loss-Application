<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav ms-auto">

          </ul>

          {{-- nav bar to go to different pages --}}
          <div class="container-fluid">
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id = "navbarNavAltMarkup">
              <div class="navbar-nav">
                <li class = "{{ 'home' == request()->path() ? 'active' : '' }}">
                  <a class="nav-link" href="http://vast-headland-62539.herokuapp.com/">Home</a>
                </li>
                <li class = "{{ 'about' == request()->path() ? 'active' : '' }}">
                <a class="nav-link" href="{{url('about')}}">About</a>
                </li>
                <li class = "{{ 'exercise' == request()->path() ? 'active' : '' }}">
                <a class="nav-link" href="{{url('exercise')}}">Exercise</a>
                </li>
                <li class = "{{ 'workout' == request()->path() ? 'active' : '' }}">
                <a class="nav-link" href="{{url('workout')}}">Workout</a>
                </li>
                <li class = "{{ 'report' == request()->path() ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('report')}}">Report</a>
                </li>
                </li>
                <li class = "{{ 'community' == request()->path() ? 'active' : '' }}">
                <a class="nav-link" href="{{url('community')}}">Community</a>
                </li>
              </div>
            </div>
          </div>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav me-auto">
              <!-- Authentication Links -->
              @guest
                  @if (Route::has('login'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                      </li>
                  @endif

                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      </li>
                  @endif
              @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }}
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                      </div>
                  </li>
              @endguest
          </ul>
      </div>
  </div>
</nav>