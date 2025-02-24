@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4">
        <h3 class="fw-bold text-center mb-4">Biodata Karyawan</h3>

        <!-- Informasi User & Biodata -->
        <div class="row">
            <!-- Kolom User -->
            <div class="col-md-6">
                <div class="card p-3 border-0 shadow-sm">
                    <h5 class="fw-bold text-primary">Informasi User</h5>
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <td>: {{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: {{ $user->alamat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>No Telepon</th>
                            <td>: {{ $user->no_telepon ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>: {{ $user->jabatan->nama_jabatan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Divisi</th>
                            <td>: {{ $user->divisi->nama_divisi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Bergabung</th>
                            <td>: {{ date('d M Y', strtotime($user->tanggal_bergabung)) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Kolom Biodata -->
            <div class="col-md-6">
                <div class="card p-3 border-0 shadow-sm">
                    <h5 class="fw-bold text-primary">Informasi Biodata</h5>
                    <table class="table">
                        <tr>
                            <th>NIP</th>
                            <td>: {{ $biodata->nip ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>: {{ $biodata->nama_lengkap ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>: {{ $biodata->nik ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td>: {{ $biodata->tempat_lahir ?? '-' }}, {{ $biodata->tanggal_lahir ? date('d M Y', strtotime($biodata->tanggal_lahir)) : '-' }}</td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td>: {{ $biodata->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                : <span class="badge bg-{{ $biodata->status == 'aktif' ? 'success' : ($biodata->status == 'cuti' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($biodata->status) }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Section Tambahan -->
        <div class="mt-4">
            <div class="card p-3 border-0 shadow-sm">
                <h5 class="fw-bold text-primary">Menu Lainnya</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{ route('data_cuti.index') }}" class="text-decoration-none">📅 Riwayat Cuti</a></li>
                    <li class="list-group-item"><a href="{{ route('berita_acara.index') }}" class="text-decoration-none">📰 Berita Acara</a></li>
                    <li class="list-group-item"><a href="##" class="text-decoration-none">⚙️ Pengaturan</a></li>
                </ul>
            </div>
        </div>

        <!-- Tombol Edit -->
        <div class="text-center mt-4">
            <a href="{{ route('biodata.edit', $user->id) }}" class="btn btn-primary px-4">
                <i class="bx bx-edit"></i> Edit Data
            </a>
        </div>
    </div>
</div>
@endsection
