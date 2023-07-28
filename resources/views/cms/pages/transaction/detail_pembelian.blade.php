@extends('cms.layouts.main')


@section('container')
    <div class="w-full px-2 ">
        <nav class="flex justify-between mb-4 p-2 bg-white shadow-md text-black rounded-md" aria-label="Breadcrumb ">
            <div class="font-bold text-2xl text-gray-700">
                Detail Transaksi
            </div>
            <div>
                <ol class="inline-flex items-center space-x-1 md:space-x-3  ">
                    <li class="inline-flex items-center">
                        <a href="/admin/list-transaction"
                            class="inline-flex items-center text-sm font-medium  hover:text-gray-900">
                            Kelola Transaksi
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right text-gray-400"></i>
                            <a href="#" class="ml-1 text-sm font-medium hover:text-gray-900 md:ml-2 ">Detail
                                Transaksi</a>
                        </div>
                    </li>
                </ol>
            </div>
        </nav>

        <section class="flex justify-between mb-2">
            <div>
            </div>
            @if (request()->is('admin/list-transaction/*'))
               @if (auth()->guard('webadmin')->user()->hak_akses == 'owner')
                <a href="/admin/dashboard"
                class="bg-purple-600 hover:bg-white hover:text-black border hover:duration-200 hover:border-purple-600 text-white p-2 rounded">
                <i class="fa-solid fa-arrow-left"></i> Kembali
                 </a>
               @endif
               
                 @if (auth()->guard('webadmin')->user()->hak_akses == 'karyawan')
                    <a href="/admin/list-transaction"
                    class="bg-purple-600 hover:bg-white hover:text-black border hover:duration-200 hover:border-purple-600 text-white p-2 rounded">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                 @endif
               
            @endif

            @if (request()->is('admin/report-transaction/*'))
                <a href="/admin/laporan/confirmed"
                    class="bg-purple-600 hover:bg-white hover:text-black border hover:duration-200 hover:border-purple-600 text-white p-2 rounded">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            @endif
        </section>
        @if ($errors->any())
            <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                role="alert">
                <div>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span class="font-medium">Ensure that these requirements are met:</span>
                    <ul class="mt-1.5 ml-4 text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="flex flex-col-reverse md:flex-row">
            <div class="w-full rounded mt-3 mb-6 md:mb-0 px-2">
                <div class="flex items-center justify-between mb-5">
                    <h1 class="text-4xl">Status Pengiriman : <span
                            @class([
                                'text-green-500' => $penjualan->status_pengiriman == 'confirmed',
                                'text-orange-400' => $penjualan->status_pengiriman == 'pending',
                                'text-red-600' => $penjualan->status_pengiriman == 'rejected',
                            ])>{{ $penjualan->status_pengiriman }}</span></h1>
                    <div class="">
                        @if (request()->is('admin/list-transaction/*'))
                           @if (auth()->guard('webadmin')->user()->hak_akses != 'owner')
                           <form action="/admin/list-transaction/{{ $id }}/konfirmasi" method="POST">
                            @method('PUT')
                            @csrf
                            <button
                                onclick="return confirm('perubahan status tidak dapat dibatalkan, apakah anda yakin?')"
                                name="status_pengiriman" value="confirmed"
                                class="bg-green-500 disabled:opacity-75    text-white p-2 rounded">
                                Confirm
                            </button>
                            <button
                                onclick="return confirm('perubahan status tidak dapat dibatalkan, apakah anda yakin?')"
                                name="status_pengiriman" value="rejected"
                                class="bg-red-600 disabled:opacity-75 text-white p-2 rounded">
                                Reject
                            </button>
                        </form>
                           @endif
                        @endif
                    </div>
                </div>
                <h1 class="font-bold">Detail Order Customer : </h1>
            </div>
        </div>
        <div class="flex flex-col-reverse md:flex-row">
            <div class="w-full md:w-1/2 bg-white rounded mt-3 mb-6 md:mb-0 px-2">

                {{-- informasi pembelian --}}
                <div class="overflow-x-auto border-2 border-purple-700  shadow-md rounded mb-5 ">
                    <div class="px-2 bg-purple-700  text-white">
                        Informasi Pembelian
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 bg-gray-100 ">
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2">
                                Nota
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $penjualan->nota }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2">
                                Tanggal Pembelian
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $penjualan->tanggal_pembelian }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2 ">
                                Jumlah Pembelian
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $penjualan->qty }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2 ">
                                Jumlah Pembelian
                            </th>
                            <td class="py-2 px-6 bg-white">
                                Rp. {{ number_format($penjualan->total, 0, '', '.') }}
                            </td>
                        </tr>
                    </table>
                </div>
                {{-- informasi Kurir --}}
                <div class="overflow-x-auto border-2 border-purple-700  shadow-md rounded mb-5 ">
                    <div class="px-2 bg-purple-700  text-white">
                        Informasi Kurir
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 bg-gray-100 ">
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2">
                                Kurir
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $kurir->code }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2">
                                Layanan
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $kurir->service }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2 ">
                                Deskripsi
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $kurir->deskripsi }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2 ">
                                Tarif
                            </th>
                            <td class="py-2 px-6 bg-white">
                                Rp. {{ number_format($kurir->tarif, 0, '', '.') }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2 ">
                                Estimasi
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $kurir->estimasi }} hari
                            </td>
                        </tr>
                    </table>
                </div>

                {{-- informasi pembayaran --}}
                <div class="overflow-x-auto border-2 border-purple-700  shadow-md rounded mb-5 ">
                    <div class="px-2 bg-purple-700  text-white">
                        Informasi Pembayaran
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 bg-gray-100 ">
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2">
                                Kode Transaksi
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $pembayaran->code_transaction }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2">
                                Kode Order
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $pembayaran->code_order }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2 ">
                                Kode Merchant
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $pembayaran->code_merchant }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2 ">
                                Kode Bank
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $pembayaran->code_bank }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2 ">
                                Status Transaksi Pembayaran
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $pembayaran->transaction_status }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2 ">
                                Va Number
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $pembayaran->va_number ? $pembayaran->va_number : 'null' }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2 ">
                                Bill Key
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $pembayaran->bill_key ? $pembayaran->bill_key : 'null' }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2 ">
                                Biller Code
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $pembayaran->biller_code ? $pembayaran->biller_code : 'null' }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- informasi pengiriman --}}
            <div class="w-full md:w-1/2  bg-white rounded mt-3 mb-6 md:mb-0 px-2">
                <div class="overflow-x-auto border-2 border-purple-700  shadow-md rounded mb-5 ">
                    <div class="px-2 bg-purple-700  text-white">
                        Informasi Pengiriman
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 bg-gray-100 ">
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2">
                                nama
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $alamat->nama_depan }} {{ $alamat->nama_belakang }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2">
                                alamat
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $alamat->alamat }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2 ">
                                provinsi
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $alamat->provinsi }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2 ">
                                kota
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $alamat->kota }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2 ">
                                kode pos
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $alamat->kode_pos }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th class=" py-2 w-36 px-2 ">
                                telp
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $alamat->telp }}
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="overflow-x-auto border-2 border-purple-700  shadow-md rounded mb-5 ">
                    <div class="px-2 bg-purple-700  text-white">
                        Informasi Pemesanan
                    </div>

                    @foreach ($informasi_pemesanan as $item)
                        <div class="p-2 border-b flex">
                            <img src="{{ asset('/storage/' . $item->gambar) }}" class="w-36" alt="">
                            <div class="px-5">
                                <p class="font-bold ">{{ $item->item_nama }}</p>
                                <p>Katgori {{ $item->kategori_nama }} </p>
                                <p>qty {{ $item->qty }}</p>
                                <p>Harga: Rp {{ number_format($item->harga_total, 0, '', '.') }}</p>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
