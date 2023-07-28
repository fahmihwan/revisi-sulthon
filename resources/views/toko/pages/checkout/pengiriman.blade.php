@extends('toko.layout.main_checkout')



@section('container-checkout')
    <div class="w-full md:w-2/3 pr-0 md:pr-8 mb-5 md:mb-14  ">
        <div class="border h-full">
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


            {{-- tabs --}}
            <div class=" md:flex hidden ">
                <div class=" border-t-2 p-3  border-emerald-500 w-1/2 inline-block text-center">
                    <span
                        class="bg-emerald-500 inline-block  rounded-full w-6 text-center  text-white mr-1">1</span>Pengiriman
                </div>
                <div class=" border-t-2 p-3 bg-gray-100  w-1/2 inline-block text-center">
                    <span class="bg-gray-700 inline-block  rounded-full w-6 text-center text-white mr-1">2
                    </span>Pembayaran
                </div>
            </div>

            <div class="pt-10 border-b-2 border-gray-200 pb-3  mx-5 ">
                ALAMAT PENGIRIMAN
            </div>
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
            <!-- Modal toggle -->
            <button class="block px-4 mt-4 underline focus:ring-0" type="button" data-modal-toggle="authentication-modal">
                Tambah alamat baru
            </button>


            <div class="pt-2 border-b-2  mt-16 border-gray-200 pb-3  mx-5 mb-4">
                <p class="font-extrabold">METODE PENGEIRIMAN</p>
            </div>

            <form action="/checkout/pembayaran" method="GET">
                <div class="mx-5 mb-5">
                    <label for="" class="mb-1 inline-block">Metode pengiriman <span class="text-red-600 ">*</span>
                    </label><br>

                    <select id="metode_pengiriman" required
                        class="border {{ $alamats->count() == 0 ? 'bg-gray-200' : 'bg-white' }}  border-black"
                        name="metode_pengiriman" {{ $alamats->count() == 0 ? 'disabled' : '' }}>
                        <option disabled selected value>pilih metode pengiriman</option>
                        <option value="jne">JNE</option>
                        <option value="pos">POS</option>
                        <option value="tiki">TIKI</option>
                    </select>
                </div>

                <div id="list-layanan-ongkir">

                    {{-- <div role="status" class="mx-20 border flex items-ce">
                        <svg aria-hidden="true" class="mr-2 w-8 h-8 text-gray-300 animate-spin  fill-blue-600"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="">Loading...</span>
                    </div> --}}


                </div>


                <button
                    class="bg-black hover:bg-white hover:text-black border-2 duration-300 border-black text-white p-2 w-40 text-center float-right m-3">
                    Selanjutnya
                </button>
            </form>
        </div>
    </div>

    {{-- @include('toko.components.sidebarCheckout') --}}

    <div class="border h-fit w-full md:w-1/3">
        <div class="w-[90%] pt-5 mx-auto font-bold">
            Ringkasan Berbelanja
        </div>
        <div class="w-90% p-3  ">
            @foreach ($items as $item)
                <div class="flex border-t-2 pt-2 pb-7">
                    <img class="w-24 mr-3" src="{{ asset('./storage/' . $item->item->gambar) }}" alt="">
                    <article>
                        {{ $item->item->nama }}<br>
                        Jumlah : {{ $item->qty }} <br>
                        Size : {{ $item->ukuran->nama }} <br>
                    </article>
                </div>
            @endforeach

        </div>
        <div class="flex justify-between px-3 pb-2">
            <span class="font-light text-sm">Subtotal Belanja</span>
            <span>Rp. {{ number_format($sub_total, 0, '', '.') }}</span>
        </div>
        <div id="info-pengiriman">

        </div>
        <div class="border-t flex justify-between p-3 ">
            <span class="font-light text-sm">Total</span>
            <span class="font-extrabold">Rp. <span id="total"
                    data-total="{{ $sub_total }}">{{ number_format($sub_total, 0, '', '.') }}</span></span>
        </div>
    </div>





    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
        <div class="relative  w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white  shadow ">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm  ml-auto inline-flex items-center  "
                    data-modal-toggle="authentication-modal">
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
                            <button data-modal-toggle="authentication-modal"
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


            $('#metode_pengiriman').change(function() {
                $('#info-pengiriman').html('')
                $('#total').text(($('#total').attr('data-total') / 1000).toFixed(3))



                $.ajax({
                    url: `/checkout/alamat-pengiriman/${$(this).val()}/cost`,
                    type: "GET",
                    dataType: "json",
                    beforeSend: function() {
                        $('#list-layanan-ongkir').html('')
                        $('#list-layanan-ongkir').append(`
                    <div role="status" class="mx-6 flex items-center">
                <svg aria-hidden="true" class="mr-2 w-8 h-8 text-gray-300 animate-spin  fill-blue-600"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
                <span class="">Loading...</span>
            </div>
                    `)
                    },
                    success: function(res) {
                        if (res.rajaongkir.status.code == 400) {
                            alert(res.rajaongkir.status.description)
                        }
                        let listText = ''
                        $('#list-layanan-ongkir').html('')
                        let response = res.rajaongkir.results;

                        let dataCode = response[0].code;

                        response[0].costs.forEach((data, increment) => {
                            listText += `<div class="opsi-pengiriman relative mb-3 ">
                    <input type="radio" name='ongkir' id="paket-${increment+1}"  value="${data.cost[0].value}"  data-service="${data.service}" data-description="${data.description}" class="radio-pengiriman absolute z-[-2] top-8 left-8 lg:left-11">
                    <label for="paket-${increment+1}" class="label-pengiriman border-2  mx-5 h-20 cursor-pointer flex justify-end">
                        <div class=" flex items-center justify-between w-11/12 pr-5">
                            <div class="flex items-center">
                                <p class="text-xl font-bold mr-3 border-r-2 py-3 pr-2">${data.service}</p>
                                <div>
                                    <p class="text-xs">${data.description}</p>
                                    <p class="text-xs">Estimasi : ${data.cost[0].etd} Hari</p>
                                </div>
                            </div>
                            <div>
                                Rp ${ (data.cost[0].value/1000).toFixed(3)}
                            </div>
                        </div>
                    </label>
                 </div>`
                        });

                        $('#list-layanan-ongkir').append(listText)

                        $('.label-pengiriman').each(function() {
                            $(this).click(function() {
                                let opsiPengiriman = $(this).closest(
                                    '.opsi-pengiriman').find(
                                    '.radio-pengiriman');
                                $.ajax({
                                    url: '/checkout/store-session-from-ajax',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        code: dataCode,
                                        service: opsiPengiriman.attr(
                                            'data-service')
                                    },
                                    success: function(res) {
                                        $('#info-pengiriman').html(
                                            `<div class="flex justify-between pb-3 px-3">
                                            <div class=" text-sm">
                                            <p>Pengiriman</p>
                                            <p class="text-sm uppercase"> ${res.code} <span class="normal-case"> -
                                            ${res.service}   (${opsiPengiriman.attr('data-description')})
                                            </span>
                                            </p>
                                            </div>
                                            <span>Rp. <span id="sub-total"> ${ (opsiPengiriman.val()/1000).toFixed(3)} </span></span>
                                        </div> `
                                        )

                                        let sub_total = Number(
                                            opsiPengiriman.val()
                                        )

                                        let total = Number($(
                                                '#total')
                                            .attr('data-total'))

                                        total += sub_total
                                        $('#total').text((total /
                                            1000).toFixed(
                                            3))
                                    },
                                    error: function(err) {
                                        alert(err)
                                    }
                                })

                            })


                        })


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
                            window.location.href = '/checkout/pengiriman';
                            alert('alamat pengiriman anda sekarang : ' + res.data)
                        },
                        error: function(err) {
                            alert(err)
                        }

                    })
                })
            })


            // ok




        })
    </script>
@endsection
