@section('thead')
    <th>{{ __('Price') }}</th>
    <th>{{ __('Options') }}</th>
    <th>{{ __('Actions') }}</th>
@endsection
@section('tbody')
    @foreach ($setup['products'] as $variant)
        <tr>
            <td>{{ $variant->price }}<span class="badge badge-gray"> MAD</span></td>
            <td>{{ $variant->option }}</td>
            <td><a href="{{ route('products.variants.edit', $variant) }}" class="btn btn-primary btn-sm">{{ __('Edit') }}</a><a href="{{ route('products.variants.delete', $variant) }}" class="btn btn-danger btn-sm" onclick="return confirm('are you sure?')">{{ __('Delete') }}</a></td>
        </tr>
    @endforeach
@endsection