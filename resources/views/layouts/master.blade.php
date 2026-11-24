<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>{{ config('app.name') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/backend/images/np.png') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalimati:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/site-header-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/site-documents.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/site-accessibility.css') }}">
    {{-- In <head> so saved accessibility settings apply before the page paints --}}
    <script src="{{ asset('assets/frontend/js/site-accessibility.js') }}"></script>
    @stack('style')
</head>

<body>
    @include('frontend.partials.header')

    @yield('content')

    @include('frontend.partials.footer')

    @include('frontend.partials.accessibility')

    <button onclick="topFunction()" id="backToTop" title="Go to top">
        <svg fill="#fff" height="30px" width="30px" version="1.1" id="Capa_1"
            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
            xml:space="preserve">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <g>
                    <path
                        d="M304,160c0-5.123-0.805-10.169-2.392-14.998c-1.379-4.197-5.902-6.479-10.098-5.102c-4.198,1.379-6.482,5.9-5.103,10.098 C287.464,153.212,288,156.577,288,160c0,17.645-14.355,32-32,32s-32-14.355-32-32s14.355-32,32-32c3.785,0,7.486,0.652,11,1.938 c4.15,1.519,8.744-0.613,10.263-4.762c1.519-4.149-0.613-8.744-4.762-10.263C267.219,112.981,261.668,112,256,112 c-26.467,0-48,21.533-48,48s21.533,48,48,48S304,186.468,304,160z">
                    </path>
                    <path
                        d="M362.8,337.74c-6.429-6.768-12.821-11.898-16.698-14.788C355.164,293.051,360,260.978,360,228 c0-91.433-36.996-175.999-98.963-226.215c-2.937-2.38-7.137-2.38-10.073,0C188.996,52.001,152,136.568,152,228 c0,32.978,4.837,65.051,13.898,94.953c-3.877,2.89-10.269,8.02-16.698,14.788C135.133,352.548,128,367.439,128,382v122 c0,3.235,1.949,6.152,4.938,7.391c0.99,0.41,2.029,0.609,3.06,0.609c2.082,0,4.128-0.813,5.659-2.343l81.789-81.79 c7.648,8.595,15.853,16.563,24.554,23.864V503c0,4.418,3.582,8,8,8s8-3.582,8-8v-51.268c8.701-7.301,16.906-15.27,24.554-23.864 l81.789,81.79c1.53,1.53,3.576,2.343,5.659,2.343c1.03,0,2.07-0.199,3.06-0.609c2.989-1.238,4.938-4.155,4.938-7.391V382 C384,367.439,376.867,352.548,362.8,337.74z M144,484.687V382c0-12.767,9.018-24.998,16.582-33.01 c3.765-3.988,7.565-7.36,10.686-9.919c10.254,28.139,24.385,54.013,41.899,76.449L144,484.687z M264,430.271V328 c0-4.418-3.582-8-8-8s-8,3.582-8,8v102.271c-5.955-5.685-11.625-11.727-16.985-18.109c-0.357-0.652-0.806-1.266-1.358-1.818 c-0.175-0.175-0.358-0.337-0.545-0.492C190.317,362.437,168,297.387,168,228c0-84.128,32.782-161.908,88-209.571 C311.218,66.092,344,143.872,344,228c0,69.386-22.317,134.436-61.112,181.851c-0.187,0.155-0.37,0.317-0.545,0.492 c-0.552,0.552-1.001,1.166-1.358,1.818C275.625,418.544,269.955,424.586,264,430.271z M368,484.687l-69.167-69.167 c17.525-22.449,31.662-48.34,41.917-76.499C352.011,348.262,368,365.088,368,382V484.687z">
                    </path>
                </g>
            </g>
        </svg>
    </button>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/frontend/js/app.js') }}"></script>
    @stack('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nav = document.querySelector('.site-nav');
            if (!nav) return;
            const isMobile = () => window.matchMedia('(max-width: 991.98px)').matches;

            // Mobile menu toggle
            document.querySelectorAll('[data-nav-toggle]').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const open = nav.classList.toggle('is-open');
                    btn.setAttribute('aria-expanded', open);
                });
            });

            // Dropdowns: hover on desktop (CSS), tap to expand on mobile
            nav.querySelectorAll('[data-dropdown-toggle]').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    if (!isMobile()) {
                        if (link.getAttribute('href') === '#') e.preventDefault();
                        return;
                    }
                    e.preventDefault();
                    const item = link.parentElement;
                    const expanded = item.classList.toggle('is-expanded');
                    link.setAttribute('aria-expanded', expanded);
                });
            });

            // Search popover
            const search = nav.querySelector('[data-search]');
            const searchToggle = nav.querySelector('[data-search-toggle]');
            if (search && searchToggle) {
                searchToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const open = search.classList.toggle('is-open');
                    searchToggle.setAttribute('aria-expanded', open);
                    if (open) search.querySelector('input').focus();
                });
                document.addEventListener('click', function(e) {
                    if (!search.contains(e.target)) {
                        search.classList.remove('is-open');
                        searchToggle.setAttribute('aria-expanded', false);
                    }
                });
            }

            // Shadow + mini logo once the nav sticks to the top
            const sentinel = document.querySelector('.site-nav__sentinel');
            if (sentinel && 'IntersectionObserver' in window) {
                new IntersectionObserver(function(entries) {
                    nav.classList.toggle('is-stuck', !entries[0].isIntersecting);
                }).observe(sentinel);
            }
        });
    </script>
    <script>
        //Get the button
        const backToTop = document.getElementById("backToTop");
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                backToTop.style.display = "block";
            } else {
                backToTop.style.display = "none";
            }
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>

</body>

</html>
