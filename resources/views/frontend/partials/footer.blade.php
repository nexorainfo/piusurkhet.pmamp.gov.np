@php
    $isEnglish = app()->getLocale() === 'en';
    $emails = array_filter(array_map('trim', explode(',', (string) $header?->office_email)));
    $phones = array_filter(array_map('trim', explode(',', (string) $header?->office_phone)));
    $officeName = $isEnglish && $header?->office_name_en ? $header->office_name_en : $header?->office_name;
    $address = $isEnglish && $header?->office_address_en ? $header->office_address_en : $header?->office_address;
    $logo = $header?->en_header ? asset('storage/' . $header->en_header) : asset('images/logo.png');
    $socialLinks = $header?->social_links ?? [];
    $year = \NepDate\AdDate::fromDateTime(new DateTimeImmutable())
        ->toBs()
        ->format('Y', $isEnglish ? 'en' : 'ne');

    // "सोमबार - शुक्रबार ( ०९:०० - ४:०० ) बजे" → days on the left, time on the right.
    $officeHours = [
        [__('Winter (Kartik 16 to Magh 15)'), $header?->office_hours_winter ?: __('Monday - Friday ( 09:00 - 4:00 )')],
        [__('Summer (Magh 16 to Kartik 15)'), $header?->office_hours_summer ?: __('Monday - Friday ( 09:00 - 5:00 )')],
    ];
    $splitHours = function (string $text) {
        $at = mb_strpos($text, '(');
        return $at === false ? [$text, ''] : [trim(mb_substr($text, 0, $at)), trim(mb_substr($text, $at))];
    };

    $socialIcons = [
        'facebook' => ['Facebook', '<path fill="currentColor" d="M14 8.6V6.9c0-.8.5-1 .9-1H17V2.1L14.1 2C10.9 2 10 4.4 10 6.5v2.1H8v3.9h2V22h4v-9.5h2.9l.4-3.9H14z"/>'],
        'x' => ['X', '<path fill="currentColor" d="M17.8 3h3.1l-6.8 7.7L22 21h-6.2l-4.9-6.4L5.3 21H2.2l7.2-8.3L2 3h6.4l4.4 5.8L17.8 3zm-1.1 16.2h1.7L7.4 4.7H5.6l11.1 14.5z"/>'],
        'youtube' => ['YouTube', '<path fill="currentColor" d="M23 7.2a3 3 0 0 0-2.1-2.1C19 4.6 12 4.6 12 4.6s-7 0-8.9.5A3 3 0 0 0 1 7.2 31 31 0 0 0 .5 12a31 31 0 0 0 .5 4.8 3 3 0 0 0 2.1 2.1c1.9.5 8.9.5 8.9.5s7 0 8.9-.5a3 3 0 0 0 2.1-2.1 31 31 0 0 0 .5-4.8 31 31 0 0 0-.5-4.8zM9.8 15V9l5.8 3-5.8 3z"/>'],
        'instagram' => ['Instagram', '<rect x="3" y="3" width="18" height="18" rx="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.2" fill="currentColor"/>'],
        'tiktok' => ['TikTok', '<path fill="currentColor" d="M16.6 3c.4 2.2 1.9 3.8 4.1 4v3.1c-1.5 0-2.9-.4-4.1-1.2v6.2a5.9 5.9 0 1 1-5.9-5.9c.3 0 .6 0 .9.1v3.2a2.8 2.8 0 1 0 2 2.7V3h3z"/>'],
    ];
    $pinIcon = '<path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"/>';
    $mailIcon = '<path fill="currentColor" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"/>';
    $phoneIcon = '<path fill="currentColor" d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"/>';
@endphp

<footer class="site-footer">
    <div class="site-footer__container">
        <a href="{{ route('welcome', ['language' => $language]) }}" class="site-footer__brand">
            <img src="{{ $logo }}" alt="{{ __('Emblem of Nepal') }}" loading="lazy">
            <span>
                <span class="site-footer__brand-name">{{ $officeName }}</span>
                @if ($address)
                    <span class="site-footer__brand-address">{{ $address }}</span>
                @endif
            </span>
        </a>

        <div class="site-footer__middle">
            <section class="site-footer__hours" aria-labelledby="footer-hours-title">
                <h2 class="site-footer__title" id="footer-hours-title">{{ __('Office Hours') }}</h2>
                @foreach ($officeHours as [$season, $hours])
                    @php [$days, $time] = $splitHours($hours); @endphp
                    @if (!$loop->first)
                        <hr>
                    @endif
                    <h3 class="site-footer__subtitle">{{ $season }}</h3>
                    <p class="site-footer__hours-row">
                        <span>{{ $days }}</span>
                        @if ($time)
                            <span>{{ $time }}</span>
                        @endif
                    </p>
                @endforeach
            </section>

            <nav class="site-footer__links" aria-labelledby="footer-links-title">
                <h2 class="site-footer__title" id="footer-links-title">{{ __('Useful Links') }}</h2>
                <ul class="site-footer__list">
                    @foreach ($sharedLinks as $link)
                        <li>
                            <a href="{{ $link->url }}" target="_blank" rel="noopener">
                                {{ $isEnglish && $link->title_en ? $link->title_en : $link->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('static', ['links', 'language' => $language]) }}" class="site-footer__more">
                    {{ __('View All') }}
                </a>
            </nav>
        </div>

        <div class="site-footer__contact-bar">
            @if ($socialLinks)
                <ul class="site-footer__social" aria-label="{{ __('Social media') }}">
                    @foreach ($socialLinks as $network => $url)
                        <li>
                            <a href="{{ $url }}" target="_blank" rel="noopener" aria-label="{{ $socialIcons[$network][0] }}"
                                title="{{ $socialIcons[$network][0] }}">
                                <svg viewBox="0 0 24 24" aria-hidden="true">{!! $socialIcons[$network][1] !!}</svg>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif

            <ul class="site-footer__contact">
                @if ($address)
                    <li>
                        <svg viewBox="0 0 384 512" aria-hidden="true">{!! $pinIcon !!}</svg>
                        @if ($header?->map_iframe)
                            <a href="{{ $header->map_iframe }}" target="_blank" rel="noopener">{{ $address }}</a>
                        @else
                            <span>{{ $address }}</span>
                        @endif
                    </li>
                @endif
                @foreach ($emails as $email)
                    <li>
                        <svg viewBox="0 0 512 512" aria-hidden="true">{!! $mailIcon !!}</svg>
                        <a href="mailto:{{ $email }}">{{ $email }}</a>
                    </li>
                @endforeach
                @if ($phones)
                    <li>
                        <svg viewBox="0 0 512 512" aria-hidden="true">{!! $phoneIcon !!}</svg>
                        <span class="site-footer__phones">
                            @foreach ($phones as $phone)
                                <a href="tel:{{ preg_replace('/[^\d+]/', '', \App\Support\NepaliNumber::toAscii($phone)) }}">{{ $phone }}</a>
                            @endforeach
                        </span>
                    </li>
                @endif
            </ul>
        </div>

        <p class="site-footer__copyright">© {{ __('All rights reserved') }} {{ $year }}</p>
    </div>

    {{-- Stupa, temples and hills skyline along the bottom edge, as on opmcm.gov.np --}}
    <div class="site-footer__skyline" aria-hidden="true">
        <img src="{{ asset('images/skyline.png') }}" alt="" loading="lazy">
    </div>
</footer>
