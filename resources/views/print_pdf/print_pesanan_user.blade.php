<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            padding: 20px
        }

        .header {
            display: flex;
            margin-bottom: 10px;
        }

        .status {
            display: flex;
            padding: 5px;
            align-items: center;
            border: 1px solid black
        }

        .pesanan-anda {
            padding: 10px;
            border: 1px solid gray;
        }

        .pesanan-anda h1 {
            /* border-bottom: 1px solid black; */
        }

        table.table-item {
            /* border-bottom: 10px solid black; */
            width: 100%;
            text-align: left;
            border-collapse: collapse;

        }

        table.table-item tr {
            border: 1px solid black;
        }

        table.table-item tr th,
        td {
            padding: 10px;
        }

        .total {
            border: 1px solid black;
            display: flex;
            justify-content: end;
        }

        .total table#table-total {
            border: none;
        }

        .total table#table-total {
            border: none;
        }

        table#table-total tr th,
        td {
            padding: 10px;
            border: none;
        }

        section.informasi {
            padding: 10px;
            display: flex;
            justify-content: space-between
        }

        ul.info {
            list-style-type: none;
        }

        ul.detail-info {}
    </style>
</head>

<body>
    <section class="header">
        <h1 style="margin-right: 5px">Order # {{ $item->nota }} </h1>
        <div class="status"> {{ $item->pembayaran->transaction_status }}</div>
    </section>

    <section style="margin-bottom:10px ">
        <p>{{ $item->tanggal_pembelian }}</p>
    </section>

    <section class="pesanan-anda">
        <h1>Pesanan Anda</h1>
        <table class="table-item" colspan="1" rowspan="1">
            <tr style="">
                <th>Nama Produk</th>
                <th>Ukuran</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
            @foreach ($detail_penjualans as $detail)
                <tr>
                    <td>{{ $detail->item->nama }}</td>
                    <td>{{ $detail->ukuran->nama }}</td>
                    <td>Rp. {{ number_format($detail->item->harga, 0, '', '.') }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>RP. {{ number_format($detail->item->harga * $detail->qty, 0, '', '.') }}</td>
                </tr>
            @endforeach

        </table>
        <div class="total">
            <div>
                <table id="table-total">
                    <tr>
                        <td>Sub Total</td>
                        <td>Rp. {{ number_format($sub_total, 0, '', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Pengiriman </td>
                        <td>Rp. {{ number_format($pengiriman->tarif, 0, '', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Nominal Pesanan</td>
                        <td>Rp. {{ number_format($total, 0, '', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>

    <section class="informasi">
        <div class="detail-info">
            <h5>Alamat Pengiriman</h5>
            <ul class="info">
                <li>{{ $alamat->nama_depan }} {{ $alamat->nama_belakang }}</li>
                <li>{{ $alamat->alamat }}</li>
                <li>{{ $alamat->kota }}, {{ $alamat->provinsi }} {{ $alamat->kode_pos }}</li>
                <li>+{{ $alamat->telp }}</li>
            </ul>
        </div>
        <div class="detail-info">
            <h5>Metode Pengiriman</h5>
            <ul class="info">
                <li>{{ $pengiriman->code }}</li>
                <li>{{ $pengiriman->service }} - {{ $pengiriman->deskripsi }}</li>
                <li>{{ $pengiriman->estimasi }}</li>
            </ul>
        </div>
        <div class="detail-info">
            <h5>Metode Pembayaran</h5>
            <ul class="info">
                <li>{{ $pembayaran }}</li>
            </ul>
        </div>
    </section>


</body>

</html>
