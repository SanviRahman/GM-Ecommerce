<div class="tile">
    
    <form action="{{ url('/admin/setting/') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Pathao API</h3>
        <div class="tile-body">
            <div clas="form-group">
                 <label class="control-label" for="pathao_base_url">Pathao Base Url</label>
                 <select class="form-control" id="pathao_base_url" name="pathao_base_url">
                     <option>Select an Option</option>
                     <option value="https://courier-api-sandbox.pathao.com" @if(Settings::get('pathao_base_url') == 'https://courier-api-sandbox.pathao.com') selected @endif>Sandbox/Test Environment</option>
                     <option value="https://api-hermes.pathao.com" @if(Settings::get('pathao_base_url') == 'https://api-hermes.pathao.com') selected @endif>Production/Live Environment</option>
                 </select>
            </div>
            <hr>
            <div clas="form-group">
                <label class="control-label" for="pathao_client_id">Pathao Client ID</label>
                <input class="form-control" id="pathao_client_id" name="pathao_client_id" value="{{Settings::get('pathao_client_id')}}">
            </div>
            <hr>
            <div clas="form-group">
                <label class="control-label" for="pathao_client_secret">Pathao Client Secret</label>
                <input class="form-control" id="pathao_client_secret" name="pathao_client_secret" value="{{Settings::get('pathao_client_secret')}}">
            </div>
            <hr>
            <div clas="form-group">
                <label class="control-label" for="pathao_client_email">Pathao Client Email</label>
                <input class="form-control" id="pathao_client_email" name="pathao_client_email" value="{{Settings::get('pathao_client_email')}}">
            </div>
            <hr>
            <div clas="form-group">
                <label class="control-label" for="pathao_client_password">Pathao Client Password</label>
                <input class="form-control" id="pathao_client_password" name="pathao_client_password" value="{{Settings::get('pathao_client_password')}}">
            </div>
            <hr>
            <div clas="form-group">
                <label class="control-label" for="pathao_grant_type">Pathao Grant Type</label>
                <input class="form-control" id="pathao_grant_type" name="pathao_grant_type" value="{{Settings::get('pathao_grant_type')}}">
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
