@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">BERITA ACARA</h2>
        <a href="{{ route('berita-acara.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Buat Berita Acara
        </a>
    </div>

    <!-- Form Pencarian -->
    <form action="{{ route('berita-acara.index') }}" method="GET" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request()->input('search') }}" class="form-control"
                   placeholder="Cari berdasarkan judul, deskripsi, atau tanggal...">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-search"></i> Cari
            </button>
        </div>
    </form>

    <!-- Tabel Data Berita Acara -->
    <div class="card shadow-sm p-3">
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead class="table-secondary">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritaAcara as $key => $ba)
                        <tr>
                            <td>{{ $beritaAcara->firstItem() + $key }}</td>
                            <td>{{ $ba->judul }}</td>
                            <td>{{ date('d M Y', strtotime($ba->tanggal)) }}</td>
                            <td>
                                <button class="btn btn-{{ $ba->approved_by_director == 'approved' ? 'success' : ($ba->approved_by_director == 'rejected' ? 'danger' : 'warning') }} btn-sm" disabled>
                                    {{ ucfirst($ba->approved_by_director) }}
                                </button>
                            </td>
                            <td>
                                <a href="{{ route('berita-acara.show', $ba->id) }}" class="btn btn-info btn-sm">
                                    <i class="bx bx-detail"></i> Detail
                                </a>
                                @if ($ba->approved_by_director == 'pending')
                                    <a href="{{ route('berita-acara.edit', $ba->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bx bx-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('berita-acara.destroy', $ba->id) }}" method="POST" style="display:inline;" 
                                        onsubmit="return confirm('Yakin ingin menghapus berita acara ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bx bx-trash"></i> Hapus
                                        </button>
                                    </form>
                                @endif

                                @if(Auth::user()->id_jabatan == 1)
                                    <a href="{{ route('berita-acara.showValidate', $ba->id) }}" class="btn btn-success btn-sm">
                                        <i class="bx bx-check-circle"></i> Validasi
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $beritaAcara->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
