@extends('cms.layouts.main')


@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection


@section('container')
    {{-- @dd($kategories[1]->id) --}}
    {{-- @dd($item->kategori->id) --}}
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
                        Edit Item
                    </div>

                    <div class="px-10 py-5">
                        <form action="/admin/item/{{ $item->id }}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-4">
                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 ">Nama
                                    Item</label>
                                <input type="text" id="nama"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                                    placeholder="nama item" value="{{ $item->nama }}" required name="nama">
                            </div>


                            <div class="lg:flex ">
                                <div class="mb-4 w-full lg:w-1/2 lg:pr-2">
                                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 ">
                                        Kategori
                                    </label>
                                    <select class="js-example-basic-single w-full" name="kategori_id">
                                        {{-- <option value="{{ $item->kategori->id }}">{{ $item->kategori->nama }}</option> --}}
                                        @foreach ($kategories as $kategori)
                                            <option {{ $kategori->id == $item->kategori->id ? 'selected' : '' }}
                                                value="{{ $kategori->id }}">
                                                {{ $kategori->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4 mt-4 w-full lg:mt-0 lg:px-2 lg:w-1/2">
                                    <label for="nama"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Harga</label>
                                    <input type="text" id="nama"
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                                        placeholder="harga" required value="{{ $item->harga }}" name="harga">
                                </div>
                            </div>


                            <div class="lg:flex">
                                <div class="mb-4 lg:mb-0 mt-4 lg:mt-0 mr-3  w-full lg:w-1/2 lg-px-2">
                                    <label for="nama"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Berat</label>
                                    <input type="text" id="berat"
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                                        placeholder="berat" required value="{{ $item->berat }}" name="berat">
                                </div>
                                <div class="mb-4 lg:mb-0 mt-4 lg:mt-0  w-full lg:w-1/2 lg-px-2">
                                    <label for="nama"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Terjual</label>
                                    <input type="text" id="nama"
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                                        placeholder="harga" required value="{{ $item->terjual }}" name="terjual">
                                </div>
                                <div class="mb-4 lg:mb-0 mt-4lg:mt-0  w-full lg:w-1/2 lg:px-2">
                                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 ">stok</label>
                                    <input type="text" id="nama"
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                                        placeholder="harga" required value="{{ $item->stok }}" name="stok">
                                </div>

                            </div>


                            <div class="mb-4 mt-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 " for="user_avatar">Upload
                                    file</label>
                                <input name="gambar" value="{{ $item->gambar }}"
                                    class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer  focus:outline-none   "
                                    aria-describedby="user_avatar_help" id="user_avatar" type="file">
                            </div>
                            <div class="mb-4 mt-4">
                                <label for="nama"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Deskripski</label>
                                <textarea name="deskripsi" class="border border-gray-300 rounded w-full" name="" id="" cols="30"
                                    rows="5">
                                {{ $item->deskripsi }}
                                </textarea>
                            </div>


                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center   ">Submit</button>
                        </form>

                    </div>


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




        });
    </script>
@endsection
