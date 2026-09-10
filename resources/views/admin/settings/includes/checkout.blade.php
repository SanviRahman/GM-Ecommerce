<div class="tile">
    <form action="{{ url('/admin/setting/') }}" method="POST" role="form">
        @csrf
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="checkout_number_text">Product Bottom text</label>
                <textarea
                    class="form-control"
                    rows="8"
                    cols="8"
                    placeholder="Enter Product Bottom text"
                    id="checkout_number_text"
                    name="checkout_number_text"
                >{{ Settings::get('checkout_number_text') }}</textarea>
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Settings</button>
                </div>
            </div>
        </div>
    </form>
</div>
