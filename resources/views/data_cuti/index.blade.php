@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
    <div id="app">
        <div class="container-xxl flex-grow-1 container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-0">Data Cuti</h2>
                    @if (Auth::user()->id_jabatan != 1 && Auth::user()->id_jabatan != 2)
                        <a href="{{ route('data_cuti.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus"></i> Buat Pengajuan Cuti
                        </a>
                    @endif
                </div>

                <div class="card p-3 shadow-sm">
                    <div class="container">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Filter Form -->
                        <form action="{{ route('data_cuti.index') }}" method="GET" class="row g-2 mb-4">
                            <div class="col-md-4">
                                <input type="text" name="search" value="{{ request()->input('search') }}" class="form-control"
                                    placeholder="Cari nama atau jenis cuti...">
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="tanggal_mulai" value="{{ request()->input('tanggal_mulai') }}" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="tanggal_selesai" value="{{ request()->input('tanggal_selesai') }}" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bx bx-search"></i> Cari
                                </button>
                            </div>
                        </form>

                        @if ($cuti->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-striped align-middle">
                                    <thead class="table-secondary text-center">
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
                                    <tbody class="text-center">
                                        @foreach ($cuti as $c)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $c->user->name }}</td>
                                                <td>{{ $c->Jenis_Cuti->nama_jenis_cuti ?? '-' }}</td>
                                                <td>{{ date('d M Y', strtotime($c->tanggal_mulai)) }}</td>
                                                <td>{{ date('d M Y', strtotime($c->tanggal_selesai)) }}</td>
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
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <a href="{{ route('data_cuti.show', $c->id) }}" class="btn btn-info btn-sm" title="Detail">
                                                            <i class="bx bxs-detail"></i>
                                                        </a>

                                                        @if (Auth::id() == $c->id_user && $c->approved_by_director == 'pending' && $c->approved_by_head_acdemy == 'pending')
                                                            <a href="{{ route('data_cuti.edit', $c->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                                <i class="bx bx-edit"></i>
                                                            </a>
                                                            <form action="{{ route('data_cuti.destroy', $c->id) }}" method="POST" style="display:inline;" 
                                                                onsubmit="return confirm('Yakin ingin menghapus?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif

                                                        <!-- Tombol Validasi untuk Direktur dan Kepala Academy -->
                                                        @if (Auth::user()->role_as == '1' || Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2)
                                                            <a href="{{ route('data_cuti.validasi', $c->id) }}" class="btn btn-success btn-sm" title="Validasi">
                                                                <i class="bx bx-check-circle"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                {{ $cuti->appends(request()->all())->links('pagination::bootstrap-4') }}
                            </div>
                        @else
                            <div class="alert alert-info text-center mt-3">Tidak ada data cuti ditemukan.</div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
