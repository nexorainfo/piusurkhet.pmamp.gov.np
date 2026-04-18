@extends('layouts.master')
@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb-overlay-text text-center">
                <div class="breadcrumb-title mt-2">
                    <h1>
                        {{ __('Bill Publicity') }}
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
                            {{ __('Bill Publicity') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <div class="container my-5">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>

                    <tr>
                        <th>{{ __('S.N') }}</th>
                        <th>{{ __('Budget No.') }}</th>
                        <th>{{ __('Expenditure heading') }}</th>
                        <th>{{ __('Procurement process') }}</th>
                        <th>{{ __('Page No.') }}</th>
                        <th>{{ __('Bill Date') }}</th>
                        <th>{{ __('Receipt date') }}</th>
                        <th>{{ __('Cost') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Remarks') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bills as $bill)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bill->budget_no }}</td>
                            @if (request()->language == 'en')
                                <td>{{ $bill->expense_head_en }}</td>
                                <td>{{ $bill->buying_process_en }}</td>
                            @else
                                <td>{{ $bill->expense_head }}</td>
                                <td>{{ $bill->buying_process }}</td>
                            @endif
                            <td>{{ $bill->pan_no }}</td>
                            <td>{{ $bill->bill_date ? $bill->bill_date->toDateString() : '' }}</td>
                            <td>{{ $bill->receipt_date ? $bill->receipt_date->toDateString() : '' }}</td>
                            <td>रु. {{ $bill->amount }}</td>
                            @if (request()->language == 'en')
                                <td>{{ $bill->description_en }}</td>
                                <td>{{ $bill->remarks_en }}</td>
                            @else
                                <td>{{ $bill->description }}</td>
                                <td>{{ $bill->remarks }}</td>
                            @endif
                            <td>
                                <a href="{{ asset('storage/' . $bill->bill_photo) }}"
                                    download="{{ asset('storage/' . $bill->bill_photo) }}">
                                    <i class="fa fa-download"></i> Bill File
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
