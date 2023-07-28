@extends('toko.layout.main')


@section('breadcrumb')
    <nav class="flex border   border-gray-200" aria-label="Breadcrumb">
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
            <li aria-current="page">
                <div class="flex items-center ">
                    <i class="fa-solid fa-chevron-right"></i>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 ">List Item</span>
                </div>
            </li>
        </ol>
    </nav>

    {{-- resend_email --}}
    @include('toko.components.resend_email_confirmation')
@endsection

@section('sidebar-kategori')
    <aside
        class="w-96 bg-white md:w-80 border-r-2 absolute md:static shadow-lg shadow-slate-800 md:shadow-none transition-width"
        id="sidebar" aria-label="Sidebar">
        <button class="p-4 flex justify-between font-light  w-full btn-filter-toggle ">
            <span class="text-sm"><span class="">Sembunyikan Filter</span>
            </span>

            <i class="fa-solid fa-bars hidden md:block"></i>

            <svg aria-hidden="true" class="w-5 h-5 block md:hidden" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>

        </button>
        <div class="overflow-y-auto py-4 px-3 bg-gray-50 h-full rounded ">
            <ul class="space-y-2">
                <li>
                    <div class="flex items-center p-2 border-b-2 mb-3">
                        <span class="flex-1 ml-3 whitespace-nowrap">Kategori</span>
                        <br>
                    </div>
                    <ul class="px-5">
                        @foreach ($kategories as $kategori)
                            <li>
                                <form action="/list-item" id="form-kategori">
                                    <div class="flex items-center mb-4">
                                        <input id="kategori-{{ $kategori->nama }}" name="kategori[{{ $loop->iteration }}]"
                                            type="checkbox" value="{{ $kategori->id }}" data-nama="{{ $kategori->nama }}"
                                            class="check-kategori w-5 h-5 text-black bg-white   border-gray-300  focus:ring-blue-500  focus:ring-2  ">
                                        <label for="kategori-{{ $kategori->nama }}"
                                            class="ml-2 font-medium text-gray-900 w-full pb-2 border-b  ">
                                            {{ $kategori->nama }}</label>
                                    </div>
                                </form>
                            </li>
                        @endforeach
                    </ul>

                </li>

            </ul>
        </div>
    </aside>
@endsection

@section('container')
    <div class="w-full">
        <div class="w-full border-b-2 flex justify-between">
            <div class="flex items-center">
                <button class="p-4 hidden mr-2 btn-filter-toggle">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <span class="font-bold mr-3 text-sm p-4">
                    <span id="jumlah-data">0</span> Hasil
                </span>
                <div id="render-kategori">
                    {{-- <span class="text-xs">Sepatu <button class="hapus-kategori font-bold text-red-600 pl-1 pr-5">x</button></span> --}}
                    {{-- <span class="text-xs">Hodie <button class="hapus-kategori font-bold text-red-600 pl-1 pr-5">x</button></span> --}}
                    {{-- <span class="text-xs">Kaos <button class="hapus-kategori font-bold text-red-600 pl-1 pr-5">x</button></span> --}}

                </div>
            </div>
            <form class="flex items-center">
                <label for="countries" class="block mr-3  text-sm font-medium text-gray-900 dark:text-gray-400">Sort
                    By</label>
                <select id="filter-items"
                    class="border border-gray-200 focus:ring-gray-200    focus:border-gray-200 focus:border-0  text-gray-900 text-sm  block w-56 p-2.5 h-full">
                    <option selected value="">Filter</option>
                    <option value="desc">HARGA : TINGGI KE RENDAH</option>
                    <option value="asc">HARGA : RENDAH KE TINGGI</option>
                    <option value="latest">PRODUK BARU</option>

                </select>
            </form>
        </div>
        <!-- content -->
        <div class=" grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 min:h-screen  p-2 bg-gray-100" id="content-items">

            {{-- render content javascript --}}

        </div>
    </div>
@endsection



