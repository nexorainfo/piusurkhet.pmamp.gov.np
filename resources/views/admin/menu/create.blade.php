@extends('layouts.app')
@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Menu</h2>
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
                                <a href="{{route('admin.menu.index')}}">
                                    Menu List
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add New Menu
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
        <form action="{{route('admin.menu.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="title">शीर्षक</label>
                        <input type="text" id="title" name="title"
                               placeholder="शीर्षक" value="{{old('title')}}">
                        @error('title')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                @if(config('default.dual_language'))
                    <div class="col-md-6">
                        <div class="input-style-1">
                            <label for="title_en">शीर्षक English</label>
                            <input type="text" id="title_en" name="title_en"
                                   placeholder="शीर्षक English" value="{{old('title_en')}}">
                            @error('title_en')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="input-style-1">
                        Slug For Static Menus: @foreach(config('fixMenus') as $fixMenu) {{$fixMenu}} , @endforeach
                        <label for="slug">Slug</label>
                        <input type="search" id="slug" name="slug" list="slug"
                               placeholder="Slug" value="{{old('slug')}}" autocomplete="off">
                        @error('slug')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <div class="select-position">
                            <label for="menu_id">Parent Menu</label>
                            <select name="menu_id" id="menu_id" class="form-control">
                                <option value="">- - छान्नुहोस् - -</option>
                                @foreach($mainMenus as $mainMenu)
                                    <option value="{{$mainMenu->id}}">{{$mainMenu->title}}</option>
                                    @foreach ($mainMenu->menus as $menu )
                                    <option value="{{$menu->id}}">-- {{$menu->title}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        @error('menu_id')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-style-1">
                        <label for="position">Position</label>
                        <input type="number" id="position" name="position" value="{{old('position')}}" placeholder="Position">
                        @error('position')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                @livewire('check-menu-type')

                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
