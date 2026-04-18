<footer class="footer-bg-color mt-2">
    <div class="footer-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <h4 class="footer-title mb-3">
                        {{ __('Contacts') }}
                    </h4>
                    <h4 class="office-name">
                        @if (request()->language == 'en')
                            {{ $header->office_name_en }}
                        @else
                            {{ $header->office_name }}
                        @endif
                    </h4>
                    <div class="footer-contact mt-1">
                        <ul class="d-flex flex-column list-unstyled gap-1">
                            <li>
                                <i class="fa fa-map-marker"></i>
                                @if (request()->language == 'en')
                                    {{ $header->office_address_en }}
                                @else
                                    {{ $header->office_address }}
                                @endif
                            </li>
                            <li class="d-flex gap-3 align-items-center">
                                <i class="fa fa-envelope"></i>
                                <div class="d-flex flex-col gap-2">
                                    @foreach (explode(',', $header->office_email) as $email)
                                        <a href="mailto:{{ $email }}">
                                            {{ $email }}
                                        </a>
                                        @if (!$loop->last), @endif
                                    @endforeach
                                </div>

                            </li>
                            <li class="d-flex gap-3 align-items-center">
                                <i class="fa fa-phone"></i>
                                <div class="d-flex gap-2">
                                    @foreach (explode(',', $header->office_phone) as $phone)
                                        <a href="mailto:{{ $phone }}">
                                            {{ $phone }}
                                        </a>
                                        @if (!$loop->last), @endif
                                    @endforeach
                                </div>
                            </li>

                        </ul>
                    </div>
                    <div class="footer-social mt-4">
                        <ul class="d-flex list-unstyled gap-2">
                            <li>
                                <a href="#">
                                    <i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-youtube"></i></a>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <h4 class="footer-title mb-3">{{ __('Important Links') }}</h4>
                    <div class="footer-link">
                        <ul class="list-unstyled">
                            @foreach ($sharedLinks as $link)
                                <li class="mb-2">
                                    <a class="text-decoration-none" href="{{ $link->url }}" target="_blank">
                                        {{ $link->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('static', ['links', 'language' => $language]) }}"
                            class="btn btn-light btn-sm">
                            {{ __('View More') }}
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <h4 class="footer-title mb-3">कार्यालय समय</h4>
                    <div class="text-white">

                        <h5 class="subTitle">जाडो (कार्तिक १६ देखि माघ १५)</h5>

                        <div class="d-flex justify-content-between mt-2">
                            <h6>सोमबार देखि शुक्रबार</h6>
                            <span class="time">बिहान ०९:०० देखि बेलुकी ४:०० सम्म</span>
                        </div>

                        <hr>

                        <h5 class="subTitle">गर्मी (माघ १६ देखि कार्तिक १५)</h5>

                        <div class="d-flex justify-content-between mt-2">
                            <h6>सोमबार देखि शुक्रबार</h6>
                            <span class="time">बिहान ०९:०० देखि बेलुकी ५:०० बजे सम्म</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container border-top pb-3">
        <div class="pt-2 d-flex justify-content-between text-white">
            <span>© सर्वाधिकार सुरक्षित २०८१ </span>
            {{-- <span>Developed By:
                <a class="text-white" href="https://nexorainfo.com/" target="_blank">Nexora Info</a>
            </span> --}}
        </div>
    </div>
</footer>
