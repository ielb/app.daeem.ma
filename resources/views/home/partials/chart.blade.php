<div class="row">
    <div class="col-xl-8">
      <div class="card bg-default">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
              <h5 class="h3 text-white mb-0">Sales value</h5>
            </div>
            <div class="col">
              <script>

                var months = {!! json_encode($months) !!};
                function monthNumToName(monthnum){
                  return months[monthnum - 1] || ''
                }
                
                var monthLabels = {!! json_encode($monthLabels) !!};
                var salesValue= {!! json_encode($salesValue) !!};
                var just_created_order = {!! json_encode($just_created_order) !!};
                var accept_driver_order = {!! json_encode($accept_driver_order) !!};
                var prepared_order = {!! json_encode($prepared_order) !!};
                var refunded_order = {!! json_encode($refunded_order) !!};
                var delivred_order = {!! json_encode($delivred_order) !!};
                var totalOrders = {!! json_encode($totalOrders) !!};
                
                for(var i=0; i<monthLabels.length; i++)
                  {
                      monthLabels[i]=monthNumToName(monthLabels[i]);
                      var data = monthLabels[i];
                   
                  }
      
            </script>

            </div>
          </div>
        </div>
  
        <div class="card-body">
          <!-- Chart -->
          <div class="chart">
            <!-- Chart wrapper -->
            <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4">
      <div class="card">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
              <h5 class="h3 mb-0">Total orders</h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Chart -->
          <div class="chart">
            <canvas id="chart-bars" class="chart-canvas"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

