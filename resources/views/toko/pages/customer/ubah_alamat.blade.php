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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 ">Informasi Akun</span>
                </div>
            </li>
        </ol>
    </nav>
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
@endsection

@section('container')
    <!-- conetent -->
    <div class=" md:flex w-full mt-10">
        <!-- sidebar -->
        @include('toko.components.sidebar-account')

        {{-- informasi  --}}
        <div class=" md:w-full px-10 ">
            <div class="m-2 py-4 ">
                <h1 class="font-bold text-2xl mb-7">Ubah Informasi Akun</h1>

                <div class="w-full md:w-2/3">
                    <form class="" action="/customer/address/{{ $almt->id }}/update" method="POST">
                        @method('PUT')
                        @csrf
                        <div class=" w-full mb-2 md:mb-8">
                            <label for="nama_depan" class="block mb-1 text-xs font-normal text-gray-900 ">Nama Depan
                                <span class="text-red-700">*</span></label>
                            <input type="text" value="{{ $almt->nama_depan }}" name="nama_depan" id="nama_depan"
                                class=" w-3/4 border border-gray-400   text-gray-900 text-sm  h-8" placeholder="Nama Depan"
                                required="">
                        </div>
                        <div class=" w-full mb-2 md:mb-8">
                            <label for="nama_belakang" class="block mb-1 text-xs font-normal text-gray-900 ">Nama
                                Belakang
                                <span class="text-red-700">*</span></label>
                            <input type="text" value="{{ $almt->nama_belakang }}" name="nama_belakang" id="nama_belakang"
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
                                <option value="{{ $almt->provinsi }}">{{ $almt->provinsi }}</option>
                            </select>
                        </div>
                        <div class=" w-full mb-2 md:mb-8">
                            <label for="kota" class="block mb-1 text-xs font-normal text-gray-900 ">Kota
                                <span class="text-red-700">*</span></label>
                            <select name="kota" id="kota"
                                class=" w-3/4 py-0 border border-gray-400  text-gray-900 text-sm  h-8" required>
                                <option value="{{ $almt->kota }}">{{ $almt->kota }}</option>
                            </select>
                        </div>
                        <div class=" w-full mb-2 md:mb-8">
                            <input type="hidden" id="kota_id" value="{{ $almt->kota_id }}" name="kota_id" readonly
                                required>
                        </div>
                        <div class=" w-full mb-2 md:mb-8">
                            <label for="kode_pos" class="block mb-1 text-xs font-normal text-gray-900 ">Kode Pos
                                <span class="text-red-700">*</span> </label>
                            <input type="text" value="{{ $almt->kode_pos }}" name="kode_pos" id="kode_pos"
                                class=" w-3/4 border border-gray-400 bg-gray-100   text-gray-900 text-sm  h-8"
                                placeholder="Kode pos" required readonly>
                        </div>
                        <div class=" w-full mb-2 md:mb-8">
                            <label for="alamat" class="block mb-1 text-xs font-normal text-gray-900 ">Alamat
                                <span class="text-red-700">* tuliskan alamat secara detail</span></label>
                            <input type="text" value="{{ $almt->alamat }}" name="alamat" id="alamat"
                                class=" w-3/4 border  border-gray-400   text-gray-900 text-sm  h-20" placeholder="Alamat"
                                required="">
                        </div>

                        <div class=" w-full mb-2 md:mb-8">
                            <label for="nama_depan" class="block mb-1 text-xs font-normal text-gray-900 ">Nomor
                                Telepon
                                <span class="text-red-700">*</span></label>
                            <div class="relative">
                                <div class="flex absolute text-sm inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    62
                                </div>
                                <input type="number" value="{{ $almt->telp }}" name="telp" id="telp"
                                    class="w-3/4 border border-gray-400 pl-9 focus:ring-0  text-gray-900 text-sm h-8 "
                                    placeholder="">
                            </div>
                        </div>

                        <button
                            class=" inline-block border border-black p-2 w-40 text-center bg-black text-white hover:bg-white hover:text-black"
                            type="submit">
                            Ubah alamat
                        </button>
                    </form>
                </div>


            </div>



        </div>
    </div>
@endsection

@section('script')
    <script>
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
    </script>
@endsection
