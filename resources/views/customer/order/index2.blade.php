@extends('layout.master')

@section('title', 'Checkout')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="top_tiles">
            <h1>Checkout</h1>
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h2>Rincian Pesanan</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">

                                @php
                                    $keranjang = [
                                        ['id' => 1, 'nama' => 'Ikan Bakar', 'harga' => 22000, 'jumlah' => 2, 'gambar' => 'ayam_geprek.jpeg'],
                                        ['id' => 2, 'nama' => 'Ayam Geprek', 'harga' => 20000, 'jumlah' => 1, 'gambar' => 'ayam_geprek.jpeg'],
                                    ];
                                    $total = collect($keranjang)->reduce(fn($carry, $item) => $carry + ($item['harga'] * $item['jumlah']), 0);
                                @endphp

                                <table class="table table-striped table-bordered" id="checkoutTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Menu</th>
                                            <th>Harga Satuan</th>
                                            <th class="text-center">Jumlah</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($keranjang as $index => $item)
                                            <tr data-id="{{ $item['id'] }}" data-harga="{{ $item['harga'] }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <img src="{{ asset('assets/images/' . $item['gambar']) }}" alt="{{ $item['nama'] }}"
                                                        style="max-height: 60px;" class="img-fluid"
                                                        onerror="this.src='{{ asset('assets/images/ayam_geprek.jpeg') }}'">
                                                </td>
                                                <td>{{ $item['nama'] }}</td>
                                                <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <button class="btn btn-sm btn-danger kurang-btn">–</button>
                                                        <input type="text" class="form-control text-center mx-1 jumlah-input" value="{{ $item['jumlah'] }}" style="width: 60px;">
                                                        <button class="btn btn-sm btn-primary tambah-btn">+</button>
                                                    </div>
                                                </td>
                                                <td class="total-item">Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-danger hapus-item">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="mt-4">
                                    <h4>Total Belanja:
                                        <strong class="text-success" id="total-belanja-text">
                                            Rp {{ number_format($total, 0, ',', '.') }}
                                        </strong>
                                    </h4>
                                </div>

                                <input type="hidden" id="total-belanja" value="{{ $total }}">

                                <button type="button" class="btn btn-success mt-4" data-toggle="modal" data-target="#checkoutModal">
                                    Proses Pembayaran
                                </button>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal Checkout -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/checkout/submit" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Formulir Checkout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran:</label>
                        <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" required>
                            <option value="">-- Pilih --</option>
                            <option value="cash">Cash</option>
                            <option value="qris">QRIS (Midtrans)</option>
                        </select>
                    </div>

                    <div id="cash-fields" style="display: none;">
                        <div class="form-group">
                            <label for="total_belanja_cash">Total Belanja:</label>
                            <input type="text" class="form-control" id="total_belanja_cash" value="Rp {{ number_format($total, 0, ',', '.') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="uang_diterima">Uang Diterima:</label>
                            <input type="text" class="form-control" id="uang_diterima" name="uang_diterima">
                        </div>
                        <div class="form-group">
                            <label for="kembalian">Kembalian:</label>
                            <input type="text" class="form-control" id="kembalian" readonly>
                        </div>
                    </div>

                    <div id="qris-fields" style="display: none;">
                        <div class="form-group">
                            <label>QRIS (Scan Barcode):</label>
                            <img src="{{ asset('assets/images/dumy-qris.png') }}" alt="QRIS" class="img-fluid" style="max-width: 300px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan:</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Proses Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Tambah jQuery jika belum ada --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function parseRupiah(rp) {
            return parseInt(rp.replace(/[^0-9]/g, '')) || 0;
        }

        function updateTotalBelanja() {
            let total = 0;
            $('#checkoutTable tbody tr').each(function (index) {
                const harga = parseInt($(this).data('harga'));
                const jumlah = parseInt($(this).find('.jumlah-input').val());
                const totalItem = harga * jumlah;

                $(this).find('.total-item').text(formatRupiah(totalItem));
                $(this).find('td:first').text(index + 1); // update no
                total += totalItem;
            });

            $('#total-belanja').val(total);
            $('#total-belanja-text').text(formatRupiah(total));
            $('#total_belanja_cash').val(formatRupiah(total));
        }

        $(document).on('click', '.tambah-btn', function () {
            const input = $(this).siblings('.jumlah-input');
            let val = parseInt(input.val()) || 0;
            input.val(val + 1);
            updateTotalBelanja();
        });

        $(document).on('click', '.kurang-btn', function () {
            const input = $(this).siblings('.jumlah-input');
            let val = parseInt(input.val()) || 0;
            if (val > 1) {
                input.val(val - 1);
                updateTotalBelanja();
            }
        });

        $(document).on('click', '.hapus-item', function () {
            $(this).closest('tr').remove();
            updateTotalBelanja();
        });

        $('#metode_pembayaran').on('change', function () {
            const metode = $(this).val();
            $('#cash-fields, #qris-fields').hide();

            if (metode === 'cash') {
                $('#cash-fields').show();
                $('#uang_diterima').val('');
                $('#kembalian').val('');
            } else if (metode === 'qris') {
                $('#qris-fields').show();
            }
        });

        $('#uang_diterima').on('keyup', function () {
            let angka = parseRupiah($(this).val());
            $(this).val(formatRupiah(angka));
            let total = parseInt($('#total-belanja').val());
            let kembalian = angka - total;
            $('#kembalian').val(formatRupiah(kembalian >= 0 ? kembalian : 0));
        });
    });
</script>

@endsection
