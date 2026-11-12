@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <h1>Checkout</h1>
    <div class="checkout-layout">
        <div class="card">
            <h2>Alamat Pengiriman</h2>
            <form method="POST" action="{{ route('checkout.store') }}">
                @csrf
                <label>Nama Penerima
                    <input class="input" name="recipient_name" value="{{ old('recipient_name', auth()->user()->name) }}" required>
                </label>
                <label>Nomor Telepon
                    <input class="input" name="phone" value="{{ old('phone') }}" required>
                </label>
                <label>Alamat Lengkap
                    <textarea class="input" name="address" rows="4" required>{{ old('address') }}</textarea>
                </label>
                <h2>Pilih Ekspedisi</h2>
                <label>Layanan Pengiriman
                    <select name="shipping_service_id" required>
                        <option value="">Pilih ekspedisi</option>
                        @foreach($shippingServices as $service)
                            <option value="{{ $service->id }}" data-cost="{{ $service->cost }}">
                                {{ $service->courier }} - {{ $service->service }} ({{ $service->eta }}) - Rp{{ number_format($service->cost, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <button class="btn">Buat Pesanan</button>
            </form>
        </div>
        <div class="card">
            <h2>Ringkasan Pesanan</h2>
            @foreach($items as $item)
                <div class="row" style="justify-content:space-between">
                    <span>{{ $item['product']->name }} ({{ $item['quantity'] }}x)</span>
                    <span>Rp{{ number_format($item['lineTotal'], 2, ',', '.') }}</span>
                </div>
            @endforeach
            <hr>
            <div class="row" style="justify-content:space-between">
                <span>Subtotal</span>
                <span data-subtotal="{{ $subtotal }}">Rp{{ number_format($subtotal, 2, ',', '.') }}</span>
            </div>
            <div class="row" style="justify-content:space-between">
                <span>Ongkos Kirim</span>
                <span data-shipping-total>Pilih ekspedisi</span>
            </div>
            <div class="row" style="justify-content:space-between">
                <strong>Total</strong>
                <strong data-order-total>Rp{{ number_format($subtotal, 2, ',', '.') }}</strong>
            </div>
        </div>
    </div>
@endsection