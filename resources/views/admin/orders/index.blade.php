@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')

{{-- ================= HEADER ================= --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-primary mb-0">
        <i class="bi bi-receipt"></i> Manajemen Pesanan
    </h4>
</div>

{{-- ================= CARD ================= --}}
<div class="card dashboard-card shadow-sm border-0">

    {{-- FILTER --}}
    <div class="card-header bg-transparent border-0 py-3">
        <ul class="nav nav-pills gap-2">
            <li class="nav-item">
                <a class="nav-link px-3 rounded-pill
                    {{ !request('status') ? 'active' : '' }}"
                   href="{{ route('admin.orders.index') }}">
                    Semua
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-3 rounded-pill
                    {{ request('status') == 'pending' ? 'active' : '' }}"
                   href="{{ route('admin.orders.index', ['status' => 'pending']) }}">
                    Pending
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-3 rounded-pill
                    {{ request('status') == 'processing' ? 'active' : '' }}"
                   href="{{ route('admin.orders.index', ['status' => 'processing']) }}">
                    Diproses
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-3 rounded-pill
                    {{ request('status') == 'completed' ? 'active' : '' }}"
                   href="{{ route('admin.orders.index', ['status' => 'completed']) }}">
                    Selesai
                </a>
            </li>
        </ul>
    </div>

    {{-- TABLE --}}
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 order-table">
                <thead>
                    <tr>
                        <th class="ps-4">No. Order</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="ps-4 fw-semibold text-primary">
                                #{{ $order->order_number }}
                            </td>

                            <td>
                                <div class="fw-semibold">{{ $order->user->name }}</div>
                                <small class="text-muted">{{ $order->user->email }}</small>
                            </td>

                            <td>
                                {{ $order->created_at->format('d M Y H:i') }}
                            </td>

                            <td class="fw-semibold">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </td>

                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning bg-opacity-10 text-warning">
                                        Pending
                                    </span>
                                @elseif($order->status == 'processing')
                                    <span class="badge bg-info bg-opacity-10 text-info">
                                        Diproses
                                    </span>
                                @elseif($order->status == 'completed')
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        Selesai
                                    </span>
                                @elseif($order->status == 'cancelled')
                                    <span class="badge bg-danger bg-opacity-10 text-danger">
                                        Batal
                                    </span>
                                @endif
                            </td>

                            <td class="text-end pe-4">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                   class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                Tidak ada pesanan ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="card-footer bg-transparent border-0">
        {{ $orders->links() }}
    </div>
</div>

{{-- ================= STYLE ================= --}}
<style>
.dashboard-card {
    border-radius: 1.25rem;
}

.order-table thead {
    background: #f8f9fc;
}

.order-table tbody tr {
    transition: .2s;
}
.order-table tbody tr:hover {
    background-color: #f9fbff;
}

.nav-pills .nav-link {
    color: #0d6efd;
    background: #eef2ff;
}
.nav-pills .nav-link.active {
    background: #0d6efd;
    color: #fff;
}
</style>

@endsection
