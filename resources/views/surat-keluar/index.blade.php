@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
    <div id="app">
        <div class="container-xxl flex-grow-1 container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Data Surat Keluar</b>
                        <span class="text-muted fw-light">/ Untuk instansi luar</span>
                    </h2>
                </div>
                <div class="card mb-4">
                    <div class="container">
                        @if (Auth::user()->role_as == '2' || Auth::user()->role_as == '1')
                            <div class="d-flex justify-content-between mb-3">
                                <a href="{{ route('surat-keluar.create') }}">
                                    <button type="button" class="btn rounded-pill btn-primary mt-3 align-content-center">
                                        <i class="menu-icon tf-icons bx bxs-plus-circle"></i>Tambah
                                    </button>
                                </a>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('surat-keluar.index') }}" method="GET" class="mb-3">
                            <div class="form-group d-flex">
                                <input type="text" name="search" value="{{ request()->input('search') }}"
                                    class="form-control" placeholder="Cari asal surat keluar...">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>

                        @if ($surat_keluar ?? false)
                        <div class="table-responsive text-nowrap">
                            <br>
                            <table class="table table-hover align-content-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>Tanggal Surat</th>
                                        <th>Perihal</th>
                                        <th>Tujuan Surat</th>
                                        <th>Status Validasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0 align-content-center">
                                    @foreach ($surat_keluar as $surat)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $surat->nomor_surat }}</td>
                                            <td>{{ $surat->tanggal_surat }}</td>
                                            <td>{{ implode(' ', array_slice(explode(' ', $surat->perihal), 0, 5)) }}{{ strlen($surat->perihal) > 5 ? '...' : '' }}</td>
                                            <td>{{ implode(' ', array_slice(explode(' ', $surat->tujuan_surat), 0, 5)) }}{{ strlen($surat->tujuan_surat) > 5 ? '...' : '' }}</td>
                                            <td>{{ $surat->status_validasi }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('surat-keluar.view', $surat->id_surat) }}" class="btn btn-success btn-sm">Lihat</a>
                                                    <a href="{{ route('surat-keluar.edit', $surat->id_surat) }}" class="btn btn-warning btn-sm">
                                                        <i class="menu-icon tf-icons bx bx-edit"></i>
                                                    </a>
                                                    <form action="{{ route('surat-keluar.delete', $surat->id_surat) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?');">
                                                            <i class="menu-icon tf-icons bx bx-trash"></i>
                                                        </button>
                                                    </form>

                                                    @if (Auth::user()->role_as == '1')
                                                        <a href="{{ route('surat-keluar.validasi', $surat->id_surat) }}" class="btn btn-success btn-sm">
                                                            Validasi
                                                        </a>
                                                        <a href="{{ route('surat-keluar.tolak', $surat->id_surat) }}" class="btn btn-danger btn-sm">
                                                            Tolak
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center my-4 pagination-wrapper">
                            {{ $surat_keluar->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4') }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            Tidak ada data surat keluar ditemukan.
                        </div>
                    @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection