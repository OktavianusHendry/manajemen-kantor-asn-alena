@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
<div class="container">
    <h2>Validasi Berita Acara</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <h4>Judul: {{ $beritaAcara->judul }}</h4>
            <p><strong>Deskripsi:</strong></p>
            <p>{!! $beritaAcara->deskripsi !!}</p>
            <p><strong>Tanggal:</strong> {{ $beritaAcara->tanggal }}</p>
            <p><strong>Status Saat Ini:</strong> 
                <span class="badge bg-{{ $beritaAcara->status == 'approved_by_director' ? 'success' : ($beritaAcara->status == 'pending' ? 'warning' : 'danger') }}">
                    {{ ucfirst(str_replace('_', ' ', $beritaAcara->status)) }}
                </span>
            </p>

            <form action="{{ route('berita-acara.validate', $beritaAcara->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Status Validasi:</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="approved_by_director" {{ $beritaAcara->status == 'approved_by_director' ? 'selected' : '' }}>Approved by Director</option>
                        <option value="pending" {{ $beritaAcara->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="rejected" {{ $beritaAcara->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div class="mb-3" id="catatan_direktur_field" style="display: none;">
                    <label>Catatan Direktur (Alasan Penolakan):</label>
                    <textarea name="catatan_direktur" class="form-control">{{ $beritaAcara->catatan_direktur }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('berita-acara.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('status').addEventListener('change', function() {
    var catatanField = document.getElementById('catatan_direktur_field');
    if (this.value === 'rejected') {
        catatanField.style.display = 'block';
    } else {
        catatanField.style.display = 'none';
    }
});

// Tampilkan textarea jika status awal adalah "rejected"
if (document.getElementById('status').value === 'rejected') {
    document.getElementById('catatan_direktur_field').style.display = 'block';
}
</script>

@endsection
