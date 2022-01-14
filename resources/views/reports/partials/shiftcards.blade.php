<div class="row">
    <div class="col-xl-6 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Delivered Orders</h5>
                        <span class="h2 font-weight-bold mb-0"></span>
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

    <div class="col-xl-6 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Delivery Profit</h5>
                        <span class="h2 font-weight-bold mb-0">{{ number_format(1, 2, '.', '') }} <span class="badge badge-gray"> MAD</span></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                            <i class="ni ni-money-coins"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">Profit from delivered orders</span>
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
                        <h5 class="card-title text-uppercase text-muted mb-0">All Collectables</h5>
                        <span class="h2 font-weight-bold mb-0">{{ 1 }}</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                            <i class="ni ni-chart-bar-32"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">Collections</span>
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
                        <h5 class="card-title text-uppercase text-muted mb-0">Collectables Profit</h5>
                        <span class="h2 font-weight-bold mb-0">{{ number_format(1, 2, '.', '') }} <span class="badge badge-gray"> MAD</span></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                            <i class="ni ni-chart-pie-35"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">Profit from collected products</span>
                </p>
            </div>
        </div>
    </div>
</div>