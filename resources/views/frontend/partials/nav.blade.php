<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="{{ route('welcome', ['language' => $language]) }}">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                @foreach ($sharedMenus as $sharedMenu)
                    <li class="nav-item {{ $sharedMenu->menus_count > 0 ? 'dropdown' : '' }}">
                        <a href="{{ App\Helpers\Helpers::getFrontUrl($sharedMenu, $language) }}"
                            class="nav-link {{ $sharedMenu->menus_count > 0 ? 'dropdown-toggle' : '' }} text-white"
                            @if ($sharedMenu->menus_count > 0) data-bs-toggle="dropdown" @endif>
                            @if (request()->language == 'en')
                                {{ $sharedMenu->title_en }}
                            @else
                                {{ $sharedMenu->title }}
                            @endif
                        </a>
                        @if ($sharedMenu->menus_count > 0)
                            <x-frontend.child-menu-component :menus="$sharedMenu->menus" />
                        @endif

                    </li>
                @endforeach
            </ul>
        </div>
        @include('frontend.search.search')
    </div>
</nav>
