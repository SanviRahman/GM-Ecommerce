<div class="tile">
    <form action="{{ url('admin/setting?tab=collections') }}" method="POST">
        @csrf
        <h3 class="tile-title">Shop by Collection</h3>
        <p class="text-muted">Home hero-এর নিচে আলাদা responsive slider. Disable করলে আগের Category Slider থাকবে।</p>
        <div class="form-group">
            <label>Enable Collection Section</label>
            <select name="lk_collection_enabled" class="form-control">
                <option value="0" {{ Settings::get('lk_collection_enabled') !== '1' ? 'selected' : '' }}>Off</option>
                <option value="1" {{ Settings::get('lk_collection_enabled') === '1' ? 'selected' : '' }}>On</option>
            </select>
        </div>
        <div class="form-group"><label>Eyebrow Text</label>
            <input class="form-control" name="lk_collection_eyebrow" maxlength="100" value="{{ Settings::get('lk_collection_eyebrow') ?: 'THE LEATHERKET EDIT' }}">
        </div>
        <div class="form-group"><label>Section Heading</label>
            <input class="form-control" name="lk_collection_heading" maxlength="150" value="{{ Settings::get('lk_collection_heading') ?: 'Shop by Collection' }}">
        </div>
        <div class="form-group"><label>Short Subtitle</label>
            <textarea class="form-control" name="lk_collection_subtitle" rows="2" maxlength="500">{{ Settings::get('lk_collection_subtitle') }}</textarea>
        </div>
        <div class="form-group"><label>Description Heading (below slider)</label>
            <input class="form-control" name="lk_collection_description_heading" maxlength="160" value="{{ Settings::get('lk_collection_description_heading') }}">
        </div>
        <div class="form-group"><label>Description Text (below slider)</label>
            <textarea class="form-control" name="lk_collection_description" rows="4" maxlength="1500">{{ Settings::get('lk_collection_description') }}</textarea>
        </div>
        <p class="text-muted">একাধিক Category Select করলে তাদের Category Image দিয়ে Cards তৈরি হবে। Image পরিবর্তন: Admin → Categories.</p>
        @php $selectedCollectionIds = array_filter(explode(',', (string) Settings::get('lk_collection_category_ids'))); @endphp
        <div class="form-group"><label>Collections (Ctrl/Command ধরে multiple select)</label>
            <select class="form-control" name="lk_collection_categories[]" multiple size="9">
                @foreach(\App\Category::orderBy('categoryName')->get() as $category)
                    <option value="{{ $category->id }}" {{ in_array((string) $category->id, $selectedCollectionIds, true) ? 'selected' : '' }}>{{ $category->categoryName }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Collection Settings</button>
    </form>
</div>
