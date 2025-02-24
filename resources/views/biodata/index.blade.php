@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4">
        <h3 class="fw-bold text-center mb-4">Biodata Karyawan</h3>
        <!-- Kolom User -->
        <div class="card p-3 border-0 shadow-sm">
            <h5 class="fw-bold text-primary">Informasi User</h5>
            <table class="table">
                <tr><th>Nama</th><td>: {{ $user->name }}</td></tr>
                <tr><th>Email</th><td>: {{ $user->email }}</td></tr>
                <tr><th>No Telepon</th><td>: {{ $user->no_telepon ?? '-' }}</td></tr>
                <tr><th>Jabatan</th><td>: {{ $user->jabatan->nama_jabatan ?? '-' }}</td></tr>
                <tr><th>Divisi</th><td>: {{ $user->divisi->nama_divisi ?? '-' }}</td></tr>
                <tr><th>Status</th>
                    <td>
                        : <span class="badge bg-{{ $biodata->status == 'aktif' ? 'success' : ($biodata->status == 'cuti' ? 'warning' : 'danger') }}">
                            {{ ucfirst($biodata->status) }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
        <br/>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="biodataTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="biodata-tab" data-bs-toggle="tab" data-bs-target="#biodata" type="button" role="tab" aria-controls="biodata" aria-selected="true">📄 Biodata Pribadi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="absensi-tab" data-bs-toggle="tab" data-bs-target="#absensi" type="button" role="tab" aria-controls="absensi" aria-selected="false">📊 Absensi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="cuti-tab" data-bs-toggle="tab" data-bs-target="#cuti" type="button" role="tab" aria-controls="cuti" aria-selected="false">📅 Riwayat Cuti</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="manajemen_berkas-tab" data-bs-toggle="tab" data-bs-target="#manajemen_berkas" type="button" role="tab" aria-controls="manajemen_berkas" aria-selected="false">📰 Manajemen Berkas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="berita-tab" data-bs-toggle="tab" data-bs-target="#berita" type="button" role="tab" aria-controls="berita" aria-selected="false">📰 Berita Acara</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pengaturan-tab" data-bs-toggle="tab" data-bs-target="#pengaturan" type="button" role="tab" aria-controls="pengaturan" aria-selected="false">⚙️ Pengaturan</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3" id="biodataTabContent">
            <!-- Tab Biodata -->
            <div class="tab-pane fade show active" id="biodata" role="tabpanel" aria-labelledby="biodata-tab">
                <div class="row">
                    <!-- Kolom Biodata -->
                        <div class="card p-3 border-0 shadow-sm">
                            <h5 class="fw-bold text-primary">Informasi Biodata</h5>
                            <table class="table">
                                <tr><th>NIP</th><td>: {{ $biodata->nip ?? '-' }}</td></tr>
                                <tr><th>Nama Lengkap</th><td>: {{ $biodata->nama_lengkap ?? '-' }}</td></tr>
                                <tr><th>NIK</th><td>: {{ $biodata->nik ?? '-' }}</td></tr>
                                <tr><th>Tempat, Tanggal Lahir</th><td>: {{ $biodata->tempat_lahir ?? '-' }}, {{ $biodata->tanggal_lahir ? date('d M Y', strtotime($biodata->tanggal_lahir)) : '-' }}</td></tr>
                                <tr><th>No HP</th><td>: {{ $biodata->no_hp ?? '-' }}</td></tr>
                                <tr><th>Alamat</th><td>: {{ $biodata->alamat ?? '-' }}</td></tr>
                                <tr><th>Jabatan</th><td>: {{ $user->jabatan->nama_jabatan ?? '-' }}</td></tr>
                                <tr><th>Divisi</th><td>: {{ $user->divisi->nama_divisi ?? '-' }}</td></tr>
                                <tr><th>Tanggal Bergabung</th><td>: {{ date('d M Y', strtotime($user->tanggal_bergabung)) }}</td></tr>

                                <!-- Foto KTP -->
                                <tr>
                                    <th>Foto KTP</th>
                                    <td>
                                        @if ($biodata->data_ktp)
                                            <img src="{{ asset('storage/' . $biodata->data_ktp) }}" alt="Foto KTP" width="100">
                                        @else
                                            <button class="btn btn-danger btn-sm">Belum diupload</button>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Tanda Tangan -->
                                <tr>
                                    <th>Tanda Tangan</th>
                                    <td>
                                        @if ($biodata->data_ttd)
                                            <img src="{{ asset('storage/' . $biodata->data_ttd) }}" alt="Tanda Tangan" width="100">
                                        @else
                                            <button class="btn btn-danger btn-sm">Belum diupload</button>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                </div>

                <!-- Tombol Edit -->
                <div class="text-center mt-4">
                    <a href="{{ route('biodata.edit', $user->id) }}" class="btn btn-primary px-4">
                        <i class="bx bx-edit"></i> Edit Data
                    </a>
                </div>
            </div>

            <!-- Tab Absensi -->
            <div class="tab-pane fade" id="absensi" role="tabpanel" aria-labelledby="absensi-tab">
                <div class="card p-3 border-0 shadow-sm">
                    <h5 class="fw-bold text-primary">📊 Data Absensi</h5>
                    <p>Data absensi akan ditampilkan di sini.</p>
                </div>
            </div>

            <!-- Tab Riwayat Cuti -->
            <div class="tab-pane fade" id="cuti" role="tabpanel" aria-labelledby="cuti-tab">
                <div class="card p-3 border-0 shadow-sm">
                    <h5 class="fw-bold text-primary">📅 Riwayat Cuti</h5>
                    <p>Riwayat cuti akan ditampilkan di sini.</p>
                </div>
            </div>

            <!-- Tab Berita Acara -->
            <div class="tab-pane fade" id="berita" role="tabpanel" aria-labelledby="berita-tab">
                <div class="card p-3 border-0 shadow-sm">
                    <h5 class="fw-bold text-primary">📰 Berita Acara</h5>
                    <p>Berita acara akan ditampilkan di sini.</p>
                </div>
            </div>

             <!-- Tab Manajemen Berkas -->
             <div class="tab-pane fade" id="manajemen_berkas" role="tabpanel" aria-labelledby="manajemen_berkas-tab">
                <div class="card p-3 border-0 shadow-sm">
                    <h5 class="fw-bold text-primary">📰 Manajemen Berkas</h5>
                    <p>Berkas yang pernah di unggah oleh karyawan akan ditampilkan di sini.</p>
                </div>
            </div>

            <!-- Tab Pengaturan -->
            <div class="tab-pane fade" id="pengaturan" role="tabpanel" aria-labelledby="pengaturan-tab">
                <div class="card p-3 border-0 shadow-sm">
                    <h5 class="fw-bold text-primary">⚙️ Pengaturan</h5>
                    <p>Pengaturan user akan ditampilkan di sini.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
