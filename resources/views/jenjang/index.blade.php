@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
    <div id="app">
        <div class="container-xxl flex-grow-1 container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Data Jenjang</b>
                        <span class="text-muted fw-light">/ Manajemen Jenjang Pembelajaran</span>
                    </h2>
                </div>
                <div class="card mb-4">
                    <div class="container">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="{{ route('jenjang.create') }}">
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

                        <form action="{{ route('jenjang.index') }}" method="GET" class="mb-3">
                            <div class="form-group d-flex">
                                <input type="text" name="search" value="{{ request()->input('search') }}"
                                    class="form-control" placeholder="Cari jenjang...">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>

                        @if ($jenjangs->count() > 0)
                            <div class="table-responsive text-nowrap">
                                <br>
                                <table class="table table-hover align-content-center">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama jenjang</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="table-border-bottom-0 align-content-center">
                                        @foreach ($jenjangs as $jenjang)
                                            <tr>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong>{{ $loop->iteration }}</strong>
                                                </td>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong>{{ $jenjang->nama_jenjang }}</strong>
                                                </td>
                                                <td>
                                                    <a href="{{ route('jenjang.edit', $jenjang->id_jenjang) }}"
                                                        class="btn btn-warning btn-sm">&nbsp;
                                                        <i class="menu-icon tf-icons bx bx-edit"></i>
                                                    </a>&nbsp;&nbsp;
                                                    <form action="{{ route('jenjang.destroy', $jenjang->id_jenjang) }}"
                                                        method="POST" style="display:inline;"
                                                        onsubmit="return confirm('Yakin ingin menghapus?');">
                                                        <input type="hidden" name="_method" value="delete" />
                                                        {{ csrf_field() }}
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
                                {{ $jenjangs->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4') }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                Tidak ada data jenjang ditemukan.
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
