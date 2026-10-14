@php
    $selectedIds = collect(explode(',', (string) Settings::get('lk_collection_category_ids')))
        ->filter(fn ($id) => ctype_digit((string) $id))->map(fn ($id) => (int) $id)->unique()->values();
    $collectionCategories = $selectedIds->isNotEmpty()
        ? \App\Category::whereIn('id', $selectedIds->all())->get()->sortBy(fn ($category) => $selectedIds->search((int) $category->id))
        : collect();
@endphp
@if(Settings::get('lk_collection_enabled') === '1' && $collectionCategories->isNotEmpty())
<section class="lk-collections" aria-labelledby="lk-collections-heading">
    <div class="lk-collections-inner">
        <header class="lk-collections-heading">
            <small>{{ Settings::get('lk_collection_eyebrow') ?: 'THE LEATHERKET EDIT' }}</small>
            <h2 id="lk-collections-heading">{{ Settings::get('lk_collection_heading') ?: 'Shop by Collection' }}</h2>
            @if(Settings::get('lk_collection_subtitle'))<p>{{ Settings::get('lk_collection_subtitle') }}</p>@endif
        </header>
        {{-- One slide holds four categories. On mobile each slide is a 2x2 grid. --}}
        <div class="lk-collections-track" id="lk-collections-track" tabindex="0"
             role="region" aria-roledescription="carousel" aria-label="Shop by Collection">
            @foreach($collectionCategories->chunk(4) as $collectionPage)
                <div class="lk-collection-page" role="group" aria-label="Collection page {{ $loop->iteration }} of {{ (int) ceil($collectionCategories->count() / 4) }}">
                    @foreach($collectionPage as $category)
                        <a class="lk-collection-item" href="{{ url('/category/'.$category->categorySlug) }}">
                            <div class="lk-collection-image">
                                @if($category->categoryImage)
                                    <img loading="lazy" src="{{ \App\Support\PublicMedia::url('product/thumbnail/'.$category->categoryImage) }}" alt="{{ $category->categoryName }}">
                                @else
                                    <div class="lk-collection-placeholder">{{ $category->categoryName }}</div>
                                @endif
                                <div class="lk-collection-overlay">
                                    <span>EXPLORE COLLECTION</span>
                                    <h3>{{ $category->categoryName }}</h3>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="lk-collections-controls">
            <button class="lk-scroll-button" type="button" data-lk-scroll="prev" aria-controls="lk-collections-track" aria-label="Previous collections">&#8592;</button>
            <button class="lk-scroll-button" type="button" data-lk-scroll="next" aria-controls="lk-collections-track" aria-label="Next collections">&#8594;</button>
        </div>
        @if(Settings::get('lk_collection_description_heading') || Settings::get('lk_collection_description'))
            <div class="lk-collections-description">
                @if(Settings::get('lk_collection_description_heading'))<h3>{{ Settings::get('lk_collection_description_heading') }}</h3>@endif
                @if(Settings::get('lk_collection_description'))<p>{{ Settings::get('lk_collection_description') }}</p>@endif
            </div>
        @endif
    </div>
</section>
@endif
