{{-- ================================================
 FILE: resources/views/home.blade.php
 FUNGSI: Halaman utama website
 TEMA: Kantin Sekolah Kekinian (Biru Dominan)
================================================ --}}

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<style>
html, body {
    background: #0d6efd; /* sama dengan navbar */
    margin: 0;
    padding: 0;
}

:root {
    --blue-strong: #0a58ca;
    --blue-main: #0d6efd;
    --blue-glow: #3b82f6;
    --blue-soft: #dbeafe;
    --blue-bg: #eaf2ff;
}

/* ================= HERO ================= */
.hero-kantin {
    background: linear-gradient(135deg, #0a58ca, #0d6efd, #3b82f6);
    position: relative;
    overflow: hidden;
}
.hero-kantin::after {
    content: '';
    position: absolute;
    bottom: -70px;
    left: 0;
    width: 100%;
    height: 140px;
    background: var(--blue-bg);
    border-radius: 100% 100% 0 0;
}

/* ================= SECTION TITLE ================= */
.section-title {
    font-weight: 800;
    color: var(--blue-strong);
}
.section-title::after {
    content: '';
    display: block;
    width: 70%;
    height: 5px;
    background: linear-gradient(to right, #0a58ca, #3b82f6);
    margin: 10px auto 0;
    border-radius: 20px;
}

/* ================= KATEGORI ================= */
.section-kategori {
    background: var(--blue-bg);
}

.category-card {
    border: none;
    border-radius: 1.75rem;
    background: linear-gradient(160deg, #dbeafe, #ffffff);
    transition: .35s;
}
.category-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 18px 40px rgba(13,110,253,.35);
}

.category-card img {
    background: #fff;
    padding: 10px;
    border: 3px solid var(--blue-main);
}

/* ================= PRODUK ================= */
.product-card {
    border-radius: 1.75rem;
    background: linear-gradient(180deg, #ffffff, #f1f7ff);
    transition: .35s;
}
.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 45px rgba(13,110,253,.35);
}

/* ================= SECTION BG ================= */
.bg-light {
    background: var(--blue-bg) !important;
}

/* ================= BUTTON ================= */
.btn-primary {
    background: linear-gradient(to right, #0a58ca, #0d6efd);
    border: none;
}
.btn-outline-primary {
    border: 2px solid #0d6efd;
    font-weight: 600;
}
</style>

{{-- ================= HERO ================= --}}
<section class="hero-kantin text-white py-5">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3">
                    Jajan Online Kantin Sekolah
                </h1>
                <p class="lead mb-4">
                    Snack favorit siswa • Harga ramah • Praktis & cepat 🍟🥤
                </p>
                <a href="{{ route('catalog.index') }}" class="btn btn-light btn-lg">
                    <i class="bi bi-bag me-2"></i>Mulai Jajan
                </a>
            </div>

            <div class="col-lg-6 d-none d-lg-block text-center">
                <img src="{{ asset('images/hero-snack.png') }}"
                     class="img-fluid"
                     style="max-height: 380px;">
            </div>
        </div>
    </div>
</section>

{{-- ================= KATEGORI ================= --}}
<section class="py-5 section-kategori">
    <div class="container text-center">
        <h2 class="section-title mb-5">Kategori Snack Sekolah</h2>

        <div class="row g-4 justify-content-center">
            @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('catalog.index', ['category' => $category->slug]) }}"
                       class="text-decoration-none text-dark">
                        <div class="card category-card h-100">
                            <div class="card-body">
                                <img src="{{ $category->image_url }}"
                                     class="rounded-circle mb-3"
                                     width="80" height="80">
                                <h6 class="fw-semibold mb-1">{{ $category->name }}</h6>
                                <small class="text-muted">{{ $category->products_count }} produk</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= PRODUK UNGGULAN ================= --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between mb-4">
            <h2 class="fw-bold">Produk Favorit</h2>
            <a href="{{ route('catalog.index') }}" class="btn btn-outline-primary">
                Lihat Semua
            </a>
        </div>

        <div class="row g-4">
            @foreach($featuredProducts as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= PRODUK TERBARU ================= --}}
<section class="py-5 section-kategori">
    <div class="container">
        <h2 class="text-center section-title mb-4">Produk Terbaru</h2>

        <div class="row g-4">
            @foreach($latestProducts as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
