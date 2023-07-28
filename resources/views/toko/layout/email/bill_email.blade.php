
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
    </style>
</head>

<body style="background: rgb(243, 243, 243)">
    <div style="border: 1px solid black; width: 500px; margin: 20px auto; padding: 10px; background: white">
        <div style="text-align: center">
            <p style="text-align: left; padding: 5px; 0px; ">Hi {{ $data['user']['credential']['nama_depan'] }}
                {{ $data['user']['credential']['nama_belakang'] }}</p>
            <p style="font-size: 17px; font-weight: bold">TERIMA KASIH SUDAH MEMESAN DI OUTLAWS STUDIO</p>
            Pesanan sedang <span style="font-weight: bold">Menunggu Pembayaran</span>
        </div>


        @if (isset($data['response']['va_numbers']) != null)
            <div class="paragraf">
                <p style="font-weight: bold">Berikut kode pembayaran rekening virtual: </p>
                <p style="font-weight: bold; font-size: 23px;">{{ $data['response']['va_numbers'][0]['va_number'] }}
                </p>
                <p>Kami akan memproses pesanan setelah kami menerima pembayaran Anda</p>
            </div>
        @endif
        @if (isset($data['response']['bill_key']) != null && isset($data['response']['biller_code']) != null)
            <div class="paragraf">
                <p style="font-weight: bold">Berikut kode pembayaran rekening virtual: </p>
                <p style="padding: 10px 0px; font-weight: bold; font-size: 20px;">
                    <span style="color:gray">Bill Key</span> {{ $data['response']['bill_key'] }} <br>
                    <span style="color:gray">Biller Code</span> {{ $data['response']['biller_code'] }}
                </p>
                <p>Kami akan memproses pesanan setelah kami menerima pembayaran Anda</p>
            </div>
        @endif

        <div class="paragraf">
            <p style="font-weight: bold; font-size: 17px;">METODE PENGIRIMAN</p>
            <p>{{ $data['pengiriman'] }}</p>
        </div>
        <div class="paragraf">
            <p style="font-weight: bold; font-size: 17px;">BATAS AKHIR PEMBAYARAN</p>
            <p>{{ $data['batas_akhir_pembayaran'] }}</p>
        </div>
        @if (isset($data['response']['va_numbers'][0]['bank']) != null)
            <div class="paragraf">
                <p style="font-weight: bold; font-size: 17px;">METODE PEMBAYARAN</p>
                <p>{{ $data['response']['va_numbers'][0]['bank'] }}</p>
            </div>
        @endif
        @if (isset($data['response']['va_numbers'][0]['bank']) == null)
            <div class="paragraf">
                <p style="font-weight: bold; font-size: 17px;">METODE PEMBAYARAN</p>
                <p>Mandiri</p>
            </div>
        @endif

        <div class="paragraf">
            <p style="font-size: 12px">Jika Anda memiliki pertanyaan tentang pesanan Anda, silakan email kami di
                outlawsstuido@gmail.com atau
                hubungi
                dengan kami di 081575111117. Jam operasional kami adalah 08.00 - 21.00 WIB.</p>
        </div>
        <div class="paragraf">
            <p style="font-size: 20px">Pesanan dengan nomor order <span style="font-weight: bold">
                    {{ $data['response']['order_id'] }}
                </span>
            </p>
            <p style="color:gray">Dilakukan pada
                {{ $data['response']['transaction_time'] }}
            </p>
            <hr style="margin-top: 10px">
        </div>
        <div style="margin-top: 10px;">
            <p style="font-size: 20px">NFO PENGIRIMAN:</p>
            <div>
                {{ $data['user']['credential']['nama_depan'] }} {{ $data['user']['credential']['nama_belakang'] }}
                <br>
                {{ $data['user']['credential']['alamat']['alamat'] }} <br>
                {{ $data['user']['credential']['alamat']['kota'] }},
                {{ $data['user']['credential']['alamat']['provinsi'] }},
                {{ $data['user']['credential']['alamat']['kode_pos'] }} <br>
                {{ $data['user']['credential']['alamat']['telp'] }}<br>
            </div>
            <hr style="margin-top: 10px">
        </div>
        <div style="margin-top: 10px;">
            Nama Item
            <hr style="margin-top: 10px">
            @foreach ($data['keranjang'] as $item)
                <div style="display: flex; border-bottom: 1px solid rgb(192, 192, 192);">

                    {{-- 1. berhasil mengirimkan email dengan gambar tanpa queue job, tp terjadi error jika melalui queue job --}}
                    {{-- jika melalui queue job: error unable to open path --}}
                    <img src="{{ $message->embed('./storage/' . $item->item->gambar) }}" style="width: 100px;"  alt="">
              
                    {{-- 2. berhasil mengirimkan email tapi gambar tidak terbaca di direcotry melalui queue job--}}
                    <img src="{{ 'storage/'. base64_encode($item->item->gambar) }}" style="width: 100px;"  alt="">



                    {{-- <img src="{{ $message->embed('storage/'. base64_encode($item->item->gambar)) }}" style="width: 100px;"  alt=""> --}}



                    <div style="padding: 5px">
                        <p>{{ $item->item->nama }}</p>
                        <p>ukuran {{ $item->ukuran->nama }} </p>
                        <p>qty {{ $item->qty }}</p>
                        <p>Harga Rp {{ number_format($item->item->harga, 0, '', '.') }}</p>
                    </div>
                </div>
            @endforeach


            <div style="padding: 5px">
                <table style="width: 100%; background: rgb(201, 201, 201); padding: 5px;">
                    <tr>
                        <td>Sub Total</td>
                        <td style="text-align: end">Rp
                            {{ number_format($data['sub_total'], 0, '', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Pengiriman</td>
                        <td style="text-align: end">Rp
                            {{ number_format($data['ongkir'], 0, '', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Nominal Pemesanan</td>
                        <td style="text-align: end">Rp
                            {{ number_format($data['response']['gross_amount'], 0, '', '.') }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</body>

</html> 
