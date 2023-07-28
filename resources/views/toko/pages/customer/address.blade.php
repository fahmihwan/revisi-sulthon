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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 ">Alamat</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection

@section('container')
    <!-- conetent -->
    <div class=" md:flex w-full mt-10">
        <!-- sidebar -->
        @include('toko.components.sidebar-account')

        {{-- informasi  --}}
        <div class=" md:w-full px-10 ">
            <div class="m-2 py-4 ">
                <h1 class="font-bold text-2xl mb-7">Alamat</h1>
                <h1 class="font-bold text-2xl pb-5 border-b-2">ALAMAT PENGIRIMAN UTAMA</h1>
            </div>

            {{-- <div class="flex">
                @foreach ($alamats as $almt)
                    <div class="mb-5 mr-5">
                        <h1 class="font-bold mb-4">Alamat Pengiriman</h1>
                        <p class="font-light text-sm pb-2">{{ $almt->nama_depan }} {{ $almt->nama_belakang }}</p>
                        <p class="font-light text-sm pb-2">{{ $almt->alamat }}</p>
                        <p class="font-light text-sm pb-2">{{ $almt->kota }}, {{ $almt->provinsi }}, {{ $almt->kode_pos }}
                        </p>
                        <p class="font-light text-sm pb-2">{{ $almt->telp }}</p>
                        <a href="" class="underline text-xs hover:text-red-500">Ubah Alamat Pengiriman</a>
                    </div>
                @endforeach
            </div> --}}

            <div class="flex flex-wrap " id="radio-group">

                @foreach ($alamats as $alamat)
                    <section class="cek-alamat text-sm  w-full md:w-1/3 m-3 cursor-pointer relative">
                        <input type="radio" name="alamat" value="{{ $alamat->id }}" id="alamat-{{ $loop->iteration }}"
                            class="input-alamat peer hidden absolute top-0 right-0"
                            {{ $alamat->credential != null ? 'checked' : '' }}>
                        <i class="hidden peer-checked:block fa-solid fa-check absolute  top-0 right-3 text-2xl"></i>
                        <label for="alamat-{{ $loop->iteration }}"
                            class="label-alamat  peer-checked:border-black peer-checked:text-black  text-gray-300 border-gray-300 cursor-pointer label-alamat w-full h-full  border-2  p-3 flex ">
                            <ul>
                                <li class="mb-1">
                                    {{ $alamat->nama_depan }} {{ $alamat->nama_belakang }}
                                </li>
                                <li class="mb-1">
                                    {{ $alamat->alamat }}
                                </li>
                                <li class="mb-1">
                                    {{ $alamat->kota }}, {{ $alamat->provinsi }}
                                    {{ $alamat->kode_pos }}
                                </li>
                                <li class="mb-1">
                                    {{ $alamat->telp }}
                                </li>
                            </ul>
                        </label>
                    </section>
                @endforeach
            </div>


            <div class=" mt-5">
                <h1 class="font-bold text-2xl pb-5 border-b-2 mb-10">Alamat Tambahan </h1>
                <div class="">
                    <table class="w-full text-left text-gray-500  text-xs">
                        <thead class="text-xs text-gray-900  ">
                            <tr class="border-b">
                                <th scope="col" class="py-2 px-0">
                                    Nama Depan
                                </th>
                                <th scope="col" class="py-2 px-0">
                                    Nama Belakang
                                </th>
                                <th scope="col" class="py-2 px-0">
                                    Alamat
                                </th>
                                <th scope="col" class="py-2 px-0">
                                    Provinsi
                                </th>
                                <th scope="col" class="py-2 px-0">
                                    Kota
                                </th>
                                <th scope="col" class="py-2 px-0">
                                    Kode Pos
                                </th>
                                <th scope="col" class="py-2 px-0">
                                    Nomor Telp
                                </th>
                                <th scope="col" class="py-2 px-0">
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($alamats as $alamat)
                                <tr class="border-b ">
                                    <th scope="row" class="py-2 px-0 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $alamat->nama_depan }}
                                    </th>
                                    <td class="py-2 px-0">
                                        {{ $alamat->nama_belakang }}
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ $alamat->alamat }}
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ $alamat->provinsi }}
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ $alamat->kota }}
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ $alamat->kode_pos }}
                                    </td>
                                    <td class="py-2 px-0">
                                        {{ $alamat->telp }}
                                    </td>
                                    <td class="py-2 px-0 flex ">
                                        <a class="text-red-500" href="/customer/address/{{ $alamat->id }}/edit">Ubah</a>
                                        &nbsp;| &nbsp;
                                        <form action="/customer/address/{{ $alamat->id }}/delete" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="text-red-500">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div class="float-right mt-5 mb-5 text-sm">
                        <label for="">Show</label>
                        <select name="" id="" class="border border-gray-300 rounded-sm w-14 p-2 text-sm">
                            <option value="">10</option>
                            <option value="">20</option>
                            <option value="">50</option>
                        </select>
                        <label for="">Per Page</label>
                    </div>

                </div>
                <!-- Modal toggle -->
                <button
                    class="mt-20 inline-block border border-black p-2 w-40 text-center bg-black text-white hover:bg-white hover:text-black"
                    type="button" data-modal-toggle="create-alamat-customer">
                    Tambah alamat
                </button>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>

        </div>
    </div>


    <!-- Main modal -->
    <div id="create-alamat-customer" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
        <div class="relative  w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white  shadow ">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm  ml-auto inline-flex items-center  "
                    data-modal-toggle="create-alamat-customer">
                    <i class="fa-solid fa-xmark"></i>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="py-6  lg:px-4 ">
                    <h3 class="mb-4 text-2xl font-semibold text-center border-b pb-5  font-00 ">
                        Alamat pengiriman
                    </h3>
                    <form class="m-0" action="/alamat" method="POST">
                        @csrf
                        <div class="overflow-scroll h-96 pl-5">
                            <div class=" w-full mb-2 md:mb-8">
                                <label for="nama_depan" class="block mb-1 text-xs font-normal text-gray-900 ">Nama Depan
                                    <span class="text-red-700">*</span></label>
                                <input type="text" name="nama_depan" id="nama_depan"
                                    class=" w-3/4 border border-gray-400   text-gray-900 text-sm  h-8"
                                    placeholder="Nama Depan" required="">
                            </div>
                            <div class=" w-full mb-2 md:mb-8">
                                <label for="nama_belakang" class="block mb-1 text-xs font-normal text-gray-900 ">Nama
                                    Belakang
                                    <span class="text-red-700">*</span></label>
                                <input type="text" name="nama_belakang" id="nama_belakang"
                                    class=" w-3/4 border border-gray-400   text-gray-900 text-sm  h-8"
                                    placeholder="Nama Belakang" required="">
                            </div>

                            <div class=" w-full  mb-2 md:mb-8">
                                <label for="" class="block mb-1 text-xs font-normal text-gray-900 ">Negara
                                    <span class="text-red-700">*</span></label>
                                <input type="text" name="" id=""
                                    class=" w-3/4 border border-gray-400 bg-gray-50 text-gray-900 text-sm  h-8"
                                    placeholder="negara" value="Indonesia" readonly required="">
                            </div>
                            <div class=" w-full mb-2 md:mb-8">
                                <label for="provinsi" class="block mb-1 text-xs font-normal text-gray-900 ">Provinsi
                                    <span class="text-red-700">*</span></label>
                                <select name="provinsi" id="provinsi"
                                    class=" w-3/4 py-0 border border-gray-400  text-gray-900 text-sm  h-8" required>
                                    <option value="">Pilih wilayah atau provinsi</option>
                                </select>
                            </div>
                            <div class=" w-full mb-2 md:mb-8">
                                <label for="kota" class="block mb-1 text-xs font-normal text-gray-900 ">Kota
                                    <span class="text-red-700">*</span></label>
                                <select name="kota" id="kota"
                                    class=" w-3/4 py-0 border border-gray-400  text-gray-900 text-sm  h-8" required>

                                </select>
                            </div>
                            <div class=" w-full mb-2 md:mb-8">
                                <input type="hidden" id="kota_id" name="kota_id" readonly required>
                            </div>
                            <div class=" w-full mb-2 md:mb-8">
                                <label for="kode_pos" class="block mb-1 text-xs font-normal text-gray-900 ">Kode Pos
                                    <span class="text-red-700">*</span> </label>
                                <input type="text" name="kode_pos" id="kode_pos"
                                    class=" w-3/4 border border-gray-400 bg-gray-100   text-gray-900 text-sm  h-8"
                                    placeholder="Kode pos" required readonly>
                            </div>
                            <div class=" w-full mb-2 md:mb-8">
                                <label for="alamat" class="block mb-1 text-xs font-normal text-gray-900 ">Alamat
                                    <span class="text-red-700">* tuliskan alamat secara detail</span></label>
                                <input type="text" name="alamat" id="alamat"
                                    class=" w-3/4 border  border-gray-400   text-gray-900 text-sm  h-20"
                                    placeholder="Alamat" required="">
                            </div>

                            <div class=" w-full mb-2 md:mb-8">
                                <label for="nama_depan" class="block mb-1 text-xs font-normal text-gray-900 ">Nomor
                                    Telepon
                                    <span class="text-red-700">*</span></label>
                                <div class="relative">
                                    <div
                                        class="flex absolute text-sm inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        62
                                    </div>
                                    <input type="number" name="telp" id="telp"
                                        class="w-3/4 border border-gray-400 pl-9 focus:ring-0  text-gray-900 text-sm h-8 "
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                        {{-- api --}}


                        <div class="px-5 flex">
                            <button data-modal-toggle="create-alamat-customer"
                                class="w-full text-white mt-7 mr-2 bg-black border border-black hover:bg-white hover:text-black duration-300 focus:ring-0 focus:outline-none  font-medium  text-sm px-5 py-2.5 text-center ">
                                Batal
                            </button>
                            <button type="submit"
                                class="w-full text-white mt-7 ml-2 bg-black border border-black hover:bg-white hover:text-black duration-300 focus:ring-0 focus:outline-none  font-medium  text-sm px-5 py-2.5 text-center ">Tambahkan</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            let id_provinsi = '';
            let id_kota = '';
            $.ajax({
                url: '/checkout/alamat-pengiriman/province',
                type: 'GET',
                dataType: "json",
                success: function(res) {
                    let prov = '';
                    $('#provinsi').append(prov)
                    if (res.rajaongkir.status.code != 400) {
                        let prov = '';
                        res.rajaongkir.results.forEach(e => {
                            prov +=
                                `<option value="${e.province}" data-id="${e.province_id}">${e.province}</option>`;
                        });
                        $('#provinsi').append(prov)
                    }
                },
                error: function(err) {
                    alert(err)
                }
            })


            $('#provinsi').change(function() {
                let id = $(this).find(':selected').attr('data-id')
                id_provinsi = id;
                $.ajax({
                    url: `/checkout/alamat-pengiriman/province/${id}/city`,
                    type: 'GET',
                    dataType: "json",
                    success: function(res) {
                        let kota = ''
                        $('#kota').html('')
                        $('#kota').append(`<option disabled> Pilih Kabupate / Kota</option>`)
                        res.rajaongkir.results.forEach(e => {
                            kota +=
                                `<option value="${e.city_name}" data-id="${e.city_id}">${e.city_name}</option>`;
                        });
                        $('#kota').append(kota)
                    },
                    error: function(err) {
                        alert(err)
                    }
                })
            })

            $('#kota').change(function() {
                let id = $(this).find(':selected').attr('data-id')
                id_kota = id
                $.ajax({
                    url: `/checkout/alamat-pengiriman/province/${id_kota}/city/${id_provinsi}`,
                    type: 'GET',
                    dataType: "json",
                    success: function(res) {
                        let result = res.rajaongkir.results;
                        $('#kota_id').val('')
                        $('#kode_pos').val('')
                        $('#kode_pos').val(result.postal_code)
                        $('#kota_id').val(result.city_id)
                    },
                    error: function(err) {
                        alert(err)
                    }
                })
            })


            $('.label-alamat').each(function() {
                $(this).click(function() {
                    let idAlamat = $(this).closest('.cek-alamat').find('.input-alamat').val()
                    $.ajax({
                        url: `/checkout/pengiriman/${idAlamat}/set_alamat_primary`,
                        type: 'PUT',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            window.location.href = '/customer/address';
                            alert('alamat pengiriman utama sekarang adalah : ' + res
                                .data)
                        },
                        error: function(err) {
                            alert(err)
                        }

                    })
                })
            })

        })
    </script>
@endsection
