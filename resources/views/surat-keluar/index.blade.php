@if ($surat_keluars ?? false)
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
                @foreach ($surat_keluars as $surat_keluar)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $surat_keluar->nomor_surat }}</td>
                        <td>{{ $surat_keluar->tanggal_surat }}</td>
                        <td>{{ $surat_keluar->perihal }}</td>
                        <td>{{ $surat_keluar->tujuan_surat }}</td>
                        <td>{{ $surat_keluar->status_validasi }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('surat_keluar.view', $surat_keluar->id_surat) }}" class="btn btn-success btn-sm">Lihat</a>
                                <a href="{{ route('surat_keluar.edit', $surat_keluar->id_surat) }}" class="btn btn-warning btn-sm">
                                    <i class="menu-icon tf-icons bx bx-edit"></i>
                                </a>
                                <!-- Additional action buttons here -->
                            </div>
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