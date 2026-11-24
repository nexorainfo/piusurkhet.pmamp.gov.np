@php
    $isEnglish = app()->getLocale() === 'en';
    $headerLines = $officeSettingHeaders ?? collect();
    $mainLineId = $headerLines->sortByDesc(fn($line) => (int) $line->font_size)->first()?->id;
    $logo = $header?->en_header ? asset('storage/' . $header->en_header) : asset('images/logo.png');
    $officeName = $isEnglish ? $header?->office_name_en : $header?->office_name;
@endphp

<header class="site-header">
    <div class="site-header__top">
        @if ($header?->cover_photo)
            <div class="site-header__deco">
                <img src="{{ asset('storage/' . $header->cover_photo) }}" alt="">
            </div>
        @endif

        <div class="site-header__brand">
            <a href="{{ route('welcome', ['language' => $language]) }}" class="site-header__brand-link">
                <img src="{{ $logo }}" alt="{{ __('Emblem of Nepal') }}" class="site-header__logo">
                <div class="site-header__titles">
                    @forelse ($headerLines as $line)
                        @if ($line->id === $mainLineId)
                            <h2>{{ $isEnglish ? $line->english : $line->nepali }}</h2>
                        @else
                            <h3>{{ $isEnglish ? $line->english : $line->nepali }}</h3>
                        @endif
                    @empty
                        <h2>{{ $officeName }}</h2>
                    @endforelse
                </div>
            </a>

            <div class="site-header__mobile-actions">
                <a href="{{ route('language', $isEnglish ? 'ne' : 'en') }}" class="site-header__lang">
                    {{ $isEnglish ? 'ने' : 'EN' }}
                </a>
                <button type="button" class="site-header__icon-btn" data-nav-toggle aria-controls="site-nav-menu"
                    aria-expanded="false" aria-label="{{ __('Menu') }}">
                    <svg viewBox="0 0 448 512" width="20" height="20" aria-hidden="true">
                        <path fill="currentColor"
                            d="M16 132h416c8.8 0 16-7.2 16-16V76c0-8.8-7.2-16-16-16H16C7.2 60 0 67.2 0 76v40c0 8.8 7.2 16 16 16zm0 160h416c8.8 0 16-7.2 16-16v-40c0-8.8-7.2-16-16-16H16c-8.8 0-16 7.2-16 16v40c0 8.8 7.2 16 16 16zm0 160h416c8.8 0 16-7.2 16-16v-40c0-8.8-7.2-16-16-16H16c-8.8 0-16 7.2-16 16v40c0 8.8 7.2 16 16 16z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="site-header__flag-area">
            @if ($header?->ne_header)
                <img src="{{ asset('storage/' . $header->ne_header) }}" alt="{{ __('Flag of Nepal') }}"
                    class="site-header__flag">
            @endif
            <div class="site-header__date">
                <x-top-bar-date-component />
            </div>
        </div>
    </div>
</header>

{{-- Kept outside <header> so it can stick to the top of the page while scrolling --}}
@include('frontend.partials.nav')
