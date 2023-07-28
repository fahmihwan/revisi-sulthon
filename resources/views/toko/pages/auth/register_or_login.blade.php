@extends('toko.layout.main')

@section('container')
    <!-- full image  -->

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

            <li aria-current="page">
                <div class="flex items-center ">
                    <i class="fa-solid fa-chevron-right"></i>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 ">Masuk atau Daftar</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection
<div class="container mx-14 my-5 ">


    @if ($errors->any())
        <div class="flex p-4 mt-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg " role="alert">
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


    <section class="w-full flex flex-wrap  ">
        <div class="w-full md:w-1/2 p-0 md:p-2 lg:p-7 ">
            <div class="border px-8 py-8 border-gray-300">
                <h1 class="font-bold border-b pb-3  text-2xl mb-5">Masuk</h1>
                <div class="">
                    <p class="text-xs mb-4 text-gray-700">Apabila Anda memiliki akun, Masuk dengan alamat email.</p>
                    <form action="/customer/account/authenticate" method="POST">
                        @csrf
                        <div class="mb-6 w-full  ">
                            <label class="font-ligth text-sm mb-2  block" for="">Email <span
                                    class="text-red-600">*</span></label>
                            <input type="email" name="email" placeholder="Masukan Email Anda"
                                class="bg-white border-gray-300 w-full py-1 placeholder:italic placeholder:text-gray-400 placeholder:font-normal placeholder:text-sm">
                        </div>
                        <div class="mb-6 w-full  ">
                            <label class="font-ligth text-sm mb-2  block" for="">Kata Sandi <span
                                    class="text-red-600">*</span></label>
                            <input type="password" name="password" placeholder="Masukan password Anda"
                                class="bg-white border-gray-300 w-full py-1 placeholder:italic placeholder:text-gray-400 placeholder:font-normal placeholder:text-sm">
                        </div>

                        <div class="mb-6 w-full  ">
                            <button type="submit"
                                class="w-full mb-0  text-white bg-black border-2 border-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium  text-sm px-5 py-3 text-center
                            hover:bg-white hover:text-black 
                            hover:duration-300
                            ">
                                Masuk
                            </button>

                            <div class="text-sm font-medium text-gray-500 mt-0  text-center pt-5">
                                <a href="/customer/account/forgotpassword"
                                    class="text-black text-xs font-light  hover:text-red-900 underline">
                                    Lupa Kata
                                    Sandi?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 p-0 md:p-0 lg:p-7 ">
            <div class="border px-8 py-8 border-gray-300">
                <h1 class="font-bold border-b pb-3  text-2xl mb-5">Buat Akun</h1>
                <div class="">
                    <p class="text-xs mb-4 text-gray-700">Buat Akun dan dapatkan banyak keuntungan: Pembayaran lebih
                        cepat,
                        Menyimpan
                        lebih
                        banyak alamat,
                        lacak pembelian anda dan banyak lagi!</p>
                    <form action="/customer/account/store" method="POST">
                        @csrf
                        <div class="mb-6 w-full  ">
                            <label class="mb-2 font-light text-sm block" for="">Nama Depan <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="nama_depan" placeholder="Masukan nama Depan Anda"
                                class="bg-white border-gray-300 w-full py-1 placeholder:italic placeholder:text-gray-400 placeholder:font-normal placeholder:text-sm  ">
                        </div>
                        <div class="mb-6 w-full  ">
                            <label class="font-ligth text-sm mb-2 block" for="">Nama Belakang <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="nama_belakang" placeholder="Masukan nama Depan Belakang"
                                class="bg-white border-gray-300   w-full py-1 placeholder:italic placeholder:text-gray-400 placeholder:font-normal placeholder:text-sm">
                        </div>
                        <div class="mb-6 w-full  ">
                            <label class="font-ligth text-sm mb-2 block" for="">Tanggal Lahir <span
                                    class="text-red-600">*</span></label>
                            <div class="flex">
                                <select name="tanggal" id="tanggal"
                                    class="bg-white border-gray-300 mr-3 w-4/12 lg:w-4/12 py-1 placeholder:italic placeholder:text-gray-400 placeholder:font-normal placeholder:text-sm">
                                    <option value="">Tanggal</option>
                                </select>
                                <select name="bulan" id="bulan"
                                    class="bg-white border-gray-300 mr-3 w-4/12 lg:w-6/12 py-1 placeholder:italic placeholder:text-gray-400 placeholder:font-normal placeholder:text-sm">
                                    <option value="">Bulan</option>
                                </select>
                                <select name="tahun" id="tahun"
                                    class="bg-white border-gray-300 w-4/12 lg:w-4/12 py-1 placeholder:italic placeholder:text-gray-400 placeholder:font-normal placeholder:text-sm">
                                    <option value="">Tahun</option>

                                </select>
                            </div>
                        </div>
                        <div class="mb-6 w-full ">
                            <label class="font-ligth text-sm mb-2 block" for="">Jenis kelamin <span
                                    class="text-red-600">*</span></label>
                            <select name="jenis_kelamin" id=""
                                class="bg-white border-gray-300 w-full py-1 placeholder:italic placeholder:text-gray-400 placeholder:font-normal placeholder:text-sm">
                                <option value=""></option>
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="mb-6 w-full ">
                            <label class="font-ligth text-sm mb-2 block" for="">Nomor Telepon <span
                                    class="text-red-600">*</span></label>
                            <div class="relative">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    62
                                </div>
                                <input type="number" name="telp" id="telp"
                                    class="bg-white border-gray-300 py-1 placeholder:italic placeholder:text-gray-400 placeholder:font-normal placeholder:text-sm  text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 "
                                    placeholder="">
                            </div>
                        </div>

                        <h1 class="border-b font-bold text-2xl mb-5 mt-8 pb-1">
                            INFORMASI AKUN
                        </h1>


                        <div class="mb-6 w-full  ">
                            <label class="font-ligth text-sm mb-2  block" for="">Email <span
                                    class="text-red-600">*</span></label>
                            <input type="email" name="email" placeholder="Masukan Email Anda"
                                class="bg-white border-gray-300 w-full py-1 placeholder:italic placeholder:text-gray-400 placeholder:font-normal placeholder:text-sm">
                        </div>
                        <div class="mb-6 w-full  ">
                            <label class="font-ligth text-sm mb-2  block" for="">Kata Sandi <span
                                    class="text-red-600">*</span></label>
                            <input type="password" name="password" placeholder="Masukan password Anda"
                                class="bg-white border-gray-300 w-full py-1 placeholder:italic placeholder:text-gray-400 placeholder:font-normal placeholder:text-sm">
                        </div>
                        <div class="mb-6 w-full  ">
                            <label class="font-ligth text-sm mb-2  block" for="">Konfirmasi Kata Sandi
                                <span class="text-red-600">*</span></label>
                            <input type="password" name="confirm_password"
                                placeholder="Masukan password Anda kembali"
                                class="bg-white border-gray-300 w-full py-1 placeholder:italic placeholder:text-gray-400 placeholder:font-normal placeholder:text-sm">
                        </div>
                        <div class="mb-6 w-full  ">
                            <button type="submit"
                                class="w-full mb-0  text-white bg-black border-2 border-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium  text-sm px-5 py-3 text-center
                            hover:bg-white hover:text-black 
                            hover:duration-300
                            ">
                                Daftar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script>
    $('document').ready(function() {

        // console.log($('#tanggal').val())

        let tanggalDropdown = document.getElementById('tanggal');
        let bulanDropdown = document.getElementById('bulan');
        let tahunDropdown = document.getElementById('tahun');
        let currentYear = new Date().getFullYear();
        let earliestYear = 1945;


        for (let index = 1; index <= 31; index++) {
            let dateOption = document.createElement('option');
            dateOption.text = index;
            dateOption.value = index;
            tanggalDropdown.add(dateOption);
        }

        for (let index = 1; index <= 12; index++) {
            let dateOption = document.createElement('option');
            dateOption.text = index;
            dateOption.value = index;
            bulanDropdown.add(dateOption);
        }

        while (currentYear >= earliestYear) {
            let dateOption = document.createElement('option');
            dateOption.text = currentYear;
            dateOption.value = currentYear;
            tahunDropdown.add(dateOption);
            currentYear -= 1;
        }
    })
</script>
@endsection
