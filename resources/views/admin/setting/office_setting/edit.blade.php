@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>कार्यालय सेटिंग</h2>
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
                                कार्यालय सेटिंग
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <form action="{{route('admin.officeSettingHeader.update',$officeSettingHeader)}}" method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="input-style-1">
                    <label for="english">English*</label>
                    <input type="text" id="english" name="english"
                           placeholder="English" value="{{old('english',$officeSettingHeader->english)}}">
                    @error("english")
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-style-1">
                    <label for="nepali">नाम *</label>
                    <input type="text" id="nepali" name="nepali"
                           placeholder="Nepali" value="{{old('nepali',$officeSettingHeader->nepali)}}">
                    @error("nepali")
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-style-1">
                    <label for="font_color">Font Color *</label>
                    <input type="color" id="font_color"
                           name="font_color"
                           placeholder="Font Color" value="{{old('font_color',$officeSettingHeader->font_color)}}"
                    >
                    @error("font_color")
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-style-1">
                    <label for="font_size">Font Size *</label>
                    <input type="text" id="font_size"
                           name="font_size"
                           placeholder="Font Size" value="{{old('font_size',$officeSettingHeader->font_size)}}">
                    @error("font_size")
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <div class="input-style-1">
                    <label for="font_family">Font Family *</label>
                    <input type="text" id="font_family"
                           name="font_family"
                           placeholder="Font Family" value="{{old('font_family',$officeSettingHeader->font_family)}}"
                    >
                    @error("font_family")
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-style-1">
                    <label for="font">Font *</label>
                    <input type="text" id="font"
                           name="font"
                           placeholder="Font" value="{{old('font',$officeSettingHeader->font)}}"
                    >
                    @error("font")
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-style-1">
                    <label for="position">Position *</label>
                    <input type="text" id="position"
                           name="position"
                           placeholder="Position" value="{{old('position',$officeSettingHeader->position)}}"
                    >
                    @error("position")
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-sm btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </form>

@endsection
