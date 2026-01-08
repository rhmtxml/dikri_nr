@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-md-6 col-lg-5">

            <div class="card shadow border-0 rounded-4 overflow-hidden">

                {{-- ===== HEADER ===== --}}
                <div class="bg-primary text-white text-center p-4">
                    <div class="mb-2">
                        <i class="bi bi-envelope-check-fill fs-1"></i>
                    </div>
                    <h4 class="fw-bold mb-1">Verifikasi Email 📧</h4>
                    <p class="mb-0 opacity-75">
                        Hampir selesai! Satu langkah lagi
                    </p>
                </div>

                {{-- ===== BODY ===== --}}
                <div class="card-body p-4 text-center">

                    @if (session('resent'))
                        <div class="alert alert-success">
                            Link verifikasi baru telah dikirim ke email kamu.
                        </div>
                    @endif

                    <p class="mb-3">
                        Kami telah mengirimkan <strong>link verifikasi</strong> ke alamat email kamu.
                        <br>
                        Silakan cek inbox atau folder <em>spam</em>.
                    </p>

                    <p class="text-muted mb-4">
                        Belum menerima email?
                    </p>

                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary rounded-pill px-4">
                            Kirim Ulang Email Verifikasi
                        </button>
                    </form>

                    <hr class="my-4">

                    <p class="small text-muted mb-0">
                        Pastikan email yang kamu daftarkan benar ya 😊
                    </p>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
