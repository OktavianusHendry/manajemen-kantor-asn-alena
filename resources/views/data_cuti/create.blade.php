@extends('layoutss.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <main class="py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">Ajukan Cuti</h2>
                <a href="{{ route('data_cuti.index') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back"></i> Kembali
                </a>
            </div>

            <div class="card p-4 shadow-sm">
                <form action="{{ route('data_cuti.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Jenis Cuti</label>
                        <select name="id_jenis_cuti" class="form-control @error('id_jenis_cuti') is-invalid @enderror">
                            <option value="">-- Pilih Jenis Cuti --</option>
                            @foreach($jenisCuti as $jenis)
                                <option value="{{ $jenis->id }}" {{ old('id_jenis_cuti') == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis_cuti }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_jenis_cuti') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai') }}">
                        @error('tanggal_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai') }}">
                        @error('tanggal_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alasan</label>
                        <textarea name="alasan" class="form-control @error('alasan') is-invalid @enderror" rows="3">{{ old('alasan') }}</textarea>
                        @error('alasan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bx bx-send"></i> Ajukan Cuti
                    </button>
                </form>
            </div>
        </main>
    </div>
@endsection
