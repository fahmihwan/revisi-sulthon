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
                Edit Ukuran
            </div>
            <div>
                <ol class="inline-flex items-center space-x-1 md:space-x-3  ">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium  hover:text-gray-900">
                            Master item
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right text-gray-400"></i>
                            <a href="/admin/master-item/ukuran"
                                class="ml-1 text-sm font-medium hover:text-gray-900 md:ml-2 ">Ukuran</a>
                            <i class="fa-solid fa-chevron-right text-gray-400"></i>
                            <a href="/admin/master-item/ukuran"
                                class="ml-1 text-sm font-medium hover:text-gray-900 md:ml-2 ">Edit</a>
                        </div>
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
            <form action="/admin/master-item/ukuran/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama
                        Item</label>
                    <input type="text" id="nama"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="nama item" value="{{ $item->nama }}" required name="nama">
                </div>
                <div class="mb-4">
                    <label for="nama"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Kategori</label>

                    <select name="kategori_id" id=""
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                        <option value="{{ $item->kategori->id }}">{{ $item->kategori->nama }}</option>
                        @foreach ($kategories as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">
                    Update
                </button>
            </form>


        </div>



    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
