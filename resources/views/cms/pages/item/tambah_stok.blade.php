@extends('cms.layouts.main')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('container')
    <div class="w-full px-2 ">
        <nav class="flex justify-between mb-4 p-2 bg-white shadow-md text-black rounded-md" aria-label="Breadcrumb ">
            <div class="font-bold text-2xl text-gray-700">
                Tambah Stok
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
                            <a href="#" class="ml-1 text-sm font-medium hover:text-gray-900 md:ml-2 ">Tambah Stok</a>
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


        <div class=" w-full  flex flex-col-reverse md:flex-row  pt-3 ">
            <div
                class="w-full mt-5 md:mt-0 md:w-8/12 bg-white rounded  overflow-hidden border-2 border-purple-700 mb-6 md:mb-0">
                <div class="bg-purple-700  text-white">
                    Tambah Stok {{ $item->kategori->nama }}
                </div>
                <div class="pl-2 flex flex-col-reverse md:flex-row h-full">
                    <div class="w-full md:w-3/6 pt-4  ">
                        <form action="/admin/item/{{ $item->id }}/store-stok-item" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <p class="text-lg font-bold">{{ $item->nama }} <span
                                        class="font-medium text-gray-500">({{ $item->stok }} item)</span></p>
                            </div>
                            <div class="mb-3">

                            </div>
                            <input type="hidden" name="item_id" value="{{ $item->id }}">

                            {{-- ukuran --}}
                            <div class="mb-3 flex flex-wrap ">
                                <div class="w-full px-2 ">
                                    <div for="nama"
                                        class="mb-2 flex justify-between text-sm border-b font-medium text-gray-900 ">
                                        List Ukuran
                                        <div>
                                            <a class="text-blue-600 ml-2 hover:text-blue-700 hover:underline hover:cursor-pointer"
                                                data-modal-toggle="authentication-modal">
                                                <i class="fa-solid fa-plus"></i> Tambah Ukuran lainnya
                                            </a>

                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 md:grid-cols-4  gap-2">
                                        <?php $i = 1; ?>
                                        @foreach ($list_ukuran as $list)
                                            <?php $increment = $i++; ?>
                                            <div class=" my-size">
                                                <input id="draft-{{ $list->id }}" class="ukuran-nama hidden"
                                                    type="checkbox" name="ukuran_id[{{ $increment }}]"
                                                    value="{{ $list->ukuran->id }}" />
                                                <label for="draft-{{ $list->id }}"
                                                    class="my-label border-2 h-10 flex items-center justify-center">
                                                    {{ $list->ukuran->nama }}
                                                </label>
                                                <input disabled value="0" type="number"
                                                    name="ukuran_qty[{{ $increment }}]"
                                                    class="hidden ukuran-qty w-full h-10 mt-2 border border-purple-500"
                                                    min="1">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                            <button type="submit"
                                class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                        </form>
                    </div>

                    <div class="w-full md:w-3/6 pt-4 px-0 bg-purple-100  ">
                        <div class="w-full pl-0 md:px-3 pb-0   ">
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Ukuran yang
                                terseida
                                saat ini</label>
                            <div class="overflow-x-auto relative">
                                <table class="text-sm text-left text-gray-500  w-full md:w-full  ">
                                    <tr>
                                        <th scope="col" class="py-2 px-6 bg-black border border-white text-white  ">
                                            Ukuran
                                        </th>
                                        <th scope="col" class="py-2 px-6 border border-white bg-black text-white">
                                            Qty
                                        </th>
                                        <th scope="col" class="py-2 text-center border border-white bg-black text-white">
                                            action
                                        </th>
                                    </tr>


                                    @foreach ($list_ukuran as $list)
                                        <tr class="border-b border-gray-200 ">
                                            <th scope="row"
                                                class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 ">
                                                {{ $list->ukuran->nama }}
                                            </th>
                                            <td class="py-2 px-6 bg-gray-50">
                                                {{ $list->qty }}
                                            </td>
                                            <td class="py-2  bg-gray-50 text-center">
                                                <form
                                                    action="/admin/item/{{ $item->id }}/{{ $list->id }}/hapus_list_ukuran"
                                                    method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit"
                                                        onclick="return confirm('jika anda menghapus list ukuran, QTY juga akan ikut terhapus. apakah anda yakin?')"
                                                        class="text-red-600 ml-2 hover:text-red-700 hover:underline hover:cursor-pointer">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr class="border-b border-gray-200 ">
                                        <th scope="col" class="py-2 bg-black border border-white text-white px-6 ">
                                            Total
                                        </th>
                                        <th scope="col" class="py-2 px-6 bg-black  border border-white text-white">
                                            {{ $item->stok }}
                                        </th>
                                        <th scope="col" class="py-2  bg-black  border border-white text-white">
                                        </th>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="w-full md:w-4/12 bg-white py-0 px-2 rounded-sm  ">
                <div class="p-1 rounded  bg-purple-700 text-white">
                    <div>
                        Detail Gambar
                    </div>
                    <img src="{{ asset('./storage/' . $item->gambar) }}" alt="">
                </div>
            </div>
        </div>
    </div>






    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
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
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">
                        <i class="fa-solid fa-plus"></i> Kategori Ukuran
                    </h3>
                    <form class="space-y-6" method="POST" action="/admin/item/{{ $link }}/store-list-item">
                        @csrf
                        <div>
                            <label for="text"
                                class="block  text-sm font-medium text-gray-900 dark:text-gray-300">Ukuran</label>
                            <select name="ukuran_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                @foreach ($list_ukuran_item as $ukuran)
                                    <option value="{{ $ukuran->id }}">{{ $ukuran->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                            Submit
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            $('.ukuran-nama').click(function(e) {
                const id = $(this).val();
                const isChecked = $(this).is(':checked');
                const findMyLabel = $(this).closest('.my-size').find('.my-label')
                const findUkuranQty = $(this).closest('.my-size').find('.ukuran-qty')
                const myClass = 'border-purple-600 bg-purple-300';
                if (isChecked) {
                    findMyLabel.addClass(myClass)
                    findUkuranQty.removeClass('hidden')
                    findUkuranQty.prop('disabled', false)
                    findUkuranQty.val(1)
                } else {
                    findMyLabel.removeClass(myClass)
                    findUkuranQty.prop('disabled', true)
                    findUkuranQty.addClass('hidden')
                }


            })
        });
    </script>
@endsection
