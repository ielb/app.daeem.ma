
<div class="card-body">
    <h6 class="heading-small text-muted mb-4">{{ __('store information') }}</h6>
     @include('partials.flash')
     <div class="pl-lg-4">
        <h3>{{ $order->store->name }}</h3>
          <h4>{{ $order->store->address }}</h4>
         <h4>{{ $order->store->phone }}</h4>
         <h4>{{ $order->store->city->name}}</h4>
     </div>
     <hr class="my-4" />
         <h6 class="heading-small text-muted mb-4">{{ __('Client Information') }}</h6>
         <div class="pl-lg-4">
              <h3>{{ $order->client->name }}</h3>
             <h4>{{ $order->client->email }}</h4>
            <h4>{{ $order->address?$order->address->address:"" }}</h4>
   
             @if(!empty($order->client->phone))
             <br/>
             <h4>{{ __('Contact')}}: {{ $order->client->phone }}</h4>
             @endif
         </div>
         <hr class="my-4" />
         <h6 class="heading-small text-muted mb-4">{{ __('Product') }}</h6>

    <div class="table-responsive">

        <table class="table align-items-center">
            <thead class="thead-light">
            <tr>
                <th scope="col" class="sort">Product</th>
                <th scope="col" class="sort">Qty</th>
                <th scope="col" class="sort">Unit Price</th>
                <th scope="col" class="sort">Total Price</th>

            </tr>
            </thead>
            <tbody class="list">

            @foreach ($order_products as $item)
                <tr>

                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ number_format($item->product->price, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></td>
                    <td>{{ number_format($item->qty * $item->product->price, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></td>

                </tr>

            @endforeach

            </tbody>
        </table>
    </div>

        <hr class="my-4" />
     <h6 class="heading-small text-muted">{{ __('Order') }}</h6>

     @if(!empty($order->comment))
        <br/>
        <h4>{{ __('Comment') }}: {{ $order->comment }}</h4> 
    @endif    
     @if(!empty($order->delivery_pickup_interval))
     <br/>
     <h4>{{ __('Time to prepare') }}: {{ $order->delivery_pickup_interval ." " .__('minutes')}}</h4>
     <br/>
     @endif
    @if($order->use_delivery_time == 1)
        <h4>{{ __('Delivery time') }}: {{ $order->delivery_time }}</h4>
    @else
        <h4>{{ __('Delivery time') }}: ASAP</h4>
    @endif
     <h5>{{ __("Price") }}: {{ number_format($order->order_price, 2, '.', '') }}<span class="badge badge-gray">MAD</span></h5>
     <h5>{{ __("Vat") }}: {{ number_format(0, 2, '.', '')}}<span class="badge badge-gray">MAD</span></h5>

     <h4>{{ __("Sub Total") }}: {{ number_format($order->order_price, 2, '.', '')}}<span class="badge badge-gray">MAD</span></h4>
      @if(!empty($order->delivery_price))
     <h4>{{ __("Delivery") }}: {{ number_format($order->delivery_price, 2, '.', '')}}<span class="badge badge-gray">MAD</span></h4>
     @endif

    @if(!empty($order->invoice_images))
        <hr>
        <h6 class="heading-small text-muted mb-4">{{ __('Preview Images') }}</h6>
           <div class="gallery_container">
               <div class="gallery">
                   @foreach($preview_image as $pi)
                           <div class="image-area">
                               <a href="{{asset('images/orders/'.$pi) }}?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" data-lightbox="models" data-title="{{$pi}}">
                               <img src="{{asset('images/orders/'.$pi) }}?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"  alt="Preview">
                               <a class="remove-image" href="{{ route('invoice_image.delete', ['order'=>$order,'pi'=>$pi]) }}" style="display: inline;">&#215;</a>
                           </div>
                       </a>

    {{--                       <div class="image-area">--}}
    {{--                           <img src="https://blog.codepen.io/wp-content/uploads/2012/06/White-Large.png"  alt="Preview">--}}
    {{--                           <a class="remove-image" href="#" style="display: inline;">&#215;</a>--}}
    {{--                       </div>--}}

                   @endforeach
               </div>
           </div>

{{--        @foreach($preview_image as $pi)--}}
{{--            <span class="image-area">--}}
{{--                <a href="{{asset('images/orders/'.$pi) }}" data-lightbox="homePortfolio">--}}
{{--                    <img src="{{asset('images/orders/'.$pi) }}"/>--}}
{{--                </a>--}}
{{--                <a class="remove-image" href="{{ route('invoice_image.delete', ['order'=>$order,'pi'=>$pi]) }}" style="display: inline;">&#215;</a>--}}
{{--            </span>--}}
{{--        @endforeach--}}
    @endif
     @if (auth()->user()->role == 'driver' && $order->status_id == 8 || auth()->user()->role == 'driver' && $order->status_id == 4)
        <hr>
     <h6 class="heading-small text-muted mb-4">{{ __('Upload Image') }}<span class="badge badge-gray"> (Notice that previews images will be replaced if placed)</span></h6>
     <form method="post" action="{{ route('invoice.image', $order) }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <div class="field" align="left">
                <input type="file" id="files" class="form-control" name="images[]" multiple />
            </div>
        </div>
         <div class="text-left">
             <button type="submit" class="btn btn-success mt-4">{{ __('Upload') }}</button>
         </div>
     </form>

    @else
        
    @endif
     
     <hr />
     <h3>{{ __("TOTAL") }}: {{ number_format($order->delivery_price+$order->order_price, 2, '.', '') }}<span class="badge badge-gray">MAD</span></h3>
     <hr />
     <h4>{{ __("Payment method") }}: {{ __(strtoupper($order->payment_method)) }}</h4>
     @if($order->status->name == "delivered")
     <h4>{{ __("Payment status") }}: {{ __('Paid') }}</h4>
     @endif
    
     @if($order->status->name == "prepared")
     <hr />
         <h4>{{ __("Delivery method") }}: {{ __('Prepared') }}</h4>
         <h3>{{ __("Time slot") }}:  {{ $order->delivery_pickup_interval ." " .__('minutes') }}</h3>
     @elseif($order->status->name == "delivered")
         <h4>{{ __("Dine method") }}: {{ __('Delivered') }}</h4>
         @if ($order->delivery_method!=3)
             <h3>{{ __("Time slot") }}:  </h3>
         @endif
 @endif
 </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox-plus-jquery.js" integrity="sha512-0rYcJjaqTGk43zviBim8AEjb8cjUKxwxCqo28py38JFKKBd35yPfNWmwoBLTYORC9j/COqldDc9/d1B7dhRYmg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
