@extends('layouts.master')
@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb-overlay-text text-center">
                <div class="breadcrumb-title mt-2">
                    <h1>
                        {{ __('Ex-Employee') }}
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
                            {{ __('Ex-Employee') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <div class="container mt-2">
        <div class="row">
            @foreach ($exEmployees as $employee)
                <div class="col-md-3">
                    <div class="border">
                        <img class="rounded" src="{{ $employee->photo }}" height="120" width="120"
                            alt="{{ $employee->name ?? '' }}">
                        @if (request()->language == 'en')
                            <p>{{ $employee->name_en ?? '' }}</p>
                            <p>{{ $employee->designation ?? '' }}</p>
                        @else
                            <p>{{ $employee->name ?? '' }}</p>
                            <p>{{ $employee->designation ?? '' }}</p>
                        @endif
                        <p>{{ $employee->phone ?? '' }}</p>
                        <p>{{ $employee->email ?? '' }}</p>
                        <p>{{ $employee->joining_date->todateString() }}देखि {{ $employee->leaving_date->todateString() }}
                            सम्म</p>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
