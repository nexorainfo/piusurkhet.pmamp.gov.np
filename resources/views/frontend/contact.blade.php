@extends('layouts.master')
@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb-overlay-text text-center">
                <div class="breadcrumb-title mt-2">
                    <h1>
                        {{ __('Contact') }}

                    </h1>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href={{ route('welcome', ['language' => $language]) }}>
                                गृहपृष्‍ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('Contact') }}

                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <iframe src="{{ $header->map_iframe }}" width="100%" height="300" style="border:0;" allowfullscreen=""
                    loading="lazy"></iframe>
            </div>
            <div class="col-md-6">
                <div class="info-content">
                    <h3>मद्दतको लागि हामीलाई सम्पर्क गर्नुहोस्</h3>
                    <ul class="list-unstyled mt-3">

                        <li>
                            <div class="list-item">
                                <div class="list-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>

                                <div class="list-text">

                                    <p class="mb-0">{{ $header->office_address }}</p>
                                </div>
                            </div>
                        </li>



                        <li>
                            <div class="list-item">
                                <div class="list-icon">
                                    <i class="fa fa-phone"></i>
                                </div>

                                <div class="list-text">
                                    <label>{{ __('Phone') }}</label>
                                    <p>
                                        <a href="tel:{{ $header->office_phone }}">{{ $header->office_phone }}</a>

                                    </p>
                                </div>
                            </div>
                        </li>



                        <li>
                            <div class="list-item">
                                <div class="list-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>

                                <div class="list-text">
                                    <label>{{ __('Email') }}</label>
                                    <p>
                                        <a href="mailto:{{ $header->office_email }}">{{ $header->office_email }}</a>
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
