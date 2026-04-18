@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Frequently Asked Question</h2>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">ड्यासबोर्ड</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.faq.index')}}">
                                    Faq List
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Update Frequently Asked Question
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <div class="card-style mb-30">
        <form action="{{route('admin.faq.update',$faq)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-12">
                    <div class="input-style-1">
                        <label for="question">Question</label>
                        <input type="text" id="question" name="question"
                               placeholder="Question" value="{{old('question',$faq->question)}}">
                        @error('question')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-style-1">
                        <label for="answer">Answer</label>
                        <textarea name="answer" id="answer" cols="30" rows="6" placeholder="Answer">{{old('answer',$faq->answer)}}</textarea>
                        @error('answer')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>

                @if(config('default.dual_language'))
                    <div class="col-md-12">
                        <div class="input-style-1">
                            <label for="question_en">Question English</label>
                            <input type="text" id="question_en" name="question_en"
                                   placeholder="Question English" value="{{old('question_en',$faq->question_en)}}">
                            @error('question_en')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                @endif

                @if(config('default.dual_language'))
                    <div class="col-md-12">
                        <div class="input-style-1">
                            <label for="answer_en">Answer English</label>
                            <textarea name="answer_en" id="answer_en" cols="30" rows="6" placeholder="Answer English">{{old('answer_en',$faq->answer_en)}}</textarea>
                            @error('answer_en')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
