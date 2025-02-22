@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
<div class="container">
    <h2>Detail Berita Acara</h2>
    <a href="{{ route('berita-acara.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <div class="card">
        <div class="card-body">
            <h4>{{ $beritaAcara->judul }}</h4>
            <p><strong>Tanggal:</strong> {{ $beritaAcara->tanggal }}</p>
            <p><strong>Deskripsi:</strong></p>
            <div>{!! $beritaAcara->deskripsi !!}</div> <!-- CKEditor mendukung HTML -->

            <hr>
            <h5>Peserta Berita Acara</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Instansi</th>
                        <th>Jabatan</th>
                        <th>Jenis Peserta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($beritaAcara->peserta as $peserta)
                        <tr>
                            <td>
                                @if ($peserta->jenis_peserta == 'karyawan' && $peserta->user)
                                    {{ $peserta->user->name }} <!-- Nama dari users -->
                                @else
                                    {{ $peserta->nama_lengkap }} <!-- Nama dari input manual -->
                                @endif
                            </td>
                            <td>
                                @if ($peserta->jenis_peserta == 'karyawan' && $peserta->user)
                                    <p>PT. Anagata Sisedu Nusantara</p><!-- PT Karyawan users -->
                                @else
                                    {{ $peserta->instansi }} <!-- Nama dari input manual -->
                                @endif
                            </td>
                            <td>
                                @if ($peserta->jenis_peserta == 'karyawan' && $peserta->user)
                                    {{ optional($peserta->user->jabatan)->nama_jabatan ?? '-' }}<!--  -->
                                @else
                                    {{ $peserta->jabatan }} <!-- Nama dari input manual -->
                                @endif
                            </td>
                            <td>{{ ucfirst($peserta->jenis_peserta) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr>
            <h5>Status Validasi</h5>
            <p><strong>Disetujui Oleh:</strong> {{ $beritaAcara->approved_by_director == 'approved' ? 'Direktur' : 'Belum Disetujui' }}</p>
            <p><strong>Catatan Direktur:</strong> {{ $beritaAcara->catatan_direktur ?? 'Tidak Ada Catatan' }}</p>
        </div>
    </div>
</div>
@endsection
