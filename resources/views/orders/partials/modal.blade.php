{{-- assign to driver modal --}}

<div class="modal fade" id="modal-asign-driver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Assign Driver
          <button type="button" id="ref" class="btn btn-sm btn-success float-right ml-3"><i class="fas fa-sync-alt"></i></button>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
         <form id="form-assing-driver" method="GET" action="">

        <div class="modal-body">
                <label for="">Collector</label>
                <select class="form-control" id="collector" name="collector" required>
                  <option disabled selected value>{{ __('Select a collector') }}</option>
                  @foreach ($collectors as $collector)
                     <option value="{{$collector->id}}">{{$collector->name}}</option>   
                  @endforeach
              
              </select>

                <label for="">Driver </label>
                <select class="form-control" id="driver" name="driver" required>
                    <option disabled selected value>{{ __('Select a driver') }}</option>
                    @foreach ($drivers as $driver)
                       <option value="{{$driver->id}}">{{$driver->name}}</option>   
                    @endforeach
                
                </select>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-primary" onclick="return confirm('are you sure?')">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>


  {{-- prepared by driver --}}

  <div class="modal fade" id="modal-prepared" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Time Slot</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
         <form enctype="multipart/form-data" id="form-prepared" method="POST" action="">
             @csrf

        <div class="modal-body">
            @if(empty($order->invoice_images))
                <div class="form-group">
                    <div class="field" align="left">
                        <input type="file" id="files" class="form-control" name="images[]" multiple />
                    </div>
                </div>
            @endif

                <label for="">Time</label>
            <input type="time" class="form-control" name="time" id="">

        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-primary " onclick="return confirm('are you sure?')">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  @section('scripts')
  <script>
    $(document).ready(function() {
      $('#ref').click(function(){
        $.ajax({
            type:"GET",
            dataType : 'JSON',
            url:'/orders/driver/refresh',
            success:function(res){   
              console.log(res);           
             var driver = res.data;
             $('#driver').html('');
             var html = '';
             html += '<option disabled selected value>Select a driver</option>';
             for(var i = 0; i<driver.length ; i++){

              html += '<option name="subcategory_id" value="'+driver[i].id+'">'+driver[i].name+'</option>';
                             
            }
                     
          $('#driver').html(html);                    
         }
        });
      });
    });
  </script>
  @endsection