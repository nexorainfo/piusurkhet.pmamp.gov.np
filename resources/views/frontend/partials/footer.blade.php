@php
    $isEnglish = app()->getLocale() === 'en';
    $emails = array_filter(array_map('trim', explode(',', (string) $header?->office_email)));
    $phones = array_filter(array_map('trim', explode(',', (string) $header?->office_phone)));
    $year = \NepDate\AdDate::fromDateTime(new DateTimeImmutable())
        ->toBs()
        ->format('Y', $isEnglish ? 'en' : 'ne');
@endphp

<footer class="site-footer">
    <div class="site-footer__container">
        <div class="site-footer__top">
            <div class="site-footer__col">
                <h2 class="site-footer__title">{{ __('Useful Links') }}</h2>
                <ul class="site-footer__menu">
                    @foreach ($sharedLinks as $link)
                        <li>
                            <a href="{{ $link->url }}" class="site-footer__link" target="_blank" rel="noopener">
                                {{ $isEnglish && $link->title_en ? $link->title_en : $link->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="site-footer__more">
                    <a href="{{ route('static', ['links', 'language' => $language]) }}">{{ __('View All') }}</a>
                </div>
            </div>

            <div class="site-footer__col">
                <h2 class="site-footer__title">{{ __('Contact Address') }}</h2>
                <ul class="site-footer__menu">
                    @if ($header?->office_name || $header?->office_name_en)
                        <li class="site-footer__office">
                            {{ $isEnglish ? $header->office_name_en : $header->office_name }}
                        </li>
                    @endif
                    @if ($header?->office_address || $header?->office_address_en)
                        <li class="site-footer__group">
                            <span class="site-footer__label">
                                <svg viewBox="0 0 384 512" aria-hidden="true">
                                    <path fill="currentColor"
                                        d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z" />
                                </svg>
                                {{ __('Address') }}:
                            </span>
                            <span>{{ $isEnglish ? $header->office_address_en : $header->office_address }}</span>
                        </li>
                    @endif
                    <li class="site-footer__group">
                        <span class="site-footer__label">
                            <svg viewBox="0 0 512 512" aria-hidden="true">
                                <path fill="currentColor"
                                    d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z" />
                            </svg>
                            {{ __('Email') }}:
                        </span>
                        <span class="site-footer__values">
                            @forelse ($emails as $email)
                                <a href="mailto:{{ $email }}">{{ $email }}</a>
                            @empty
                                -
                            @endforelse
                        </span>
                    </li>
                    <li class="site-footer__group">
                        <span class="site-footer__label">
                            <svg viewBox="0 0 512 512" aria-hidden="true">
                                <path fill="currentColor"
                                    d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z" />
                            </svg>
                            {{ __('Phone') }}:
                        </span>
                        <span class="site-footer__values">
                            @forelse ($phones as $phone)
                                <a href="tel:{{ $phone }}">{{ $phone }}</a>
                            @empty
                                -
                            @endforelse
                        </span>
                    </li>
                </ul>
            </div>

            <div class="site-footer__col">
                @if ($header?->map_iframe)
                    <div class="site-footer__map">
                        <iframe src="{{ $header->map_iframe }}" title="{{ __('Our Map') }}" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                    </div>
                @endif
            </div>
        </div>

        <div class="site-footer__bottom">
            <p class="site-footer__copyright">© {{ __('All rights reserved') }} {{ $year }}</p>
            <button type="button" class="site-footer__top-btn" onclick="topFunction()"
                aria-label="{{ __('Back to top') }}">
                <svg viewBox="0 0 448 512" width="16" height="16" aria-hidden="true">
                    <path fill="currentColor"
                        d="M34.9 289.5l-22.2-22.2c-9.4-9.4-9.4-24.6 0-33.9L207 39c9.4-9.4 24.6-9.4 33.9 0l194.3 194.3c9.4 9.4 9.4 24.6 0 33.9L413 289.4c-9.5 9.5-25 9.3-34.3-.4L264 168.6V456c0 13.3-10.7 24-24 24h-32c-13.3 0-24-10.7-24-24V168.6L69.2 289.1c-9.3 9.8-24.8 10-34.3.4z" />
                </svg>
            </button>
        </div>
    </div>
</footer>
