@extends('layouts.master')
@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb-overlay-text text-center">
                <div class="breadcrumb-title mt-2">
                    <h1>

                        @if (request()->language == 'en')
                            {{ $documentCategory->title_en }}
                        @else
                            {{ $documentCategory->title }}
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
                                {{ $mainCategory->title_en }}
                            @else
                                {{ $mainCategory->title }}
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="document-table my-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('S.N') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Published Date') }}</th>
                            <th>कार्य</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($documentCategory->documents as $document)
                            <tr>
                                <td class="text-wrap">{{ $loop->iteration }}</td>
                                @if (request()->language == 'en')
                                    <td  class="text-wrap text-left">{{ $document->title_en }}</td>
                                @else
                                    <td  class="text-wrap text-left">{{ $document->title }}</td>
                                @endif
                                <td  class="text-wrap">
                                    {{ $document->published_date }}
                                </td>
                                <td  class="text-wrap">
                                    <a href="{{ route('documentDetail', [$document->slug, 'language' => $language]) }}"
                                        class="btn btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            @foreach ($documentCategory->mainDocuments as $mainDocument)
                                <tr>
                                    <td  class="text-wrap">{{ $loop->iteration }}</td>
                                    @if (request()->language == 'en')
                                        <td  class="text-wrap text-left">{{ $mainDocument->title_en }}</td>
                                    @else
                                        <td  class="text-wrap text-left">{{ $mainDocument->title }}</td>
                                    @endif
                                    <td  class="text-wrap">
                                        {{ $mainDocument->published_date }}
                                    </td>

                                    <td  class="text-wrap">
                                        <a href="{{ route('documentDetail', [$mainDocument->slug, 'language' => $language]) }}"
                                            class="btn btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
