<div class="row">
  @if (Auth()->user()->role == "admin")
        <div class="col-xl-8">
    @else
    <div class="col-xl-12">
    @endif
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-0">{{ __('Realtime map') }}</h6>
                            <h3 class="mb-0">{{ __('Stores Places')}} <small> ({{count($store)}})</small></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div id="map" class="form-control form-control-alternative"></div>
                </div>
            </div>

        </div>
        @if (Auth()->user()->role == "admin")
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                  <h6 class="surtitle">Partners</h6>
                  <h5 class="h3 mb-0">Orders </h5>
                </div>
                <div class="card-body">
                  <div class="chart my-3">
                    <canvas id="chart-doughnut" class="chart-canvas"></canvas>
                  </div>
                </div>
                <div class="card-footer bg-transparent">
                  <h5 class="h3 "><i class="ni ni-calendar-grid-58"></i> Orders by date </h5>
                  <div class="row align-items-center my-2">
                    @foreach($earnings as $key => $value)
                    <div class="col text-center">
                      <small> <strong>{{ __($key) }}:</strong></small>
                      <h5 class="mb-0">{{$value['orders']}}</h5>
                    </div>
                    @endforeach
                  </div>
              </div>
              </div>
        </div>
        @endif
    </div>
 
