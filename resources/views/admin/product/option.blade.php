@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    
                    <h4 class="card-title mt-0 d-inline">Product Option Wise Price Variation </h4>
                    <a href="{{url('admin/product')}}" class="btn btn-info btn-sm">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.update-option-price', $product->id) }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="proOption" class="form-label">Options</label>
                            <select class="form-control select2" name="proOption[]" id="proOption" multiple="multiple" onchange="handleOptionChange()">
                                @foreach ($options as $option)
                                    <option value="{{ $option->id }}" 
                                        @if($product->options->contains($option->id)) selected @endif>
                                        {{ $option->optionName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="optionPrices">
                            @foreach ($product->options as $selectedOption)
                            
                                <div class="form-group mb-3" id="option_{{ $selectedOption->id }}">
                                    <label for="price_{{ $selectedOption->option_id }}" class="form-label">{{ $selectedOption->optionName }} Price</label>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        name="optionPrices[{{ $selectedOption->id }}]" 
                                        id="price_{{ $selectedOption->id }}" 
                                        step="any" required 
                                        placeholder="Enter price for {{ $selectedOption->optionName }}" 
                                        value="{{ $selectedOption->pivot->price }}">
                                </div>
                            @endforeach
                        </div>
                        
                        <button type="submit" class="btn btn-success mt-3">Update Price</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
@endsection
@push('js')
    <script>
    function handleOptionChange() {
        const selectElement = document.getElementById('proOption');
        const selectedOptions = Array.from(selectElement.selectedOptions).map(opt => ({
            id: opt.value,
            name: opt.text,
        }));
    
        const container = document.getElementById('optionPrices');
    
        // Track existing fields and their prices
        const existingFields = Array.from(container.children).map(div => {
            const optionId = div.id.replace('option_', '');
            const priceInput = div.querySelector('input');
            return { id: optionId, price: priceInput ? priceInput.value : null };
        });
        
        console.log(existingFields);
        console.log(selectedOptions);
    
        // Add new fields for newly selected options
        selectedOptions.forEach(option => {
            // Check if the option is already selected and add its price input field if it's not there
            if (!existingFields.some(field => field.id === option.id)) {
                const inputGroup = `
                    <div class="form-group mb-3" id="option_${option.id}">
                        <label for="price_${option.id}" class="form-label">${option.name} Price *</label>
                        <input 
                            type="number" 
                            class="form-control" 
                            name="optionPrices[${option.id}]"
                            value="${option.price}" 
                            id="price_${option.id}" 
                            step="any" 
                            required
                            placeholder="Enter price for ${option.name}">
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', inputGroup);
            }
        });
    
        // Remove fields for unselected options and keep prices for the selected ones
        existingFields.forEach(field => {
            if (!selectedOptions.find(opt => opt.id === field.id)) {
                const fieldToRemove = document.getElementById(`option_${field.id}`);
                if (fieldToRemove) {
                    fieldToRemove.remove();
                }
            }
        });
    
        // Reapply the prices for the selected options
        selectedOptions.forEach(option => {
            const existingField = existingFields.find(field => field.id === option.id);
            if (existingField) {
                const priceInput = document.getElementById(`price_${option.id}`);
                if (priceInput && existingField.price) {
                    priceInput.value = existingField.price;
                }
            }
        });
    }



      document.addEventListener('DOMContentLoaded', function() {
        // Initialize Select2 on the select element
        $('.select2').select2({
            placeholder: 'Select Options',
            allowClear: true
        });
        
      });
    </script>
@endpush
