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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 ">Alamat</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection

@section('container')
    <!-- conetent -->



    <div class=" w-full mt-10">
        <!-- sidebar -->

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
        {{-- informasi  --}}
        <div class=" w-[580px] border  border-gray-400 mx-auto p-5">
            <h1 class="border-b border-black pb-5 font-semibold text-2xl mb-10">Buat Kata Sandi Baru</h1>


            <form action='/customer/account/reset-password' method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-6  w-full  ">
                    <label class="mb-2 font-normal block" for="">Email<span class="text-red-600">*</span></label>
                    <input type="email" name="email" placeholder="Masukan Email"
                        class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                </div>
                <div class="mb-6  w-full  ">
                    <label class="mb-2 font-normal block" for="">Kata Sandi Baru<span
                            class="text-red-600">*</span></label>
                    <input type="password" name="password" placeholder="Masukan kata sandi baru"
                        class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                </div>

                <div class="mb-6  w-full  ">
                    <label class="mb-2 font-normal block" for="">Konfirmasi Kata Sandi Baru<span
                            class="text-red-600">*</span></label>
                    <input type="password" name="password_confirmation" placeholder="Masukan konfirmasi kata sandi baru"
                        class="bg-gray-100 w-full border-b border-x-0 border-t-0">
                </div>

                <div class="mb-6 w-full  ">
                    <button type="submit"
                        class="w-full mb-0  text-white bg-black border-2 border-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium  text-sm px-5 py-3 text-center
                    hover:bg-white hover:text-black 
                    hover:duration-300
                    ">
                        Buat Kata Sandi Baru
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
