@extends('layouts.master')
@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb-overlay-text text-center">
                <div class="breadcrumb-title mt-2">
                    <h1>
                        {{ __('Photo Gallery') }}
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
                            {{ __('Photo Gallery') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <div class="container my-4">
        <div class="gallery-grid">
            @foreach ($photoAlbums as $photoAlbum)
                <div class="border">
                    <div class="gallery-image">
                       <a href="{{ route('photoGalleryDetails', [$photoAlbum->slug, 'language' => $language]) }}">
                            <img src="{{ asset('storage/' . $photoAlbum->photos->first()->images) }}"
                                alt={{ $photoAlbum->title_en }}>
                        </a>
                    </div>

                    <h3 class="gallery-title mt-3">
                       <a href="{{ route('photoGalleryDetails', [$photoAlbum->slug, 'language' => $language]) }}">
                            @if (request()->language == 'en')
                                {{ $photoAlbum->title_en }}
                            @else
                                {{ $photoAlbum->title }}
                            @endif
                        </a>
                    </h3>
                </div>
            @endforeach
        </div>
    </div>
@endsection
