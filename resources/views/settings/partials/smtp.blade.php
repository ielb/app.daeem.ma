<div class="row">
    <div class="col-md-12 mt-5">
      <form action="{{route('smtp.edit')}}" method="post">
        @csrf
        <div class="form-group">
          <label for="MAIL_MAILER">Mail driver</label>
          <input type="text" class="form-control" id="MAIL_MAILER" name="MAIL_MAILER" value="{{env('MAIL_MAILER')}}">
        </div>
        <div class="form-group">
          <label for="MAIL_HOST">Host</label>
          <input type="text" class="form-control" id="MAIL_HOST" name="MAIL_HOST" value="{{env('MAIL_HOST')}}">
        </div>
        <div class="form-group ">
          <label for="MAIL_PORT">Port</label>
          <input type="text" class="form-control" id="MAIL_PORT" name="MAIL_PORT" value="{{env('MAIL_PORT')}}">
        </div>
        <div class="form-group ">
          <label for="MAIL_ENCRYPTION">Encryption</label>
          <input type="text" class="form-control" id="MAIL_ENCRYPTION" name="MAIL_ENCRYPTION" value="{{env('MAIL_ENCRYPTION')}}">
        </div>
        <div class="form-group ">
            <label for="MAIL_USERNAME">Username</label>
            <input type="text" class="form-control" id="MAIL_USERNAME" name="MAIL_USERNAME" value="{{env('MAIL_USERNAME')}}">
          </div>
          <div class="form-group ">
            <label for="MAIL_PASSWORD">Password</label>
            <input type="text" class="form-control" id="MAIL_PASSWORD" name="MAIL_PASSWORD" value="{{env('MAIL_PASSWORD')}}">
          </div>
          <div class="form-group ">
            <label for="MAIL_FROM_ADDRESS">From address</label>
            <input type="text" class="form-control" id="MAIL_FROM_ADDRESS" name="MAIL_FROM_ADDRESS" value="{{env('MAIL_FROM_ADDRESS')}}">
          </div>
          <div class="form-group ">
            <label for="MAIL_FROM_NAME">From Name</label>
            <input type="text" class="form-control" id="MAIL_FROM_NAME" name="MAIL_FROM_NAME" value="{{env('MAIL_FROM_NAME')}}">
          </div>
        <div class="form-group text-center pt-3">
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </form>
    </div>
  </div>