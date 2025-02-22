@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
    <div class="container">
        <h2>Validasi Berita Acara</h2>
        <form action="{{ route('berita-acara.validate.update', $ba->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Status Validasi</label>
                <select name="approved_by_director" class="form-control">
                    <option value="pending" {{ $ba->approved_by_director == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $ba->approved_by_director == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $ba->approved_by_director == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Catatan Direktur</label>
                <textarea name="catatan_direktur" class="form-control">{{ $ba->catatan_direktur }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
