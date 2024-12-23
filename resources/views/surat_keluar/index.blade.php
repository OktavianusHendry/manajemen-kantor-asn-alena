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
                        <div class="d-flex justify-content-between mb-3">
                        </div>
                        @if (Auth::user()->role_as == '2')
                            <div class="d-flex justify-content-between mb-3">
                                <a href="{{ route('surat_keluar.create') }}">
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

                        <form action="{{ route('surat_keluar.index') }}" method="GET" class="mb-3">
                            <div class="form-group d-flex">
                                <input type="text" name="search" value="{{ request()->input('search') }}"
                                    class="form-control" placeholder="Cari asal surat keluar...">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                            <div class="form-group d-flex mt-3">
                                <button type="submit" name="sifat_surat" value="Formal"
                                    class="btn btn-secondary {{ request()->input('sifat_surat') === 'Formal' ? 'active' : '' }}">
                                    Formal
                                </button>&nbsp;&nbsp;
                                <button type="submit" name="sifat_surat" value="Bisnis"
                                    class="btn btn-secondary {{ request()->input('sifat_surat') === 'Bisnis' ? 'active' : '' }}">
                                    Bisnis
                                </button>&nbsp;&nbsp;
                                <button type="submit" name="sifat_surat" value="Resmi"
                                    class="btn btn-secondary {{ request()->input('sifat_surat') === 'Resmi' ? 'active' : '' }}">
                                    Resmi
                                </button>&nbsp;&nbsp;
                                <a href="{{ route('surat_keluar.index') }}" class="btn btn-danger ml-2">
                                    &nbsp;<i class="menu-icon tf-icons bx bx-arrow-back"></i>
                                </a>
                            </div>
                        </form>

                        @if ($surat_keluars->count() > 0)
                            <div class="table-responsive text-nowrap">
                                <br>
                                <table class="table table-hover align-content-center">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kirim Surat ke-</th>
                                            <th>Sifat Surat</th>
                                            <th>Status Surat</th>
                                            <th>Catatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0 align-content-center">
                                        @foreach ($surat_keluars as $surat_keluar)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ strlen($surat_keluar->instansi->nama_instansi) > 20 ? substr($surat_keluar->instansi->nama_instansi, 0, 20) . '...' : $surat_keluar->instansi->nama_instansi }}
                                                </td>
                                                <td>{{ $surat_keluar->sifat_surat_keluar }}</td>
                                                <td>
                                                    @if ($surat_keluar->status_surat == 'Approved')
                                                        <button class="btn btn-success btn-sm disabled">Telah
                                                            Disetujui</button>
                                                    @elseif ($surat_keluar->status_surat == 'Rejected')
                                                        <button class="btn btn-danger btn-sm disabled">Ditolak</button>
                                                    @elseif ($surat_keluar->status_surat == 'Pending')
                                                        <button class="btn btn-warning btn-sm disabled">Pending</button>
                                                    @endif
                                                </td>

                                                @if ($surat_keluar->status_surat == 'Rejected')
                                                    <td><b>{{ $surat_keluar->catatan_surat }}</b></td>
                                                @else
                                                    <td> - </td>
                                                @endif

                                                <td>
                                                    @if ($surat_keluar->file_surat)
                                                        <a href="{{ asset('storage/' . $surat_keluar->file_surat) }}"
                                                            target="_blank"
                                                            class="btn btn-success btn-sm">Unduh</a>&nbsp;&nbsp;
                                                    @else
                                                        Tidak ada dokumen
                                                    @endif
                                                    <a href="{{ route('surat_keluar.show', $surat_keluar->id_surat_keluar) }}"
                                                        class="btn btn-info btn-sm">Detail</a>&nbsp;&nbsp;
                                                    <a href="{{ route('surat_keluar.edit', $surat_keluar->id_surat_keluar) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="menu-icon tf-icons bx bx-edit"></i>
                                                    </a>

                                                    &nbsp;&nbsp;
                                                    <form
                                                        action="{{ route('surat_keluar.destroy', $surat_keluar->id_surat_keluar) }}"
                                                        method="POST" style="display:inline;"
                                                        onsubmit="return confirm('Yakin ingin menghapus?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            &nbsp;<i class="menu-icon tf-icons bx bx-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center my-4 pagination-wrapper">
                                {{ $surat_keluars->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4') }}
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
