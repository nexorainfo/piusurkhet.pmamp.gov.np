@extends('layouts.master')
@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb-overlay-text text-center">
                <div class="breadcrumb-title mt-2">
                    <h1>
                        {{ __('Employee details') }}
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
                            {{ __('Employee details') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <div class="container mt-2">
        <div class="document-table my-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>नाम</th>
                            <th>पद</th>
                            <th>विभाग</th>
                            <th>फोन</th>
                            <th>इमेल</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>
                                    <div class="emp-wrapper">
                                        <img class="rounded" src="{{ $employee->photo ?? '' }}" height="120"
                                            weight="120" alt="{{ $employee->name ?? '' }}">
                                        @if (request()->language == 'en')
                                            <div class="mb-0">{{ $employee->name_en ?? '' }}</div>
                                        @else
                                            <div class="mb-0">{{ $employee->name ?? '' }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if (request()->language == 'en')
                                        <div>{{ $employee->designation->title_en ?? '' }}</div>
                                    @else
                                        <div>{{ $employee->designation->title ?? '' }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if (request()->language == 'en')
                                        <div>{{ $employee->department->title_en ?? '' }}</div>
                                    @else
                                        <div>{{ $employee->department->title ?? '' }}</div>
                                    @endif

                                </td>
                                <td>
                                    <a href="telto:{{ $employee->phone ?? '' }}">{{ $employee->phone ?? '' }}</a>
                                </td>
                                <td>
                                    <a href="mailto:{{ $employee->email ?? '' }}">{{ $employee->email ?? '' }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
