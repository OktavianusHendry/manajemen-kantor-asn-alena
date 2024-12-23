@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
    <div id="app">
        <div class="container-xxl flex-grow-1 container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Data Arsip File Berita Acara</b>
                        <span class="text-muted fw-light">/ Manajemen File Berita Acara</span>
                    </h2>
                </div>

                <div class="card mb-4">
                    <div class="container">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="{{ route('berita_acara.create') }}">
                                <button type="button" class="btn rounded-pill btn-primary mt-3 align-content-center">
                                    <i class="menu-icon tf-icons bx bxs-plus-circle"></i> Tambah
                                </button>
                            </a>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('berita_acara.index') }}" method="GET" class="mb-3">
                            <div class="form-group d-flex">
                                <input type="text" name="search" value="{{ request()->input('search') }}"
                                    class="form-control" placeholder="Cari laporan cuti...">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>

                        @if ($beritas->count() > 0)
                            <div class="table-responsive text-nowrap">
                                <br>
                                <table class="table table-hover align-content-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Isi</th>
                                            <th>File</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($beritas as $berita)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $berita->judul_berita }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($berita->isi_berita, 12) }}</td>
                                                <td>
                                                    @if ($berita->file)
                                                        <a href="{{ Storage::url($berita->file) }}" target="_blank"
                                                            class="btn btn-primary btn-sm">Lihat
                                                            File</a>
                                                    @else
                                                        Tidak ada file
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('berita_acara.show', $berita->id_berita) }}"
                                                        class="btn btn-info btn-sm">
                                                        &nbsp;<i
                                                            class="menu-icon tf-icons bx bxs-detail"></i></a>&nbsp;&nbsp;
                                                    <a href="{{ route('berita_acara.edit', $berita->id_berita) }}"
                                                        class="btn btn-warning btn-sm">
                                                        &nbsp;<i class="menu-icon tf-icons bx bx-edit"></i>
                                                    </a>&nbsp;&nbsp;
                                                    <form action="{{ route('berita_acara.destroy', $berita->id_berita) }}"
                                                        method="POST" style="display:inline;"
                                                        onsubmit="return confirm('Yakin ingin menghapus?');">
                                                        <input type="hidden" name="_method" value="delete" />
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            &nbsp; <i class="menu-icon tf-icons bx bx-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center my-4 pagination-wrapper">
                                {{ $beritas->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4') }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                Tidak ada data berita acara ditemukan.
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
