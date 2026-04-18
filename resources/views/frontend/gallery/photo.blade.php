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
    <div class="container">
        <h1 class="photo-title text-center mb-0 mt-4">
            @if (request()->language == 'en')
                {{ $photoGallery->title_en }}
            @else
                {{ $photoGallery->title }}
            @endif
        </h1>

        <div class="gallery-grid mt-2 mb-4">
            @foreach ($photoGallery->photos as $photo)
                <div class="border">
                    <div class="gallery-image">
                        <a class="#">
                            <img src="{{ asset('storage/' . $photo->images) }}" alt="{{ $photoGallery->title_en }}"
                                class="lightbox-trigger">

                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="lightbox" class="lightbox">
        <span class="close">&times;</span>
        <img class="lightbox-content" id="lightbox-img">
    </div>

    @push('script')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const lightbox = document.getElementById("lightbox");
                const lightboxImg = document.getElementById("lightbox-img");
                const closeBtn = document.querySelector(".close");

                document.querySelectorAll(".lightbox-trigger").forEach(image => {
                    image.addEventListener("click", function() {
                        lightbox.style.display = "flex";
                        lightboxImg.src = this.src;
                    });
                });

                closeBtn.addEventListener("click", function() {
                    lightbox.style.display = "none";
                });

                lightbox.addEventListener("click", function(e) {
                    if (e.target === lightbox) {
                        lightbox.style.display = "none";
                    }
                });
            });
        </script>
    @endpush

    @push('style')
        <style>
            .lightbox-trigger {
                cursor: pointer;
            }

            .lightbox {
                display: none;
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.8);
                justify-content: center;
                align-items: center;
            }

            .lightbox-content {
                max-width: 60%;
                max-height: 60%;
            }

            .close {
                position: absolute;
                top: 20px;
                right: 30px;
                color: white;
                font-size: 35px;
                font-weight: bold;
                cursor: pointer;
            }
        </style>
    @endpush
@endsection
