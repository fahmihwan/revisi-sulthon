@extends('cms.layouts.main')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .mylabel {
            @apply text-sm text-blue-300 text-bold;
        }

        .select2-dropdown {
            background-color: white;
            border: 1px solid #aaa;
            border-radius: 4px;
            box-sizing: border-box;
            display: block;
            position: absolute;
            left: -100000px;
            width: 100%;
            z-index: 1051;
        }
    </style>
@endsection

@section('container')
    <div class="w-full px-2 ">
        <nav class="flex justify-between mb-4 p-2 bg-white shadow-md text-black rounded-md" aria-label="Breadcrumb ">
            <div class="font-bold text-2xl text-gray-700">
                Create Akun
            </div>
            <div>
                <ol class="inline-flex items-center space-x-1 md:space-x-3  ">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium  hover:text-gray-900">
                            Create akun
                        </a>
                    </li>

                </ol>
            </div>
        </nav>

        <section class="flex justify-between mb-2">
            <div>
            </div>
            <a href="/admin/master-item/ukuran"
                class="bg-purple-600 hover:bg-white hover:text-black border hover:duration-200 hover:border-purple-600 text-white p-2 rounded">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </section>


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

        <div class="border w-full md:w-full lg:w-1/2 p-3 bg-white">
            <form action="/admin/auth/{{ $user->id }}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 ">Nama</label>
                    <input type="text" id="nama"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="nama" required name="nama" value="{{ $user->nama }}">
                </div>
                <div class="w-full flex">
                    <div class="mb-4 w-1/2 mr-3">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
                        <input type="text" id="username"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                            placeholder="username" required name="username" value="{{ $user->username }}">
                    </div>
                    <div class="mb-4 w-1/2">
                        <label for="hak_akses" class="block mb-2 text-sm font-medium text-gray-900 ">Hak
                            Akses</label>
                        <select id="hak_akses" name="hak_akses"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                            <option value="{{ $user->hak_akses }}">{{ $user->hak_akses }}</option>
                            <option value="owner">owner</option>
                            <option value="karyawan">karyawan</option>
                        </select>
                    </div>
                </div>
                <div id="hide-password" class="hidden">
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password Lama</label>
                        <input type="password" id="password"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                            placeholder="password" name="old_password">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                        <input type="password" id="password"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                            placeholder="password" name="password">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">confirm
                            password</label>
                        <input type="password" id="password"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                            placeholder="password" name="confirm_password">
                    </div>
                </div>
                <div class="flex items-center mb-4">
                    <input id="ganti-password" type="checkbox" name="check"
                        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500   focus:ring-2  ">
                    <label for="ganti-password" class="ml-2 text-sm font-medium text-gray-900 ">Ganti
                        Password</label>
                </div>
                <button type="submit"
                    class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">
                    Submit
                </button>
            </form>


        </div>



    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#ganti-password').click(function() {
                if ($('#ganti-password').is(":checked")) {
                    $('#hide-password').removeClass('hidden')
                } else {
                    $('#hide-password').addClass('hidden')
                }

            })

        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
