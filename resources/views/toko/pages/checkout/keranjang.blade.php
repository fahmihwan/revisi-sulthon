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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 ">Keranjang Belanja</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection

@section('container')
    <div class="w-full">

        <nav class="p-4 hidden md:flex  border bg-gray-100  ">
            <div class="w-1/3">
                <span>Butuh Bantuan?</span>
            </div>
            <div class="w-96  text-center  flex justify-between items-center">
                <a href="" class="block "><i class="fab fa-whatsapp"></i> 082332112343</a>
                <p class=" inline-block mr10  text-xs text-gray-400">7 days a week 08.00 – 21.00
                    WIB</p>
            </div>
            <div class="w-1/3">

            </div>
        </nav>

        <div class="w-full md:flex mt-0 md:mt-5  ">
            <div class="w-full md:w-4/6  md:flex md:justify-end pr-0 md:pr-10">
                <div class=" w-full md:w-5/6 border">
                    @forelse ($items as $item)
                        <div class="flex m-5 bg-gray-100 p-2">
                            <div class="w-32  md:w-2/12  flex justify-center m-2 ">
                                <img class="w-32 h-32 md:w-auto md:h-auto "
                                    src="{{ asset('./storage/' . $item->item->gambar) }}" alt="">
                            </div>
                            <div class=" md:w-10/12 pl-0 md:pl-10 pt-3 flex justify-between">
                                <div class="w-1/2">
                                    <a href="" class="underline">{{ $item->item->nama }}</a>
                                    <p class="text-xs mt-2"><span class="text-gray-500">Size </span>:
                                        {{ $item->ukuran->nama }}</p>
                                </div>
                                <div class="w-1/2">
                                    <div class="float-right ">
                                        <p class="text-sm total_qty_harga">Rp.
                                            {{ number_format($item->item->harga * $item->qty, 0, '', '.') }}
                                        </p>
                                        <select data-id="{{ $item->id }}"
                                            class="select-qty border-t-0  border-x-0 float-right  bg-white border-b border-black"
                                            name="qty-cart" id="">
                                            @if ($item->qty > 10)
                                                @for ($i = 1; $i <= $item->qty; $i++)
                                                    <option {{ $item->qty == $i ? 'selected' : '' }}
                                                        value="{{ $i }}">
                                                        {{ $i }}</option>
                                                @endfor
                                            @else
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <option {{ $item->qty == $i ? 'selected' : '' }}
                                                        value="{{ $i }}">
                                                        {{ $i }}</option>
                                                @endfor
                                            @endif
                                        </select>
                                    </div>
                                    <div class="float-right flex md:block w-52 md:w-full items-center  mt-5">
                                        <a href="" class="text-xs mr-3 font-semibold underline">SAVE FOR LATER</a>
                                        <a href="/checkout/cart/{{ $item->id }}/edit-cart"
                                            class="text-xs mr-3 font-semibold underline">UBAH</a>
                                        <form class="inline-block" action="/list-item/cart/{{ $item->id }}/destroy"
                                            method="POST">
                                            @method('delete')
                                            @csrf
                                            <button class="text-xs font-semibold underline">HAPUS</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty

                        <div class="border h-full flex items-center justify-center">
                            <h1>Keranjang Belanja Anda Kosong, </h1> &nbsp;klik&nbsp;<a href="/list-item"
                                class="text-blue-700 underline">
                                disini </a> &nbsp;untuk
                            Berbelanja.
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="w-full md:w-2/6 ">
                <div class="bg-gray-100 mr-0 md:mr-0 lg:mr-32 pb-5">
                    <h1 class="font-bold text-lg text-center p-3 ">Ringkasan Belanja</h1>
                    <div class=" p-2 mb-4 bg-white mx-5">
                        <table class="w-full">
                            <tr>
                                <td class="py-5 text-xs text-gray-500">Subtotal</td>
                                <td class="text-right text-xs text-gray-500">Rp.
                                    {{ number_format($total_keranjang, 0, '', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold text-sm">Total</td>
                                <td class="text-right font-bold text-sm">Rp.
                                    {{ number_format($total_keranjang, 0, '', '.') }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <p class="text-center text-xs mb-3"><i class="fa-solid fa-clipboard-check"></i> Checkout dengan cepat
                        dan aman</p>
                    <div class=" p-5 bg-white mx-5">
                        <a href="/checkout/pengiriman"
                            class="w-full text-center block py-3 bg-black text-white hover:bg-white hover:text-black duration-300 border border-black">
                            Lanjut Checkout
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {

            $('.select-qty').change(function() {

                $.ajax({
                    url: `/checkout/cart/${$(this).attr('data-id')}/ajax`,
                    type: 'PUT',
                    cache: false,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "qty": $(this).val()
                    },
                    success: function(response) {
                        if (response.status == false) {
                            alert(response.message)
                        }
                        window.location.href = '/checkout/cart'
                    },
                    error: function(error) {
                        alert('error')
                    }

                })


            })


        })
    </script>
@endsection
