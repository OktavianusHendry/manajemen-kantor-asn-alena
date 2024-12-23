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

            .form-section {
                margin-bottom: 15px;
            }

            .form-section label {
                display: block;
                font-weight: bold;
            }

            .form-section .input-value {
                border-bottom: 1px dotted #000;
                padding-bottom: 5px;
                min-height: 24px;
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
        </style>
    </head>

    <body>
        <div class="form-container">
            <p style="text-align: right; margin: 0;"><u>Approve by apps</u></p>
            <br><br>
            <div class="header" style="display: flex; align-items: center;">
                <img class="card-img" src="../assets/img/elements/logo-asn.png" alt="Card image"
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

            <div class="form">
                <label class="form-label"><b>Data Karyawan</b></label>
                <div class="input-value">Nama
                    Lengkap:&nbsp;&nbsp;&nbsp; {{ $cetaklaporan->users->name }}
                </div>
            </div>
            <div class="form">
                <div class="input-value">Divisi / Bagian / Unit
                    Kerja:&nbsp;&nbsp;&nbsp;{{ $cetaklaporan->divisi->nama_divisi }} (
                    {{ $cetaklaporan->divisi->kode_divisi }} )</div>
            </div>
            <br>
            <div class="form">
                <label class="form-label"><b>Keterangan Cuti</b></label>
                <div class="input-value">Jenis Cuti yang diajukan
                    (Tahunan):&nbsp;&nbsp;&nbsp;{{ $cetaklaporan->jenis_cuti->nama_jenis_cuti }}</div>
            </div>
            <div class="form">
                <div class="input-value">Lama cuti dijalankan / mulai tanggal s/d
                    tanggal:&nbsp;&nbsp;&nbsp;{{ $cetaklaporan->mulai_tanggal }} s/d {{ $cetaklaporan->sampai_tanggal }}
                </div>
            </div>
            <br>
            <div class="form">
                <div class="input-value">Keterangan / Alasan:&nbsp;&nbsp;&nbsp;{{ $cetaklaporan->keterangan }}</div>
            </div>
            <div class="footer-signature">
                <div style="text-align: left">
                    <p>Jakarta,
                        <br>Pemohon,
                    </p>
                    <br><br>
                    <p>(&nbsp;&nbsp;<u>{{ $cetaklaporan->users->name }}</u>&nbsp;&nbsp;)</p>
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
                </div>
            </div>
        </div>
    </body>

    <script type="text/javascript">
        window.print();
    </script>

</html>
