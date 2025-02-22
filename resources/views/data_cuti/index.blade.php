@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
    <div id="app">
        <div class="container-xxl flex-grow-1 container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Data Cuti</b>
                        <span class="text-muted fw-light">/ Manajemen Cuti</span>
                    </h2>
                    @if (Auth::user()->id_jabatan != 1 && Auth::user()->id_jabatan != 2)
                        <a href="{{ route('data_cuti.create') }}" class="btn btn-primary">Buat Pengajuan Cuti</a>
                    @endif
                </div>

                <div class="card mb-4">
                    <div class="container">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Filter tanggal -->
                        <form action="{{ route('data_cuti.index') }}" method="GET" class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="date" name="tanggal_mulai" value="{{ request()->input('tanggal_mulai') }}" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <input type="date" name="tanggal_selesai" value="{{ request()->input('tanggal_selesai') }}" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>

                        @if ($cuti->count() > 0)
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jenis Cuti</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Direktur</th>
                                            <th>Kepala Academy</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cuti as $c)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $c->user->name }}</td>
                                                <td>{{ $c->Jenis_Cuti->nama_jenis_cuti ?? '-' }}</td>
                                                <td>{{ $c->tanggal_mulai }}</td>
                                                <td>{{ $c->tanggal_selesai }}</td>
                                                <td>
                                                    <button class="btn btn-{{ $c->approved_by_director == 'approved' ? 'success' : ($c->approved_by_director == 'rejected' ? 'danger' : 'warning') }} btn-sm" disabled>
                                                        {{ ucfirst($c->approved_by_director) }}
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-{{ $c->approved_by_head_acdemy == 'approved' ? 'success' : ($c->approved_by_head_acdemy == 'rejected' ? 'danger' : 'warning') }} btn-sm" disabled>
                                                        {{ ucfirst($c->approved_by_head_acdemy) }}
                                                    </button>
                                                </td>
                                                <td>
                                                    <a href="{{ route('data_cuti.show', $c->id) }}" class="btn btn-info btn-sm">
                                                        <i class="menu-icon tf-icons bx bxs-detail"></i>
                                                    </a>

                                                    @if (Auth::id() == $c->id_user && $c->approved_by_director == 'pending' && $c->approved_by_head_acdemy == 'pending')
                                                        <a href="{{ route('data_cuti.edit', $c->id) }}" class="btn btn-warning btn-sm">
                                                            <i class="menu-icon tf-icons bx bx-edit"></i>
                                                        </a>
                                                        <form action="{{ route('data_cuti.destroy', $c->id) }}" method="POST" style="display:inline;" 
                                                            onsubmit="return confirm('Yakin ingin menghapus?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="menu-icon tf-icons bx bx-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif

                                                    @if (Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2)
                                                        @if ($c->approved_by_director == 'pending' || $c->approved_by_head_acdemy == 'pending')
                                                            <a href="{{ route('data_cuti.validasi', $c->id) }}" class="btn btn-success btn-sm">
                                                                <i class="menu-icon tf-icons bx bx-check-circle"></i> Validasi
                                                            </a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center my-4 pagination-wrapper">
                                {{ $cuti->appends(request()->all())->links('pagination::bootstrap-4') }}
                            </div>
                        @else
                            <div class="alert alert-info">Tidak ada data cuti ditemukan.</div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
