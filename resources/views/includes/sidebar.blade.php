<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
          <img src="{{ asset('assets/img/brand/daeem_blue.png')}}" class="navbar-brand-img" alt="...">
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>

            @if (auth()->user()->role != 'admin' && auth()->user()->working == 0)
            <li class="nav-item bg-secondary">
              <a class="nav-link" href="javascript:void(0)">
                <i class="ni ni-basket text-orange"></i>
                <span class="nav-link-text">Orders<span class="badge badge-gray"> (closed)</span></span>
              </a>
            </li>
            @else
              <li class="nav-item">
                <a class="nav-link" href="{{ route('orders') }}">
                  <i class="ni ni-basket text-orange"></i>
                  <span class="nav-link-text">Orders</span>
                </a>
              </li>
            @endif

            @if (auth()->user()->role == 'driver' && auth()->user()->working == 0)
            <li class="nav-item bg-secondary">
              <a class="nav-link" href="javascript:void(0)">
                <i class="fas fa-calendar text-primary"></i>
                <span class="nav-link-text">Shifts<span class="badge badge-gray"> (closed)</span></span>
              </a>
            </li>
            @elseif(auth()->user()->role == 'driver' && auth()->user()->working == 1)
            <li class="nav-item">
              <a class="nav-link" href="{{ route('shifts_options') }}">
                <i class="fas fa-calendar text-primary"></i>
                <span class="nav-link-text">Shifts</span>
              </a>
            </li>
            @endif
            
            
            @if (auth()->user()->role == 'admin')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('refund_orders') }}">
                  <i class="ni ni-basket text-warning"></i>
                  <span class="nav-link-text">Refund Orders </span>
                </a>
              </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('live_orders') }}">
                <i class="ni ni-basket text-success"></i>
                <span class="nav-link-text">Live Orders </span><div class="blob red"></div>
              </a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('store_types.index')}}">
                  <i class="ni ni-shop text-warning"></i>
                  <span class="nav-link-text">Stores types</span>
                </a>
              </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('stores')}}">
                <i class="ni ni-shop text-success"></i>
                <span class="nav-link-text">Stores</span>
              </a>
{{--            </li>--}}
{{--              <li class="nav-item">--}}
{{--              <a class="nav-link" href="{{route('supermarkets')}}">--}}
{{--                <i class="ni ni-shop text-info"></i>--}}
{{--                <span class="nav-link-text">Supermarkets</span>--}}
{{--              </a>--}}
{{--            </li>--}}
              <li class="nav-item">
              <a class="nav-link" href="{{route('store_types.view')}}">
                <i class="ni ni-collection text-pink"></i>
                <span class="nav-link-text">Categories</span>
              </a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('products.allproducts')}}">
                  <i class="fab fa-product-hunt text-success"></i>
                  <span class="nav-link-text">All products</span>
                </a>
              </li>
            @endif
            @if (auth()->user()->role == 'admin')
                 <li class="nav-item">
              <a class="nav-link" href="{{ route('drivers.index') }}">
                <i class="ni ni-delivery-fast text-pink"></i>
                <span class="nav-link-text">Staff</span>
              </a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('shifts.show') }}">
                  <i class="ni ni-delivery-fast text-green"></i>
                  <span class="nav-link-text">Drivers Shifts</span>
                </a>
              </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('drivers.edit',auth()->user()->id) }}">
                <i class="ni ni-delivery-fast text-pink"></i>
                <span class="nav-link-text">Profile</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('support.create') }}">
                <i class="ni ni-settings-gear-65 text-success"></i>
                <span class="nav-link-text">Support</span>
              </a>
            </li>
            @endif
            @if(auth()->user()->role == 'driver')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('reports.index') }}">
                  <i class="ni ni-collection text-primary"></i>
                  <span class="nav-link-text">Reports</span>
                </a>
              </li>
            @endif

          @if (auth()->user()->role == 'admin')
              <li class="nav-item">
              <a class="nav-link" href="{{ route('clients.index') }}">
                <i class="fas fa-users text-blue"></i>
                <span class="nav-link-text">Clients</span>
              </a>
            </li> 
        
         
            <li class="nav-item">
              <a class="nav-link" href="{{ route('auth.index') }}">
                <i class="ni ni-single-02 text-success"></i>
                <span class="nav-link-text">Users</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('cities') }}">
                <i class="fas fa-city text-pink"></i>
                <span class="nav-link-text">Cities</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('zones') }}">
                <i class="fas fa-city text-pink"></i>
                <span class="nav-link-text">Zones</span>
              </a>
            </li>
              <li class="nav-item">
              <a class="nav-link" href="{{ route('shifts') }}">
                <i class="fas fa-calendar text-primary"></i>
                <span class="nav-link-text">Shifts</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('reviews.index') }}">
                <i class="ni ni-diamond text-info"></i>
                <span class="nav-link-text">Reviews</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('settings.delivery')}}">
                <i class="ni ni-credit-card text-orange"></i>
                <span class="nav-link-text">Pricing plans</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('coupons')}}">
                <i class="fas fa-tags text-success"></i>
                <span class="nav-link-text">Coupons</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('finances.index')}}">
                <i class="ni ni-money-coins text-blue"></i>
                <span class="nav-link-text">Finances</span>
              </a>
            </li>
              <li class="nav-item">
              <a class="nav-link" href="{{route('notifications.index')}}">
                <i class="ni ni-bell-55 text-blue"></i>
                <span class="nav-link-text">Notifications</span>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="{{route('settings.delivery')}}">
                <i class="ni ni-settings-gear-65"></i>
                <span class="nav-link-text">Delivery Settings</span>
              </a>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link" href="{{route('settings')}}">
                <i class="ni ni-settings text-black"></i>
                <span class="nav-link-text">Site Settings</span>
              </a>
            </li>
            @endif
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">Version 1.0.0</h6>
          <h6>{{ \Carbon\Carbon::now() }}</h6>
        </div>
      </div>
    </div>
  </nav>