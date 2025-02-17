<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Resmi</title>
    <style>
        @page {
            size: A4;
            margin: 120px 50px 100px 50px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.5;
            text-align: justify;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            text-align: center;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
        }

        .content {
            margin-top: 150px; /* Memberi ruang agar tidak tertutup header */
            margin-bottom: 80px; /* Memberi ruang agar tidak tertutup footer */
            page-break-after: auto;
        }

        .signature {
            margin-top: 50px;
            text-align: left;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        @php
            $headerPath = public_path('assets/pdf/header-asn.png'); // Path to header image
            $headerData = base64_encode(file_get_contents($headerPath));
            $headerSrc = 'data:image/png;base64,'.$headerData;
        @endphp
        <img src="{{ $headerSrc }}" width="100%" style="max-width: 100%; height: auto;"> <!-- Header image -->
    </div>
    <!-- Footer -->
    <div class="footer">
        @php
            $footerPath = public_path('assets/pdf/footer-asn.png'); // Path to footer image
            $footerData = base64_encode(file_get_contents($footerPath));
            $footerSrc = 'data:image/png;base64,'.$footerData;
        @endphp
        <img src="{{ $footerSrc }}" width="100%" style="max-width: 100%; height: auto;">
    </div>
    <!-- Isi Surat -->
    <div class="content">
        <p>Nomor: <strong>{{ $surat->nomor_surat }}</strong></p>
        <p>Tanggal: <strong>{{ $surat->tanggal_surat }}</strong></p>
        <p>Kepada Yth,</p>
        <p class="bold">{{ $surat->tujuan_surat }}</p>
        <p>Di Tempat</p>
        <br>
        <p><strong>Perihal:</strong> <br> {{ $surat->perihal }}</p><br>
        <p><strong>Lampiran:</strong> <br>{{ $surat->lampiran }}</p>
        <br>
        <p>{!! $surat->isi_surat !!}</p> 
        <br>

        <!-- Tanda Tangan 
        <div class="signature">
            <p class="no-margin">Hormat kami,</p>
            <p class="no-margin">{{ $surat->jabatan_pengesah }}</p>
            <p class="no-margin">PT. Anagata Sisedu Nusantara</p>
            </br></br></br>
            <p class="no-margin">____________________</p> <!-- Signature line 
            <p class="no-margin">{{ $surat->disahkan_oleh }}</p> <!-- Name of the signer 
        </div></br></br></br></br> --->

        <p class="no-margin"><strong>Tembusan:</strong></p>
        <p class="no-margin">{{ $surat->tembusan }}</p>
    </div>
</body>
</html>