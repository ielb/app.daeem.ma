<script>
    function setSelectedOrderId(id){
        $("#form-assing-driver").attr("action", "/orders/asign_driver/"+id);
    }
     function setOrderId(id){
        $("#form-prepared").attr("action", "/orders/prepared/"+id);
    }
</script>
@if ($order->status->alias == 'just_created')
    <a href="{{ url('orders/accepted_by_admin/'.$order->id) }}" class="btn btn-success btn-sm" onclick="return confirm('are you sure?')">{{ __('Accept') }}</a>
    <a href="{{ url('orders/rejected_by_admin/'.$order->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('are you sure?')">{{ __('Reject') }}</a>
@elseif($order->status->alias == 'accepted_by_admin')
<button class="btn btn-primary btn-sm" data-toggle="modal" onClick=(setSelectedOrderId({{ $order->id }})) data-target="#modal-asign-driver">{{ __('Assign to driver') }}</button>
@elseif($order->status->alias == 'rejected_by_admin')
<h6>{{ __('No actions for you right now!') }}</h6>
@elseif($order->status->alias == 'assigned_to_driver' && auth()->user()->role == 'admin')
<h6>{{ __('No actions for you right now!') }}</h6>
@elseif($order->status->alias == 'assigned_to_driver' && auth()->user()->role == 'driver' && auth()->user()->working == 1)
<a href="{{ url('orders/accepted_by_driver/'.$order->id) }}" class="btn btn-success btn-sm" onclick="return confirm('are you sure?')" >{{ __('Accept') }}</a>
<a href="{{ url('orders/rejected_by_driver/'.$order->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('are you sure?')">{{ __('Reject') }}</a>
@elseif($order->status->alias == 'assigned_to_driver' && auth()->user()->role == 'driver' && auth()->user()->working == 0)
<h6>{{ __('You are offline!') }}</h6>
@elseif($order->status->alias == 'accepted_by_driver' && auth()->user()->role == 'driver' && auth()->user()->working == 1)
<button class="btn btn-warning btn-sm" data-toggle="modal" onClick=(setOrderId({{ $order->id }})) data-target="#modal-prepared">{{ __('Prepared') }}</button>
@elseif($order->status->alias == 'accepted_by_driver' && auth()->user()->role == 'driver' && auth()->user()->working == 0)
<h6>{{ __('You are offline!') }}</h6>
@elseif($order->status->alias == 'rejected_by_driver')
<button class="btn btn-primary btn-sm" data-toggle="modal" onClick=(setSelectedOrderId({{ $order->id }})) data-target="#modal-asign-driver">{{ __('Assign to driver') }}</button>
@elseif($order->status->alias == 'prepared' && auth()->user()->role == 'admin')
<h6>{{ __('No actions for you right now!') }}</h6>
@elseif($order->status->alias == 'prepared' && auth()->user()->role == 'driver' && auth()->user()->working == 1)
<a href="{{ url('orders/delivered/'.$order->id) }}" class="btn btn-info btn-sm" onclick="return confirm('are you sure?')">{{ __('Delivered') }}</a>
@elseif($order->status->alias == 'prepared' && auth()->user()->role == 'driver' && auth()->user()->working == 0)
<h6>{{ __('You are offline!') }}</h6>
@elseif($order->status->alias == 'delivered' && auth()->user()->role == 'admin')
<h6>{{ __('No actions for you right now!') }}</h6>
@elseif($order->status->alias == 'delivered' && auth()->user()->role == 'driver')
<h6>{{ __('No actions for you right now!') }}</h6>

@endif