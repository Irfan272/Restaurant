<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Struk Pesanan</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 2cm;
            font-size: 14px;
        }

        h2,
        h4 {
            text-align: center;
            margin: 0;
        }

        .section {
            margin-top: 20px;
        }

        .label {
            font-weight: bold;
            width: 200px;
            display: inline-block;
        }

        .value {
            display: inline-block;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 13px;
        }

        .detail-table th,
        .detail-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .print-button {
            text-align: right;
            margin-bottom: 20px;
        }

        .print-button button {
            padding: 8px 15px;
            font-size: 14px;
            cursor: pointer;
        }

        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>

<body>


    <h2>Struk Pesanan</h2>
    <h4>Nomor Pesanan: #{{ $pesanan->id }}</h4>

    <div class="section">
        <div><span class="label">Nama Customer:</span> <span class="value">{{ $pesanan->user->name }}</span></div>
        <div><span class="label">No HP:</span> <span class="value">{{ $pesanan->user->detailUser->no_hp ?? '-' }}</span>
        </div>
        <div><span class="label">Alamat:</span> <span
                class="value">{{ $pesanan->user->detailUser->alamat ?? '-' }}</span></div>
        {{-- <div><span class="label">Jenis Kelamin:</span> <span
                class="value">{{ $pesanan->user->detailUser->jenis_kelamin ?? '-' }}</span></div> --}}
        {{-- <div><span class="label">Tanggal Lahir:</span> <span class="value">{{ $pesanan->user->tanggal_lahir ?? '-' }}</span></div> --}}
    </div>

    <div class="section">
        <div><span class="label">Tanggal Pesanan:</span> <span class="value">{{ $pesanan->tanggal_pesanan }}</span>
        </div>
        <div><span class="label">Waktu Pesanan:</span> <span class="value">{{ $pesanan->waktu_pesanan }}</span></div>
        <div><span class="label">Jenis Pesanan:</span> <span class="value">{{ $pesanan->jenis_pesanan }}</span></div>
        <div><span class="label">Metode Pembayaran:</span> <span
                class="value">{{ $pesanan->metode_pembayaran }}</span></div>
        {{-- <div><span class="label">Status:</span> <span class="value">{{ $pesanan->status }}</span></div> --}}
        <div><span class="label">Catatan:</span> <span class="value">{{ $pesanan->catatan }}</span></div>
    </div>

    <h4>Detail Pesanan</h4>
    <table class="detail-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pesanan->detailPesanan as $i => $detail)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="text-left">{{ $detail->menu->nama_menu ?? 'Menu Tidak Ditemukan' }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp {{ number_format($detail->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section">
        <div><span class="label">Total Pesanan:</span> <span class="value">Rp
                {{ number_format($pesanan->total_pesanan, 0, ',', '.') }}</span></div>
        @if ($pesanan->metode_pembayaran != 'qris')
            <div><span class="label">Uang Diterima:</span> <span class="value">Rp
                    {{ number_format($pesanan->uang_diterima, 0, ',', '.') }}</span></div>
        @endif
        <div><span class="label">Tanggal Cetak:</span> <span
                class="value">{{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}</span></div>
    </div>

</body>

</html>
