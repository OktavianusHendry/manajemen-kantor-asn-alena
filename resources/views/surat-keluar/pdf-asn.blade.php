<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keluar</title>
    <style>
        @page {
            size: A4;
            margin: 120px 50px 100px 50px;
        }

        .header {
            position: fixed;
            top: -50px; /* Position header */
            left: -5px;
            width: 45%;
            text-align: left; /* Align header to the left */
        }

        .footer {
            position: fixed;
            bottom: -10px; /* Position footer */
            left: 0;
            right: 0;
            width: 100%;
            text-align: center;
        }

        body {
            font-family: Arial, sans-serif; /* Font Arial */
            font-size: 12pt; /* Font size */
            line-height: 1.5; /* Single spacing */
            text-align: justify; /* Justify text */
        }

        .content {
            margin-top: 50px; /* Margin from header to push content down */
            margin-bottom: 70px; /* Ensure content does not overlap with footer */
            text-align: justify; /* Justify text */
        }

        .bold {
            font-weight: bold;
        }

        .underline {
            text-decoration: underline;
        }

        .signature {
            margin-top: 50px; /* Margin for signature */
            text-align: left; /* Align signature to the left */
        }

        .signature p {
            margin: 0; /* Remove margin for signature paragraphs */
        }

        table {
            width: 100%; /* Full width for table */
            border-collapse: collapse; /* Remove space between borders */
        }

        td {
            padding: 0px; /* Padding in table cells */
            vertical-align: top; /* Align cells to the top */
        }

        .left-align {
            text-align: left; /* Align text to the left */
        }

        .right-align {
            text-align: right; /* Align text to the right */
        }

        .no-margin {
            margin: 0; /* Remove margin */
        }

        .justify-align {
            text-align: justify; /* Justify text */
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
        <!-- <table>
            <tr>
                <td class="left-align">Nomor: <strong>{{ $surat->nomor_surat ?? 'Nomor tidak tersedia' }}</strong></td>
                <td class="right-align"><strong>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}</strong></td>
            </tr>
        </table> </br>
        <p class="no-margin recipient">Kepada Yth,</p>
        <p class="no-margin bold">{{ $surat->tujuan_surat }}</p>
        <p class="no-margin recipient">Di</p>
        <p class="no-margin">Tempat</p></br>

        <p class="no-margin"><strong>Perihal:</strong></p>
        <p class="no-margin"><strong>{{ $surat->perihal }}</strong></p></br>

        <p class="no-margin"><strong>Lampiran:</strong></p>
        <p class="no-margin">{{ $surat->lampiran }}</p> -->

        <p class="no-margin justify-align">{!! $surat->isi_surat !!}</p> <!-- Justified content --> <br>

        <!-- Tanda Tangan -->
        <!-- <div class="signature">
            <p class="no-margin">Hormat kami,</p>
            <p class="no-margin">{{ $surat->jabatan_pengesah }}</p>
            <p class="no-margin">PT. Anagata Sisedu Nusantara</p>
            </br></br></br>
            <p class="no-margin">____________________</p> <!-- Signature line 
            <p class="no-margin">{{ $surat->disahkan_oleh }}</p> <!-- Name of the signer 
        </div></br></br></br></br>

        <p class="no-margin"><strong>Tembusan:</strong></p>
        <p class="no-margin">{{ $surat->tembusan }}</p> -->
    </div>
</body>
</html>