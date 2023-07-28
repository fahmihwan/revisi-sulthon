@extends('cms.layouts.main')


@section('container')
    <div class="w-full px-2 ">
        <nav class="flex justify-between mb-4 p-2 bg-white shadow-md text-black rounded-md" aria-label="Breadcrumb ">
            <div class="font-bold text-2xl text-gray-700">
                Detail Customer
            </div>
            <div>
                <ol class="inline-flex items-center space-x-1 md:space-x-3  ">
                    <li class="inline-flex items-center">
                        <a href="/admin/list-customer"
                            class="inline-flex items-center text-sm font-medium  hover:text-gray-900">
                            List Customer
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right text-gray-400"></i>
                            <a href="#" class="ml-1 text-sm font-medium hover:text-gray-900 md:ml-2 ">Detail
                                Customer</a>
                        </div>
                    </li>
                </ol>
            </div>
        </nav>
        <section class="flex justify-between mb-2">
            <div>
            </div>
            <a href="/admin/list-customer"
                class="bg-purple-600 hover:bg-white hover:text-black border hover:duration-200 hover:border-purple-600 text-white p-2 rounded">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </section>

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
                                {{ $user->credential->nama_depan }} {{ $user->credential->nama_belakang }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="col" class=" py-2 px-6 flex items-start">
                                Email
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $user->email }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="col" class=" py-2 px-6 flex items-start">
                                Tanggal Lahir
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $user->credential->tanggal_lahir }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="col" class=" py-2 px-6 flex items-start">
                                Telp
                            </th>
                            <td class="py-2 px-6 bg-white">
                                {{ $user->credential->telp }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="col" class=" py-2 px-6 flex items-start">
                                Status
                            </th>
                            <td class="py-2 px-6 bg-white">
                                <div class="flex items-center justify-between">
                                    <span class="mr-3 flex">
                                        <div
                                            class=" {{ $user->status == 'active' ? 'bg-green-400' : 'bg-red-500' }} mt-1 mr-1 w-2 h-2 rounded-xl">
                                        </div>
                                        {{ $user->status }}
                                    </span>
                                    @if (auth()->guard('webadmin')->user()->hak_akses == 'karyawan')
                                        <button
                                            class="block text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1 text-center  "
                                            type="button" data-modal-toggle="popup-modal">
                                            Edit Status Account
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>



                    </table>
                </div>

            </div>


        </div>

    </div>



    <div id="popup-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center  "
                    data-modal-toggle="popup-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 " fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">edit status pengguna
                        {{ $user->email }}?</h3>
                    <form action="/admin/list-customer/{{ $user->id }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button value="active" name="status"
                            class="text-white bg-blue-600 w-32 focus:ring-4 focus:outline-none mr-3 rounded py-2">
                            Active
                        </button>
                        <button value="suspend" name="status"
                            class="text-white bg-red-600 w-32 focus:ring-4 focus:outline-none mr-3 rounded py-2">
                            Suspend
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
