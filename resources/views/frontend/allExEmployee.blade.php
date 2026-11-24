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
                        <x-image :path="$employee->getRawOriginal('photo')" :widths="[160, 320]" sizes="120px"
                            :fallback="asset('assets/backend/images/user_icon.jpg')" :alt="$employee->name ?? ''"
                            class="rounded" width="120" height="120" style="object-fit: cover;" />
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
