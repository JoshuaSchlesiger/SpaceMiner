@section('nav')
    <input type="hidden" id="route" value="{{ url()->current() }}">
    @php
        $urlParts = parse_url(url()->current());
        $lastSegment = isset($urlParts['path']) ? basename($urlParts['path']) : 'welcome'; // 'default' als Standard, wenn kein Pfad vorhanden ist
    @endphp

    <input type="hidden" id="routeBasename" value="{{ $lastSegment }}">
    <nav class="nv navbar navbar-expand-lg bg-body-tertiary shadow">
        <div class="container-fluid ps-4">
            <a class="navbar-brand nv-brand fs-3" href="{{ url('/') }}">
                {{ config('app.name') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto">
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="{{ route('task') }}">Aufträge</a>
                        </li>
                    @endif


                    <li class="nav-item">
                        <a class="nav-link fs-5" href="{{ route('calculator') }}">Berechnungen</a>
                    </li>

                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="{{ route('aboutme') }}">Über Mich</a>
                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link fs-5" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link fs-5 me-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle fs-5 me-2" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('userSettings') }}">Einstellungen
                                </a>

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
                    <form id="languageForm">
                        @if (Cookie::has('language'))
                            <input type="hidden" name="language" id="language" value="{{ Cookie::get('language') }}">
                            <div class="d-flex" role="search">
                                <button
                                    class="btn @if (Cookie::get('language') === 'EN') btn-outline-danger @else btn-outline-success @endif  language btn-sm h-75 mt-1">
                                    <?php echo Cookie::get('language'); ?>
                                </button>
                            </div>
                        @elseif (Session::exists('language'))
                            <input type="hidden" name="language" id="language" value="{{ Session::get('language') }}">
                            <div class="d-flex" role="search">
                                <button
                                    class="btn @if (Session::get('language') === 'EN') btn-outline-danger @else btn-outline-success @endif  language btn-sm h-75 mt-1">
                                    <?php echo Session::get('language'); ?>
                                </button>
                            </div>
                        @else
                            <input type="hidden" name="language" id="language" value="EN">
                            <div class="d-flex" role="search">
                                <button class="btn btn-outline-danger language btn-sm h-75 mt-1">EN</button>
                            </div>
                        @endif
                    </form>

                </ul>
            </div>
        </div>
    </nav>
@endsection
