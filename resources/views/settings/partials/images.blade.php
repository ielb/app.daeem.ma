<form action="{{route('logo.edit')}}" method="POST" utocomplete="off" enctype="multipart/form-data">
    @csrf
    {{-- <div class="row text-center p-5">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="form-group">
            <label class="form-control-label" for="logo">{{ __('Site Logo') }}</label>
            <div class="image-upload">
                <label for="site_logo" style="cursor: pointer">
                    <img id="logo-img" width="250" height="150" src="{{ asset('assets/img/brand/daeem_blue.png')}}" alt="..." />
                </label>
                <input  type="file"  accept="image/*"  style="display: none" name="site_logo" id="site_logo" />
            </div>
        </div>
        <div class="form-group pt-5">
          <button type="submit" class="btn btn-success">save</button>
        </div>
    </div>
    </div> --}}

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="form-group text-center">
          <label class="form-control-label"
                 for="site_logo">{{ __('Site Logo') }}</label>
          <div class="">
              <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class="fileinput-preview img-thumbnail"
                       data-trigger="fileinput" style="width: 250px;">
                      <img src="{{ asset('assets/img/brand/daeem_blue.png')}}"
                           width="250px"  alt="..."/>
                  </div>
                  <div>
                          <span class="btn btn-outline-secondary btn-file">
                          <span class="fileinput-new">{{ __('Select logo') }}</span>
                          <span class="fileinput-exists">{{ __('Change') }}</span>
                          <input type="file" name="site_logo"
                            accept="image/x-png,image/gif,image/jpeg">
                          </span>
                         <a href="#" class="btn btn-outline-secondary fileinput-exists"
                         data-dismiss="fileinput">{{ __('Remove') }}</a>
                  </div>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="form-group text-center">
          <label class="form-control-label"
                 for="site_icon">{{ __('Site Icon') }}</label>
          <div class="">
              <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class="fileinput-preview img-thumbnail"
                       data-trigger="fileinput" style="">
                      <img src="{{ asset('assets/img/brand/'.env('icon'))}}"
                           width="50"  alt="..."/>
                  </div>
                  <div>
                          <span class="btn btn-outline-secondary btn-file">
                          <span class="fileinput-new">{{ __('Select logo') }}</span>
                          <span class="fileinput-exists">{{ __('Change') }}</span>
                          <input type="file" name="site_icon"
                            accept="image/x-png,image/gif,image/jpeg">
                          </span>
                         <a href="#" class="btn btn-outline-secondary fileinput-exists"
                         data-dismiss="fileinput">{{ __('Remove') }}</a>
                  </div>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="form-group text-center">
          <label class="form-control-label"
                 for="site_avatar_client">{{ __('Site Avatar Client') }}</label>
          <div class="">
              <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class="fileinput-preview img-thumbnail"
                       data-trigger="fileinput" style="">
                      <img src="{{ asset('assets/img/brand/'.env('avatar'))}}"
                           width="50"  alt="..."/>
                  </div>
                  <div>
                          <span class="btn btn-outline-secondary btn-file">
                          <span class="fileinput-new">{{ __('Select logo') }}</span>
                          <span class="fileinput-exists">{{ __('Change') }}</span>
                          <input type="file" name="site_avatar_client"
                            accept="image/x-png,image/gif,image/jpeg">
                          </span>
                         <a href="#" class="btn btn-outline-secondary fileinput-exists"
                         data-dismiss="fileinput">{{ __('Remove') }}</a>
                  </div>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="row">
          <div class="col-lg-6 center py-3">
            <div class="form-group text-center px-5">
              <label for="color_head" class="form-control-label">Color</label>
            <input class="form-control " name="color_head"   type="color" value="#{{env('color_head')}}" id="color_head">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 text-center">
        <div class="form-group pt-5">
          <button type="submit" class="btn btn-success">save</button>
        </div>
      </div>
    </div>
  </form>

  @section('scripts')
    <script>
      $('#site_logo').on('change',function (e){
                        $('#logo-img').css('display','block')
                        var output = document.getElementById('logo-img');
                        output.src = URL.createObjectURL(e.target.files[0]);
                        $('.logo-icon').css('display','none');
                        output.onload = function () {
                            URL.revokeObjectURL(output.src) // free memory
                        }

                    });
    </script>
@endsection