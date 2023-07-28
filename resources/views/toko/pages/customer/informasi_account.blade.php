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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 ">Informasi Akun</span>
                </div>
            </li>
        </ol>
    </nav>
    @if ($errors->any())
        <div class="flex p-4 mb-4  text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
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
@endsection

@section('container')
    <!-- conetent -->
    <div class=" md:flex w-full mt-10">
        <!-- sidebar -->
        @include('toko.components.sidebar-account')

        {{-- informasi  --}}
        <div class=" md:w-full px-10 ">
            <div class="m-2 py-4 ">
                <h1 class="font-bold text-2xl mb-7">Ubah Informasi Akun</h1>


                <form class="" action="/customer/account/update" method="POST">
                    @csrf
                    <div class="w-full md:flex">
                        <div class="w-full md:w-1/2 md:pr-20">
                            <h1 class="font-bold text-2xl pb-5 border-b-2 mb-10">Informasi Akun</h1>
                            <div class="mb-6  w-full  ">
                                <label class="mb-2 font-normal block" for="">Nama Depan <span
                                        class="text-red-600">*</span></label>
                                <input type="text" name="nama_depan" value="{{ $user->credential->nama_depan }}"
                                    placeholder="Masukan nama Depan Anda"
                                    class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                            </div>
                            <div class="mb-6 w-full  ">
                                <label class="mb-2 block" for="">Nama Belakang <span
                                        class="text-red-600">*</span></label>
                                <input type="text" name="nama_belakang" value="{{ $user->credential->nama_belakang }}"
                                    placeholder="Masukan nama Depan Belakang"
                                    class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                            </div>
                            <div class="mb-6 w-full  ">
                                <label class="mb-2 block" for="">Tanggal Lahir <span
                                        class="text-red-600">*</span></label>
                                <div class="flex">
                                    <select name="tanggal" id="tanggal"
                                        class="bg-gray-100 mr-3 w-4/12 lg:w-4/12 border-b border-x-0 border-t-0">
                                        <option value="{{ intval($date[2]) }}">{{ intval($date[2]) }}</option>
                                    </select>
                                    <select name="bulan" id="bulan"
                                        class="bg-gray-100 mr-3 w-4/12 lg:w-6/12 border-b border-x-0 border-t-0">
                                        <option value="{{ intval($date[1]) }}">{{ intval($date[1]) }}</option>
                                    </select>
                                    <select name="tahun" id="tahun"
                                        class="bg-gray-100 w-4/12 lg:w-4/12 border-b border-x-0 border-t-0">
                                        <option value="{{ intval($date[0]) }}">{{ intval($date[0]) }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-6 w-full ">
                                <label class="mb-2 block" for="">Jenis kelamin <span
                                        class="text-red-600">*</span></label>
                                <select name="jenis_kelamin" id=""
                                    class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                                    <option value="{{ $user->credential->jenis_kelamin }}">
                                        {{ $user->credential->jenis_kelamin }}</option>
                                    <option value="pria">Pria</option>
                                    <option value="wanita">Wanita</option>
                                </select>
                            </div>
                            <div class="mb-6 w-full ">
                                <label class="mb-2 block" for="">Nomor Telepon <span
                                        class="text-red-600">*</span></label>
                                {{-- <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        62
                                    </div> --}}
                                <input type="string" name="telp" id="telp"
                                    class="bg-gray-100 border-b border-x-0 border-t-0   block w-full  p-2.5 " placeholder=""
                                    value="{{ $user->credential->telp }}">
                            </div>

                            <div class="mb-6 w-full lg:w-10/12 ">
                                <input type="checkbox" class="mr-5" id="ganti-email" name="ganti_email"> <label
                                    for="ganti-email"> Ganti
                                    Email</label><br><br>
                                <input type="checkbox" class="mr-5" id="gant-sandi" name="ganti_password"> <label
                                    for="gant-sandi"> Ubah Kata
                                    Sandi</label><br>
                            </div>
                            <div class="mb-6 w-32 ">
                                <button type="submit"
                                    class="w-full mb-0  text-white bg-black border-2 border-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium  text-sm px-5 py-3 text-center
                                hover:bg-white hover:text-black 
                                hover:duration-300
                                ">
                                    Simpan
                                </button>
                            </div>
                        </div>


                        {{-- password --}}
                        <div class="w-full md:w-1/2">
                            <h1 class="font-bold text-2xl pb-5 border-b-2 mb-10">
                                Ganti Alamat Email & Password
                            </h1>
                            <div class="mb-6 w-full lg:w-10/12 hidden" id="form-email">
                                <label class="mb-2 font-normal block" for="">Email <span
                                        class="text-red-600">*</span></label>
                                <input type="email" name="email" id="email" value="{{ $user->email }}"
                                    placeholder="Masukan Email Anda"
                                    class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                            </div>
                            <div class="mb-6 w-full lg:w-10/12 hidden" id="katasandisekarang">
                                <label class="mb-2 font-normal block" for="">Kata Sandi Sekarang<span
                                        class="text-red-600">*</span></label>
                                <input type="password" name="old_password" placeholder="Masukan password Anda"
                                    class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                            </div>
                            <div id="form-password" class="hidden">
                                <div class="mb-6 w-full lg:w-10/12 ">
                                    <label class="mb-2 font-normal block" for="">Kata Sandi Baru<span
                                            class="text-red-600">*</span></label>
                                    <input type="password" name="new_password" placeholder="Masukan password Anda"
                                        class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                                </div>
                                <div class="mb-6 w-full lg:w-10/12 ">
                                    <label class="mb-2 font-normal block" for="">Konfirmasi Kata Sandi <span
                                            class="text-red-600">*</span></label>
                                    <input type="password" name="confirm_password"
                                        placeholder="Masukan password Anda kembali"
                                        class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                                </div>
                            </div>

                        </div>
                    </div>

                </form>
            </div>



        </div>
    </div>
@endsection

@section('script')
    <script>
        $('document').ready(function() {

            kataSandiSekarang()
            $('#ganti-email').click(function() {
                if ($(this).is(':checked')) {
                    $('#form-email').removeClass('hidden')
                } else {
                    $('#form-email').addClass('hidden')
                }
                kataSandiSekarang()
                console.log($('#email').val())
            })
            $('#gant-sandi').click(function() {
                if ($(this).is(':checked')) {
                    $('#form-password').removeClass('hidden')
                } else {
                    $('#form-password').addClass('hidden')
                }

                kataSandiSekarang()

            })

            function kataSandiSekarang() {

                if ($('#ganti-email').is(':checked') == false && $('#gant-sandi').is(':checked') == false) {
                    $('#katasandisekarang').addClass('hidden')
                } else {
                    $('#katasandisekarang').removeClass('hidden')
                }
            }

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
