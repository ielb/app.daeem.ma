<div class="table-responsive py-4">
    <table class="table align-items-center table-flush" id="datatable-basic">
        <thead class="thead-light">
        <tr>
            <th scope="col">{{ __('Order') }}</th>
            <th scope="col">{{ __('Delivery Profit') }}</th>
            <th scope="col">{{ __('Collection Profit') }}</th>
            <th scope="col">{{ __('Total') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr>
                <td><a class="btn badge badge-success badge-pill" href="orders/{{ $order->id }}">#{{$order->code}}</a></td>
                <td>{{ number_format($profitDelivery, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></td>
                <td>{{ number_format($order->collection_profit, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></td>
                <td>{{ number_format($profitDelivery + $order->collection_profit, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></td>
            </tr>
        @endforeach
        </tbody>
        <tfoot class="font-weight-bold">
            <th scope="col">{{ __('Total') }}</th>
            <th scope="col">{{ number_format($sumProfitDelivery, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></th>
            <th scope="col">{{ number_format($all_collection_profit, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></th>
            <th scope="col">{{ number_format($sumProfitDelivery + $all_collection_profit, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></th>
        </tfoot>
    </table>
</div>