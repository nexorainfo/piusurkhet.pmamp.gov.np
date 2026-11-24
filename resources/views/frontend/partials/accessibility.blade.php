@php
    // key => [label, number of levels, svg icon]. A tile cycles through its levels, then turns off.
    $a11yTools = [
        'text-size' => [__('Text Size'), 3, '<text x="1" y="19" font-size="13" font-family="serif" fill="currentColor">T</text><text x="10" y="20" font-size="19" font-family="serif" fill="currentColor">T</text>'],
        'contrast' => [__('High Contrast'), 2, '<circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="2"/><path d="M12 3a9 9 0 0 1 0 18z" fill="currentColor"/>'],
        'align' => [__('Text Align'), 3, '<path d="M4 6h16M4 10h10M4 14h16M4 18h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>'],
        'color' => [__('Color Filter'), 3, '<circle cx="9" cy="12" r="6" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="15" cy="12" r="6" fill="currentColor" opacity=".45"/>'],
        'spacing' => [__('Text Spacing'), 3, '<text x="2" y="13" font-size="12" font-weight="600" fill="currentColor">A V</text><path d="M3 19h18M3 19l3-2.5M3 19l3 2.5M21 19l-3-2.5M21 19l-3 2.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>'],
        'line-height' => [__('Line Height'), 3, '<path d="M11 6h10M11 12h10M11 18h10M6 4v16M3.5 6.5 6 4l2.5 2.5M3.5 17.5 6 20l2.5-2.5" stroke="currentColor" stroke-width="1.8" fill="none" stroke-linecap="round"/>'],
        'font' => [__('Font Selection'), 3, '<text x="2" y="18" font-size="15" font-family="serif" fill="currentColor">Aa</text>'],
        'saturation' => [__('Saturation'), 3, '<path d="M12 3s6.5 7 6.5 11.5a6.5 6.5 0 0 1-13 0C5.5 10 12 3 12 3z" fill="none" stroke="currentColor" stroke-width="2"/><path d="M12 21a6.5 6.5 0 0 1-6.5-6.5h13A6.5 6.5 0 0 1 12 21z" fill="currentColor"/>'],
        'dyslexia' => [__('Dyslexia Friendly'), 1, '<text x="1" y="18" font-size="16" font-weight="700" font-family="sans-serif" fill="currentColor">Df</text>'],
        'cursor' => [__('Bigger Cursor'), 1, '<path d="M5 3l14 8-6.2 1.6L10 19z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>'],
        'hide-images' => [__('Hide Images'), 1, '<path d="M2 12s3.6-6 10-6 10 6 10 6-3.6 6-10 6S2 12 2 12z" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="3" fill="currentColor"/><path d="M4 20 20 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>'],
        'pause' => [__('Pause Animations'), 1, '<circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="2"/><path d="M10 8.5v7M14 8.5v7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>'],
    ];
@endphp

<div class="a11y" data-a11y>
    <button type="button" class="a11y__toggle" data-a11y-open aria-controls="a11y-panel" aria-expanded="false"
        aria-label="{{ __('Accessibility Tools') }}" title="{{ __('Accessibility Tools') }}">
        <svg viewBox="0 0 24 24" width="30" height="30" aria-hidden="true">
            <circle cx="12" cy="12" r="11" fill="none" stroke="currentColor" stroke-width="1.6" />
            <circle cx="12" cy="6.3" r="1.7" fill="currentColor" />
            <path d="M6.5 9.3 12 10.5l5.5-1.2M12 10.5v3.8M12 14.3l-2.6 5M12 14.3l2.6 5" fill="none"
                stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>

    <aside class="a11y__panel" id="a11y-panel" aria-labelledby="a11y-title" hidden>
        <div class="a11y__head">
            <h2 class="a11y__title" id="a11y-title">{{ __('Accessibility Tools') }}</h2>
            <button type="button" class="a11y__icon-btn" data-a11y-reset aria-label="{{ __('Reset') }}"
                title="{{ __('Reset') }}">
                <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true">
                    <path d="M20 12a8 8 0 1 1-2.3-5.7M20 4v5h-5" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <button type="button" class="a11y__icon-btn" data-a11y-close aria-label="{{ __('Close') }}"
                title="{{ __('Close') }}">
                <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true">
                    <path d="M6 6l12 12M18 6 6 18" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" />
                </svg>
            </button>
        </div>

        <div class="a11y__grid">
            @foreach ($a11yTools as $key => [$label, $levels, $icon])
                <button type="button" class="a11y__tool" data-a11y-tool="{{ $key }}" data-levels="{{ $levels }}"
                    aria-pressed="false">
                    <svg viewBox="0 0 24 24" width="28" height="28" aria-hidden="true">{!! $icon !!}</svg>
                    <span class="a11y__label">{{ $label }}</span>
                    <span class="a11y__levels" aria-hidden="true">
                        @for ($i = 0; $i < $levels; $i++)
                            <span></span>
                        @endfor
                    </span>
                </button>
            @endforeach
        </div>
    </aside>
</div>
