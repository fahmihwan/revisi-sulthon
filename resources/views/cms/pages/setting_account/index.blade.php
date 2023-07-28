@extends('cms.layouts.main')


@section('container')
    <div class="w-full px-2 ">
        <nav class="flex justify-between mb-4 p-2 bg-white shadow-md text-black rounded-md" aria-label="Breadcrumb ">
            <div class="font-bold text-2xl text-gray-700">
                Setting Account
            </div>
            <div>
                <ol class="inline-flex items-center space-x-1 md:space-x-3  ">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium  hover:text-gray-900">
                            setting
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right text-gray-400"></i>
                            <a href="#" class="ml-1 text-sm font-medium hover:text-gray-900 md:ml-2 ">account</a>
                        </div>
                    </li>
                </ol>
            </div>
        </nav>






        <div class="w-full shadow-md bg-white  rounded-md p-2 ">
            <div class="text-sm font-medium  text-gray-500   ">


                {{-- header --}}
                <div class="overflow-x-auto relative :rounded-lg">
                    <div class="mb-3 font-bold flex justify-between  items-center ">
                        List Account

                        <!-- Modal toggle -->
                        <a href="/admin/auth/create"
                            class="block text-xs font-sm text-white bg-purple-600 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center "
                            type="button">
                            Tambah Akun <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>


                    {{-- table --}}
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                            <tr>
                                <th scope="col" class="p-4">
                                    No
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Nama
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Username
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Akses
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Created at
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Updated at
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="bg-white hover:bg-gray-50 ">
                                    <td class="p-4 w-4">
                                        {{ $loop->iteration }}
                                    </td>
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $user->nama }}
                                    </th>
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $user->username }}
                                    </th>
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $user->hak_akses }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $user->created_at }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $user->updated_at }}
                                    </td>

                                    <td class="py-4 px-6 flex">
                                        <a href="/admin/auth/{{ $user->id }}/edit"
                                            class="font-medium text-blue-600  hover:underline mr-3">Edit</a> |
                                        <form method="POST" action="/admin/auth/{{ $user->id }}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit"
                                                class="font-medium text-red-600  hover:underline ml-3">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <nav class="flex justify-between items-center pt-4" aria-label="Table navigation">
                        <span class="text-sm font-normal text-gray-500 ">Showing <span
                                class="font-semibold text-gray-900 ">1-10</span> of <span
                                class="font-semibold text-gray-900 ">1000</span></span>
                        <ul class="inline-flex items-center -space-x-px">
                            <li>
                                <a href="#"
                                    class="block py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700  dark:border-gray-700   ">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700  dark:border-gray-700   ">1</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700  dark:border-gray-700   ">2</a>
                            </li>
                            <li>
                                <a href="#" aria-current="page"
                                    class="z-10 py-2 px-3 leading-tight text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700  ">3</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700  dark:border-gray-700   ">...</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700  dark:border-gray-700   ">100</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700  dark:border-gray-700   ">
                                    <span class="sr-only">Next</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>

        </div>
    </div>
@endsection