@section('script')
    <script>
        $(document).ready(function() {
            filterItems()

            let checkedKategori = [];
            $('.check-kategori').click(function() {
                if ($(this).is(':checked')) {
                    checkedKategori.push({
                        'id': $(this).val(),
                        'nama': $(this).attr('data-nama')
                    })
                }
                if (!$(this).is(':checked')) {
                    deleteKategori($(this).val())
                    $(this).prop('checked', false)
                }
                renderKategori(checkedKategori)
            })

            $('#filter-items').change(function() {
                filterItems(checkedKategori.map(data => data.id), $(this).val())
            })


            function renderKategori(data) {
                // console.log(data.map(data => data.id))
                filterItems(data.map(data => data.id), null)

                let elemeKtgr = ''
                data.forEach(e => {
                    elemeKtgr +=
                        `<span class="text-xs">${e.nama} <button data-id='${e.id}' class="hapus-kategori font-bold text-red-600  pr-5"> X </button></span>`
                })
                $('#render-kategori').html(elemeKtgr)
                $('.hapus-kategori').click(function() {
                    deleteKategori($(this).attr('data-id'))
                    renderKategori(checkedKategori)
                })
            }


            function deleteKategori(vId) {
                $(`.check-kategori[value=${vId}]`).prop('checked', false)[0]
                let indexCheckbox = checkedKategori.findIndex(data => data.id == vId);
                if (indexCheckbox !== -1) {
                    checkedKategori.splice(indexCheckbox, 1);
                }
            }


            function filterItems(data, filter) {

                $.ajax({
                    url: 'list-item-ajax',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "isChecked": data ? data : [],
                        "filter": filter
                    },
                    success: function(response) {
                        let items = ''
                        console.log(response)
                        $('#content-items').html('')
                        $('#jumlah-data').text(response.length)
                        if (response.length == 0) {
                            $('#content-items').html(
                                '<p class="text-center py-10"> Hasil Tidak di temukan </p>')
                        }
                        response.forEach(e => {
                            items += `<div class="">
                        <a href="/list-item/${e.id}/detail-item" >
                            <img class="object-cover" src="./storage/${e.gambar}" alt="product image">
                        </a>
                        <div class="p-2 border flex justify-between bg-white ">
                            <div class=""> 
                                <span class="block text-ellipsis w-36 whitespace-nowrap overflow-hidden">${e.nama}</span>
                                <span class="text-gray-400">Rp ${ (e.harga/1000).toFixed(3)}</span>
                            </div>
                            <div class="text-right">
                                <span class="mb-3 text-gray-500">
                                    ${e.kategori.nama}
                                </span><br>
                                ${(e.wish_list == null)?`
                                                                                                                                                                                                                                                                                 <button type="submit" class="wish-list-off mr-2" data-id="${e.id}"><i class="text-xl far fa-heart"></i></button>`: `
                                                                                                                                                                                                                                                                                 <button type="submit" class="wish-list-on mr-2" data-id="${e.id}"> <i class="fa-solid fa-heart text-xl"></i></button>`}
                            </div>
                        </div>
                    </div>`
                            $('#content-items').html(items)
                        });
                        wishlist()

                    }
                })
            }


        })


        function wishlist() {
            $('.wish-list-off').click(function() {
                let id = $(this).attr('data-id')
                $.ajax({
                    url: `/list-item/wish_list/${id}`,
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function(response) {
                        console.log(response)
                        alert('item ditambahkan ke wishlist')
                        window.location.reload()
                    }

                })
            })

            $('.wish-list-on').click(function() {
                let id = $(this).attr('data-id')
                $.ajax({
                    url: `/list-item/wish_list/${id}/destroy`,
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function(response) {
                        console.log(response)
                        alert('item dihapus dari wishlist')
                        window.location.reload()
                    }

                })
            })
        }
    </script>
@endsection

{{-- /list-item/wish_list/${e.id} --}}
{{-- /list-item/wish_list/${e.id}/destroy --}}
