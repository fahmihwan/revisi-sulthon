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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 ">Wish List</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection

@section('container')
    <!-- conetent -->
    <div class=" md:flex w-full pt-10 bg-gray-50">
        <!-- sidebar -->
        @include('toko.components.sidebar-account')

        <div class=" md:w-full">
            <div class=" m-2 py-4 px-10">
                <h1 class="font-bold text-2xl mb-7">Wish List</h1>

                <p class="text-sm">{{ $items->count() }} item(s)</p>
                <div class=" grid md:grid-cols-2 lg:grid-cols-4  gap-8">

                    @foreach ($items as $item)
                        <div class="group hover:bg-white hover:border border-gray-600   h-full">
                            <img src="{{ asset('./storage/' . $item->item->gambar) }}" alt="">
                            <div class="px-2">
                                <h1 class="font-light">{{ $item->item->nama }}</h1>
                                <p class="font-light">Rp. {{ number_format($item->item->harga, 0, '', '.') }}</p>
                            </div>
                            <div class="p-3 text-center flex items-center justify-between">
                                <a href="/list-item/{{ $item->item_id }}/detail-item" style="overflow: hidden"
                                    class="bg-black invisible group-hover:visible inline-block  text-center w-full mr-3 mt-3 text-white p-2 text-sm">
                                    Tambah Ke Troli
                                </a>
                                <form action="/list-item/wish_list/{{ $item->item_id }}/destroy" method="POST"
                                    class="invisible group-hover:visible">
                                    @method('DELETE')
                                    @csrf
                                    <button class="text-sm underline ">Hapus</button>
                                </form>
                            </div>

                        </div>
                    @endforeach




                </div>
            </div>
        </div>
    </div>
@endsection
