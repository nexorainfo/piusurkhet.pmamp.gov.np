@extends('layouts.master')
@section('content')
    @php
        $isEnglish = app()->getLocale() === 'en';
        $categoryTitle = fn ($category) => $isEnglish && $category->title_en ? $category->title_en : $category->title;
        $isSubCategory = $mainCategory->id !== $documentCategory->id;
        // Sub-categories to switch between: this category's own, or its siblings when viewing one.
        $subCategories = $isSubCategory
            ? $mainCategory->documentCategories()->orderBy('position')->get()
            : $documentCategory->documentCategories;
    @endphp

    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb-overlay-text text-center">
                <div class="breadcrumb-title mt-2">
                    <h1>{{ $categoryTitle($documentCategory) }}</h1>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('welcome', ['language' => $language]) }}">{{ __('Home') }}</a>
                        </li>
                        @if ($isSubCategory)
                            <li class="breadcrumb-item">
                                <a href="{{ route('documentCategory', [$mainCategory->slug, 'language' => $language]) }}">
                                    {{ $categoryTitle($mainCategory) }}
                                </a>
                            </li>
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">{{ $categoryTitle($documentCategory) }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <div class="container my-4">
        @if ($subCategories->isNotEmpty())
            <nav class="doc-chips" aria-label="{{ __('Category') }}">
                <a href="{{ route('documentCategory', [$mainCategory->slug, 'language' => $language]) }}"
                    class="doc-chip {{ $isSubCategory ? '' : 'is-active' }}">{{ __('All') }}</a>
                @foreach ($subCategories as $subCategory)
                    <a href="{{ route('documentCategory', [$subCategory->slug, 'language' => $language]) }}"
                        class="doc-chip {{ $subCategory->id === $documentCategory->id ? 'is-active' : '' }}">
                        {{ $categoryTitle($subCategory) }}
                    </a>
                @endforeach
            </nav>
        @endif

        <div class="doc-toolbar">
            <p class="doc-toolbar__count mb-0">
                {{ __('Total') }}: <strong>{{ \App\Support\NepaliNumber::localize($documents->total()) }}</strong>
                @if ($keyword !== '')
                    · {{ __('Search') }}: "<strong>{{ $keyword }}</strong>"
                    <a href="{{ route('documentCategory', [$documentCategory->slug, 'language' => $language]) }}">{{ __('Clear') }}</a>
                @endif
            </p>
            <form method="get" class="doc-toolbar__search" role="search">
                <input type="hidden" name="language" value="{{ $language }}">
                <input type="search" name="q" value="{{ $keyword }}"
                    placeholder="{{ __('Search in this category...') }}" aria-label="{{ __('Search') }}">
                <button type="submit" aria-label="{{ __('Search') }}"><i class="fa fa-search"></i></button>
            </form>
        </div>

        @include('frontend.document.partials.table', ['documents' => $documents, 'showCategory' => !$isSubCategory])
    </div>
@endsection
