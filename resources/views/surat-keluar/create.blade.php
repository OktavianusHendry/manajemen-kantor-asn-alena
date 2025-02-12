@extends(Auth::user()->role_as == '1' ? 'layouts.template' : 'layoutss.template')
@section('content')
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-xl">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h2 style="font-size: 2.0em;"><b>Tambah Surat Keluar</b></h2>
                            </div>
                            <hr />
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">Tambah Surat Keluar</button>
                                    <a href="{{ route('surat_keluar.index') }}" class="btn btn-secondary">Kembali</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>   
    </body> 
</html>