@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
    <h1>Riwayat Pesanan</h1>
    @if($orders->isEmpty())
        <div class="card">
            <p>Belum ada pesanan.</p>
            <a class="btn" href="{{ route('shop.index') }}">Mulai belanja</a>
        </div>
    @else
        <div class="table-scroll">
            <table>
                <tr>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th></th>
                </tr>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->code }}</td>
                        <td>{{ $order->ordered_at->format('d M Y') }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>Rp{{ number_format($order->grand_total, 2, ',', '.') }}</td>
                        <td><a class="btn" href="{{ route('orders.show', $order) }}">Detail</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $orders->links() }}
    @endif
@endsection