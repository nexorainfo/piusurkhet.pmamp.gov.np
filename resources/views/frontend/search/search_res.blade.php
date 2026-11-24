@extends('layouts.master')
@section('content')
    <div class="container my-5">
        <div class="title">
            <h4 class="category-title">
                {{ __('Search results for') }}: {{ $keyword }}
            </h4>
        </div>

        <div class="doc-toolbar mt-3">
            <p class="doc-toolbar__count mb-0">
                {{ __('Total') }}: <strong>{{ \App\Support\NepaliNumber::localize($documents->total()) }}</strong>
            </p>
            <form action="{{ route('frontend.search') }}" method="get" class="doc-toolbar__search" role="search">
                <input type="hidden" name="language" value="{{ $language }}">
                <input type="search" name="keyword" value="{{ $keyword }}" required
                    placeholder="{{ __('Search...') }}" aria-label="{{ __('Search') }}">
                <button type="submit" aria-label="{{ __('Search') }}"><i class="fa fa-search"></i></button>
            </form>
        </div>

        @include('frontend.document.partials.table', ['documents' => $documents, 'showCategory' => true])
    </div>
@endsection
