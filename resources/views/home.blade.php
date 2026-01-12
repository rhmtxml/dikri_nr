{{-- =====================================================
 FILE   : resources/views/home.blade.php
 FUNGSI : Halaman utama website
 TEMA   : Kantin Sekolah Kekinian (Biru Dominan)
===================================================== --}}

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<style>

/* ================= PREMIUM PAGE ANIMATION ================= */

/* easing profesional */
:root {
    --ease-smooth: cubic-bezier(0.22, 1, 0.36, 1);
}

/* animasi utama */
@keyframes smoothReveal {
    from {
        opacity: 0;
        transform: translateY(32px) scale(.96);
        filter: blur(4px);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
        filter: blur(0);
    }
}

/* ================= HERO ================= */
.hero-kantin .col-lg-6 {
    opacity: 0;
    animation: smoothReveal 1.1s var(--ease-smooth) forwards;
}

.hero-kantin .col-lg-6:first-child {
    animation-delay: .2s;
}

.hero-kantin .col-lg-6:last-child {
    animation-delay: .4s;
}

/* ================= CONTENT WRAPPER ================= */
.content-wrapper > section {
    opacity: 0;
    animation: smoothReveal 1s var(--ease-smooth) forwards;
}

.content-wrapper > section:nth-child(1) { animation-delay: .25s; }
.content-wrapper > section:nth-child(2) { animation-delay: .45s; }
.content-wrapper > section:nth-child(3) { animation-delay: .65s; }
.content-wrapper > section:nth-child(4) { animation-delay: .85s; }

/* ================= CARD ANIMATION ================= */
.category-card,
.product-card {
    opacity: 0;
    animation: smoothReveal .8s var(--ease-smooth) forwards;
}

/* stagger otomatis grid */
.category-card:nth-child(1),
.product-card:nth-child(1) { animation-delay: .1s; }
.category-card:nth-child(2),
.product-card:nth-child(2) { animation-delay: .18s; }
.category-card:nth-child(3),
.product-card:nth-child(3) { animation-delay: .26s; }
.category-card:nth-child(4),
.product-card:nth-child(4) { animation-delay: .34s; }
.category-card:nth-child(5),
.product-card:nth-child(5) { animation-delay: .42s; }
.category-card:nth-child(6),
.product-card:nth-child(6) { animation-delay: .5s; }

/* ================= HOVER LEBIH HALUS ================= */
.category-card,
.product-card,
.promo-card {
    transition: transform .6s var(--ease-smooth),
                box-shadow .6s var(--ease-smooth);
}

.category-card:hover,
.product-card:hover {
    transform: translateY(-12px) scale(1.03);
}

/* ================= ROOT ================= */
:root {
    --blue-strong: #0a58ca;
    --blue-main: #0d6efd;
    --blue-glow: #3b82f6;
    --blue-soft: #dbeafe;
    --blue-bg: #eaf2ff;
}

html, body {
    margin: 0;
    padding: 0;
    background: #0d6efd;
}

/* ================= HERO ================= */
.hero-kantin {
    position: relative;
    overflow: hidden;
    background: url('/images/banner-snack.jpg') center / cover no-repeat;
}

.hero-kantin::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        rgba(10,88,202,.85),
        rgba(13,110,253,.85),
        rgba(59,130,246,.85)
    );
    z-index: 1;
}

/* LENGKUNGAN BAWAH HERO */
.hero-kantin::after {
    content: '';
    position: absolute;
    bottom: -80px;
    left: 0;
    width: 100%;
    height: 160px;
    background: var(--blue-bg);
    border-radius: 100% 100% 0 0;
    z-index: 2;
}

.hero-kantin .container {
    position: relative;
    z-index: 3;
}

.hero-kantin img {
    max-height: 380px;
    animation: floatHero 4s ease-in-out infinite;
    filter: drop-shadow(0 20px 35px rgba(0,0,0,.25));
}

@keyframes floatHero {
    0%   { transform: translateY(0); }
    50%  { transform: translateY(-20px); }
    100% { transform: translateY(0); }
}

/* ================= CONTENT WRAPPER (MENYATU) ================= */
.content-wrapper {
    background: var(--blue-bg);
    margin-top: -90px;
    padding-top: 110px;
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
    margin: 10px auto 0;
    background: linear-gradient(to right, #0a58ca, #3b82f6);
    border-radius: 20px;
}

/* ================= KATEGORI ================= */
.section-kategori,
.bg-light,
.promo-section {
    background: transparent !important;
}

.category-card {
    border: none;
    border-radius: 1.75rem;
    background: linear-gradient(160deg, #dbeafe, #ffffff);
    transition: .35s ease;
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
    transition: .35s ease;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 45px rgba(13,110,253,.35);
}

/* ================= PROMO ================= */
.promo-card {
    padding: 2.5rem;
    border-radius: 20px;
    color: #fff;
    position: relative;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(13,110,253,.25);
}

.promo-sale {
    background: url('/images/banner-promo-snack.jpg') center / cover no-repeat;
}

.promo-sale::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        rgba(10,88,202,.75),
        rgba(13,110,253,.75)
    );
}

.promo-content {
    position: relative;
    z-index: 2;
}

.promo-badge {
    display: inline-block;
    background: #fff;
    color: #0d6efd;
    font-weight: 700;
    padding: .35rem .9rem;
    border-radius: 999px;
    margin-bottom: 1rem;
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
                <h1 class="display-4 fw-bold mb-3">Jajan Online Kantin Sekolah</h1>
                <p class="lead mb-4">
                    Snack favorit siswa • Harga ramah • Praktis & cepat 🍟🥤
                </p>
                <a href="{{ route('catalog.index') }}" class="btn btn-light btn-lg">
                    <i class="bi bi-bag me-2"></i>Mulai Jajan
                </a>
            </div>

            <div class="col-lg-6 d-none d-lg-block text-center">
                <img src="{{ asset('images/hero-snack.png') }}" class="img-fluid">
            </div>
        </div>
    </div>
</section>

{{-- ================= SEMUA MENYATU ================= --}}
<section class="content-wrapper">

    {{-- KATEGORI --}}
    <section class="py-5 section-kategori">
        <div class="container text-center">
            <h2 class="section-title mb-5">Kategori Snack Sekolah</h2>
            <div class="row g-4 justify-content-center">
                @foreach($categories as $category)
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="text-decoration-none text-dark">
                            <div class="card category-card h-100">
                                <div class="card-body">
                                    <img src="{{ $category->image_url }}" class="rounded-circle mb-3" width="80" height="80">
                                    <h6 class="fw-semibold">{{ $category->name }}</h6>
                                    <small class="text-muted">{{ $category->products_count }} produk</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- PRODUK FAVORIT --}}
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between mb-4">
                <h2 class="fw-bold">Produk Favorit</h2>
                <a href="{{ route('catalog.index') }}" class="btn btn-outline-primary">Lihat Semua</a>
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

    {{-- PROMO --}}
    <section class="py-5">
        <div class="container">
            <div class="promo-card promo-sale text-center">
                <div class="promo-content">
                    <span class="promo-badge">🎉 Promo Kantin</span>
                    <h3 class="display-6 fw-bold">Diskon Snack Sekolah</h3>
                    <p>Hemat jajan favoritmu hari ini!</p>
                    <a href="{{ route('catalog.index', ['on_sale' => 1]) }}" class="btn btn-light fw-semibold">
                        Lihat Promo
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- PRODUK TERBARU --}}
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

</section>

@endsection
