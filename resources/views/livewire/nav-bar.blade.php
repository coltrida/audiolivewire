<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('inizio')}}">
                <img src="{{asset('img/logo-centroudito.png')}}" alt="Centro Udito" width="150px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{Auth::user()->name}}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                {{--<li>
                                    <a class="dropdown-item" href="#"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="#" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>--}}
                                <li><a class="dropdown-item" href="{{route('logout')}}">logout</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>

                        @if(Auth::user()->isAdmin)
                            @include('partials.menuAdmin')
                        @elseif(Auth::user()->isAudio)
                            @include('partials.menuAudio')
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Register</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
</div>
