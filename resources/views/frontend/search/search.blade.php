<form id="search_this" action="{{ route('frontend.search', ['language' => app()->getLocale()]) }}"
    class="d-none d-sm-block" method="get">
    <div class="search-group">
        <div class="search-input">
            <input type="search" name="keyword" placeholder="खोज्नुहोस्..." autocomplete="off" required>
            <button type="submit" class="search-btn">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</form>
