@extends('layouts.master')
@section('content')
    @php
        use App\Support\NepaliNumber;

        $isEnglish = app()->getLocale() === 'en';
        $pick = fn ($ne, $en) => $isEnglish && $en ? $en : $ne;
        $title = $pick($document->title, $document->title_en);
        $publisher = $pick($document->publisher, $document->publisher_en);
        $description = $pick($document->description, $document->description_en);
        $mainCategory = $document->mainDocumentCategory;
        $subCategory = $document->documentCategory;
        $shareUrl = urlencode(request()->fullUrl());
        $shareText = urlencode($title);
    @endphp

    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb-overlay-text text-center">
                <div class="breadcrumb-title mt-2">
                    <h1>{{ $mainCategory ? $pick($mainCategory->title, $mainCategory->title_en) : '' }}</h1>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('welcome', ['language' => $language]) }}">{{ __('Home') }}</a>
                        </li>
                        @if ($mainCategory)
                            <li class="breadcrumb-item">
                                <a href="{{ route('documentCategory', [$mainCategory->slug, 'language' => $language]) }}">
                                    {{ $pick($mainCategory->title, $mainCategory->title_en) }}
                                </a>
                            </li>
                        @endif
                        @if ($subCategory && $subCategory->id !== $mainCategory?->id)
                            <li class="breadcrumb-item">
                                <a href="{{ route('documentCategory', [$subCategory->slug, 'language' => $language]) }}">
                                    {{ $pick($subCategory->title, $subCategory->title_en) }}
                                </a>
                            </li>
                        @endif
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section>
        <div class="container my-4">
            <div class="row g-4">
                <div class="col-lg-8">
                    <h1 class="doc-title mb-3">
                        {{ $title }}
                        @if ($document->mark_as_new)
                            <span class="doc-list__badge align-middle">{{ __('New') }}</span>
                        @endif
                    </h1>

                    <dl class="doc-facts">
                        <div>
                            <dt><i class="fa fa-calendar-o"></i> {{ __('Published Date') }}</dt>
                            <dd>
                                {{ $document->published_date_long }}
                                <small class="text-muted">({{ $document->published_date_padded }})</small>
                            </dd>
                        </div>
                        @if ($subCategory || $mainCategory)
                            <div>
                                <dt><i class="fa fa-folder-o"></i> {{ __('Category') }}</dt>
                                <dd>{{ $pick(($subCategory ?? $mainCategory)->title, ($subCategory ?? $mainCategory)->title_en) }}</dd>
                            </div>
                        @endif
                        @if ($publisher)
                            <div>
                                <dt><i class="fa fa-building-o"></i> {{ __('Publisher') }}</dt>
                                <dd>{{ $publisher }}</dd>
                            </div>
                        @endif
                        <div>
                            <dt><i class="fa fa-paperclip"></i> {{ __('Files') }}</dt>
                            <dd>{{ NepaliNumber::localize($document->files->count()) }}</dd>
                        </div>
                    </dl>

                    <div class="doc-share">
                        <span>{{ __('Share') }}:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank"
                            rel="noopener" class="doc-share__btn doc-share__btn--facebook" aria-label="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}"
                            target="_blank" rel="noopener" class="doc-share__btn doc-share__btn--twitter"
                            aria-label="X / Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ $shareText }}%20{{ $shareUrl }}" target="_blank"
                            rel="noopener" class="doc-share__btn doc-share__btn--whatsapp" aria-label="WhatsApp">
                            <i class="fa fa-whatsapp"></i>
                        </a>
                        <button type="button" class="doc-share__btn doc-share__btn--copy" data-copy-link
                            aria-label="{{ __('Copy link') }}" title="{{ __('Copy link') }}">
                            <i class="fa fa-link"></i>
                        </button>
                    </div>

                    @if ($document->files->isNotEmpty())
                        <div class="doc-attachments">
                            <h2 class="doc-attachments__title">{{ __('Attachments') }}</h2>
                            <ul class="list-unstyled mb-0">
                                @foreach ($document->files as $file)
                                    <li class="doc-attachment">
                                        <i class="fa {{ $file->icon }} doc-attachment__icon doc-list__file--{{ strtolower($file->extension) }}"></i>
                                        <div class="doc-attachment__info">
                                            <span class="doc-attachment__name">{{ $file->display_name }}</span>
                                            <small class="text-muted">
                                                {{ strtoupper($file->extension) }}
                                                @if ($size = NepaliNumber::fileSize($file->size))
                                                    · {{ $size }}
                                                @endif
                                            </small>
                                        </div>
                                        <div class="doc-attachment__actions">
                                            <a href="{{ $file->public_url }}" target="_blank" rel="noopener"
                                                class="doc-btn doc-btn--outline">{{ __('Open') }}</a>
                                            <a href="{{ $file->public_url }}" download="{{ $file->display_name }}"
                                                class="doc-btn"><i class="fa fa-download"></i> {{ __('Download') }}</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($description)
                        <div class="doc-description">{!! $description !!}</div>
                    @endif

                    @foreach ($document->files as $file)
                        @if ($file->isPdf())
                            <iframe src="{{ $file->public_url }}" class="doc-preview" title="{{ $file->display_name }}"
                                loading="lazy"></iframe>
                        @elseif ($file->isImage())
                            <a href="{{ $file->public_url }}" target="_blank" rel="noopener" class="d-block doc-preview-image">
                                <x-image :path="$file->url" :widths="[640, 960, 1280, 1920]"
                                    sizes="(min-width: 992px) 66vw, 100vw" :eager="$loop->first" :alt="$file->display_name" />
                            </a>
                        @endif
                    @endforeach
                </div>

                <aside class="col-lg-4">
                    <div class="title">
                        <h4 class="category-title">
                            {{ __('Related') }}
                            {{ $mainCategory ? $pick($mainCategory->title, $mainCategory->title_en) : '' }}
                        </h4>
                    </div>
                    @forelse ($relatedDocuments as $relatedDocument)
                        <a href="{{ route('documentDetail', [$relatedDocument->slug, 'language' => $language]) }}"
                            class="doc-related">
                            <span class="doc-related__title">{{ $pick($relatedDocument->title, $relatedDocument->title_en) }}</span>
                            <small><i class="fa fa-calendar-o"></i> {{ $relatedDocument->published_date_padded }}</small>
                        </a>
                    @empty
                        <p class="text-muted">{{ __('No documents found.') }}</p>
                    @endforelse

                    @if ($subCategory ?? $mainCategory)
                        <a href="{{ route('documentCategory', [($subCategory ?? $mainCategory)->slug, 'language' => $language]) }}"
                            class="more-link d-inline-block mt-2">{{ __('View All') }}</a>
                    @endif
                </aside>
            </div>
        </div>
    </section>

    @push('script')
        <script>
            document.querySelectorAll('[data-copy-link]').forEach(function(button) {
                button.addEventListener('click', function() {
                    navigator.clipboard?.writeText(window.location.href).then(function() {
                        button.classList.add('is-copied');
                        setTimeout(() => button.classList.remove('is-copied'), 1500);
                    });
                });
            });
        </script>
    @endpush
@endsection
