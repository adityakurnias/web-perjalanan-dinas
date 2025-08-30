<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Perjalanan Dinas - {{ $laporan->sppd->user->name }}</title>
    <style>
        @page {
            margin: 2cm;
        }

        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.6;
        }

        #header {
            margin-bottom: 25px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            padding: 0;
            vertical-align: top;
        }

        .logo-container {
            width: 90px;
        }

        .logo {
            width: 85px;
            height: 85px;
            object-fit: contain;
        }

        .company-details {
            text-align: right;
        }

        .company-details h2 {
            margin: 0 0 5px 0;
            font-size: 22px;
            color: #2c3e50;
            font-weight: bold;
        }

        .company-details p {
            margin: 0;
            font-size: 11px;
            color: #7f8c8d;
        }

        .document-title {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 15px;
        }

        .document-title h1 {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
            color: #34495e;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .document-title p {
            margin-top: 5px;
            font-size: 12px;
            color: #95a5a6;
            font-style: italic;
        }

        .header-divider {
            border: 0;
            height: 1.5px;
            background-color: #34495e;
            margin-bottom: 30px;
        }


        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        .section h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #2c3e50;
            border-bottom: 1px solid #bdc3c7;
            padding-bottom: 5px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            border: none;
            padding: 4px 0;
        }

        .info-table td:first-child {
            width: 25%;
            font-weight: bold;
            color: #555;
        }

        .info-table td:nth-child(2) {
            width: 2%;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .details-table th,
        .details-table td {
            border-bottom: 1px solid #ecf0f1;
            padding: 10px;
            text-align: left;
        }

        .details-table th {
            background-color: #f8f9fa;
            color: #34495e;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }

        .details-table .text-right {
            text-align: right;
        }

        .details-table .text-center {
            text-align: center;
        }

        .details-table .total-row td {
            font-weight: bold;
            font-size: 12px;
            background-color: #f8f9fa;
            border-top: 2px solid #bdc3c7;
        }

        .content-block {
            padding: 5px 0;
            text-align: justify;
        }


        .signature-section {
            margin-top: 60px;
            page-break-inside: avoid;
        }

        .signature-table {
            width: 100%;
        }

        .signature-box {
            width: 50%;
            text-align: center;
        }

        .signature-box .signature-space {
            height: 70px;
        }

        .signature-box .name {
            font-weight: bold;
            border-bottom: 1px solid #333;
            display: inline-block;
            padding: 0 20px 2px 20px;
        }

        .signature-box .role {
            margin-top: 4px;
        }


        #footer {
            position: fixed;
            bottom: -1.5cm;
            left: 0;
            right: 0;
            height: 1cm;
            text-align: center;
        }

        #footer .page-number:after {
            content: "Halaman " counter(page);
            font-size: 10px;
            color: #95a5a6;
        }
    </style>
</head>

<body>
    <header id="header">
        <table class="header-table">
            <tr>
                <td class="logo-container">
                    <img src="{{ public_path('assets/images/pixel-perfect.png') }}" class="logo">
                </td>
                <td class="company-details">
                    <h2>Pixel Perfect</h2>
                    <p>SMK Plus PNB, XII RPL 2, Cibinong, Bogor</p>
                    <p>Telepon: (021) 1234-5678 | Email: kel3@kel3.com</p>
                </td>
            </tr>
        </table>

        <div class="document-title">
            <h1>Laporan Perjalanan Dinas</h1>
            <p>Nomor SPPD: {{ $laporan->sppd->id }}</p>
        </div>

        <hr class="header-divider">
    </header>

    <footer id="footer">
        <div class="page-number"></div>
    </footer>

    <main>
        <div class="section">
            <h3>1. Data Pegawai</h3>
            <table class="info-table">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $laporan->sppd->user->name }}</td>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $laporan->sppd->user->nik }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>{{ $laporan->sppd->user->pegawai->jabatan }}</td>
                    <td>Departemen</td>
                    <td>:</td>
                    <td>{{ $laporan->sppd->user->pegawai->departemen }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>2. Data Perjalanan</h3>
            <table class="info-table">
                <tr>
                    <td>Tujuan</td>
                    <td>:</td>
                    <td colspan="4">{{ $laporan->sppd->tujuan }}</td>
                </tr>
                <tr>
                    <td>Tanggal Berangkat</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($laporan->sppd->tanggal_berangkat)->isoFormat('dddd, D MMMM Y') }}</td>
                    <td>Tanggal Kembali</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($laporan->sppd->tanggal_kembali)->isoFormat('dddd, D MMMM Y') }}</td>
                </tr>
                <tr>
                    <td>Keperluan</td>
                    <td>:</td>
                    <td colspan="4">{{ $laporan->sppd->keperluan }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>3. Deskripsi Kegiatan</h3>
            <div class="content-block">{{ $laporan->kegiatan }}</div>
        </div>

        <div class="section">
            <h3>4. Hasil yang Dicapai</h3>
            <div class="content-block">{{ $laporan->hasil }}</div>
        </div>

        <div class="section">
            <h3>5. Rincian Biaya</h3>
            <table class="details-table">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th width="35%">Jenis Biaya</th>
                        <th class="text-right" width="20%">Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan->biayas->where('status', 'approved') as $index => $biaya)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $biaya->jenis_biaya }}</td>
                            <td class="text-right">Rp {{ number_format($biaya->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $biaya->keterangan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center; color: #7f8c8d; padding: 20px;">
                                Tidak ada rincian biaya yang disetujui.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="2" class="text-right">TOTAL BIAYA PERJALANAN DINAS</td>
                        <td colspan="2" class="text-right">Rp
                            {{ number_format($laporan->biayas->where('status', 'approved')->sum('jumlah'), 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="signature-section">
            <table class="signature-table">
                <tr>
                    <td class="signature-box">
                        <p>Cibinong, {{ now()->isoFormat('D MMMM Y') }}</p>
                        <p>Yang Melaksanakan Perjalanan Dinas,</p>
                        <div class="signature-space"></div>
                        <p class="name">{{ $laporan->sppd->user->name }}</p>
                        <p class="role">NIK: {{ $laporan->sppd->user->nik }}</p>
                    </td>
                    <td class="signature-box">
                        <p><br>Mengetahui,</p>
                        <div class="signature-space"></div>
                        <p class="name">Dr. Drs. Ir. Aditya Kurnia Saputra</p>
                        <c class="role">Leader of Pixel Perfect</c>
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>

</html>