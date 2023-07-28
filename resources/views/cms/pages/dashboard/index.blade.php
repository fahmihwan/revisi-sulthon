@extends('cms.layouts.main')


@section('container')
    <div class="w-full  ">
        <nav class="flex justify-between mb-4 p-2 bg-white shadow-md text-black rounded-md" aria-label="Breadcrumb ">
            <div class="font-bold text-2xl text-gray-700">
                Dashboard
            </div>
            <div>
                <ol class="inline-flex items-center space-x-1 md:space-x-3  ">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium  hover:text-gray-900">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right text-gray-400"></i>
                            <a href="#" class="ml-1 text-sm font-medium hover:text-gray-900 md:ml-2 ">Projects</a>
                        </div>
                    </li>
                </ol>
            </div>
        </nav>

        <div class="w-full flex">
            <div class="w-3/5">
                <div class="mb-5 flex">
                    <div class="bg-purple-800 w-1/3 mr-2 rounded shadow-md p-3">
                        <div class="text-white">
                            <p>Transaksi Bulan ini</p>
                            <span class="font-bold">{{ $transaksi_bulanan }}</span>
                        </div>
                    </div>
                    <div class="bg-purple-800 w-1/3 mr-2 rounded shadow-md p-3">
                        <div class="text-white">
                            <p>Produk Terjual Bulan ini</p>
                            <span class="font-bold">{{ $produk_terjual }}</span>
                        </div>
                    </div>
                    <div class="bg-purple-800 w-1/3 mr-2 rounded shadow-md p-3">
                        <div class="text-white">
                            <p>Jumlah Pengguna</p>
                            <span class="font-bold">{{ $jumlah_pengguna }}</span>
                        </div>
                    </div>

                </div>

                <div class="w-full shadow-md bg-white rounded-md p-3 ">

                    Dashboard <br>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="w-2/5">
                <div class="bg-white shadow-md rounded-md mx-3">
                    <div class="p-5">
                        <h1 class="font-bold mb-5 ">Transaksi minggu ini</h1>
                        <div class=" h-96 overflow-scroll rounded-lg  px-5 bg-gray-50">
                            <table class="w-full text-sm  ">
                                <tr class="border-b">
                                    <th class="text-start ">Tgl</th>
                                    <th class="text-start ">Email</th>
                                    <th class="text-start ">Status</th>
                                </tr>
                                @foreach ($transasksi_minggu as $transaksi)
                                    <tr>
                                        <td class="pb-2">{{ date('d', strtotime($transaksi->date)) }}</td>
                                        <td><a href="/admin/list-transaction/{{ $transaksi->id }}/detail"
                                                class="text-blue-600 underline">{{ $transaksi->email }}</a>
                                        </td>
                                        <td class="{{ $transaksi->pesan }}">{{ $transaksi->transaction_status }}</td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>



        </div>

    </div>
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        let chart = {{ Js::from($chart) }};
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chart.chart_month,
                datasets: [{
                    label: 'payment success',
                    data: chart.chart_count.count_success,
                    borderWidth: 2,
                    borderColor: '#4bde97',
                }, {
                    label: 'payment fail',
                    data: chart.chart_count.count_fail,
                    borderWidth: 2,
                    borderColor: '#da291c',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
