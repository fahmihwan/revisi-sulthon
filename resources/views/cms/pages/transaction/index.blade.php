@extends('cms.layouts.main')


@section('container')
    <div class="w-full px-2 ">
        <nav class="flex justify-between mb-4 p-2 bg-white shadow-md text-black rounded-md" aria-label="Breadcrumb ">
            <div class="font-bold text-2xl text-gray-700">
                Kelola Transaksi
            </div>
            <div>
                <ol class="inline-flex items-center space-x-1 md:space-x-3  ">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium  hover:text-gray-900">
                            kelola transaksi
                        </a>
                    </li>
                </ol>
            </div>
        </nav>

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
                                <th scope="col" class="p-2">
                                    No
                                </th>
                                <th scope="col" class="py-3">
                                    Nomor Pesanan
                                </th>
                                <th scope="col" class="py-3 ">
                                    Status
                                    Pembayaran
                                </th>
                                <th scope="col" class="py-3 ">
                                    Tanggal
                                </th>

                                <th scope="col" class="py-3 ">
                                    Email
                                </th>
                                {{-- <th scope="col" class="py-3 ">
                                    Status <br> Pengiriman
                                </th> --}}

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
                                        <span @class([
                                            'text-red-600' => true,
                                            'text-green-500' =>
                                                $item->pembayaran->transaction_status == 'capture' ||
                                                $item->pembayaran->transaction_status == 'settlement',
                                            'text-orange-400' => $item->pembayaran->transaction_status == 'pendding',
                                        ])>
                                            {{ $item->pembayaran->transaction_status }}
                                        </span>
                                    </td>
                                    <td class="py-4 ">
                                        {{ $item->created_at->diffForHumans() }}
                                    </td>

                                    <td class="py-4 ">
                                        {{ $item->user->email }}
                                    </td>
                                    <td class="py-4">
                                        <a href="/admin/list-transaction/{{ $item->id }}/detail"
                                            class="underline text-white rounded bg-purple-700 p-2 ">
                                            <i class="fa-solid fa-truck-fast"></i>
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
