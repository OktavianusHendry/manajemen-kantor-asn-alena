@extends(Auth::user()->role_as == 1 ? 'layouts.template' : 'layoutss.template')

@section('content')
    <div id="app">
        <div class="container-xxl flex-grow-1zz container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    @if (Auth::user()->role_as == '1')
                        <h2 class="fw-bold py-3 mb-1">
                            <b>Data Pengajuan Cuti</b>
                            <span class="text-muted fw-light">/ Manajemen Riwayat Pengajuan Cuti Karyawan</span>
                        </h2>
                    @else
                        <h2 class="fw-bold py-3 mb-1">
                            <b>Data Ajukan Cuti</b>
                            <span class="text-muted fw-light">/ Form Pengajuan</span>
                        </h2>
                    @endif
                </div>

                @if (Auth::user()->role_as == '1')
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Tanggal Awal</span>
                                <input type="date" class="form-control" name="tglawal" id="tglawal" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Tanggal Akhir</span>
                                <input type="date" class="form-control" name="tglakhir" id="tglakhir" required />
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button href="javascript:void(0)" onclick="validateAndPrint()"
                                class="btn btn-primary rounded-pill">
                                Cetak Laporan <i class="bx bxs-printer"></i>
                            </button>
                        </div>
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="container">
                        <div class="d-flex justify-content-between mb-3">
                            @if (Auth::user()->role_as == '2')
                                <a href="{{ route('laporan_cuti.create') }}">
                                    <button type="button" class="btn rounded-pill btn-primary mt-3 align-content-center">
                                        <i class="menu-icon tf-icons bx bxs-plus-circle"></i> Tambah
                                    </button>
                                </a>
                            @endif
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('laporan_cuti.index') }}" method="GET" class="mb-3">
                            <div class="form-group d-flex">
                                <input type="text" name="search" value="{{ request()->input('search') }}"
                                    class="form-control" placeholder="Cari laporan cuti...">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>

                        @if ($laporanCuti->count() > 0)
                            <div class="table-responsive text-nowrap">
                                <br>
                                <table class="table table-hover align-content-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Divisi</th>
                                            <th>Status</th>
                                            <th>Catatan</th>
                                            @if (Auth::user()->role_as == 1)
                                                <!-- Hanya admin -->
                                                <th>Aksi</th>
                                            @else
                                                <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($laporanCuti as $cuti)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $cuti->users->name }}</td>
                                                <td>{{ $cuti->divisi->kode_divisi ?? 'Tidak tersedia' }}</td>
                                                <td>
                                                    @if ($cuti->status == 'approved')
                                                        <button class="btn btn-success btn-sm disabled">Telah
                                                            Disetujui</button>
                                                    @elseif ($cuti->status == 'rejected')
                                                        <button class="btn btn-danger btn-sm disabled">Ditolak</button>
                                                    @elseif ($cuti->status == 'pending')
                                                        @if (Auth::user()->role_as == 1)
                                                            <!-- Tombol Disetujui -->
                                                            <button class="btn btn-success btn-sm"
                                                                onclick="ubahStatus('{{ $cuti->cuti_id }}', 'approved')">Setujui</button>

                                                            <!-- Tombol Ditolak (memicu modal) -->
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="showRejectModal('{{ $cuti->cuti_id }}')">Tolak</button>
                                                        @else
                                                            <button class="btn btn-warning btn-sm disabled">Pending</button>
                                                        @endif
                                                    @endif

                                                    <div class="modal fade" id="rejectModal" tabindex="-1"
                                                        aria-labelledby="rejectModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="rejectModalLabel">Tolak
                                                                        Pengajuan Cuti</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="rejectForm" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="status"
                                                                            value="rejected">
                                                                        <div class="form-group">
                                                                            <label for="catatan">Catatan Penolakan</label>
                                                                            <textarea class="form-control" id="catatan" name="catatan" rows="3" required></textarea>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="button" class="btn btn-danger"
                                                                        onclick="submitRejectForm()">Tolak</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>

                                                <td>
                                                    @if ($cuti->status == 'rejected')
                                                        {{ $cuti->catatan }}
                                                    @else
                                                        -
                                                    @endif

                                                <td>
                                                    @if (Auth::user()->role_as == '2' && $cuti->status == 'approved')
                                                        <button class="btn btn-primary btn-sm"
                                                            onclick="printCuti('{{ $cuti->cuti_id }}')">
                                                            <i class="menu-icon tf-icons bx bx-printer"></i>
                                                        </button>&nbsp;&nbsp;
                                                    @else
                                                    @endif
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#smallModal">
                                                        <i class="menu-icon tf-icons bx bx-show"></i>
                                                    </button>
                                                    &nbsp;&nbsp;
                                                    <div class="modal fade" id="smallModal" tabindex="-1"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel2">
                                                                        <b>{{ $cuti->users->name }}</b>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <hr>
                                                                    Divisi:
                                                                    {{ $cuti->divisi->kode_divisi ?? 'Tidak tersedia' }}<br>
                                                                    <hr>
                                                                    Jenis Cuti:
                                                                    {{ $cuti->jenis_cuti->nama_jenis_cuti }}<br>
                                                                    <hr>
                                                                    Mulai: {{ $cuti->mulai_tanggal }}<br>
                                                                    <hr>
                                                                    Sampai: {{ $cuti->sampai_tanggal }}<br>
                                                                    <hr>
                                                                    Alasan: {{ $cuti->keterangan }}<br>
                                                                    <hr>
                                                                    Status: {{ $cuti->status }}<br>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        Close
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('laporan_cuti.destroy', $cuti->cuti_id) }}"
                                                        method="POST" style="display:inline;"
                                                        onsubmit="return confirm('Yakin ingin menghapus?');">
                                                        <input type="hidden" name="_method" value="delete" />
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="menu-icon tf-icons bx bx-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center my-4 pagination-wrapper">
                                {{ $laporanCuti->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4') }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                Tidak ada data laporan cuti ditemukan.
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function validateAndPrint() {
            var tglAwal = document.getElementById('tglawal').value;
            var tglAkhir = document.getElementById('tglakhir').value;

            if (tglAwal && tglAkhir) {
                if (new Date(tglAwal) > new Date(tglAkhir)) {
                    alert("Tanggal awal harus lebih kecil dari tanggal akhir!");
                    return;
                }
                window.open('/cetak-laporan-cuti-pertanggal?tglawal=' + tglAwal + '&tglakhir=' + tglAkhir, '_blank');
            } else {
                alert("Pilih tanggal awal dan tanggal akhir!");
            }
        }

        function printCuti(cuti_id) {
            window.open('/cetak-laporan-cuti/' + cuti_id, '_blank');
        }

        function ubahStatus(cutiId, status) {
            // Kirimkan permintaan ke server menggunakan fetch
            fetch(`/laporan_cuti/${cutiId}/update-status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload halaman untuk melihat perubahan status
                    } else {
                        alert('Gagal memperbarui status');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Modal untuk menampilkan form penolakan
        function showRejectModal(cutiId) {
            const form = document.getElementById('rejectForm');
            form.action = `/laporan_cuti/${cutiId}/update-status`; // Ubah action form sesuai ID cuti
            const modal = new bootstrap.Modal(document.getElementById('rejectModal'));
            modal.show();
        }

        function submitRejectForm() {
            const form = document.getElementById('rejectForm');
            form.submit(); // Submit form untuk penolakan
        }
    </script>
@endsection
