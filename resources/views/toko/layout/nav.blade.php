<nav class="bg-white">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl  ">
        <a href="/" class="flex pl-5 items-center">
            <img src="{{ asset('./logo-bank/outlaws-logo.png') }}" class="w-28 mr-3 hidden md:block" alt="Flowbite Logo">
            <span class="self-center md:text-xl font-semibold whitespace-nowrap text-md "> Outlaws Studio</span>
        </a>


        {{-- cari --}}

        <div class="flex md:hidden items-center py-3 mr-4 ">
            {{-- DRAWER CART MOBILE --}}

            <div class="text-center  ">
                <button
                    class="block pr-4 relative pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 "
                    type="button" data-drawer-target="drawer-cart" data-drawer-show="drawer-cart"
                    data-drawer-placement="right" aria-controls="drawer-cart">
                    <i class="fa-solid fa-cart-shopping text-2xl"></i>
                    <span
                        class="rounded-full border-2 border-teal-300 bg-teal-400 text-white text-xs absolute mt-[-7px]  w-[20px] left-5 h-[20px] ">
                        {{ $count }}
                    </span>
                </button>
            </div>
            <!-- DRAWER CARI MOBILE -->
            <div class="text-center pb-1 ">
                <button class="  text-black mr-4 align-middle" type="button" data-drawer-target="drawer-right-example"
                    data-drawer-show="drawer-right-example" data-drawer-placement="right"
                    aria-controls="drawer-right-example">
                    <i class="fas fa-search text-2xl"></i>
                </button>
            </div>
            <div>
                @guest
                    <button
                        class="block text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 "
                        type="button" data-modal-toggle="authentication-modal">
                        <b class=" text-2xl"></b>&nbsp;<i class="text-lg fa-regular fa-user"></i>
                        </svg>
                    </button>
                @endguest


                {{-- if success login --}}
                @auth
                    <button id="dropdownDefault" data-dropdown-toggle="dropdown-twice"
                        class="block  font-extrabold text-sm  text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 "
                        type="button">
                        Hey, {{ auth()->guard('web')->user()->credential->nama_depan }} &nbsp;
                        <i class="text-2xl fa-regular fa-user"></i>
                        </svg>
                    </button>

                    <div id="dropdown-twice" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow "
                        data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 490px, 0px);">
                        <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownDefault">
                            <li>
                                <a href="/customer/account" class="block py-2 px-4 font-bold hover:bg-gray-100  ">Akun
                                    Saya</a>
                            </li>
                            <li>
                                <a href="/customer/wish-list" class="block py-2 px-4 font-bold hover:bg-gray-100  ">Wish
                                    List ({{ $wish_list_count }}
                                    items)</a>
                            </li>
                            <li>

                                <form method="POST" action="/customer/account/logout">
                                    @csrf
                                    <button
                                        class="block w-full text-left py-2 px-4 font-bold hover:bg-gray-100  ">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>

        </div>



        {{-- MEGA MENU --}}
        <div id="mega-menu-full" class="  hidden  justify-between   w-full md:flex md:w-auto md:order-1 ">
            <ul class="flex flex-coltext-sm font-medium md:flex-row md:space-x-8 md:mt-0">
                <li class="flex items-center">

                    <!-- Modal toggle -->
                    {{-- if belum login --}}
                    @guest
                        <button
                            class="block py-2 pr-4  pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 "
                            type="button" data-modal-toggle="authentication-modal">
                            <b class="text-sm">Masuk</b>&nbsp;<i class="text-lg fa-regular fa-user"></i>
                            </svg>
                        </button>
                    @endguest


                    {{-- if success login --}}
                    @auth
                        <button id="dropdownDefault-twice" data-dropdown-toggle="dropdown"
                            class="block py-2 pr-4 font-extrabold text-sm  pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 "
                            type="button">
                            Hey, {{ auth()->guard('web')->user()->credential->nama_depan }} &nbsp;
                            <i class="text-lg fa-regular fa-user"></i>
                            </svg>
                        </button>
                    @endauth

                    <div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow "
                        data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 490px, 0px);">
                        <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownDefault-twice">
                            <li>
                                <a href="/customer/account" class="block py-2 px-4 font-bold hover:bg-gray-100  ">Akun
                                    Saya</a>
                            </li>
                            <li>
                                <a href="/customer/wish-list" class="block py-2 px-4 font-bold hover:bg-gray-100  ">Wish
                                    List ({{ $wish_list_count }}
                                    items)</a>
                            </li>
                            <li>

                                <form method="POST" action="/customer/account/logout">
                                    @csrf
                                    <button
                                        class="block w-full text-left py-2 px-4 font-bold hover:bg-gray-100  ">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>

                </li>
                <li class="flex items-center ">
                    <div class="text-center">
                        <a href="/customer/wish-list" class="text-xl"><i class="far fa-heart"></i></a>
                    </div>
                </li>
                <li class=" flex items-center">
                    <!-- drawer Cart-->
                    <div class="text-center">
                        <button
                            class="block py-2 pr-4 relative  pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 "
                            type="button" data-drawer-target="drawer-cart" data-drawer-show="drawer-cart"
                            data-drawer-placement="right" aria-controls="drawer-cart">
                            <i class="fa-solid fa-cart-shopping text-2xl"></i>
                            <span
                                class="rounded-full border-2 border-teal-300 bg-teal-400 text-white text-xs absolute mt-[-7px]  w-[20px] left-5 h-[20px] ">
                                {{ $count }}
                            </span>
                        </button>
                    </div>


                </li>
                <li>
                    <!-- drawer Cari DEKSTOP -->
                    <div class="text-center">
                        <button class="bg-black  text-white p-4 w-52 flex  justify-between align-middle" type="button"
                            data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example"
                            data-drawer-placement="right" aria-controls="drawer-right-example">
                            Cari <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <!-- Show drawer Cari -->

                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- DRAWER CARI -->
