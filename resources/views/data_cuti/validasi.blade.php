@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')

@section('content')
    <div id="app">
        <div class="container-xxl flex-grow-1 container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Validasi Cuti</b>
                        <span class="text-muted fw-light">/ Persetujuan Cuti</span>
                    </h2>
                </div>
                <div class="card mb-4">
                    <br>
                    <div class="container">
                    <form action="{{ route('data_cuti.validasi', $cuti->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Status Validasi</label>
                            <select name="status" id="status" class="form-control">
                                <option value="approved">Disetujui</option>
                                <option value="rejected">Ditolak</option>
                            </select>
                        </div>

                        <div class="mb-3" id="catatan-field" style="display: none;">
                            <label class="form-label">Catatan (Alasan Penolakan)</label>
                            <textarea name="catatan" class="form-control" rows="3">{{ old('catatan') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-3">
                            <i class="bx bx-check-circle"></i> Validasi Cuti
                        </button>
                    </form>
                        <script>
                            document.getElementById('status').addEventListener('change', function () {
                                let catatanField = document.getElementById('catatan-field');
                                if (this.value === 'rejected') {
                                    catatanField.style.display = 'block';
                                } else {
                                    catatanField.style.display = 'none';
                                }
                            });
                        </script>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
