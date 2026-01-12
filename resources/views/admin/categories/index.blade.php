{{-- resources/views/admin/categories/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10">

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- CARD --}}
        <div class="card dashboard-card shadow-sm">

            {{-- Header --}}
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center py-3">
                <h5 class="fw-bold text-primary mb-0">
                    <i class="bi bi-tags"></i> Daftar Kategori
                </h5>
                <button class="btn btn-primary btn-sm rounded-pill px-3"
                        data-bs-toggle="modal"
                        data-bs-target="#createModal">
                    <i class="bi bi-plus-lg"></i> Tambah Baru
                </button>
            </div>

            {{-- Body --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 category-table">
                        <thead>
                            <tr>
                                <th class="ps-4">Kategori</th>
                                <th class="text-center">Produk</th>
                                <th class="text-center">Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            @if($category->image)
                                                <img src="{{ Storage::url($category->image) }}"
                                                     class="rounded-3"
                                                     width="44"
                                                     height="44"
                                                     style="object-fit: cover;">
                                            @else
                                                <div class="placeholder-icon">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold">{{ $category->name }}</div>
                                                <small class="text-muted">{{ $category->slug }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-primary bg-opacity-10 text-primary">
                                            {{ $category->products_count }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        @if($category->is_active)
                                            <span class="badge bg-success bg-opacity-10 text-success">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                                Non-Aktif
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-end pe-4">
                                        <button
                                            class="btn btn-sm btn-outline-primary rounded-circle me-1 btn-edit"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-active="{{ $category->is_active }}"
                                            data-action="{{ route('admin.categories.update', $category) }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editCategoryModal">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <form action="{{ route('admin.categories.destroy', $category) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger rounded-circle">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        Belum ada kategori.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Footer --}}
            <div class="card-footer bg-transparent border-0">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>

{{-- ================= CREATE MODAL ================= --}}
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content rounded-4"
              action="{{ route('admin.categories.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Cover</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                    <label class="form-check-label">Aktifkan Kategori</label>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- ================= EDIT MODAL ================= --}}
<div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content rounded-4"
              method="POST"
              enctype="multipart/form-data"
              id="editCategoryForm">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" id="edit-name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar (Opsional)</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" id="edit-active" value="1">
                    <label class="form-check-label">Aktif</label>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- ================= SCRIPT (TIDAK DIUBAH) ================= --}}
<script>
document.querySelectorAll('.btn-edit').forEach(button => {
    button.addEventListener('click', function () {
        document.getElementById('edit-name').value = this.dataset.name;
        document.getElementById('edit-active').checked = this.dataset.active == 1;
        document.getElementById('editCategoryForm').action = this.dataset.action;
    });
});
</script>

{{-- ================= STYLE ================= --}}
<style>
.dashboard-card {
    border-radius: 1.25rem;
}

.category-table thead {
    background: #f8f9fc;
}

.placeholder-icon {
    width: 44px;
    height: 44px;
    border-radius: .75rem;
    background: #eef2ff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0d6efd;
}

.category-table tbody tr {
    transition: .2s;
}
.category-table tbody tr:hover {
    background-color: #f9fbff;
}
</style>

@endsection
