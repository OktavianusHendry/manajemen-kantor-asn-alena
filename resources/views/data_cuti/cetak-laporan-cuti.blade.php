<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan Cuti</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .form-container {
            width: 80%;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header p {
            margin: 0;
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer-signature {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }

        .footer-signature div {
            width: 30%;
            text-align: center;
        }

        .barcode-container {
            text-align: center;
            margin-top: 20px;
        }

        .barcode-container p {
            font-weight: bold;
            color: #333;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .form-container {
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <p style="text-align: right; margin: 0;"><u>Approve by apps</u></p>
        <br><br>
        <div class="header" style="display: flex;">
            <img class="card-img" src="{{ asset('../public/assets/img/icons/logo-asn.png') }}" alt="Logo Perusahaan"
                style="height: 100px; width: auto; margin-right: 15px;" />
            <div>
                <p style="text-align: left; margin: 0; font-weight: bold;">PT. Anagata Sisedu Nusantara</p>
                <p style="text-align: left; margin: 0;">Revenue Tower Lt. 15, SCBD Lot 13, District 8</p>
                <p style="text-align: left; margin: 0;">Jl. Jenderal Sudirman, Senayan, Kebayoran Baru</p>
                <p style="text-align: left; margin: 0;">Jakarta Selatan 12190</p>
            </div>
        </div>

        <div class="form-title">
            <h4>FORMULIR PERMOHONAN CUTI KARYAWAN</h4>
        </div>

        <table>
            <tr>
                <th>Nama Karyawan</th>
                <td>{{ $cuti->user->name }}</td>
            </tr>
            <tr>
                <th>Jenis Cuti</th>
                <td>{{ $cuti->jenis_cuti->nama_jenis_cuti ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Mulai</th>
                <td>{{ date('d M Y', strtotime($cuti->tanggal_mulai)) }}</td>
            </tr>
            <tr>
                <th>Tanggal Selesai</th>
                <td>{{ date('d M Y', strtotime($cuti->tanggal_selesai)) }}</td>
            </tr>
            <tr>
                <th>Disetujui Direktur</th>
                <td>
                    @if ($cuti->approved_by_director == 'approved')
                        <span class="text-success">Disetujui</span>
                    @elseif ($cuti->approved_by_director == 'rejected')
                        <span class="text-danger">Ditolak</span>
                    @else
                        <span class="text-warning">Belum Diproses</span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Disetujui Kepala Academy</th>
                <td>
                    @if ($cuti->approved_by_head_acdemy == 'approved')
                        <span class="text-success">Disetujui</span>
                    @elseif ($cuti->approved_by_head_acdemy == 'rejected')
                        <span class="text-danger">Ditolak</span>
                    @else
                        <span class="text-warning">Belum Diproses</span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Catatan Direktur</th>
                <td>
                    @if (!empty($cuti->catatan_direktur))
                        {{ $cuti->catatan_direktur }}
                    @else
                        <span class="text-muted">Tidak ada catatan</span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Catatan Kepala Academy</th>
                <td>
                    @if (!empty($cuti->catatan_kepala_academy))
                        {{ $cuti->catatan_kepala_academy }}
                    @else
                        <span class="text-muted">Tidak ada catatan</span>
                    @endif
                </td>
            </tr>
        </table>

        <div class="footer-signature">
            <div style="text-align: left">
                <p>Jakarta, {{ date('d M Y', strtotime($cuti->created_at)) }} <br>Pemohon,</p>
                <br><br>
                <p>(&nbsp;&nbsp;<u>{{ $cuti->user->name }}</u>&nbsp;&nbsp;)</p>
            </div>
            <div>
                <p>Diketahui Oleh,</p>
                <br><br><br>
                <p>(&nbsp;&nbsp;Sheila Purnomo&nbsp;&nbsp;)</p>
            </div>
            <div>
                <p>Disetujui Oleh,</p>
                <br><br><br>
                <p>(&nbsp;&nbsp;Sigit Sutrisno&nbsp;&nbsp;)</p>
                <!-- <p>Disetujui Oleh,</p>
                <br><br><br>
                <p>
                    (&nbsp;&nbsp;
                    @if ($cuti->approved_by_director == 'approved') Sigit Sutrisno
                    @elseif ($cuti->approved_by_head_acdemy == 'approved') Kepala Academy
                    @else -
                    @endif
                    &nbsp;&nbsp;)
                </p> -->
            </div>
        </div>

        <!-- Barcode -->
        <div class="barcode-container">
            <p><strong>Scan untuk verifikasi keabsahan</strong></p>
            {!! $barcode !!}
        </div>
    </div>
</body>

<script type="text/javascript">
    window.print();
</script>

</html>