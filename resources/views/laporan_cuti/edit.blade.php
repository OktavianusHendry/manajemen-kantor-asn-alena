@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><b>Edit Laporan Cuti</b></h2>
                    </div>
                    <hr>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('laporan_cuti.update', $laporanCuti->cuti_id) }}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put" />

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="user_name">User</label>
                                    <input type="text" name="user_name" id="user_name" class="form-control"
                                        value="{{ $laporanCuti->users->name }}" disabled>
                                </div>

                                <div class="col-sm-6">
                                    @if (Auth::user()->role_as == '1')
                                        <label class="form-label" for="id_divisi">Divisi</label>
                                        <select name="id_divisi" id="id_divisi" class="form-control" disabled>
                                            <option value="">--Pilih Divisi--</option>
                                            @foreach ($divisi as $d)
                                                <option value="{{ $d->id_divisi }}"
                                                    {{ $d->id_divisi == $laporanCuti->id_divisi ? 'selected' : '' }}>
                                                    {{ $d->nama_divisi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <label class="form-label" for="id_divisi">Divisi</label>
                                        <select name="id_divisi" id="id_divisi" class="form-control">
                                            <option value="">--Pilih Divisi--</option>
                                            @foreach ($divisi as $d)
                                                <option value="{{ $d->id_divisi }}"
                                                    {{ $d->id_divisi == $laporanCuti->id_divisi ? 'selected' : '' }}>
                                                    {{ $d->nama_divisi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="id_jenis_cuti">Jenis Cuti</label>
                                <select name="id_jenis_cuti" id="id_jenis_cuti" class="form-control">
                                    <option value="">--Pilih Jenis Cuti--</option>
                                    @foreach ($jenis_cuti as $d)
                                        <option value="{{ $d->id_jenis_cuti }}"
                                            {{ $d->id_jenis_cuti == $laporanCuti->id_jenis_cuti ? 'selected' : '' }}>
                                            {{ $d->nama_jenis_cuti }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="mulai_tanggal">Lama Cuti Dijalankan (Mulai
                                        Tanggal)</label>
                                    <input type="date" name="mulai_tanggal" id="mulai_tanggal" class="form-control"
                                        value="{{ $laporanCuti->mulai_tanggal }}" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="lama_cuti_end">Lama Cuti Dijalansan (Sampai
                                        Tanggal)</label>
                                    <input type="date" name="sampai_tanggal" id="sampai_tanggal" class="form-control"
                                        value="{{ $laporanCuti->sampai_tanggal }}" required>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="keterangan">keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control">{{ $laporanCuti->keterangan }}</textarea>
                            </div>
                            @if (Auth::user()->role_as == '1')
                                <div class="form-group mb-3">
                                    <label class="form-label" for="status">Status</label><br>
                                    <input type="radio" id="pending" name="status" value="pending"
                                        {{ $laporanCuti->status == 'pending' ? 'checsed' : '' }}>
                                    <label class="form-label" for="pending">Pending</label><br>

                                    <input type="radio" id="approved" name="status" value="approved"
                                        {{ $laporanCuti->status == 'approved' ? 'checsed' : '' }}>
                                    <label class="form-label" for="approved">Approved</label><br>

                                    <input type="radio" id="rejected" name="status" value="rejected"
                                        {{ $laporanCuti->status == 'rejected' ? 'checsed' : '' }}>
                                    <label class="form-label" for="rejected">Rejected</label>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="catatan">Catatan</label>
                                    <input type="text" name="catatan" class="form-control" maxlength="100"
                                        value="{{ old('catatan', $laporanCuti->catatan) }}">
                                </div>
                            @else
                                <input type="hidden" name="status" value="pending">
                            @endif
                            <br>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('laporan_cuti.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .text-right-custom {
        text-align: right;
    }
</style>
