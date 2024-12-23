<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <style>
            table.static {
                position: relative;
                border: 1px solid #543535;
            }

            .th {
                align-content: center;
            }

            .td {
                text-align: center;
            }

            table.static td {
                text-align: center;
            }
        </style>

        <title>Cetak Laporan Cuti</title>
    </head>

    <body>
        <div class="form-group">
            <p align="center">
                <b>Laporan Cuti Karyawan</b>
                <br>Berikut daftar laporan cuti dari semua karyawan yang berhasil masuk.
            </p>
            <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Divisi</th>
                        <th>Jenis Cuti</th>
                        <th>Mulai Tanggal</th>
                        <th>Sampai Tanggal</th>
                        <th>Status</th>
                        <th>Total Hari</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cetakpertanggal as $cuti)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cuti->users->name }}</td> <!-- Menampilkan nama karyawan -->
                            <td>{{ $cuti->divisi->kode_divisi }}</td>
                            <td>{{ $cuti->jenis_cuti->nama_jenis_cuti }}</td>
                            <td>{{ $cuti->mulai_tanggal }}</td>
                            <td>{{ $cuti->sampai_tanggal }}</td>
                            <td>{{ $cuti->status }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($cuti->mulai_tanggal)->diffInDays(\Carbon\Carbon::parse($cuti->sampai_tanggal)) + 1 }}
                            </td> <!-- Menampilkan total hari cuti -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            window.print();
        </script>
    </body>

</html>
