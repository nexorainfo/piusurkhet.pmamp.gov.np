@php
    $isEnglish = app()->getLocale() === 'en';
@endphp

<div class="site-nav__sentinel" aria-hidden="true"></div>
<nav class="site-nav" aria-label="{{ __('Main menu') }}">
    <div class="site-nav__inner">
        <a href="{{ route('welcome', ['language' => $language]) }}" class="site-nav__mini-logo" tabindex="-1">
            <img src="{{ $header?->en_header ? asset('storage/' . $header->en_header) : asset('images/logo.png') }}"
                alt="">
        </a>

        <ul class="site-nav__menu" id="site-nav-menu">
            <li class="site-nav__item">
                <a href="{{ route('welcome', ['language' => $language]) }}" class="site-nav__link">
                    {{ __('Home') }}
                </a>
            </li>
            @foreach ($sharedMenus as $sharedMenu)
                @php $hasChildren = $sharedMenu->menus_count > 0; @endphp
                <li class="site-nav__item {{ $hasChildren ? 'has-dropdown' : '' }}">
                    <a href="{{ App\Helpers\Helpers::getFrontUrl($sharedMenu, $language) }}" class="site-nav__link"
                        @if ($hasChildren) data-dropdown-toggle aria-haspopup="true" aria-expanded="false" @endif>
                        {{ $isEnglish ? $sharedMenu->title_en : $sharedMenu->title }}
                        @if ($hasChildren)
                            <svg class="site-nav__chevron" viewBox="0 0 448 512" aria-hidden="true">
                                <path fill="currentColor"
                                    d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z" />
                            </svg>
                        @endif
                    </a>
                    @if ($hasChildren)
                        <x-frontend.child-menu-component :menus="$sharedMenu->menus" />
                    @endif
                </li>
            @endforeach
        </ul>

        <div class="site-nav__actions">
            <div class="site-nav__search" data-search>
                <button type="button" class="site-header__icon-btn site-nav__search-toggle" data-search-toggle
                    aria-expanded="false" aria-label="{{ __('Search') }}">
                    <svg viewBox="0 0 512 512" width="18" height="18" aria-hidden="true">
                        <path fill="currentColor"
                            d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z" />
                    </svg>
                </button>
                <form action="{{ route('frontend.search', ['language' => app()->getLocale()]) }}" method="get"
                    class="site-nav__search-form" role="search">
                    <input type="search" name="keyword" placeholder="{{ __('Search...') }}" autocomplete="off"
                        required>
                    <button type="submit" aria-label="{{ __('Search') }}">
                        <svg viewBox="0 0 512 512" width="16" height="16" aria-hidden="true">
                            <path fill="currentColor"
                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z" />
                        </svg>
                    </button>
                </form>
            </div>
            <a href="{{ route('language', $isEnglish ? 'ne' : 'en') }}" class="site-nav__lang">
                {{ $isEnglish ? 'ने' : 'EN' }}
            </a>
        </div>
    </div>
</nav>
