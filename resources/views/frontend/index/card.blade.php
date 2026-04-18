<div class="row">
    @foreach ($categories as $category)
        <div class="col-lg-6 mt-2">
            <div class="card-01">
                <h6 class="heading-line mb-3">
                    @if (request()->language == 'en')
                        {{ $category->title_en }}
                    @else
                        {{ $category->title }}
                    @endif
                </h6>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach ($category->documentCategories as $subcategory)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                id="{{ \Illuminate\Support\Str::slug($subcategory->title, '-') }}-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#{{ \Illuminate\Support\Str::slug($subcategory->title, '-') }}"
                                type="button" role="tab"
                                aria-controls="{{ \Illuminate\Support\Str::slug($subcategory->title, '-') }}"
                                @if ($loop->first) aria-selected="true" @endif>
                                @if (request()->language == 'en')
                                    {{ $subcategory->title_en }}
                                @else
                                    {{ $subcategory->title }}
                                @endif
                            </button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content card-content" id="myTabContent">
                    @forelse($category->documentCategories as $subcategoryData)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                            id="{{ \Illuminate\Support\Str::slug($subcategoryData->title, '-') }}" role="tabpanel"
                            aria-labelledby="{{ \Illuminate\Support\Str::slug($subcategoryData->title, '-') }}-tab">
                            <div class="tab-content">
                                @foreach ($subcategoryData->documents->take(3) as $document)
                                    <a href="{{ route('documentDetail', [$document->slug, 'language' => $language]) }}"
                                        class="card-01 mb-2 border">
                                        <h6 class="heading">
                                            @if (request()->language == 'en')
                                                {{ $document->title_en }}
                                            @else
                                                {{ $document->title }}
                                            @endif
                                        </h6>
                                        <p class="mt-2">
                                            @if (request()->language == 'en')
                                                {{ $document->published_date }} | {{ $document->publisher_en }}
                                            @else
                                                {{ $document->published_date }} | {{ $document->publisher }}
                                            @endif
                                        </p>
                                    </a>
                                @endforeach
                            </div>
                            <div class="text-right">
                                <a href="{{ route('documentCategory', [$subcategoryData->slug, 'language' => $language]) }}"
                                    class="btn btn-danger btn-sm">
                                    {{ __('View More') }}
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="tab-content">
                            @foreach ($category->mainDocuments->take(3) as $document)
                                <a href="{{ route('documentDetail', [$document->slug, 'language' => $language]) }}"
                                    class="card-01 mb-2 border">
                                    @if (request()->language == 'en')
                                        <h6 class="heading">{{ $document->title_en }}</h6>
                                        <p class="mt-2">{{ $document->published_date }} |
                                            {{ $document->publisher_en }}</p>
                                    @else
                                        <h6 class="heading">{{ $document->title }}</h6>
                                        <p class="mt-2">{{ $document->published_date }} |
                                            {{ $document->publisher }}</p>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                        <div class="text-right">
                            <a href="{{ route('documentCategory', [$category->slug, 'language' => $language]) }}"
                                class="btn btn-danger btn-sm">
                                {{ __('View More') }}
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @endforeach
</div>
