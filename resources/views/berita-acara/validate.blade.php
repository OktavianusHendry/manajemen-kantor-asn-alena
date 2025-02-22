@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
<div class="container">
    <h2>Validasi Berita Acara</h2>

    <form action="{{ route('berita-acara.validate', $beritaAcara->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" class="form-control" value="{{ $beritaAcara->judul }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" rows="4" disabled>{!! $beritaAcara->deskripsi !!}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" class="form-control" value="{{ $beritaAcara->tanggal }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Status Validasi</label>
            <select name="approved_by_director" class="form-control" id="status">
                <option value="pending" {{ $beritaAcara->approved_by_director == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $beritaAcara->approved_by_director == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $beritaAcara->approved_by_director == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <div class="mb-3" id="catatan_reject" style="display: {{ $beritaAcara->approved_by_director == 'rejected' ? 'block' : 'none' }}">
            <label class="form-label">Catatan Direktur (Alasan Rejected)</label>
            <textarea name="catatan_direktur" class="form-control" rows="3">{{ $beritaAcara->catatan_direktur }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan Validasi</button>
        <a href="{{ route('berita-acara.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
    document.getElementById('status').addEventListener('change', function() {
        let catatanField = document.getElementById('catatan_reject');
        if (this.value === 'rejected') {
            catatanField.style.display = 'block';
        } else {
            catatanField.style.display = 'none';
        }
    });
</script>

@endsection
