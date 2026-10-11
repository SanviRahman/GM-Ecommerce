<div class="tile">
    <form action="{{ url('admin/setting') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Cop Right Footer</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="footer_copyright_text">Copyright Text</label>
                <textarea
                    class="form-control"
                    type="text"
                    placeholder="Enter Copyright Text"
                    id="footer_copyright_text"
                    name="footer_copyright_text"
                   
                >{{ Settings::get('footer_copyright_text') }}</textarea>
            </div>
        
      
            <div class="form-group">
                <label for="footer_contact_email">Footer Contact Email</label>
                <input class="form-control" id="footer_contact_email" name="footer_contact_email" type="email" value="{{ Settings::get('footer_contact_email') }}" placeholder="e.g. contact@example.com">
            </div>
            <div class="form-group">
                <label for="footer_contact_address">Footer Address</label>
                <textarea class="form-control" id="footer_contact_address" name="footer_contact_address" rows="2" placeholder="Your shop address">{{ Settings::get('footer_contact_address') }}</textarea>
            </div>
            <div class="form-group">
                <label for="footer_newsletter_text">Newsletter Description</label>
                <textarea class="form-control" id="footer_newsletter_text" name="footer_newsletter_text" rows="2" placeholder="Subscribe to receive offers and updates">{{ Settings::get('footer_newsletter_text') }}</textarea>
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