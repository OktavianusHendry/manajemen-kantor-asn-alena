@extends(Auth::user()->role_as == '0' ? 'layoutsss.template' : 'layoutss.template')

@section('content')
    <div id="app">
        <div class="container-xxl flex-grow-1 container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Data Arsip Pembelajaran</b>
                        <span class="text-muted fw-light">/ Untuk Mentor</span>
                    </h2>
                </div>
                <div class="card mb-4">
                    <div class="container">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="{{ route('arsip_pembelajaran.create') }}">
                                <button type="button" class="btn rounded-pill btn-primary mt-3 align-content-center">
                                    <i class="menu-icon tf-icons bx bxs-plus-circle"></i>Tambah
                                </button>
                            </a>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('arsip_pembelajaran.index') }}" method="GET" class="mb-1">
                            <div class="row">
                                <!-- Dropdown filter berdasarkan id_jenjang -->
                                <div class="col-md-2 mb-3 mr-1">
                                    <select name="id_jenjang" class="form-select" onchange="this.form.submit()">
                                        <option value="">-- Pilih Jenjang --</option>
                                        @foreach ($jenjangs as $jenjang)
                                            <option value="{{ $jenjang->id_jenjang }}"
                                                {{ request('id_jenjang') == $jenjang->id_jenjang ? 'selected' : '' }}>
                                                {{ $jenjang->nama_jenjang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2 mb-3 mr-1">
                                    <select name="id_kategori" class="form-select" onchange="this.form.submit()">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id_kategori }}"
                                                {{ request('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2 mb-3 mr-1">
                                    <select name="id_sub_kategori" class="form-select" onchange="this.form.submit()">
                                        <option value="">-- Pilih Sub Kategori --</option>
                                        @foreach ($sub_kategoris as $sub_kategori)
                                            <option value="{{ $sub_kategori->id_sub_kategori }}"
                                                {{ request('id_sub_kategori') == $sub_kategori->id_sub_kategori ? 'selected' : '' }}>
                                                {{ $sub_kategori->nama_sub_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Kolom pencarian -->
                                <div class="col-md-6 mb-1">
                                    <div class="form-group d-flex">
                                        <input type="text" name="search" value="{{ request()->input('search') }}"
                                            class="form-control"
                                            placeholder="Cari berdasarkan judul dan pertemuan ke berapa ...">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        @if ($arsips->count() > 0)
                            <div class="table-responsive text-nowrap">
                                <br>
                                <table class="table table-hover align-content-center">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Judul Pembelajaran</th>
                                            <th>Jenjang</th>
                                            <th>Kelas</th>
                                            <th>Kategori</th>
                                            <th>Sub Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0 align-content-center">
                                        @foreach ($arsips as $arsip)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $arsip->judul_pembelajaran }}</td>
                                                <td>{{ $arsip->jenjang->nama_jenjang }}</td>
                                                <td>{{ $arsip->kelas }}</td>
                                                <td>{{ $arsip->kategori->nama_kategori }}</td>
                                                <td>{{ $arsip->sub_kategori->nama_sub_kategori }}</td>
                                                <td>
                                                    <a href="{{ route('arsip_pembelajaran.show', $arsip->id_arsip_pembelajaran) }}"
                                                        class="btn btn-info btn-sm">Detail</a>&nbsp;&nbsp;
                                                    <a href="{{ route('arsip_pembelajaran.edit', $arsip->id_arsip_pembelajaran) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="menu-icon tf-icons bx bx-edit"></i>
                                                    </a>

                                                    &nbsp;&nbsp;
                                                    <form
                                                        action="{{ route('arsip_pembelajaran.destroy', $arsip->id_arsip_pembelajaran) }}"
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
                                {{ $arsips->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4') }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                Tidak ada data pembelajaran ditemukan.
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection

<style>
    .pagination-wrapper .pagination {
        display: flex;
        justify-content: center;
        padding: 1rem 0;
    }

    .pagination-wrapper .pagination li {
        margin: 0 0.25rem;
    }

    .pagination-wrapper .pagination li a,
    .pagination-wrapper .pagination li span {
        color: #007bff;
        padding: 0.5rem 0.75rem;
        text-decoration: none;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }

    .pagination-wrapper .pagination li a:hover,
    .pagination-wrapper .pagination li span:hover {
        background-color: #e9ecef;
    }

    .pagination-wrapper .pagination li.active span {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination-wrapper .pagination li.disabled span {
        color: #6c757d;
    }
</style>
