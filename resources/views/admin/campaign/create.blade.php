@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="page-title">Add New Campaign</h4>
                    <form action="{{ route('admin.campaign.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Name Field -->
                        <div class="form-group">
                            <label for="name">Campaign Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Banner Title Field -->
                        <div class="form-group">
                            <label for="banner_title">Banner Title <span class="text-danger">*</span></label>
                            <input type="text" name="banner_title" id="banner_title" class="form-control @error('banner_title') is-invalid @enderror" value="{{ old('banner_title') }}" required>
                            @error('banner_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Video Field -->
                        <div class="form-group">
                            <label for="video">Video URL</label>
                            <input type="url" name="video" id="video" class="form-control @error('video') is-invalid @enderror" value="{{ old('video') }}">
                            @error('video')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campaign Contact Fields -->
                        <div class="form-group">
                            <label for="phone_number">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" placeholder="e.g. 01911456811" required>
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="whatsapp_number">WhatsApp Number <span class="text-danger">*</span></label>
                            <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control @error('whatsapp_number') is-invalid @enderror" value="{{ old('whatsapp_number') }}" placeholder="e.g. 8801911456811" required>
                            <small class="form-text text-muted">For WhatsApp you may use 01XXXXXXXXX, +8801XXXXXXXXX or 8801XXXXXXXXX.</small>
                            @error('whatsapp_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Banner Image Field -->
                        <div class="form-group">
                            <label for="banner">Banner Image <span class="text-danger">*</span></label>
                            <input type="file" name="banner" id="banner" class="form-control-file @error('banner') is-invalid @enderror" required>
                            @error('banner')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Slug Field -->
                        <div class="form-group">
                            <label for="slug">Slug <span class="text-danger">*</span></label>
                            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" required>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Short Description Field -->
                        <div class="form-group">
                            <label for="short_description">Short Description <span class="text-danger">*</span></label>
                            <textarea name="short_description" id="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="3" required>{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description Field -->
                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    

                        <!-- Ordered Multiple Product Field -->
                        <div class="form-group">
                            <label for="product_ids">Products <span class="text-danger">*</span></label>
                            <select name="product_ids[]" id="product_ids" class="form-control select2-campaign-products @error('product_ids') is-invalid @enderror @error('product_ids.*') is-invalid @enderror" multiple required data-placeholder="Select Products" style="width: 100%;">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ in_array((int) $product->id, $selectedProductIds ?? [], true) ? 'selected' : '' }}>
                                        {{ $product->productName }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="product_order" id="product_order" value="{{ old('product_order', implode(',', $selectedProductIds ?? [])) }}">
                            <small class="form-text text-muted">Select products in the order you want them to appear. First selected = Product 1, second selected = Product 2, and so on.</small>
                            <div id="selected-product-order" class="mt-2"></div>
                            @error('product_ids')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            @error('product_ids.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image One Field -->
                        <div class="form-group">
                            <label for="image_one">Image One <span class="text-danger">*</span></label>
                            <input type="file" name="image_one" id="image_one" class="form-control-file @error('image_one') is-invalid @enderror" required>
                            @error('image_one')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Two Field -->
                        <div class="form-group">
                            <label for="image_two">Image Two</label>
                            <input type="file" name="image_two" id="image_two" class="form-control-file @error('image_two') is-invalid @enderror">
                            @error('image_two')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Three Field -->
                        <div class="form-group">
                            <label for="image_three">Image Three</label>
                            <input type="file" name="image_three" id="image_three" class="form-control-file @error('image_three') is-invalid @enderror">
                            @error('image_three')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    

                        <!-- Submit Button -->
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Save Campaign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        var selectedOrder = ($('#product_order').val() || '').split(',').filter(function (id) {
            return id !== '';
        }).map(String);
        var $productSelect = $('#product_ids');

        // Render the existing selected products as a real dropdown with searchable
        // multi-select tags. closeOnSelect=false lets the admin click products one
        // after another without reopening the dropdown each time.
        if ($.fn.select2) {
            $productSelect.select2({
                width: '100%',
                placeholder: 'Select Products',
                closeOnSelect: false,
                allowClear: false
            });
        }

        function selectedIdsFromSelect() {
            return ($productSelect.val() || []).map(String);
        }

        function syncHiddenOrder() {
            var current = selectedIdsFromSelect();

            // Remove products that are no longer selected.
            selectedOrder = selectedOrder.filter(function (id) {
                return current.indexOf(String(id)) !== -1;
            });

            // Fallback for normal <select> interaction or restored old input.
            current.forEach(function (id) {
                if (selectedOrder.indexOf(id) === -1) {
                    selectedOrder.push(id);
                }
            });

            $('#product_order').val(selectedOrder.join(','));
            renderOrder();
        }

        function renderOrder() {
            var html = '';

            selectedOrder.forEach(function (id, index) {
                var text = $productSelect.find('option[value="' + id + '"]').text().trim();
                if (text) {
                    html += '<span class="badge badge-primary mr-1 mb-1">'
                        + (index + 1) + '. ' + $('<div>').text(text).html() + '</span>';
                }
            });

            $('#selected-product-order').html(html);
        }

        // Select2 events preserve the exact order the admin clicks products.
        $productSelect.on('select2:select', function (event) {
            var id = String(event.params.data.id);
            if (selectedOrder.indexOf(id) === -1) {
                selectedOrder.push(id);
            }
            syncHiddenOrder();
        });

        $productSelect.on('select2:unselect', function (event) {
            var id = String(event.params.data.id);
            selectedOrder = selectedOrder.filter(function (selectedId) {
                return selectedId !== id;
            });
            syncHiddenOrder();
        });

        // Keeps the feature working even if Select2 is unavailable for any reason.
        $productSelect.on('change', syncHiddenOrder);
        syncHiddenOrder();
    });
</script>
@endpush
