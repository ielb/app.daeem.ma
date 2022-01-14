<form method="GET">

    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">{{ __('Orders') }}</h3>
            </div>
            <div class="col-4 text-right">
              <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="ni ni-bold-down"></i>
              </button>
            </div>
           
                <div class="container collapse show" id="collapseExample">
                  <div class="row input-daterange datepicker">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="form-control-label">Date From</label>
                        <input class="form-control" placeholder="Date From" name="fromDate" type="text" <?php if(isset($_GET['fromDate'])){echo 'value="'.$_GET['fromDate'].'"';} ?>>
                      </div>
                    </div>
                    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="form-control-label">Date to</label>
                        <input class="form-control" placeholder="Date to" name="toDate" type="text" <?php if(isset($_GET['toDate'])){echo 'value="'.$_GET['toDate'].'"';} ?>>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <label class="form-control-label">stores</label>
                        <select class="form-control" data-toggle="select" name="store_id" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ...">
                    <option disabled selected value>{{ __('Select an option') }}</option>
                        @foreach ($stores as $store)
                        <option <?php if(isset($_GET['store_id'])&&$_GET['store_id'].""== $store->id.""){echo "selected";} ?> value="{{ $store->id }}"  >{{$store->name}}</option>
                        @endforeach
                        
                        </select>
                    </div>
                  @if (auth()->user()->role == 'admin')
                    <div class="col-sm-3">
                      <label class="form-control-label">Clients</label>

                        <select class="form-control" data-toggle="select" name="client_id" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ...">
                        <option disabled selected value>{{ __('Select an option') }}</option>
                         @foreach ($clients as $client)
                         <option <?php if(isset($_GET['client_id'])&&$_GET['client_id'].""== $client->id.""){echo "selected";} ?> value="{{ $client->id }}" >{{ $client->name }}</option>
                         @endforeach
                
                        </select>
                      
                    </div>
                   
                        
                    
                    <div class="col-sm-3">
                      <label class="form-control-label">Drivers</label>

                      <select class="form-control" data-toggle="select" name="driver_id" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ...">
                        <option disabled selected value>{{ __('Select an option') }}</option>

                       @foreach ($drivers as $driver)
                       <option  <?php if(isset($_GET['driver_id'])&&$_GET['driver_id'].""== $driver->id.""){echo "selected";} ?> value="{{ $driver->id }}" >{{ $driver->name }}</option>
                       @endforeach
              
                      </select>

                    </div>

                    <div class="col-sm-3">
                      <label class="form-control-label">Status</label>

                      <select class="form-control" data-toggle="select" name="status_id" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ...">
                        <option disabled selected value>{{ __('Select an option') }}</option>

                       @foreach ($status as $statu)
                       <option  <?php if(isset($_GET['status_id'])&&$_GET['status_id'].""== $statu->id.""){echo "selected";} ?> value="{{ $statu->id }}" >{{ $statu->name }}</option>
                       @endforeach
              
                      </select>

                    </div>
                    @endif
                    <div class="col-sm-6">
                      <div class="row">
                       
                        <div class="col-md-4">
                          <label for="form-control-label">  </label>
                          <button type="submit" class="btn btn-primary btn-md btn-block mt-2">{{ __('Filter') }}</button>
                      </div>
                        @if ($parameters)
                            <div class="col-md-6">
                              <label for="form-control-label">  </label>
                                <a href="{{ Request::url() }}" class="btn btn-md btn-block mt-2">{{ __('Clear Filters') }}</a>
                            </div>
                        @else
                            <div class="col-md-6"></div>
                        @endif
  
                    
                     </div>
                    </div>
                  </div>
               
                </div>

        </div>
    </div>
  </form>