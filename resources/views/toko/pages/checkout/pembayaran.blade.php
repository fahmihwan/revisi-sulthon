@extends('toko.layout.main_checkout')

{{-- @section('head')
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-8TLIpQcwFzXQGo9i"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
@endsection --}}


@section('container-checkout')
    <div class="w-full md:w-2/3 pr-0 md:pr-8 mb-5 md:mb-24 ">
        <div class="border h-full">
            {{-- tabs --}}
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


            <div class=" md:flex hidden ">
                <a href="/checkout/pengiriman" class=" border-t-2 p-3 block bg-gray-100  w-1/2 text-center">
                    <span class="bg-gray-700 inline-block  rounded-full w-6 text-center  text-white mr-1">1</span>
                    Pengiriman
                </a>
                <div class=" border-t-2 p-3  border-emerald-500 w-1/2 inline-block text-center">
                    <span class="inline-block  bg-emerald-500 rounded-full w-6 text-center text-white mr-1">2
                    </span>
                    Pembayaran
                </div>
            </div>

            <form action="/checkout/pembayaran/pay" method="POST">
                @csrf
                <div class="p-5 ">
                    <p class="font-bold border-b-2 py-2 block mb-5">METODE PEMBAYARAN</p>
                    <p class="block mb-3">Pilih metode pembayaran Anda</p>
                    <div class=" relative mb-3">
                        <label for="mandiri" class="border border-gray-300 w-full flex h-14 items-center justify-between">
                            <p class="ml-12 font-semibold">Mandiri Virtual Account</p>
                            <img src="{{ asset('./logo-bank/mandiri.png') }}" alt="" class="w-20 h-6 mr-3">
                        </label>
                        <input id="mandiri" type="radio" name="bank" value="echannel" required
                            class="absolute top-5 left-5">
                    </div>
                    <div class=" relative mb-3">
                        <label for="bca" class="border border-gray-300 w-full flex h-14 items-center justify-between">
                            <p class="ml-12 font-semibold">BCA Virtual Account</p>
                            <img src="{{ asset('./logo-bank/bca.png') }}" alt="" class="w-20 h-6 mr-3">
                        </label>
                        <input id="bca" type="radio" name="bank" value="bca" required
                            class="absolute top-5 left-5">
                    </div>
                    <div class=" relative mb-3">
                        <label for="bni" class="border border-gray-300 w-full flex h-14 items-center justify-between">
                            <p class="ml-12 font-semibold">BNI Virtual Account</p>
                            <img src="{{ asset('./logo-bank/bni.png') }}" alt="" class="w-20 h-6 mr-3">
                        </label>
                        <input id="bni" type="radio" name="bank" value="bni" required
                            class="absolute top-5 left-5">
                    </div>
                    <div class=" relative mb-3">
                        <label for="bri" class="border border-gray-300 w-full flex h-14 items-center justify-between">
                            <p class="ml-12 font-semibold">BRI Virtual Account</p>
                            <img src="{{ asset('./logo-bank/bri.png') }}" alt="bri" class="w-20 h-6 mr-3">
                        </label>
                        <input id="bri" type="radio" name="bank" value="bca" required
                            class="absolute top-5 left-5">
                    </div>

                </div>
                <div class="flex justify-end items-end p-5">
                    <button
                        class="border-black border p-2 w-52 bg-black text-white hover:bg-white hover:text-black duration-300">Buat
                        Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- @include('toko.components.sidebarCheckout') --}}
    <div class="border h-fit w-full md:w-1/3">
        <div class="w-[90%] pt-5 mx-auto font-bold">
            Ringkasan Berbelanja
        </div>
        <div class="w-90% p-3  ">
            @foreach ($items as $item)
                <div class="flex border-t-2 pt-2 pb-7">
                    <img class="w-24 mr-3" src="{{ asset('./storage/' . $item->item->gambar) }}" alt="">
                    <article>
                        {{ $item->item->nama }}<br>
                        <span class="text-gray-500 text-sm">Jumlah : {{ $item->qty }}</span> <br>
                        <span class="text-gray-500 text-sm">Size : {{ $item->ukuran->nama }}</span> <br>
                    </article>
                </div>
            @endforeach
        </div>
        <div class="flex justify-between px-3 pb-2">
            <span class="font-light text-sm">Subtotal Belanja</span>
            <span>Rp. {{ number_format($sub_total, 0, '', '.') }}</span>
        </div>
        <div class="flex justify-between pb-3 px-3">
            <div class=" text-sm">
                <p>Pengiriman</p>
                <p class="text-sm uppercase"> {{ $info_pengiriman['code'] }}<span class="normal-case"> -
                        {{ $info_pengiriman['service'] }}
                        ({{ $info_pengiriman['description'] }})</span></p>
            </div>

            <span>Rp. <span id="sub-total">{{ number_format($info_pengiriman['value'], 0, '', '.') }}</span></span>
        </div>
        <div class="border-t flex justify-between p-3 ">
            <span class="font-light text-sm">Total</span>
            <span class="font-extrabold">Rp. <span>{{ number_format($total, 0, '', '.') }}</span></span>
        </div>
    </div>
@endsection
