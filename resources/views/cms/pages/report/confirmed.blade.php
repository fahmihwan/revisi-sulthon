@extends('cms.layouts.main')


@section('container')
    <div class="w-full px-2 ">
        <nav class="flex justify-between mb-4 p-2 bg-white shadow-md text-black rounded-md" aria-label="Breadcrumb ">
            <div class="font-bold text-2xl text-gray-700">
                Laporan
            </div>
            <div>
                <ol class="inline-flex items-center space-x-1 md:space-x-3  ">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium  hover:text-gray-900">
                            Laporan
                        </a>
                    </li>
                </ol>
            </div>
        </nav>

        @include('cms.components.tabs_laporan')
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
        <div class="w-full shadow-md bg-white  rounded-md p-2  mb-3">
            <form action="" method="GET">
                <div class="mb-4 w-1/2 flex items-end">
                    <div class="w-1/2 mr-3">
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Start date</label>
                        <input type="date" id="start_date" value="{{ request('start_date') }}"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                            required name="start_date">
                    </div>
                    <div class="w-1/2 mr-3">
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            End date</label>
                        <input type="date" id="end_date" value="{{ request('end_date') }}"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                            required name="end_date">
                    </div>
                    <button type="submit" name="print" value="ok"
                        class="text-white mr-2 h-10 bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">
                        <i class="fa-solid fa-print"></i>
                    </button>
                    <button type="submit" name="search" value="ok"
                        class="text-white mr-2 h-10 bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <a href=""
                        class="text-white h-10 bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </a>
                </div>
            </form>
        </div>

        <div class="w-full shadow-md bg-white  rounded-md p-2 ">
            <div class="text-sm font-medium  text-gray-500   ">


                {{-- header --}}
                <div class="overflow-x-auto relative :rounded-lg">
                    <div class="mb-3 font-bold flex justify-between  items-center ">
                        List Transaksi
                    </div>

                    {{-- table --}}
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                            <tr>
                                <th scope="col" class="p-4">
                                    No
                                </th>
                                <th scope="col" class="py-3 ">
                                    Nomor Pesanan
                                </th>
                                <th scope="col" class="py-3 ">
                                    Tanggal
                                </th>
                                <th scope="col" class="py-3 ">
                                    Email
                                </th>
                                <th scope="col" class="py-3 ">
                                    Total
                                </th>
                                <th scope="col" class="py-3 ">
                                    data<br>
                                </th>
                                <th scope="col" class="py-3 ">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="bg-white hover:bg-gray-50 ">
                                    <td class="py-4 ">
                                        {{ $items->firstItem() + $loop->index }}
                                    </td>
                                    <td class="py-4 ">
                                        {{ $item->nota }}
                                    </td>
                                    <td class="py-4 ">
                                        {{ $item->tanggal_pembelian }}
                                    </td>
                                    <td class="py-4 ">
                                        {{ $item->user->email }}
                                    </td>
                                    <td class="py-4 ">
                                        Rp. {{ number_format($item->total, 0, '', '.') }}
                                    </td>
                                    <td class="py-4 ">
                                        <ul class="list-disc list-inside">
                                            @foreach ($item->detail_penjualans as $child)
                                                <li>{{ $child->item->nama }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="py-4 ">
                                        <a href="/admin/report-transaction/{{ $item->id }}/detail"
                                            class="underline text-blue-500">
                                            Lihat Detail
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav class="flex justify-between items-center  pt-4 " aria-label="Table navigation">
                        {{ $items->onEachSide(0)->links('cms.components.pagination') }}
                    </nav>
                </div>

            </div>

        </div>
    </div>
@endsection
