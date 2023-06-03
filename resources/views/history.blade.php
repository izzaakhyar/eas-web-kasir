@foreach ($orderHistory as $orderId => $items)
    <h3>Order ID: {{ $orderId }}</h3>
    <p>User: {{ $items->first()->order->user->name }}</p>
    <p>Balance before checkout: {{ $items->first()->order->pay }}</p>
    <p>Balance after checkout: {{ $items->first()->order->user->balance }}</p>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
@endforeach
