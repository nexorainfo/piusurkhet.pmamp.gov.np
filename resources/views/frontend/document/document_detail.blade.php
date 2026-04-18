@extends('layouts.master')
@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb-overlay-text text-center">
                <div class="breadcrumb-title mt-2">
                    <h1>
                        @if (request()->language == 'en')
                            {{ $document->mainDocumentCategory->title_en ?? '' }}
                        @else
                            {{ $document->mainDocumentCategory->title ?? '' }}
                        @endif

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
                            @if (request()->language == 'en')
                                {{ $document->mainDocumentCategory->title_en ?? '' }}
                            @else
                                {{ $document->mainDocumentCategory->title ?? '' }}
                            @endif

                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <h1 class="doc-title text-center mb-0 mt-4">
                @if (request()->language == 'en')
                    {{ $document->title_en }}
                @else
                    {{ $document->title }}
                @endif
            </h1>
            <div class="">

                <div class="mt-2">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="meta-group">
                                <div class="date ps-0">
                                    <p class="mb-0">
                                        <i class="fa fa-clock-o"></i>
                                        २१ माघ, २०८१
                                    </p>
                                </div>
                                <div class="share d-flex gap-2">
                                    @php
                                        $shareUrl = urlencode(request()->fullUrl());
                                        $shareText =
                                            request()->language == 'en'
                                                ? urlencode($document->title_en)
                                                : urlencode($document->title);
                                    @endphp

                                    <!-- Facebook -->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"
                                        target="_blank"
                                        class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 30px; height: 30px;">
                                        <i class="fa fa-facebook"></i>
                                    </a>

                                    <!-- Twitter/X -->
                                    <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}"
                                        target="_blank"
                                        class="btn btn-info rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 30px; height: 30px;">
                                        <i class="fa fa-twitter"></i>
                                    </a>

                                    <!-- WhatsApp -->
                                    <a href="https://api.whatsapp.com/send?text={{ $shareText }}%20{{ $shareUrl }}"
                                        target="_blank"
                                        class="btn btn-success rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 30px; height: 30px;">
                                        <i class="fa fa-whatsapp"></i>
                                    </a>
                                </div>

                            </div>
                            <div class="mt-3">
                                @foreach ($document->files as $file)
                                    @if (in_array($file->extension, ['jpg', 'jpeg', 'png']))
                                        <img src="{{ asset('storage/' . $file->url) }}" alt="Image"
                                            style="width: 100%;height: auto">
                                    @elseif($file->extension == 'pdf')
                                        <iframe src="{{ asset('storage/' . $file->url) }}" height="600px"
                                            width="100%"></iframe>
                                    @else
                                        <a href="{{ asset('storage/' . $file->url) }}"
                                            download="{{ asset('storage/' . $file->url) }}">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                            <div class="p-1 mt-2">
                                @if (request()->language == 'en')
                                    <p> {!! $document->description_en !!}</p>
                                @else
                                    <p> {!! $document->description !!}</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <div class="title">
                                <h4 class="category-title">
                                    {{ __('Related') }} @if (request()->language == 'en')
                                        {{ $document->mainDocumentCategory->title_en ?? '' }}
                                    @else
                                        {{ $document->mainDocumentCategory->title ?? '' }}
                                    @endif
                                </h4>
                            </div>
                            <div class="">
                                @forelse($relatedDocuments as $relatedDocument)
                                    <div class="border mb-2">
                                        <a
                                            href="{{ route('documentDetail', [$relatedDocument->slug, 'language' => $language]) }}">
                                            @if (request()->language == 'en')
                                                <h6>{{ $relatedDocument->title_en }}</h6>
                                            @else
                                                <h6>{{ $relatedDocument->title }}</h6>
                                            @endif
                                            <p class="mt-2 mb-0"><i
                                                    class="fa fa-clock-o"></i>{{ $relatedDocument->published_date }}</p>
                                        </a>
                                    </div>

                                @empty
                                    <h6>No Data !!</h6>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
