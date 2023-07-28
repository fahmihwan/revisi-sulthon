@extends('cms.layouts.main')


@section('container')
    <div class="w-full px-2 ">
        <nav class="flex justify-between mb-4 p-2 bg-white shadow-md text-black rounded-md" aria-label="Breadcrumb ">
            <div class="font-bold text-2xl text-gray-700">
                Item
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
                <label for="">Cari :</label>
                <input class="rounded border-gray-300" type="text" placeholder="Search...">
            </div>
            @if (auth()->guard('webadmin')->user()->hak_akses == 'karyawan')
                <a href="/admin/item/create"
                    class="bg-purple-600 hover:bg-white hover:text-black border hover:duration-200 hover:border-purple-600 text-white p-2 rounded">
                    <i class="fa-solid fa-plus"></i> Tambah
                    Data</a>
            @endif
        </section>

        <div class="w-full grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6    rounded-md p-2 ">
            @foreach ($items as $item)
                <a href="/admin/item/{{ $item->id }}/show"
                    class="block  mr-3 mb-2   border bg-purple-900 text-white group hover:translate-y-[-2px] hover:duration-300 hover:border-purple-600 ">
                    <img class="" src="{{ asset('./storage/' . $item->gambar) }}" alt="">
                    <p class="font-bold  text-xs mb-2 px-1 ">{{ $item->nama }} </p>
                    <div class="flex justify-between px-1">
                        <div>
                            <p class="text-sm  text-yellow-300"><span class="text-xs">Rp</span>
                                {{ number_format($item->harga, 0, '', '.') }}</p>
                        </div>
                        <div class="flex items-end pb-1 ">
                            <p class="text-xs pr-1 text-green-300">{{ $item->kategori->nama }}</p>
                        </div>
                    </div>
                    <div class="flex justify-between px-1">
                        <div>
                            <p class="text-xs ">Stok : <span class="text-sky-300">{{ $item->stok }}</span> </p>
                        </div>
                        <div class="flex items-end pb-1">
                            <p class="text-xs pr-1">Terjual: <span class="text-sky-300">{{ $item->terjual }}</span> </p>
                        </div>
                    </div>
                    <div
                        class="hidden group-hover:block absolute group-hover:duration-300  w-full text-center bg-purple-600">
                        <p class="text-md text-white ">
                            <i class="fa-regular fa-folder-open"></i> manage item
                        </p>
                    </div>
                </a>
            @endforeach


        </div>
    </div>
@endsection
