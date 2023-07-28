@extends('cms.layouts.main')


@section('container')
    <div class="w-full px-2 ">
        <nav class="flex justify-between mb-4 p-2 bg-white shadow-md text-black rounded-md" aria-label="Breadcrumb ">
            <div class="font-bold text-2xl text-gray-700">
                List Customer
            </div>
            <div>
                <ol class="inline-flex items-center space-x-1 md:space-x-3  ">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium  hover:text-gray-900">
                            List Customer
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
                        List Kategori
                    </div>


                    {{-- table --}}
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                            <tr>
                                <th scope="col" class="p-4">
                                    No
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    nama
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    email
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    status
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Created at
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="bg-white hover:bg-gray-50 ">
                                    <td class="py-4 px-6">
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $user->credential->nama_depan }} {{ $user->credential->nama_belakang }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $user->email }}
                                    </td>
                                    <td class="py-4 px-6 flex ">
                                        <div
                                            class=" {{ $user->status == 'active' ? 'bg-green-400' : 'bg-red-500' }} mt-1 mr-1 w-2 h-2 rounded-xl">
                                        </div>
                                        <span class="font-bold"> {{ $user->status }}</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $user->created_at }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <a href="/admin/list-customer/{{ $user->id }}"
                                            class="font-medium text-blue-600  hover:underline mr-3">Detail User</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <nav class="flex justify-between items-center  pt-4 " aria-label="Table navigation">
                        {{ $users->onEachSide(0)->links('cms.components.pagination') }}
                    </nav>
                </div>

            </div>

        </div>
    </div>
@endsection
