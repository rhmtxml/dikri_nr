@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">
        <i class="bi bi-cart3 me-2"></i>Keranjang Belanja
    </h2>

    @if($items->count())
    <div class="row">
        {{-- CART ITEMS --}}
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50%">Produk</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                @php
                                    $price = $item->product->price;
                                    $subtotal = $price * $item->quantity;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item->product->image_url }}"
                                                 class="rounded me-3"
                                                 width="60" height="60"
                                                 style="object-fit: cover;">
                                            <div>
                                                <strong>{{ \Illuminate\Support\Str::limit($item->product->name, 40) }}</strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        Rp {{ number_format($price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                            @csrf
                                            <input type="number"
                                                   name="quantity"
                                                   value="{{ $item->quantity }}"
                                                   min="1"
                                                   max="{{ $item->product->stock }}"
                                                   class="form-control form-control-sm text-center"
                                                   style="width: 70px"
                                                   onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="text-end fw-bold">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Hapus item ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- SUMMARY --}}
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Ringkasan Belanja</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Item</span>
                        <span>{{ $items->sum('quantity') }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold text-primary fs-5">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                    <a href="#" class="btn btn-primary w-100">
                        <i class="bi bi-credit-card me-2"></i>Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
        {{-- EMPTY CART --}}
        <div class="text-center py-5">
            <i class="bi bi-cart-x display-1 text-muted"></i>
            <h4 class="mt-3">Keranjang Kosong</h4>
            <p class="text-muted">Belum ada produk di keranjang belanja kamu</p>
            <a href="/" class="btn btn-primary">
                Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection
