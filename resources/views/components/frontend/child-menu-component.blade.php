@props(['menus'])
<div class="site-nav__dropdown">
    <ul>
        @foreach ($menus ?? [] as $menu)
            @php $hasChildren = $menu->menus_count > 0; @endphp
            <li class="site-nav__dropdown-item {{ $hasChildren ? 'has-dropdown' : '' }}">
                <a href="{{ App\Helpers\Helpers::getFrontUrl($menu, $language) }}" class="site-nav__dropdown-link"
                    @if ($hasChildren) data-dropdown-toggle aria-haspopup="true" aria-expanded="false" @endif>
                    {{ app()->getLocale() === 'en' ? $menu->title_en : $menu->title }}
                    @if ($hasChildren)
                        <svg class="site-nav__chevron site-nav__chevron--right" viewBox="0 0 320 512" aria-hidden="true">
                            <path fill="currentColor"
                                d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                        </svg>
                    @endif
                </a>
                @if ($hasChildren)
                    <x-frontend.child-menu-component :menus="$menu->menus" />
                @endif
            </li>
        @endforeach
    </ul>
</div>
