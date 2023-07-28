@extends('cms.layouts.main')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('container')
    <div class="w-full px-2 ">
        <nav class="flex justify-between mb-4 p-2 bg-white shadow-md text-black rounded-md" aria-label="Breadcrumb ">
            <div class="font-bold text-2xl text-gray-700">
                Detail Item
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
        @include('cms.components.tabs_item')

        <div class="flex flex-col-reverse md:flex-row">
            <div class="w-full md:w-4/6 bg-white rounded mt-3 mb-6 md:mb-0">
                <div class="overflow-x-auto border-2 border-purple-700  shadow-md rounded ">
                    <div class="px-2 bg-purple-700  text-white">
                        Informasi Item
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 bg-gray-100 ">
                        <tr class="border-b">
                            <th scope="col" class=" py-2 px-6 flex items-start">
                                Nama
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $item->nama }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="col" class=" py-2 px-6 flex items-start">
                                Kategori
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $item->kategori->nama }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="col" class=" py-2 px-6 flex items-start">
                                Harga
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $item->harga }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="col" class=" py-2 px-6 flex items-start">
                                Terjual
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $item->terjual }} item
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="col" class=" py-2 px-6 flex items-start">
                                Stok
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $item->stok }} item
                            </td>
                        </tr>
                        <tr>
                            <th scope="col" class=" py-2 px-6 flex items-start">
                                Deskripsi
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $item->deskripsi }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="col" class=" py-2 px-6 flex items-start">
                                Berat
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $item->berat }} gram
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
            <di class=" w-full md:w-2/6  bg-white py-0 px-2 rounded-sm  mt-3">
                <div class="border-2 border-purple-700 rounded   text-white">
                    <div class="bg-purple-700 px-2">
                        Detail Gambar
                    </div>
                    <img src="{{ asset('./storage/' . $item->gambar) }}" alt="">
                </div>
            </di>

        </div>



    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
        $('.js-example-basic-single').select2();






        })
        });
    </script>
@endsection