<div id="drawer-right-example"
    class="fixed  z-40 h-screen overflow-y-auto bg-white w-full  md:w-2/5   transition-transform right-0 top-16 translate-x-full"
    tabindex="-1" aria-labelledby="drawer-right-label" aria-hidden="true">

    <form action="" method="POST">
        <label for="input-search-items" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
        <div class="relative">
            <input type="search" id="input-search-items"
                class="block p-4 pl-10 w-full text-sm text-gray-900 border-b-2 border-black  focus:border-black border-0 ring-0  "
                placeholder="CARI...." autocomplete="off">
            <div type="submit"
                class="text-black font-bold absolute right-2.5 bottom-2.5 rounded-lg text-sm px-4 py-2">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
    </form>

    <div id="search-items" class="flex flex-wrap justify-between bg-gray-100 h-full p-12">
    </div>
</div>

<!-- drawer Cart -->
<div id="drawer-cart"
    class="fixed z-40 p-0  bg-gray-100 w-full md:w-96 transition-transform right-0 top-12 md:top-0 translate-x-full"
    tabindex="-1" aria-labelledby="drawer-right-label" aria-hidden="true">
    <div class=" border-b-4 pt-4 pl-2 border-lime-500">
        <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500">
            <span class="text-black">({{ $count }}) Produk baru di keranjang Belanja</span>
        </h5>
        <button type="button" data-drawer-dismiss="drawer-cart" aria-controls="drawer-cart"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center  ">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
    </div>

    <!-- list cart -->
    <div class="overflow-scroll max-h-[350px] ">
        @foreach ($data_cart as $data)
            <div class="bg-white">
                <div class="border flex flex-wrap p-2 ">
                    <div>
                        <img class="w-20" src="{{ asset('./storage/' . $data->gambar) }}" alt="">
                    </div>
                    <div class="w-[73%] pl-1">
                        <a href="/list-item/{{ $data->item_id }}/detail-item"
                            class="underline font-bold mb-2 inline-block">{{ $data->nama }}</a><br>
                        <p class="font-light text-xs p-0 m-0"><span class="text-gray-500">Size:
                            </span> {{ $data->ukuran }}</p>
                        <p class="font-light text-xs p-0 m-0">Jumlah {{ $data->qty }}</p>

                        <p class="font-light text-sm py-3 m-0">Rp.
                            {{ number_format($data->harga, 0, '', '.') }}</p>
                    </div>
                    <div class="w-4 text-center float-right">
                        <form action="/list-item/cart/{{ $data->keranjang_id }}/destroy" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="text-gray-500">
                                <i class="fa-solid text-xs fa-xmark"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        @if ($count == 0)
            <div class="w-full   bottom-10 text-center  py-8 px-4 ">
                <p class="font-bold">Keranjang belanja saat ini kosong</p>
            </div>
        @endif
    </div>

    @if ($count != 0)
        <div class="border-b  w-full bottom-0  bg-white">
            <div class="flex justify-between border-2 py-3 px-4">
                <div class="font-light">
                    Subtotal :
                </div>
                <div class="font-normal">
                    Rp.{{ number_format($sub_total, 0, '', '.') }}
                </div>
            </div>
            <div class="p-4">
                <a href="/checkout/cart"
                    class="border w-full border-black inline-block text-center text-black py-2 hover:bg-black hover:text-white duration-300">
                    Checkout
                </a>
            </div>
        </div>
    @endif
    {{-- koosong --}}

