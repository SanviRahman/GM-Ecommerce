<div class="form-group">
    <label for="newsletter-email">Subscriber Email <span class="text-danger">*</span></label>
    <input id="newsletter-email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', isset($subscriber) ? $subscriber->email : '') }}"
           required maxlength="254" autocomplete="email" autofocus>
    @error('email')
        <div class="invalid-feedback" role="alert">{{ $message }}</div>
    @enderror
    <small class="form-text text-muted">Only valid, unique email addresses are accepted.</small>
</div>
<div class="d-flex align-items-center">
    <button type="submit" class="btn btn-primary mr-2">{{ $submitLabel }}</button>
    <a href="{{ route('admin.newsletter-subscribers.index') }}" class="btn btn-secondary">Cancel</a>
</div>
