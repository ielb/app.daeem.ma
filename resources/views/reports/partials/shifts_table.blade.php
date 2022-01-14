<div class="table-responsive py-4">
    <table class="table align-items-center table-flush" id="datatable-buttons">
        <thead class="thead-light">
        <tr>
            <th scope="col">{{ __('Day') }}</th>
            <th scope="col">{{ __('Shift') }}</th>
            <th scope="col">{{ __('Total Orders') }}</th>
            <th scope="col">{{ __('Delivery Profit') }}</th>
            <th scope="col">{{ __('Collection Profit') }}</th>
            <th scope="col">{{ __('Total') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($days as $day)
            <tr>
                <td>{{ $day->name }}</td>
                <td>
                    @foreach($day->shifts as $shift)
                        {{ $shift->shift_option->shift }}<br>
                    @endforeach
                </td>
                <td>
                    <?php $count=0 ?>
                    @foreach($week_orders as $key=>$week_order)
                        @if($day->name == $week_order->dayName)
                            <?php $count++ ?>
                        @endif
                    @endforeach
                    {{ $count }}
                </td>
                <td>
                    @if(auth()->user()->vehicle == 'Car')
                        {{ number_format($count * env('DRIVER_CAR_PRICE'), 2, '.', '') }}<span class="badge badge-gray"> MAD</span>
                    @elseif(auth()->user()->vehicle == 'Motorcycle')
                        {{ number_format($count * env('DRIVER_MOTORCYCLE_PRICE'), 2, '.', '') }}<span class="badge badge-gray"> MAD</span>
                    @endif
                </td>
                <td>
                    <?php $t=0 ?>
                    @foreach($week_orders as $key=>$week_order)
                        @if($day->name == $week_order->dayName)
                            <?php $t+=$week_order->collection_profit ?>
                        @endif
                    @endforeach
                    {{ number_format($t, 2, '.', '') }}<span class="badge badge-gray"> MAD</span>
                </td>
                <td>
                    @if(auth()->user()->vehicle == 'Car')
                        {{ number_format($count * env('DRIVER_CAR_PRICE') + $t, 2, '.', '') }}<span class="badge badge-gray"> MAD</span>
                    @elseif(auth()->user()->vehicle == 'Motorcycle')
                        {{ number_format($count * env('DRIVER_MOTORCYCLE_PRICE') + $t, 2, '.', '') }}<span class="badge badge-gray"> MAD</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot class="font-weight-bold">
        <th scope="col" colspan="2">{{ __('Total') }}</th>
        <th scope="col">{{ count($week_orders) }}</th>
        <th scope="col">
            @if(auth()->user()->vehicle == 'Car')
                {{ number_format(count($week_orders) * env('DRIVER_CAR_PRICE'), 2, '.', '') }}<span class="badge badge-gray"> MAD</span>
            @elseif(auth()->user()->vehicle == 'Motorcycle')
                {{ number_format(count($week_orders) * env('DRIVER_MOTORCYCLE_PRICE'), 2, '.', '') }}<span class="badge badge-gray"> MAD</span>
            @endif
        </th>
        <th scope="col">{{ number_format($all_shift_collectables, 2, '.', '') }}<span class="badge badge-gray"> MAD</span></th>
        <th scope="col">
            @if(auth()->user()->vehicle == 'Car')
                {{ number_format(count($week_orders) * env('DRIVER_CAR_PRICE') + $all_shift_collectables, 2, '.', '') }}<span class="badge badge-gray"> MAD</span>
            @elseif(auth()->user()->vehicle == 'Motorcycle')
                {{ number_format(count($week_orders) * env('DRIVER_MOTORCYCLE_PRICE') + $all_shift_collectables, 2, '.', '') }}<span class="badge badge-gray"> MAD</span>
            @endif
        </th>
        </tfoot>
    </table>
</div>