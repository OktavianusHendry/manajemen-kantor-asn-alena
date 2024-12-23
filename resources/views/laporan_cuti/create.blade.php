@extends(Auth::user()->role_as == 1 ? 'layouts.template' : 'layoutss.template')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 style="font-size: 2.0em;"><b>Ajukan Laporan Cuti</b></h2>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('laporan_cuti.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <hr>

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="name">Nama Lengkap</label>
                                    <input type="text" id="name" class="form-control"
                                        value="{{ Auth::user()->name }}" disabled />
                                    <input type="hidden" name="id" value="{{ Auth::user()->id }}" />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="divisi_id">Divisi</label>
                                    <input type="text" class="form-control"
                                        value="{{ optional(Auth::user()->divisi)->nama_divisi ?: 'Divisi tidak tersedia' }}"
                                        disabled>
                                    <input type="hidden" name="id_divisi" value="{{ Auth::user()->id_divisi }}" />
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="id_jenis_cuti">Jenis Cuti yang diajukan</label>
                                <select name="id_jenis_cuti" id="id_jenis_cuti" class="form-control">
                                    <option value="">--Pilih Jenis Cuti--</option>
                                    @foreach ($jenis_cuti as $d)
                                        <option value="{{ $d->id_jenis_cuti }}">{{ $d->nama_jenis_cuti }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="mulai_tanggal">Lama Cuti Dijalankan (Mulai
                                        Tanggal)</label>
                                    <input type="date" name="mulai_tanggal" id="mulai_tanggal" class="form-control"
                                        required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="sampai_tanggal">Lama Cuti (Sampai Tanggal)</label>
                                    <input type="date" name="sampai_tanggal" id="sampai_tanggal" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="keterangan">Keterangan / Alasan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                            </div>

                            <input type="hidden" name="status" value="pending">

                            <br>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('laporan_cuti.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
