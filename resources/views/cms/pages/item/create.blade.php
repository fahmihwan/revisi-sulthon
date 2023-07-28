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
                Create Item
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
                            <a href="#" class="ml-1 text-sm font-medium hover:text-gray-900 md:ml-2 ">Kategori</a>
                        </div>
                    </li>
                </ol>
            </div>
        </nav>

        <section class="flex justify-between mb-2">
            <div>
            </div>
            <a href="/admin/item"
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
            <form action="/admin/item" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 ">Nama
                        Item</label>
                    <input type="text" id="nama"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="nama item" required name="nama">
                </div>
                <div class="mb-4">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Kategori
                    </label>
                    <select class="js-example-basic-single w-full" name="kategori_id">
                        @foreach ($kategories as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4 mt-4">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 ">Harga</label>
                    <input type="text" id="nama"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="harga" required="" name="harga">
                </div>
                <div class="mb-4 mt-4">
                    <label for="berat" class="block mb-2 text-sm font-medium text-gray-900 ">berat</label>
                    <input type="text" id="berat"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                        placeholder="berat" required="" name="berat">
                </div>
                <div class="mb-4 mt-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900 " for="user_avatar">Upload
                        file</label>
                    <input name="gambar"
                        class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="user_avatar_help" id="user_avatar" type="file">
                </div>
                <div class="mb-4 mt-4">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 ">Deskripski</label>
                    <textarea name="deskripsi" class="border border-gray-300 rounded w-full" name="" id="" cols="30"
                        rows="5"></textarea>
                </div>


                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>


        </div>



    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            // $('.ukuran-nama').click(function() {
            //     let id = $(this).val();
            //     let isChecked = $(this).is(':checked');

            //     console.log(isChecked)
            //     if (isChecked) {
            //         $(`.ukuran-qty-${id}`).prop('disabled', false)
            //         $(`.ukuran-qty-${id}`).val(0)
            //     } else {
            //         $(`.ukuran-qty-${id}`).prop('disabled', true)

            //     }
            // })
        });
    </script>
@endsection
