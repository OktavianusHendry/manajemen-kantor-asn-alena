@extends('layouts.template')

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
                                <label class="form-label">Validasi oleh</label>
                                <select name="approval" class="form-control">
                                    <option value="approved">Setujui</option>
                                    <option value="rejected">Tolak</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('data_cuti.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
