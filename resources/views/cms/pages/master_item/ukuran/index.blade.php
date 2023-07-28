@extends('cms.layouts.main')

@section('container')
    <div class="w-full px-2 ">
        <nav class="flex justify-between mb-4 p-2 bg-white shadow-md text-black rounded-md" aria-label="Breadcrumb ">
            <div class="font-bold text-2xl text-gray-700">
                Ukuran
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
                            <a href="#" class="ml-1 text-sm font-medium hover:text-gray-900 md:ml-2 ">Ukuran</a>
                        </div>
                    </li>
                </ol>
            </div>
        </nav>



        <section class="mb-3  w-full">
            <ul
                class=" border flex text-sm font-medium text-center text-gray-500 rounded-lg divide-x divide-gray-200 shadow sm:flex  ">
                <li class="w-1/2 md:w-full ">
                    <a href="/admin/master-item/kategori"
                        class="inline-block p-4 w-full bg-white hover:text-gray-700 hover:bg-gray-50  ">
                        Kategori
                    </a>
                </li>
                <li class="w-1/2 md:w-full">
                    <a href="/admin/master-item/ukuran" class="inline-block  p-4 w-full text-gray-900 bg-gray-200  active  "
                        aria-current="page">
                        Ukuran
                    </a>
                </li>
            </ul>
        </section>

        <div class="w-full shadow-md bg-white  rounded-md p-2 ">
            <div class="text-sm font-medium  text-gray-500   ">


                {{-- header --}}
                <div class="overflow-x-auto relative :rounded-lg">
                    <div class="mb-3 font-bold flex justify-between  items-center ">
                        List Ukuran
                        <!-- Modal toggle -->
                        @if (auth()->guard('webadmin')->user()->hak_akses == 'karyawan')
                            <button
                                class="block text-xs font-sm text-white bg-purple-600 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center "
                                type="button" data-modal-toggle="authentication-modal">
                                Tambah Data <i class="fa-solid fa-plus"></i>
                            </button>
                        @endif


                        <!-- Main modal -->
                        <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                            class="hidden p-0 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
                            <div class="relative p-0 w-full max-w-md h-full md:h-auto">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow ">
                                    <button type="button"
                                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm  ml-auto inline-flex items-center dark:hover:bg-gray-800 "
                                        data-modal-toggle="authentication-modal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>

                                    <div class="py-6 px-6 lg:px-8">
                                        <h3 class="mb-4 text-xl font-medium text-gray-900 ">Tambah Ukuran
                                        </h3>
                                        <form class="space-y-6" action="/admin/master-item/ukuran" method="POST">
                                            @csrf
                                            <div class="mb-2">
                                                <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 ">
                                                    Ukuran</label>
                                                <input type="text" name="nama" id="kategori"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                                                    required="" autocomplete="off" placeholder="input ukuran">
                                            </div>
                                            <div>
                                                <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 ">
                                                    Kategori</label>
                                                <select
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  "
                                                    name="kategori_id" id="">
                                                    @foreach ($kategories as $kategori)
                                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <button type="submit"
                                                class="w-full text-white bg-purple-600 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center  ">
                                                Submit</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- table --}}
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                            <tr>
                                <th scope="col" class="p-4">
                                    No
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Ukuran
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Kategori
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Created at
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Updated at
                                </th>
                                @if (auth()->guard('webadmin')->user()->hak_akses == 'karyawan')
                                    <th scope="col" class="py-3 px-6">
                                        Action
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="bg-white    hover:bg-gray-50 ">
                                    <td class="p-4 w-4">
                                        {{ $items->firstItem() + $loop->index }}
                                    </td>
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $item->nama }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $item->kategori->nama }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $item->created_at }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $item->updated_at }}
                                    </td>
                                    @if (auth()->guard('webadmin')->user()->hak_akses == 'karyawan')
                                        <td class="py-4 px-6 flex">
                                            <a href="/admin/master-item/ukuran/{{ $item->id }}/edit"
                                                class="font-medium text-blue-600  hover:underline mr-3">Edit</a> |
                                            <form method="POST" action="/admin/master-item/ukuran/{{ $item->id }}">
                                                @method('delete')
                                                @csrf
                                                <button type="submit"
                                                    class="font-medium text-red-600  hover:underline ml-3">Hapus</button>
                                            </form>
                                        </td>
                                    @endif
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
