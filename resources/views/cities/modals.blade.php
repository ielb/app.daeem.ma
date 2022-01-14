<!-- Modal -->
<div class="modal fade" id="addcity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
      <div class="modal-content ">
        <form method="post" action="{{ route('cities.add') }}">
            @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add a city</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col-xl-8 center">
                    <div class="form-group">
                      <label for="city">Name</label>
                      <input type="text" class="form-control" id="city" name="city" placeholder="City">
                    </div>
                    <div class="form-group">
                      <label for="code_postal">Code Postal</label>
                      <input type="text" class="form-control" id="code_postal" name="code_postal" placeholder="EX : 90000">
                    </div>
                
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
        </form>
      </div>
    </div>
  </div>