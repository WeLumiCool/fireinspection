<nav class="navbar navbar-expand-lg navbar-dark scrolling-navbar bg-light fixed-top" id="header">
    <div class="container-fluid">
        <a class="navbar-brand" href=""><img src="{{ asset('image/logo.svg') }}" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item pt-2 ">
                    <p class="h6 text-white font-weight-bold text-center" style="line-height: 1.6rem"> Межрегональное
                        управление Государственной инспекции по экологической
                        и технической безопаности по г. Бишкек </p>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item pt-2 text-center">
                    <a href="" class="btn-map font-small">Карта объектов
                    </a>
                </li>
                @if(Auth::user())
                    @if(Auth::user()->role->is_admin)
                        <li class="nav-item pt-2 text-center">
                            <a href="" class="btn-admin font-small">Админ панель</a>
                        </li>
                    @endif
                @endif
                @if(Auth::user())
                    <li class="nav-item pt-2 text-center">
                        <a  onclick="document.getElementById('logout-form-auth').submit();"
                            class="text-white btn-exit  font-small">Выйти
                        </a>
                        <form id="logout-form-auth" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

