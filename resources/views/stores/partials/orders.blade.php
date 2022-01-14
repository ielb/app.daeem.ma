<div class="card card-profile bg-secondary shadow">
    <div class="card-header">

        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">{{ __("Orders History")}}</h3>
            </div>
        </div>
    </div>
    <div class="card-body">

        <div class="tab-content" id="shifts">
            <div class="card shadow">
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-basic">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('UID') }}</th>
                            <th scope="col">{{ __('Client') }}</th>
                            <th scope="col">{{ __('Driver') }}</th>
                            <th scope="col">{{ __('Order Price') }}</th>
                            <th scope="col">{{ __('Delivery Price') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Creation Date') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <a href="#" class="badge badge-primary badge-pill"> #{{$order->code}}</a>
                                </td>
                                <td> <a href="{{route('clients.show',$order->client->id)}}" class="badge badge-primary badge-pill"> {{$order->client->name}} </a></td>
                                <td>
                                    <a href="{{route('drivers.edit',!empty($order->user->id) ? $order->user->id : '')}}"> {{ !empty($order->user->id) ? $order->user->name : ''}} </a>
                                </td>
                                <td>{{$order->order_price}} </td>
                                <td>{{ $order->delivery_price }} </td>
                                <td><span class="badge badge-{{ $order->status->color }} ">{{ $order->status->name }} </span></td>
                                <td>{{$order->created_at}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
