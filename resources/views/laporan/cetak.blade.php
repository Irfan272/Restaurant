<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        @page {
            size: A4 portrait;
            margin: 0;
        }

        body {
            margin: 1cm;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .wrap-text {
            word-wrap: break-word;
            white-space: normal;
        }

        .page-break {
            page-break-after: always;
        }

        .print-button {
            display: block;
            width: 100%;
            text-align: right;
            margin-bottom: 20px;
        }

        .print-button button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        @media print {
            .print-button {
                display: none;
            }
        }

        .detail-item {
            text-align: left;
            margin-bottom: 4px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Laporan Penjualan</h1>
    </header>

    <div class="print-button">
        <button onclick="window.print()">Print</button>
    </div>

    <main>
        <p class="text-center">Periode: {{ $tanggal_mulai }} - {{ $tanggal_terakhir }}</p>
        <p>Total Pesanan: {{ $total }}</p>
        <p>Tanggal Cetak: {{ $tanggal_cetak }}</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Customer</th>
                    <th>Tanggal Pesanan</th>
                    <th>Waktu Pesanan</th>
                    <th>Jenis Pesanan</th>
                    <th>Metode Pembayaran</th>
                    <th>Total Pesanan</th>
                    <th>Uang Diterima</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Detail Pesanan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanan as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->tanggal_pesanan }}</td>
                        <td>{{ $p->waktu_pesanan }}</td>
                        <td>{{ $p->jenis_pesanan }}</td>
                        <td>{{ $p->metode_pembayaran }}</td>
                        <td>Rp {{ number_format($p->total_pesanan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($p->uang_diterima, 0, ',', '.') }}</td>
                        <td>{{ $p->catatan }}</td>
                        <td>{{ $p->status }}</td>
                        <td style="text-align: left;">
                            @foreach ($p->detailPesanan as $detail)
                                <div class="detail-item">
                                    - {{ $detail->menu->nama_menu ?? 'Menu Tidak Ditemukan' }} |
                                    Jumlah: {{ $detail->jumlah }} |
                                    Total: Rp {{ number_format($detail->total, 0, ',', '.') }}
                                </div>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>

</html>