</div>

<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white shadow ">
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center  "
                data-modal-toggle="authentication-modal">
                <i class="fa-solid fa-xmark"></i>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="py-6 px-6 lg:px-8">
                <h3 class="mb-4 text-3xl font-medium text-gray-900 ">Masuk</h3>
                <p class="text-sm mb-3">Untuk mendapatkan hasil maksimal dari converse.id, masukkan alamat email dan
                    kata
                    sandi akun Anda di
                    bawah ini.
                </p>
                <div class="flex text-sm mb-3">
                    <p class="mr-3">Belum punya akun? </p><a href="/customer/account/create"
                        class="underline">Daftar</a>
                </div>
                <form class="space-y-6" action="/customer/account/authenticate" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email <span
                                class="text-red-600">*</span></label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border-t-0 border-x-0 border-b-1 border-black text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5   "
                            placeholder="Masukan email Anda" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Kata Sandi <span
                                class="text-red-600">*</span></label>
                        <input type="password" name="password" id="password" placeholder="Massukan password Anda"
                            class="bg-gray-50 border-t-0 border-x-0 border-b-1 border-black text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5   "
                            required="">
                    </div>
                    {{-- remember me --}}
                    {{-- <div class="flex justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" type="checkbox" value="" required="">
                            </div>
                            <label for="remember" class="ml-2 text-sm font-medium text-gray-900 ">Remember
                                me</label>
                        </div>
                        <a href="#" class="text-sm text-blue-700 hover:underline ">Lost
                            Password?</a>
                    </div> --}}
                    <div class="">
                        <button type="submit"
                            class="w-full mb-0  text-white bg-black border-2 border-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium  text-sm px-5 py-3 text-center
                        hover:bg-white hover:text-black
                        hover:duration-300
                        ">
                            Masuk
                        </button>
                    </div>


                    <div class="text-sm font-medium text-gray-500 mt-0  ">
                        <a href="/customer/account/forgotpassword"
                            class="text-black text-xs hover:text-red-900 underline"> Lupa Kata
                            Sandi?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@section('search_script')
    <script>
        $(document).ready(function() {
            let dataItems = {{ Js::from($items) }};
            $('#input-search-items').keyup(function(e) {
                let valInput = $(this).val().toLowerCase();
                let resultItems = dataItems.filter(items => items.nama.toLowerCase().indexOf(valInput) > -1)
                if (dataItems.length != resultItems.length) {
                    let elemetsSearch = ''
                    $('#search-items').html('')
                    resultItems.forEach(e => {
                        elemetsSearch += `<a href="list-item/${e.id}/detail-item" class="w-5/12 mb-5">
                            <img src="{{ asset('./storage/${e.gambar}') }}" alt="">
                            <article class="text-center text-xl ">
                            ${e.nama}
                            </article>
                            </a>`
                        $('#search-items').html(elemetsSearch)
                    });

                } else {
                    $('#search-items').html('cari items')
                }
            })

        })
    </script>
@endsection
