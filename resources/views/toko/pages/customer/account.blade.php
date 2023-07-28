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
            <li aria-current="page">
                <div class="flex items-center ">
                    <i class="fa-solid fa-chevron-right"></i>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 ">Akun Saya</span>
                </div>
            </li>
        </ol>
    </nav>
    @if (session('thanks'))
        <div class="bg-green-200 text-green-800 mx-5 absolute left-1 right-1  z-10 py-2 px-2 ">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('thanks') }}
        </div>
    @endif
@endsection

@section('container')
    <!-- conetent -->
    <div class=" md:flex w-full mt-10">
        <!-- sidebar -->
        @include('toko.components.sidebar-account')


        {{-- informasi  --}}
        <div class=" md:w-full">
            <div class=" m-2 py-4 px-10">
                <div class=" flex">
                    <div>
                        <h1 class="font-bold text-2xl mb-7">Akun Saya</h1>
                        <h1 class="font-bold text-2xl mb-6">INFORMASI AKUN & ALAMAT</h1>
                    </div>
                    <div class="flex ml-8 mb-5 items-end">
                        <a href="/customer/order-history"
                            class="border h-6 flex items-center px-10 text-xs border-black hover:bg-black hover:text-white">
                            Lihat Semua
                        </a>
                    </div>

                </div>
                <div class="overflow-x-auto relative mb-14">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700  uppercase bg-gray-200">
                            <tr>
                                <th scope="col" class="py-3 px-6 font-extrabold">
                                    Nomor Pesanan
                                </th>
                                <th scope="col" class="py-3 px-6 font-extrabold">
                                    Tanggal Pemesanan
                                </th>
                                <th scope="col" class="py-3 px-6 font-extrabold">
                                    Kirim Ke
                                </th>
                                <th scope="col" class="py-3 px-6 font-extrabold">
                                    Total
                                </th>
                                <th scope="col" class="py-3 px-6 font-extrabold">
                                    Status
                                </th>
                                <th scope="col" class="py-3 px-6 font-extrabold">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $item->nota }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $item->tanggal_pembelian }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $item->alamat->nama_depan }} {{ $item->alamat->nama_belakang }}
                                    </td>
                                    <td class="py-4 px-6">
                                        Rp. {{ number_format($item->total, 0, '', '.') }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $item->pembayaran->transaction_status }}
                                    </td>
                                    <td class="py-4 px-3 text-xs">
                                        <a href="/customer/order-history/{{ $item->id }}/detail-pesanan">Lihat Detail
                                        </a>&nbsp; | &nbsp;
                                        <form class="inline"
                                            action="/customer/oerder-history/{{ $item->id }}/pesan_ulang"
                                            method="POST">
                                            @csrf
                                            <button>Pesan Ulang</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <section class="mb-16">
                    <h1 class="font-bold text-2xl mb-2">INFORMASI AKUN</h1>
                    <hr class="mb-4">
                    <h5 class="font-bold text-sm">Informasi Kontak</h5>
                    <p class="text-sm text-gray-600">{{ $user->credential->nama_depan }}
                        {{ $user->credential->nama_belakang }}</p>
                    <p class="text-sm text-gray-600">
                        {{ $user->email }}
                    </p>
                    <div class="text-gray-500 text-xs mt-5">
                        <a href="/customer/account/edit" class="underline hover:text-red-900">Ubah </a>&nbsp; | &nbsp;
                        <a href="/customer/account/edit" class="underline hover:text-red-900">Ubah Kata Sandi </a>
                    </div>
                </section>

                <section class="mb-40">

                    <div class="flex mb-2">
                        <h1 class="font-bold text-2xl mr-10">ALAMAT</h1>
                        <a href="/customer/address"
                            class="border-2 flex items-center px-10 text-xs border-black hover:bg-black hover:text-white">
                            Pengaturan
                            Alamat
                        </a>
                    </div>
                    <hr class="mb-4">
                    @if ($alamat)
                        <h5 class="font-bold text-sm">Alamat Pengiriman</h5>
                        <p class="text-sm text-gray-600">{{ $alamat->nama_depan }} {{ $alamat->nama_belakang }}</p>
                        <p class="text-sm text-gray-600">{{ $alamat->alamat }}</p>
                        <p class="text-sm text-gray-600">
                            {{ $alamat->kota }},{{ $alamat->provinsi }},{{ $alamat->kode_pos }}</p>
                        <p class="text-sm text-gray-600">{{ $alamat->telp }}</p>
                        <div class="text-gray-500 text-xs mt-5">
                            <a href="/customer/address/{{ $alamat->id }}/edit" class="underline hover:text-red-900">Ubah
                                Alamat</a>&nbsp;
                        </div>
                    @else
                        <div>
                            <p class="text-gray-500">Anda belum memiliki alamat</p>
                        </div>
                    @endif


                </section>

            </div>
        </div>
    </div>
@endsection
