@extends('layouts.master')
@section('content')
    <section class="mt-2">
        <div class="container">
            <div class="marquee-slider">
                <h2 class="marquee-title">{{ __('Latest News') }}</h2>
                <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                    <div class="carousel-inner">
                        @foreach ($tickerFiles as $key => $tickerFile)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <a class="marquee-item"
                                    href="{{ route('documentDetail', [$tickerFile->slug, 'language' => $language]) }}">
                                    @if (request()->language == 'en')
                                        {{ $tickerFile->title_en }}
                                    @else
                                        {{ $tickerFile->title }}
                                    @endif
                                    {{ $tickerFile->published_date }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 order-1 order-lg-2 rounded-2">
                    <div id="slider" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach ($sliders as $sliderButton)
                                <button type="button" data-bs-target="#slider" data-bs-slide-to="{{ $loop->index }}"
                                    class="{{ $loop->first ? 'active' : '' }}"
                                    @if ($loop->first) aria-current="true" @endif
                                    aria-label="Slide {{ $loop->iteration }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($sliders as $slider)
                                <div class="carousel-item position-relative {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ $slider->photo }}" class="d-block w-100 carousel-height rounded-2"
                                        alt="{{ $slider->title }}">
                                    <div class="carousel-caption py-2 px-3">
                                        @if (request()->language == 'en')
                                            <p class="mb-0">{{ $slider->title_en }}</p>
                                        @else
                                            <p class="mb-0">{{ $slider->title }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-4 order-2 order-lg-3">
                    <div class="row">
                        <div class="col-sm-6 col-lg-12 mt-3 mt-md-0">
                            @if ($header->chief_id || $header->information_officer_id)
                                <div class="team-box">
                                    @if ($header->chief_id)
                                        <div class="box-wrapper">
                                            <div class="box-image">
                                                <img src="{{ $header->chief->photo ?? '' }}"
                                                    alt="{{ $header->chief->name ?? '' }}">
                                            </div>
                                            <div class="box-info">
                                                <h5 class="box-name">{{ $header->chief->name ?? '' }}</h5>
                                                <span class="box-position">
                                                    {{ $header->chief->designation->title ?? '' }}
                                                </span>
                                                <a href="telto:{{ $header->chief->phone ?? '' }}" class="box-msc">
                                                    <i class="fa fa-phone"></i>
                                                    {{ $header->chief->phone ?? '' }}
                                                </a>
                                                <a href="mailto:{{ $header->chief->email ?? '' }}" class="box-msc mt-2">
                                                    <i class="fa fa-envelope"></i>
                                                    {{ $header->chief->email ?? '' }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if ($header->information_officer_id)
                                        <div class="box-wrapper">
                                            <div class="box-image">
                                                <img src="{{ $header->informationOfficer->photo ?? '' }}"
                                                    alt="{{ $header->informationOfficer->name ?? '' }}">
                                            </div>
                                            <div class="box-info">
                                                <h5 class="box-name">{{ $header->informationOfficer->name ?? '' }}</h5>
                                                <span class="box-position">
                                                    {{ __('Information Officer') }}
                                                </span>
                                                <a href="telto:{{ $header->informationOfficer->phone ?? '' }}"
                                                    class="box-msc mt-2">
                                                    <i class="fa fa-phone"></i>
                                                    {{ $header->informationOfficer->phone ?? '' }}
                                                </a>
                                                <a href="mailto:{{ $header->informationOfficer->email ?? '' }}"
                                                    class="box-msc">
                                                    <i class="fa fa-envelope"></i>
                                                    {{ $header->informationOfficer->email ?? '' }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            <div class="card-01">
                        <h6 class="heading mb-2">
                            @if(request()->language=='en')
                                {{$officeDetail->title_en ?? ''}}
                            @else
                                {{$officeDetail->title ?? ''}}
                            @endif
                        </h6>
                        <p class="text-withlink">
                            @if(request()->language=='en')
                                {!! Str::words(strip_tags($officeDetail->description_en ?? ''), 60, '...') !!}
                            @else
                                {!! Str::words(strip_tags($officeDetail->description ?? ''), 60, '...') !!}
                            @endif
                            <a class="intro-title"
                               href="{{route('officeDetail',[$officeDetail->slug ?? '','language'=>$language])}}">
                                {{__('View More')}}
                            </a>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-bg section-padding mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="title">
                        <h4 class="category-title">
                            {{__('Highlights')}}
                        </h4>
                    </div>

                    <div class="block-grid">
                        @foreach ($tickerFiles->take(8) as $key => $tickerFile)
                            <div class="card-details">
                                <h3 class="card-title mb-0">
                                    <a href={{ route('documentDetail', [$tickerFile->slug, 'language' => $language]) }}>
                                        @if (request()->language == 'en')
                                            {{ $tickerFile->title_en }}
                                        @else
                                            {{ $tickerFile->title }}
                                        @endif
                                    </a>
                                </h3>
                                <div class="date"><i class="fa fa-clock-o"></i> {{ $tickerFile->published_date }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    @php
                        $category = $categories->first();
                    @endphp
                    @if ($category)
                        <div class="mt-3 mt-sm-0">
                            <div class="title">
                                <h4 class="category-title">
                                    @if (request()->language == 'en')
                                        {{ $category->title_en }}
                                    @else
                                        {{ $category->title }}
                                    @endif
                                </h4>
                            </div>
                            <div class="card-">
                                <ul class="nav nav-tabs" role="tablist">
                                    @foreach ($category->documentCategories as $subcategory)
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                id="{{ \Illuminate\Support\Str::slug($subcategory->title, '-') }}-tab"
                                                data-bs-toggle="tab"
                                                href="#{{ \Illuminate\Support\Str::slug($subcategory->title, '-') }}"
                                                data-bs-target="#{{ \Illuminate\Support\Str::slug($subcategory->title, '-') }}"
                                                type="button" role="tab"
                                                aria-controls="{{ \Illuminate\Support\Str::slug($subcategory->title, '-') }}"
                                                @if ($loop->first) aria-selected="true" @endif>
                                                @if (request()->language == 'en')
                                                    {{ $subcategory->title_en }}
                                                @else
                                                    {{ $subcategory->title }}
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content mt-2">
                                    @foreach ($category->documentCategories as $subcategoryData)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                            id="{{ \Illuminate\Support\Str::slug($subcategoryData->title, '-') }}"
                                            role="tabpanel"
                                            aria-labelledby="{{ \Illuminate\Support\Str::slug($subcategoryData->title, '-') }}-tab">
                                            <div class="card-group w-100">
                                                @foreach ($subcategoryData->documents->take(3) as $document)
                                                    <div
                                                        class="tab-content-bg card-detail d-flex justify-content-between gap-3 align-items-center">
                                                        <div class="d-flex gap-3 align-items-center card-info">
                                                            <i class="fa fa-file-pdf-o file"></i>
                                                            <div>
                                                                <h3 class="doc-card-title mb-0">
                                                                    <a
                                                                        href="{{ route('documentDetail', [$document->slug, 'language' => $language]) }}">

                                                                        @if (request()->language == 'en')
                                                                            {{ $document->title_en }}
                                                                        @else
                                                                            {{ $document->title }}
                                                                        @endif
                                                                    </a>
                                                                </h3>
                                                                <small>
                                                                    <i class="fa fa-clock-o"></i>
                                                                    @if (request()->language == 'en')
                                                                        {{ $document->published_date }}
                                                                    @else
                                                                        {{ $document->published_date }}
                                                                    @endif
                                                                </small>
                                                            </div>

                                                        </div>

                                                        <div class="d-none d-sm-block">
                                                            <a href={{ route('documentDetail', [$document->slug, 'language' => $language]) }}
                                                                class="btn-download">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="mt-3">
                                                <a href="{{ route('documentCategory', [$subcategoryData->slug, 'language' => $language]) }}"
                                                    class="more-link">
                                                    {{ __('View More') }}
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </section>
    <section class="section-padding">
        <div class="container">
            <div class="row">
                @include('frontend.index.list')
            </div>
        </div>
    </section>


    <section class="section-bg section-padding mt-5">
        <div class="container">
            <div class="title">
                <h4 class="category-title">
                    फोटोहरू
                </h4>
            </div>
            <div class="gallery-grid">
                @foreach ($galleries as $gallery)
                    <div class="border">
                        <div class="gallery-image">
                            <a href="{{ route('photoGalleryDetails', [$gallery->slug, 'language' => $language]) }}">
                                <img src="{{ !empty($gallery->photos->first()) ? asset('storage/' . $gallery->photos->first()?->images) : '' }}"
                                    alt={{ $gallery->title_en }}>
                            </a>
                        </div>

                        <h3 class="gallery-title mt-3">
                            <a href="{{ route('photoGalleryDetails', [$gallery->slug, 'language' => $language]) }}">
                                @if (request()->language == 'en')
                                    {{ $gallery->title_en }}
                                @else
                                    {{ $gallery->title }}
                                @endif
                            </a>
                        </h3>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 d-flex justify-content-center">
                <a href={{ route('static', ['photoGallery', 'language' => $language]) }} class="more-link">
                    थप हेर्नुहोस्
                </a>
            </div>
        </div>
    </section>


<section class="mt-2">
    <div class="container">
        <div class="row g-4">

            <!-- Video Gallery -->
            <div class="col-md-4">
                <div class="title mb-3">
                    <div class="category-title">
                        <h4 class="category-title">
                            {{ __('Facebook') }}
                        </h4>
                    </div>
                </div>
            
                    <div class="my-3">
                   <iframe src="{{$header->facebook_iframe}}"
                        style="border: none; overflow: hidden; width: 100%; height: 400px;"
                        scrolling="no"
                        frameborder="0"
                        allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                    </iframe>
                </div>
            </div>

            <!-- Calendar -->
            <div class="col-md-4">
                <div class="title mb-3">
                    <div class="category-title">
                        <h4 class="category-title">
                            {{ __('Calendar') }}
                        </h4>
                    </div>
                </div>

                <div class="my-3">
                    <iframe src="https://www.hamropatro.com/widgets/calender-medium.php"
                        frameborder="0"
                        scrolling="no"
                        style="border: none; overflow: hidden; width: 100%; height: 385px;"
                        allowtransparency="true">
                    </iframe>
                </div>
            </div>

            <!-- Our Map -->
            <div class="col-md-4">
                <div class="title mb-3">
                    <div class="category-title">
                        <h4 class="category-title">
                            {{ __('Our Map') }}
                        </h4>
                    </div>
                </div>

                <div class="my-3">
                    <iframe src="{{$header->map_iframe}}"
                        width="100%" height="400" style="border:0;"
                        allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>

        </div>
    </div>
</section>


    <!-- Modal -->
    @if ($noticePopups->count() > 0)
        <div class="modal fade" id="noticeModal" tabindex="-1" aria-labelledby="noticeModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="noticeModal"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @foreach ($noticePopups as $noticePopup)
                            @foreach ($noticePopup->files as $file)
                                @if ($file->extension == 'pdf')
                                    <iframe src="{{ asset('storage/' . $file->url) }}" frameborder="0"
                                        style="width:100%;height:600px;"></iframe>
                                @else
                                    <img src="{{ asset('storage/' . $file->url) }}" alt="" style="width:100%;">
                                @endif
                                <hr>
                            @endforeach
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    @endif

    @push('script')
        <script>
            const myCarousel = document.querySelector('#myCarousel');
            const carousel = new bootstrap.Carousel(myCarousel, {
                interval: 2000,
                wrap: false,
                loop: true
            });
        </script>
        <script>
            let items = document.querySelectorAll('#galleryCarousel .carousel-item')
            items.forEach((el) => {
                const minPerSlide = 4
                let next = el.nextElementSibling
                for (var i = 1; i < minPerSlide; i++) {
                    if (!next) {
                        // wrap carousel by using first child
                        next = items[0]
                    }
                    let cloneChild = next.cloneNode(true)
                    el.appendChild(cloneChild.children[0])
                    next = next.nextElementSibling
                }
            })
        </script>
        <script>
            $(document).ready(function() {
                $("#noticeModal").modal("show");
                setTimeout(function() {
                    $('#noticeModal').modal('hide');
                }, 10000);
            });
        </script>
    @endpush
@endsection
