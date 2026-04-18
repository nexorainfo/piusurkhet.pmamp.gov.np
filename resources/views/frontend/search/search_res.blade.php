@extends('layouts.master')
@section('content')
    <div class="container my-5">
        <div class="title">
            <h4 class="category-title">
                खोजिएको शीर्षक : {{ $keyword }}
            </h4>
        </div>

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
                        @foreach ($documents as $document)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @if (request()->language == 'en')
                                    <td>{{ $document->title_en ?? '' }} </td>
                                @else
                                    <td>{{ $document->title ?? '' }} </td>
                                @endif
                                <td>
                                    {{ $document->published_date ?? '' }}
                                </td>
                                <td>
                                    <a href="{{ route('documentDetail', [$document->slug, 'language' => $language]) }}"
                                        class="btn btn-sm">
                                        <i class="fa fa-eye"></i>
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
