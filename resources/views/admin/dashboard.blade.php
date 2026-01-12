@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

{{-- ================= DASHBOARD STATS ================= --}}
<div class="row g-4 mb-4">

    {{-- Total Pendapatan --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-primary text-white shadow-lg">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-uppercase opacity-75">Total Pendapatan</small>
                    <h4 class="fw-bold mt-1">
                        Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
                    </h4>
                </div>
                <i class="bi bi-wallet2 fs-1 opacity-75"></i>
            </div>
        </div>
    </div>

    {{-- Pending --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-info text-white shadow-lg">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-uppercase opacity-75">Perlu Diproses</small>
                    <h4 class="fw-bold mt-1">{{ $stats['pending_orders'] }}</h4>
                </div>
                <i class="bi bi-box-seam fs-1 opacity-75"></i>
            </div>
        </div>
    </div>

    {{-- Stok Menipis --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-danger text-white shadow-lg">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-uppercase opacity-75">Stok Menipis</small>
                    <h4 class="fw-bold mt-1">{{ $stats['low_stock'] }}</h4>
                </div>
                <i class="bi bi-exclamation-triangle fs-1 opacity-75"></i>
            </div>
        </div>
    </div>

    {{-- Total Produk --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-secondary text-white shadow-lg">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-uppercase opacity-75">Total Produk</small>
                    <h4 class="fw-bold mt-1">{{ $stats['total_products'] }}</h4>
                </div>
                <i class="bi bi-tags fs-1 opacity-75"></i>
            </div>
        </div>
    </div>

</div>

{{-- ================= CHART & ORDERS ================= --}}
<div class="row g-4">

    {{-- Chart --}}
    <div class="col-lg-8">
        <div class="card dashboard-card shadow-sm h-100">
            <div class="card-header bg-transparent border-0">
                <h5 class="fw-bold text-primary mb-0">
                    <i class="bi bi-graph-up"></i> Grafik Penjualan (7 Hari)
                </h5>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="110"></canvas>
            </div>
        </div>
    </div>

    {{-- Pesanan Terbaru --}}
    <div class="col-lg-4">
        <div class="card dashboard-card shadow-sm h-100">
            <div class="card-header bg-transparent border-0">
                <h5 class="fw-bold text-primary mb-0">
                    <i class="bi bi-clock-history"></i> Pesanan Terbaru
                </h5>
            </div>

            <div class="list-group list-group-flush">
                @foreach($recentOrders as $order)
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div>
                            <div class="fw-bold text-primary">#{{ $order->order_number }}</div>
                            <small class="text-muted">{{ $order->user->name }}</small>
                        </div>
                        <div class="text-end">
                            <div class="fw-semibold">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </div>
                            <span class="badge rounded-pill
                                {{ $order->payment_status == 'paid'
                                    ? 'bg-success bg-opacity-10 text-success'
                                    : 'bg-secondary bg-opacity-10 text-secondary' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card-footer bg-transparent border-0 text-center">
                <a href="{{ route('admin.orders.index') }}" class="fw-bold text-primary text-decoration-none">
                    Lihat Semua Pesanan →
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ================= PRODUK TERLARIS ================= --}}
<div class="card dashboard-card shadow-sm mt-4">
    <div class="card-header bg-transparent border-0">
        <h5 class="fw-bold text-primary mb-0">
            <i class="bi bi-star-fill"></i> Produk Terlaris
        </h5>
    </div>
    <div class="card-body">
        <div class="row g-4">
            @foreach($topProducts as $product)
                <div class="col-6 col-md-2">
                    <div class="product-card text-center">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        <h6 class="mt-2 text-truncate">{{ $product->name }}</h6>
                        <small class="text-muted">{{ $product->sold }} terjual</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ================= CHART SCRIPT ================= --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('revenueChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($revenueChart->pluck('date')) !!},
        datasets: [{
            data: {!! json_encode($revenueChart->pluck('total')) !!},
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13,110,253,.15)',
            tension: .4,
            fill: true,
            pointRadius: 4
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            y: {
                ticks: {
                    callback: v => 'Rp ' + new Intl.NumberFormat('id-ID').format(v)
                }
            }
        }
    }
});
</script>

{{-- ================= CUSTOM STYLE ================= --}}
<style>
.stat-card {
    border-radius: 1rem;
    transition: .3s;
}
.stat-card:hover {
    transform: translateY(-5px);
}

.dashboard-card {
    border-radius: 1rem;
}

.product-card {
    background: #fff;
    border-radius: 1rem;
    padding: 1rem;
    transition: .3s;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,.08);
}
.product-card img {
    max-height: 90px;
    object-fit: cover;
    border-radius: .75rem;
}
</style>

@endsection
