{{--Left sidebar--}}
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ Request::is('home*') ? 'active':''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Bosh sahifa
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('getIndex') }}" class="nav-link {{ Request::is('get*') ? 'active':''}}">
                <i class="nav-icon fas fa-plus-square"></i>
                <p>
                    Mendan olganlar
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('giveIndex') }}" class="nav-link {{ Request::is('give*') ? 'active':''}}">
                <i class="nav-icon fas fa-minus-square"></i>
                <p>
                    Men olganlar
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('statisticsIndex') }}" class="nav-link {{ Request::is('statistics*') ? 'active':''}}">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                    Statistika
                </p>
            </a>
        </li>

        <li class="nav-item has-treeview {{ Request::is('archive*') ? 'menu-open':''}}">
            <a href="" class="nav-link {{ Request::is('archive*') ? 'active':''}}">
                <i class="nav-icon fas fa-archive"></i>
                <p>
                    Arxiv
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="{{ Request::is('archive*') ? 'display: block':'display: none'}}">
                <li class="nav-item">
                    <a href="{{ route("archieveGetIndex") }}" class="nav-link {{ Request::is('archive/archievegetindex') ? 'active':''}}">
                        <i class="nav-icon fas fa-plus-square"></i>
                        <p class="text">Mendan olganlar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("archieveGiveIndex") }}" class="nav-link {{ Request::is('archive/archievegiveindex') ? 'active':''}}">
                        <i class="nav-icon fas fa-minus-square"></i>
                        <p>Men olganlar</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('userIndex') }}" class="nav-link {{ Request::is('user*') ? 'active':''}}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Users
                </p>
            </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="" class="nav-link">
                <i class="fas fa-palette"></i>
                <p>
                    Tema
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none">
                <li class="nav-item">
                    <a href="{{ route('userSetTheme',[auth()->id(),'theme' => 'default']) }}" class="nav-link">
                        <i class="nav-icon fas fa-circle text-info"></i>
                        <p class="text">Default {{ auth()->user()->theme == 'default' ? '✅':'' }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('userSetTheme',[auth()->id(),'theme' => 'dark']) }}" class="nav-link">
                        <i class="nav-icon fas fa-circle text-gray"></i>
                        <p>Dark {{ auth()->user()->theme == 'dark' ? '✅':'' }}</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link"
               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Chiqish
                </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>

    </ul>

{{--    @can('card.main')--}}

{{--    @endcan--}}
</nav>
