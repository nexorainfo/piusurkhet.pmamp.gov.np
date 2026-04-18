@extends('layouts.master')
@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb-overlay-text text-center">
                <div class="breadcrumb-title mt-2">
                    <h1>
                        {{ __('Video Gallery') }}
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
                            {{ __('Video Gallery') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row my-4">
            @foreach ($videoGalleries as $videoGallery)
                <div class="col-md-4 mt-2">
                    <div class="border">
                        <iframe width="100%" height="250" src="{!! $videoGallery->url !!}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>

                        <h3 class="gallery-title mt-3">
                            @if (request()->language == 'en')
                                {{ $videoGallery->title_en }}
                            @else
                                {{ $videoGallery->title }}
                            @endif
                        </h3>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
