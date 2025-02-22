<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan Cuti</title>
    <style>
        .form-container {
            width: 80%;
            margin: 0 auto;
            font-family: Arial, sans-serif;
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
        }

        .footer-signature {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        .footer-signature div {
            width: 30%;
            text-align: center;
        }

        .barcode-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <p style="text-align: right; margin: 0;"><u>Approve by apps</u></p>
        <br><br>
        <div class="header" style="display: flex; align-items: center;">
            <img class="card-img" src="{{ asset('assets/img/elements/logo-asn.png') }}" alt="Logo Perusahaan"
                style="height: 145px; width: auto; margin-right: 5px;" />
            <div>
                <p style="text-align: left; margin: 0;">PT. Anagata Sisedu Nusantara</p>
                <p style="text-align: left; margin: 0;">Revenue Tower Lt. 15, SCBD Lot 13, District 8</p>
                <p style="text-align: left; margin: 0;">Jl. Jenderal Sudirman, Senayan, Kebayoran Baru</p>
                <p style="text-align: left; margin: 0;">Jakarta Selatan 12190</p>
            </div>
        </div>

        <div class="form-title">
            <h4>FORMULIR PERMOHONAN CUTI KARYAWAN</h4>
        </div>

        <div class="form-section">
            <label>Nama Karyawan:</label>
            <div class="input-value">{{ $cuti->user->name }}</div>
        </div>

        <div class="form-section">
            <label>Jenis Cuti:</label>
            <div class="input-value">{{ $cuti->jenis_cuti->nama_jenis_cuti ?? '-' }}</div>
        </div>

        <div class="form-section">
            <label>Tanggal Mulai:</label>
            <div class="input-value">{{ date('d M Y', strtotime($cuti->tanggal_mulai)) }}</div>
        </div>

        <div class="form-section">
            <label>Tanggal Selesai:</label>
            <div class="input-value">{{ date('d M Y', strtotime($cuti->tanggal_selesai)) }}</div>
        </div>

        <div class="form-section">
            <label>Disetujui Oleh:</label>
            <div class="input-value">
                @if ($cuti->approved_by_director == 'approved')
                    Direktur
                @elseif ($cuti->approved_by_head_acdemy == 'approved')
                    Kepala Academy
                @else
                    Belum Disetujui
                @endif
            </div>
        </div>

        <div class="footer-signature">
            <div style="text-align: left">
                <p>Jakarta, <br>Pemohon,</p>
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
                <p>
                    (&nbsp;&nbsp;
                    @if ($cuti->approved_by_director == 'approved') Sigit Sutrisno
                    @elseif ($cuti->approved_by_head_acdemy == 'approved') Kepala Academy
                    @else -
                    @endif
                    &nbsp;&nbsp;)
                </p>
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
