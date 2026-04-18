@extends('layouts.master')
@section('content')
    <section class="breadcrumb-section">
        <div class="container">

            <div class="breadcrumb-overlay-text text-center">
                <div class="breadcrumb-title mt-2">
                    <h1>

                        @if (request()->language == 'en')
                            {{ $officeDetail->title_en }}
                        @else
                            {{ $officeDetail->title }}
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
                                {{ $officeDetail->title_en }}
                            @else
                                {{ $officeDetail->title }}
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="paragh-font-20 my-5" >
            @if (request()->language == 'en')
                {!! $officeDetail->description_en !!}
            @else
                {!! $officeDetail->description !!}
            @endif
        </div>
    </div>
@endsection
