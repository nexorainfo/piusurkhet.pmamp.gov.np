@props(['menus'])
<div class="dropdown-menu fade-down m-0">
    @foreach ($menus ?? [] as $menu)
        <div class="nav-item dropend">
            <a href="{{ App\Helpers\Helpers::getFrontUrl($menu, $language) }}"
                class="nav-link {{ $menu->menus_count > 0 ? 'dropdown-toggle' : '' }}"
                @if ($menu->menus_count > 0) data-bs-toggle="dropdown" @endif style="color: white">
                @if (request()->language == 'en')
                    {{ $menu->title_en }}
                @else
                    {{ $menu->title }}
                @endif
            </a>
            @if ($menu->menus_count > 0)
                <x-frontend.child-menu-component :menus="$menu->menus" />
            @endif
        </div>
    @endforeach
</div>