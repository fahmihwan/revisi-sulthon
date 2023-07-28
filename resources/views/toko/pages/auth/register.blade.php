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
            <li aria-current="page">
                <div class="flex items-center ">
                    <i class="fa-solid fa-chevron-right"></i>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 "> Daftar</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection
@section('container')
    <!-- full image  -->
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




        <section class="bg-gray-900 text-white h-60 flex items-center justify-center  text-center">
            <div class="w-full px-10 text-sm lg:w-1/2">
                <h1 class="mb-6 text-3xl font-semibold">Buat Akun</h1>
                <p>Buat Akun dan dapatkan banyak keuntungan: Pembayaran lebih cepat, Menyimpan lebih banyak alamatdan banyak
                    lagi!</p>
            </div>
        </section>
        <section class="w-full flex flex-wrap  ">
            <div class="w-full md:w-1/2 p-7 border">
                <p class="mb-3">Silakan isi kolom di bawah ini:</p>
                <form action="/customer/account/store" method="POST">
                    @csrf
                    <div class="mb-6  w-full lg:w-10/12 ">
                        <label class="mb-2 font-normal block" for="">Nama Depan <span
                                class="text-red-600">*</span></label>
                        <input type="text" name="nama_depan" placeholder="Masukan nama Depan Anda"
                            class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                    </div>
                    <div class="mb-6 w-full lg:w-10/12 ">
                        <label class="mb-2 block" for="">Nama Belakang <span class="text-red-600">*</span></label>
                        <input type="text" name="nama_belakang" placeholder="Masukan nama Depan Belakang"
                            class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                    </div>
                    <div class="mb-6 w-full lg:w-10/12 ">
                        <label class="mb-2 block" for="">Tanggal Lahir <span class="text-red-600">*</span></label>
                        <div class="flex">
                            <select name="tanggal" id="tanggal"
                                class="bg-gray-100 mr-3 w-4/12 lg:w-4/12 border-b border-x-0 border-t-0">
                                <option value="">Tanggal</option>
                            </select>
                            <select name="bulan" id="bulan"
                                class="bg-gray-100 mr-3 w-4/12 lg:w-6/12 border-b border-x-0 border-t-0">
                                <option value="">Bulan</option>
                            </select>
                            <select name="tahun" id="tahun"
                                class="bg-gray-100 w-4/12 lg:w-4/12 border-b border-x-0 border-t-0">
                                <option value="">Tahun</option>

                            </select>
                        </div>
                    </div>
                    <div class="mb-6 w-full lg:w-10/12">
                        <label class="mb-2 block" for="">Jenis kelamin <span class="text-red-600">*</span></label>
                        <select name="jenis_kelamin" id=""
                            class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                            <option value=""></option>
                            <option value="pria">Pria</option>
                            <option value="wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="mb-6 w-full lg:w-10/12">
                        <label class="mb-2 block" for="">Nomor Telepon <span class="text-red-600">*</span></label>
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                62
                            </div>
                            <input type="number" name="telp" id="telp"
                                class="bg-gray-100 border-b border-x-0 border-t-0  text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 "
                                placeholder="">
                        </div>
                    </div>
                    <div class="mb-6 w-full lg:w-10/12 ">
                        <label class="mb-2 font-normal block" for="">Email <span
                                class="text-red-600">*</span></label>
                        <input type="email" name="email" placeholder="Masukan Email Anda"
                            class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                    </div>
                    <div class="mb-6 w-full lg:w-10/12 ">
                        <label class="mb-2 font-normal block" for="">Kata Sandi <span
                                class="text-red-600">*</span></label>
                        <input type="password" name="password" placeholder="Masukan password Anda"
                            class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                    </div>
                    <div class="mb-6 w-full lg:w-10/12 ">
                        <label class="mb-2 font-normal block" for="">Konfirmasi Kata Sandi <span
                                class="text-red-600">*</span></label>
                        <input type="password" name="confirm_password" placeholder="Masukan password Anda kembali"
                            class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                    </div>
                    <div class="mb-6 w-full lg:w-10/12 ">
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
            <div class="w-full md:w-1/2 p-7 ">
                <h1 class="font-bold text-3xl mb-5">Member Benefits</h1>
                <div class="w-full lg:w-2/3">
                    <p class="text-sm font-light text-justify"> Create an account for a super fast checkout, save your
                        favourites, and
                        get
                        personalised
                        suggestions
                        across
                        Converse.id</p>

                    <ul class="mt-4 ml-0 lg:ml-8">
                        <li class="font-light mb-3"><i class="text-xl mr-3  fa-solid fa-truck-fast"></i> Fast, Free
                            Shipping
                        </li>
                        <li class="font-light mb-3"><i class="text-xl mr-3  fa-regular fa-heart"></i> Save Your Favourites
                        </li>
                        <li class="font-light mb-3"><i class="text-xl mr-3  fa-regular fa-star"></i> New Releases</li>
                    </ul>
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
