<div class="row">
  <div class="col-xl-3 col-md-6">
    <div class="card card-stats">
      <!-- Card body -->
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Total Orders</h5>
            
              @if(auth()->user()->role=="admin")
              <span class="h2 font-weight-bold mb-0">{{count($orders)}}</span>
              @elseif(auth()->user()->role=="driver")
              <span class="h2 font-weight-bold mb-0">{{count($driver_order)}}</span>
            @elseif(auth()->user()->role=="collector")
              <span class="h2 font-weight-bold mb-0">{{ count($collector_order) }}</span>
              @endif
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
              <i class="ni ni-active-40"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
          <span class="text-nowrap">All order</span>
        </p>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card card-stats">
      <!-- Card body -->
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">SALES VOLUME</h5>
            @if(auth()->user()->role=="admin")
            <span class="h2 font-weight-bold mb-0">{{ number_format($salesOrder, 2, '.', '') }} <span class="badge badge-gray"> MAD</span></span>
            @elseif(auth()->user()->role=="driver")
            <span class="h2 font-weight-bold mb-0">{{ number_format($salesOrderDriver, 2, '.', '') }} <span class="badge badge-gray"> MAD</span></span>
            @elseif(auth()->user()->role=="collector")
              <span class="h2 font-weight-bold mb-0">{{ number_format($salesOrderCollector, 2, '.', '') }} <span class="badge badge-gray"> MAD</span></span>
            @endif
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
              <i class="ni ni-money-coins"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
          <span class="text-nowrap">Delivered orders</span>
        </p>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card card-stats">
      <!-- Card body -->
      <div class="card-body">
        <div class="row">
          <div class="col">

            
            
            @if(auth()->user()->role=="admin")
              <h5 class="card-title text-uppercase text-muted mb-0">Delivery price</h5>
            <span class="h2 font-weight-bold mb-0">{{ number_format($delivery_price, 2, '.', '') }} <span class="badge badge-gray"> MAD</span></span>
            @elseif(auth()->user()->role=="driver")
              <h5 class="card-title text-uppercase text-muted mb-0">Delivery price</h5>
            <span class="h2 font-weight-bold mb-0">{{ number_format($deliveryPrice, 2, '.', '') }} <span class="badge badge-gray"> MAD</span></span>
            @elseif(auth()->user()->role=="collector")
              <h5 class="card-title text-uppercase text-muted mb-0">Delivered Orders</h5>
              <span class="h2 font-weight-bold mb-0">{{ count($collectorOrderDelivred) }}</span>
            @endif
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
              <i class="ni ni-chart-bar-32"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-sm">

        @if(auth()->user()->role=="admin" || auth()->user()->role=="driver")
            <span class="text-nowrap">Profit from delivered orders</span>
        @elseif(auth()->user()->role=="collector")
            <span class="text-nowrap">Total of delivered orders</span>
          @endif
        </p>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card card-stats">
      <!-- Card body -->
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Delivery Profit</h5>

            
            @if(auth()->user()->role=="admin")
            <span class="h2 font-weight-bold mb-0">{{ number_format($deliveryProfit, 2, '.', '')}} <span class="badge badge-gray"> MAD</span></span>
            @elseif(auth()->user()->role=="driver")
            <span class="h2 font-weight-bold mb-0">{{ number_format($profitDelivery, 2, '.', '') }} <span class="badge badge-gray"> MAD</span></span>
            @elseif(auth()->user()->role=="collector")
              <span class="h2 font-weight-bold mb-0"> {{ number_format(0, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></span>
            @endif
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
              <i class="ni ni-chart-pie-35"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
          <span class="text-nowrap">Net profit from delivered orders</span>
        </p>
      </div>
    </div>
  </div>
</div>

@if (auth()->user()->role=="driver" || auth()->user()->role == 'collector')
  <div class="row">
    <div class="col-xl-6 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Collected products<span class="badge badge-gray"> (orders above {{ number_format(env('COLLECTION_PRODUCT_PRICE'), 2, '.', '') }} MAD will be count as collectables)</span></h5>
                <span class="h2 font-weight-bold mb-0">{{ $count_of_collectables }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                <i class="ni ni-cart"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-nowrap">Collectables</span>
          </p>
        </div>
      </div>
    </div>

    <div class="col-xl-6 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Collection profit<span class="badge badge-gray"> (you will get {{ number_format(env('COLLECTION_PRICE'), 2, '.', '') }} MAD profit for each collectable)</span></h5>
              <span class="h2 font-weight-bold mb-0">{{ number_format($collection_profit, 2, '.', '') }} <span class="badge badge-gray"> MAD</span></span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                <i class="ni ni-bold-up"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-nowrap">Profit</span>
          </p>
        </div>
      </div>
    </div>
  </div>
@else
    
@endif