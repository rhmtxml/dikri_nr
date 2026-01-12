@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->order_number)

@section('content')

{{-- ================= HEADER ================= --}}
<div class="mb-4">
    <h4 class="fw-bold text-primary mb-0">
        <i class="bi bi-receipt"></i> Detail Pesanan #{{ $order->order_number }}
    </h4>
</div>

<div class="row g-4">

    {{-- ================= ITEM PESANAN ================= --}}
    <div class="col-lg-8">
        <div class="card dashboard-card shadow-sm border-0 h-100">
            <div class="card-header bg-transparent border-0 py-3">
                <h5 class="fw-bold mb-0">Item Pesanan</h5>
            </div>

            <div class="card-body">
                @foreach($order->items as $item)
                    <div class="d-flex align-items-center mb-3 order-item">
                        <img src="{{ $item->product->image_url }}"
                             class="rounded-3 me-3"
                             style="width: 64px; height: 64px; object-fit: cover;">

                        <div class="flex-grow-1">
                            <div class="fw-semibold">{{ $item->product->name }}</div>
                            <small class="text-muted">
                                {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}
                            </small>
                        </div>

                        <div class="fw-semibold">
                            Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach

                <hr>

                <div class="d-flex justify-content-between fs-5 fw-bold">
                    <span>Total Pembayaran</span>
                    <span class="text-primary">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= SIDEBAR ================= --}}
    <div class="col-lg-4">

        {{-- CUSTOMER INFO --}}
        <div class="card dashboard-card shadow-sm border-0 mb-4">
            <div class="card-header bg-transparent border-0 py-3">
                <h6 class="fw-bold mb-0">Info Customer</h6>
            </div>
            <div class="card-body">
                <div class="fw-semibold">{{ $order->user->name }}</div>
                <small class="text-muted">{{ $order->user->email }}</small>
            </div>
        </div>

        {{-- UPDATE STATUS --}}
        <div class="card dashboard-card shadow-sm border-0 bg-light">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Update Status Pesanan</h6>

                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label small text-muted">
                            Status Saat Ini:
                            <span class="fw-semibold text-primary">
                                {{ ucfirst($order->status) }}
                            </span>
                        </label>

                        <select name="status" class="form-select">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                Processing (Sedang Dikemas)
                            </option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                Completed (Selesai / Dikirim)
                            </option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                Cancelled (Batalkan & Restock)
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill">
                        Update Status
                    </button>
                </form>

                @if($order->status == 'cancelled')
                    <div class="alert alert-danger mt-3 mb-0 small rounded-3">
                        <i class="bi bi-info-circle"></i>
                        Pesanan ini telah dibatalkan. Stok produk dikembalikan otomatis.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ================= STYLE ================= --}}
<style>
.dashboard-card {
    border-radius: 1.25rem;
}

.order-item {
    padding-bottom: .75rem;
    border-bottom: 1px dashed #e5e7eb;
}
.order-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}
</style>

@endsection
