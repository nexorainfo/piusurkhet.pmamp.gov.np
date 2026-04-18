@foreach ($categories->skip(1)->take(2) as $category)
<div class="col-md-6">
    <div class="title">
        <h4 class="category-title">
            @if (request()->language == 'en')
                {{ $category->title_en }}
            @else
                {{ $category->title }}
            @endif
        </h4>
    </div>
    <ul class="nav nav-tabs" role="tablist">
        @foreach ($category->documentCategories as $subcategory)
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                    href="{{ \Illuminate\Support\Str::slug($subcategory->title, '-') }}-tab"
                    id="{{ \Illuminate\Support\Str::slug($subcategory->title, '-') }}-tab" data-bs-toggle="tab"
                    data-bs-target="#{{ \Illuminate\Support\Str::slug($subcategory->title, '-') }}" type="button"
                    role="tab" aria-controls="{{ \Illuminate\Support\Str::slug($subcategory->title, '-') }}"
                    @if ($loop->first) aria-selected="true" @endif>
                    @if (request()->language == 'en')
                        {{ $subcategory->title_en }}
                    @else
                        {{ $subcategory->title }}
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content mt-2">
        @foreach ($category->documentCategories as $subcategoryData)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                id="{{ \Illuminate\Support\Str::slug($subcategoryData->title, '-') }}"
                role="tabpanel"
                aria-labelledby="{{ \Illuminate\Support\Str::slug($subcategoryData->title, '-') }}-tab">
                <div class="card-group w-100">
                    @foreach ($subcategoryData->documents->take(3) as $document)
                        <div
                            class="card-detail d-flex justify-content-between gap-3 align-items-center border rounded">
                            <div class="d-flex gap-3 align-items-center card-info">
                                <i class="fa fa-file-pdf-o file"></i>
                                <div>
                                    <h3 class="doc-card-title mb-0">
                                        <a
                                            href="{{ route('documentDetail', [$document->slug, 'language' => $language]) }}">

                                            @if (request()->language == 'en')
                                                {{ $document->title_en }}
                                            @else
                                                {{ $document->title }}
                                            @endif
                                        </a>
                                    </h3>
                                    <small>
                                        <i class="fa fa-clock-o"></i>
                                        @if (request()->language == 'en')
                                            {{ $document->published_date }}
                                        @else
                                            {{ $document->published_date }}
                                        @endif
                                    </small>
                                </div>

                            </div>

                            <div class="d-none d-sm-block">
                                <a href={{ route('documentDetail', [$document->slug, 'language' => $language]) }}
                                    class="btn-download">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>
                <div class="mt-3">
                    <a href="{{ route('documentCategory', [$subcategoryData->slug, 'language' => $language]) }}"
                        class="more-link">
                        {{ __('View More') }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endforeach
