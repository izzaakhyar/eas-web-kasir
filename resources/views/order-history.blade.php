<!-- Tambahkan elemen-elemen lain yang diperlukan dalam view -->
@foreach($orders as $order)
    <div>
        <h4>Order ID: {{ $order->id }}</h4>
        <p>Tanggal Pesanan: {{ $order->date }}</p>
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>Total: {{ $order->totalAmount }}</p>
    </div>
@endforeach
