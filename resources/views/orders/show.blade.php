@extends('layouts.app')

@section('title', 'Detail Pesanan ' . $order->code)

@section('content')
    <h1>Pesanan {{ $order->code }}</h1>
    <div class="checkout-layout">
        <div class="card">
            <h2>Status: {{ ucfirst($order->status) }}</h2>
            <p>Dipesan pada: {{ $order->ordered_at->format('d M Y, H:i') }}</p>
            @if($order->validated_at)
                <p class="muted">Divalidasi oleh {{ $order->validator?->name }} pada {{ $order->validated_at->format('d M Y, H:i') }}</p>
            @endif
            <hr>
            <h3>Alamat Pengiriman</h3>
            <p>{{ $order->recipient_name }}<br>{{ $order->phone }}<br>{{ $order->address }}</p>
            <h3>Ekspedisi</h3>
            <p>{{ $order->shipping_courier }} - {{ $order->shipping_service }} ({{ $order->shipping_eta }})</p>
        </div>
        <div class="card">
            <h2>Item Pesanan</h2>
            @foreach($order->items as $item)
                <div class="row" style="justify-content:space-between">
                    <span>{{ $item->product_name }} ({{ $item->quantity }}x)</span>
                    <span>Rp{{ number_format($item->subtotal, 2, ',', '.') }}</span>
                </div>
            @endforeach
            <hr>
            <div class="row" style="justify-content:space-between"><span>Subtotal</span><span>Rp{{ number_format($order->subtotal, 2, ',', '.') }}</span></div>
            <div class="row" style="justify-content:space-between"><span>Ongkos Kirim</span><span>Rp{{ number_format($order->shipping_cost, 2, ',', '.') }}</span></div>
            <div class="row" style="justify-content:space-between"><strong>Total</strong><strong>Rp{{ number_format($order->grand_total, 2, ',', '.') }}</strong></div>
        </div>
    </div>
@endsection