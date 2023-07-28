@extends('toko.layout.main')


@section('breadcrumb')
    <nav class="flex border  border-gray-200" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900  ">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                        </path>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fa-solid fa-chevron-right"></i>
                    <a href="/list-item" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2  ">List
                        Item</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fa-solid fa-chevron-right"></i>
                    <a href="/customer/order-history"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2  ">Pesanan</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center ">
                    <i class="fa-solid fa-chevron-right"></i>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 ">Lihat Detail</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection

@section('container')
    <!-- conetent -->
    <div class=" md:flex w-full mt-10">
        <!-- sidebar -->
        @include('toko.components.sidebar-account')

        <div class=" md:w-full">
            <div class=" m-2 py-4 px-2 md:px-10">
                <div class="flex mb-7">
                    <h1 class="font-bold text-2xl ">Order # {{ $item->nota }}</h1>
                    <p class="ml-5 px-5 py-1 border-gray-300 border-2 ">{{ $item->pembayaran->transaction_status }}</p>
                </div>

                <p class="mb-7">{{ $item->tanggal_pembelian }}</p>

                <div class="flex justify-between">
                    <form class="inline" action="/customer/oerder-history/{{ $item->id }}/pesan_ulang" method="POST">
                        @csrf
                        <button>Pesan Ulang</button>
                    </form>
                    <a href="/customer/order-history/detail/{{ $item->id }}/print" class="text-sm">Cetak Pesanan</a>
                </div>

                <div class="border mt-3 text-xs p-5 mb-5">
                    <table class="w-full">
                        <tr class="border-b">
                            <td class="md:p-3 font-semibold">Nama Produk</td>
                            <td class="md:p-3 font-semibold">Ukuran</td>
                            <td class="md:p-3 font-semibold ">Harga</td>
                            <td class="md:p-3 font-semibold ">Jumlah</td>
                            <td class="md:p-3 font-semibold ">Subtotal</td>
                        </tr>
                        @foreach ($detail_penjualans as $item)
                            <tr class="text-sm border-b">
                                <td class="py-2 md:p-3">{{ $item->item->nama }}</td>
                                <td class="py-2 md:p-3">{{ $item->ukuran->nama }}</td>
                                <td class="py-2 md:p-3">Rp. {{ number_format($item->item->harga, 0, '', '.') }}</td>
                                <td class="py-2 md:p-3">{{ $item->qty }}</td>
                                <td class="py-2 md:p-3">Rp. {{ number_format($item->qty * $item->item->harga, 0, '', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <section class="bg-gray-100 flex justify-end text-sm border-t-2 mb">
                        <table class="">
                            <tr>
                                <td class="p-2 text-right">Subtotal</td>
                                <td class="p-2 text-right">Rp. {{ number_format($sub_total, 0, '', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="p-2 text-right">Pengiriman</td>
                                <td class="p-2 text-right">Rp. {{ number_format($pengiriman->tarif, 0, '', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="p-2 text-right font-bold">Nominal Pesanan</td>
                                <td class="p-2 font-bold">Rp. {{ number_format($total, 0, '', '.') }}</td>
                            </tr>
                        </table>
                    </section>

                </div>

                <section class="mb-10">
                    <h1 class=" border-b mb-5">INFORMASI PEMESANAN</h1>
                    <div class="md:flex">
                        <div class="w-full md:w-1/3 border-b md:border-none">
                            <h1 class=" font-bold py-3">Alamat Pengiriman</h1>
                            <p class="font-light text-sm pb-2">{{ $alamat->nama_depan }} {{ $alamat->nama_belakang }}</p>
                            <p class="font-light text-sm pb-2">{{ $alamat->alamat }}</p>
                            <p class="font-light text-sm pb-2">{{ $alamat->kota }}, {{ $alamat->provinsi }},
                                {{ $alamat->kode_pos }}</p>
                            <p class="font-light text-sm pb-2">{{ $alamat->telp }}</p>
                        </div>
                        <div class=" w-full md:w-1/3 border-b md:border-none">
                            <h1 class=" font-bold py-3">Metode Pengiriman</h1>
                            <p class="font-light text-sm pb-2">{{ $pengiriman->code }} </p>
                            <p class="font-light text-sm pb-2">{{ $pengiriman->service }} - {{ $pengiriman->deskripsi }}
                            </p>
                            <p class="font-light text-sm pb-2">{{ $pengiriman->estimasi }}</p>
                        </div>
                        <div class=" w-full md:w-1/3 border-b md:border-none">
                            <h1 class=" font-bold py-3">Metode Pembayaran </h1>
                            <p class="font-light text-sm pb-2">{{ $pembayaran }}</p>
                        </div>
                    </div>
                </section>


            </div>
        </div>
    </div>
@endsection
