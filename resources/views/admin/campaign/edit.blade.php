@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="page-title">Edit Campaign</h4>
                    <form action="{{ route('admin.campaign.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Name Field -->
                        <div class="form-group">
                            <label for="name">Campaign Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $campaign->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Banner Title Field -->
                        <div class="form-group">
                            <label for="banner_title">Banner Title <span class="text-danger">*</span></label>
                            <input type="text" name="banner_title" id="banner_title" class="form-control @error('banner_title') is-invalid @enderror" value="{{ old('banner_title', $campaign->banner_title) }}" required>
                            @error('banner_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Video Field -->
                        <div class="form-group">
                            <label for="video">Video ID</label>
                            <input type="text" name="video" id="video" class="form-control @error('video') is-invalid @enderror" value="{{ $campaign->video }}">
                            @error('video')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Banner Image Field -->
                        <div class="form-group">
                            <label for="banner">Banner Image <span class="text-danger">*</span></label>
                            <input type="file" name="banner" id="banner" class="form-control-file @error('banner') is-invalid @enderror">
                            @if($campaign->banner)
                                <img src="{{ asset('public/campaigns/'.$campaign->banner) }}" alt="Banner Image" width="100" class="mt-2">
                            @endif
                            @error('banner')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Slug Field -->
                        <div class="form-group">
                            <label for="slug">Slug <span class="text-danger">*</span></label>
                            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $campaign->slug) }}" required>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Short Description Field -->
                        <div class="form-group">
                            <label for="short_description">Short Description <span class="text-danger">*</span></label>
                            <textarea name="short_description" id="short_description" class="form-control summernote @error('short_description') is-invalid @enderror" rows="3" required>{{ old('short_description', $campaign->short_description) }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description Field -->
                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control summernote @error('description') is-invalid @enderror" rows="5" required>{{ old('description', $campaign->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                      

                        <!-- Product Field -->
                        <div class="form-group">
                            <label for="product_id">Product <span class="text-danger">*</span></label>
                            <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id', $campaign->product_id) == $product->id ? 'selected' : '' }}>
                                        {{ $product->productName }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image One Field -->
                        <div class="form-group">
                            <label for="image_one">Image One <span class="text-danger">*</span></label>
                            <input type="file" name="image_one" id="image_one" class="form-control-file @error('image_one') is-invalid @enderror">
                            @if($campaign->image_one)
                                <img src="{{ asset('public/campaigns/' . $campaign->image_one) }}" alt="Image One" width="100" class="mt-2">
                            @endif
                            @error('image_one')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Two Field -->
                        <div class="form-group">
                            <label for="image_two">Image Two</label>
                            <input type="file" name="image_two" id="image_two" class="form-control-file @error('image_two') is-invalid @enderror">
                            @if($campaign->image_two)
                                <img src="{{ asset('public/campaigns/' . $campaign->image_two) }}" alt="Image Two" width="100" class="mt-2">
                            @endif
                            @error('image_two')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Three Field -->
                        <div class="form-group">
                            <label for="image_three">Image Three</label>
                            <input type="file" name="image_three" id="image_three" class="form-control-file @error('image_three') is-invalid @enderror">
                            @if($campaign->image_three)
                                <img src="{{ asset('public/campaigns/' . $campaign->image_three) }}" alt="Image Three" width="100" class="mt-2">
                            @endif
                            @error('image_three')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Update Campaign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $(".summernote").summernote({height:180,minHeight:null,maxHeight:null,focus:!1});
        });
    </script>
@endpush