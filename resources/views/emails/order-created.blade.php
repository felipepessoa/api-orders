<h1>New Order Created</h1>

<p>Order Details:</p>
<ul>
    <li>Order ID: {{ $orderDetail->order->id }}</li>
    <li>Order Itens:</li>
    <ul>
        @foreach($orderDetail as $item)
            <li>{{ $item->product->name }} - Qty: {{ $item->quantity }} - : {{ $item->price }}</li>
        @endforeach
    </ul>
</ul>
