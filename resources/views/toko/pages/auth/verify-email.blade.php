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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 ">Detail Item</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection
<div class="container mx-14  ">
    <div class="text-center mt-36">
        @auth
            @if (!auth()->user()->hasVerifiedEmail())
                <span class="text-black">
                    This account is not confirmed. <form action="/email/verification-notification" method="POST"
                        class="inline">
                        @csrf
                        <button type="submit" class="text-red-900 underline"> Click Here</button>
                    </form> to resend confirmation email.
                </span>
            @endif
            @if (auth()->user()->hasVerifiedEmail())
                <span class="text-black">
                    Email Anda Sudah terverifikasi <a href="/" class="text-blue-600 underline">Lanjutkan untuk
                        Berbelanja</a>
                </span>
            @endif
        @endauth

    </div>

</div>
@endsection
