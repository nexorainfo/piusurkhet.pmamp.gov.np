{{--
    Document list used by category pages and search results.
    $documents    - paginator of Document models (with files + documentCategory loaded)
    $showCategory - also show each document's sub-category under its title
--}}
@php
    use App\Support\NepaliNumber;

    $isEnglish = app()->getLocale() === 'en';
    $showCategory = $showCategory ?? false;
@endphp

<div class="doc-list">
    <div class="table-responsive">
        <table class="table doc-list__table align-middle mb-0">
            <thead>
                <tr>
                    <th class="doc-list__sn">{{ __('S.N') }}</th>
                    <th>{{ __('Title') }}</th>
                    <th class="doc-list__date">{{ __('Published Date') }}</th>
                    <th class="doc-list__files">{{ __('Files') }}</th>
                    <th class="doc-list__action"><span class="visually-hidden">{{ __('View Details') }}</span></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($documents as $document)
                    @php
                        $title = $isEnglish && $document->title_en ? $document->title_en : $document->title;
                        $publisher = $isEnglish && $document->publisher_en ? $document->publisher_en : $document->publisher;
                        $category = $document->documentCategory
                            ?? ($document->relationLoaded('mainDocumentCategory') ? $document->mainDocumentCategory : null);
                        $detailUrl = route('documentDetail', [$document->slug, 'language' => $language]);
                    @endphp
                    <tr>
                        <td class="doc-list__sn">{{ NepaliNumber::localize($documents->firstItem() + $loop->index) }}</td>
                        <td class="doc-list__title">
                            <a href="{{ $detailUrl }}">{{ $title }}</a>
                            @if ($document->mark_as_new)
                                <span class="doc-list__badge">{{ __('New') }}</span>
                            @endif
                            @if (($showCategory && $category) || $publisher)
                                <div class="doc-list__meta">
                                    @if ($showCategory && $category)
                                        <span><i class="fa fa-folder-o"></i>
                                            {{ $isEnglish && $category->title_en ? $category->title_en : $category->title }}</span>
                                    @endif
                                    @if ($publisher)
                                        <span><i class="fa fa-building-o"></i> {{ $publisher }}</span>
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td class="doc-list__date">
                            <i class="fa fa-calendar-o"></i> {{ $document->published_date_padded }}
                        </td>
                        <td class="doc-list__files">
                            @forelse ($document->files as $file)
                                <a href="{{ $file->public_url }}" target="_blank" rel="noopener"
                                    class="doc-list__file doc-list__file--{{ strtolower($file->extension) }}"
                                    title="{{ $file->display_name }}">
                                    <i class="fa {{ $file->icon }}"></i>
                                    <span>{{ strtoupper($file->extension) }}</span>
                                </a>
                            @empty
                                <span class="text-muted">-</span>
                            @endforelse
                        </td>
                        <td class="doc-list__action">
                            <a href="{{ $detailUrl }}" class="doc-list__view">
                                {{ __('View') }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">{{ __('No documents found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if ($documents->hasPages())
    <div class="doc-pagination mt-3">
        {{ $documents->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
@endif
