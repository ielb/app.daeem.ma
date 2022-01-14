
<form action="{{route('settings.edit')}}" method="post">
  @csrf
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label class="form-control-label" for="site_name">Site Name</label>
      <input type="text" class="form-control" id="site_name" name="site_name"  value="{{env('APP_NAME')}}">
    </div>
  </div>
  <div class="col-md-12">
      <div class="form-group">
        <label class="form-control-label" for="description">Site Description</label>
        <input type="text" class="form-control" id="description" name="description"  value="{{env('description')}}">
      </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <label class="form-control-label" for="maps_api_key">maps api key</label>
      <input type="text" class="form-control" id="maps_api_key" name="maps_api_key" placeholder="" value="{{env('maps_api_key')}}">
    </div>
  </div>
  <div class="col-md-12 py-3">
      <h3>MOBİLE APP</h3>
  </div>
  <div class="col-md-12">
      <div class="form-group">
        <label class="form-control-label" for="playstore">Play Store</label>
        <input type="text" class="form-control" id="playstore" name="playstore"  value="{{env('playstore')}}">
      </div>
  </div>
  <div class="col-md-12">
      <div class="form-group">
        <label class="form-control-label" for="appstore">app Store</label>
        <input type="text" class="form-control" id="appstore" name="appstore"  value="{{env('appstore')}}">
      </div>
    </div>
    <div class="col-md-12 py-3">
      <h3>SOCİAL LİNKS</h3>
  </div>
  <div class="col-md-12">
      <div class="form-group">
        <label class="form-control-label" for="facebook_link">Facebook</label>
        <input type="text" class="form-control" id="facebook_link" name="facebook_link"  value="{{env('facebook_link')}}">
      </div>
  </div>
  <div class="col-md-12">
      <div class="form-group">
        <label class="form-control-label" for="instagram_link" >Instagram</label>
        <input type="text" class="form-control" id="instagram_link" name="instagram_link"  value="{{env('instagram_link')}}">
      </div>
  </div>
  <div class="col text-center">
      <button type="submit" class="btn btn-success">save</button>
  </div>
</div>
</form>