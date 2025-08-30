<!-- resources/views/laporan/export.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Perjalanan Dinas - {{ $laporan->sppd->user->name }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #6750A4;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #6750A4;
        }

        .header p {
            margin: 5px 0 0;
            color: #666;
            font-size: 14px;
        }

        .section {
            margin-bottom: 25px;
        }

        .section h3 {
            margin-bottom: 10px;
            font-size: 16px;
            color: #6750A4;
            border-bottom: 1px solid #CCC2DC;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #CCC2DC;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #EADDFF;
            color: #6750A4;
            font-weight: bold;
        }

        .section p {
            line-height: 1.6;
        }

        .signature {
            margin-top: 60px;
            page-break-inside: avoid;
        }

        .signature table {
            border: none;
            width: 100%;
        }

        .signature td {
            border: none;
            padding: 20px 0;
            text-align: center;
            width: 50%;
        }

        .signature .line {
            border-bottom: 1px solid #333;
            width: 250px;
            margin: 60px auto 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN PERJALANAN DINAS</h1>
        <p>No. SPPD: {{ $laporan->sppd->id }} | Tanggal: {{ $laporan->created_at->format('d/m/Y') }}</p>
    </div>

    <div class="section">
        <h3>Data Pegawai</h3>
        <table>
            <tr>
                <td width="20%">Nama</td>
                <td width="30%">{{ $laporan->sppd->user->name }}</td>
                <td width="20%">NIK</td>
                <td width="30%">{{ $laporan->sppd->user->nik }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>{{ $laporan->sppd->user->pegawai->jabatan }}</td>
                <td>Departemen</td>
                <td>{{ $laporan->sppd->user->pegawai->departemen }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3>Data Perjalanan</h3>
        <table>
            <tr>
                <td width="20%">Tujuan</td>
                <td width="80%">{{ $laporan->sppd->tujuan }}</td>
            </tr>
            <tr>
                <td>Tanggal Berangkat</td>
                <td>{{ $laporan->sppd->tanggal_berangkat->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Tanggal Kembali</td>
                <td>{{ $laporan->sppd->tanggal_kembali->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Keperluan</td>
                <td>{{ $laporan->sppd->keperluan }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3>Kegiatan yang Dilakukan</h3>
        <p>{{ $laporan->kegiatan }}</p>
    </div>

    <div class="section">
        <h3>Hasil yang Dicapai</h3>
        <p>{{ $laporan->hasil }}</p>
    </div>

    <div class="section">
        <h3>Rincian Biaya</h3>
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Jenis Biaya</th>
                    <th width="20%">Jumlah</th>
                    <th width="50%">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporan->biayas as $index => $biaya)
                    @if ($biaya->status === 'approved')
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $biaya->jenis_biaya }}</td>
                            <td>Rp {{ number_format($biaya->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $biaya->keterangan ?? '-' }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="text-align: right; font-weight: bold;">Total Biaya:</td>
                    <td colspan="2" style="font-weight: bold;">Rp
                        {{ number_format($laporan->total_biaya, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="signature">
        <table>
            <tr>
                <td width="50%">
                    <p>Yang Melaksanakan Perjalanan Dinas,</p>
                    <div class="line"></div>
                    <p>{{ $laporan->sppd->user->name }}</p>
                    <p>NIK: {{ $laporan->sppd->user->nik }}</p>
                </td>
                <td width="50%">
                    <p>Mengetahui,</p>
                    <div class="line"></div>
                    <p>Administrator</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>