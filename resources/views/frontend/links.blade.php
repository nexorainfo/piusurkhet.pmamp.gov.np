@extends('layouts.master')
@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb-overlay-text text-center">
                <div class="breadcrumb-title mt-2">
                    <h1>
                        {{ __('Important Links') }}
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
                            {{ __('Important Links') }}
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
                            <th>{{ __('Office Name') }}</th>
                            <th>{{ __('Links') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($importantLinks as $importantLink)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @if (request()->language == 'en')
                                <td>{{ $importantLink->title_en }}</td>
                            @else
                                <td>{{ $importantLink->title }}</td>
                            @endif
                                <td>
                                    <a href="{{ $importantLink->url }}" target="_blank">
                                      <i class="fa fa-globe"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
