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
            font-family: Arial, Helvetica, sans-serif;
        }

        .paragraf {
            text-align: center;
            margin-top: 15px
        }

        .content {
            display: flex;
            align-items: center;
            border: 1px solid black;
            width: 500px;
            margin: 20px auto;
            padding: 10px;
            background: white;
            height: 500px
        }

        .list {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }


        table tr,
        td {
            padding: 2px 10px;
        }

        .qty {
            margin-left: 10px;
            color: gray;
        }
    </style>
</head>

<body style="background: rgb(243, 243, 243)">
    <div class="content">
        <div>
            <div style="text-align: center; ">
                <p style="text-align: left; padding: 5px; 0px; ">
                <p style="font-size: 17px; font-weight: bold">TERIMA TElAH BERBELANJA DI OUTLAWS STUDIO</p> <br>
                <p>Pembayaran anda sudah kami Terima</p>
                <p>Kami akan segera mengiirmkan paket anda</p>
            </div>
            <div class="list">
                <table style="">
                    <tr>
                        <td>invoice</td>
                        <td>{{ $pembayaran->nota }}</td>
                    </tr>
                    <tr>
                        <td>order id</td>
                        <td>{{ $pembayaran->code_order }}</td>
                    </tr>
                    <tr>
                        <td style="">detail transaction</td>
                        <td style="padding: 0 0 0 20px ">
                            <ul>
                                @foreach ($detail_penjualan as $item)
                                    <li>{{ $item->nama }}
                                        <span style="color:gray"> size:{{ $item->ukuran }}</span>
                                        <span style="color:gray">x{{ $item->qty }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>

            <div style="margin-top: 10px;">
                <div style="padding: 5px">
                    <table style="width: 100%; background: rgb(201, 201, 201); padding: 5px;">
                        <tr>
                            <td>Sub Total</td>
                            <td style="text-align: end">Rp
                                {{ $pembayaran->total }}
                            </td>
                        </tr>
                        <tr>
                            <td>Pengiriman</td>
                            <td style="text-align: end">Rp
                                {{ $pembayaran->tarif }}
                            </td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td style="text-align: end">Rp
                                {{ $pembayaran->total + $pembayaran->tarif }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="paragraf">
                <p style="font-size: 12px">Jika Anda memiliki pertanyaan tentang pesanan Anda, silakan email kami di
                    outlawsstuido@gmail.com atau
                    hubungi
                    dengan kami di 081575111117. Jam operasional kami adalah 08.00 - 21.00 WIB.</p>
            </div>
        </div>


    </div>
</body>

</html>
