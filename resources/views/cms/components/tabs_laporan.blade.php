<section class="mb-3 w-full">
    <ul
        class=" border overflow-hidden flex text-sm font-medium text-center text-gray-500 rounded-lg divide-x divide-gray-200   ">
        <li class="w-1/2 md:w-full ">
            <a href="/admin/laporan/confirmed"
                class="flex items-center justify-center  h-12  w-full text-gray-900 {{ request()->is('admin/laporan/confirmed') ? 'bg-gray-200' : 'bg-white' }} ">
                Laporan Confirmed
            </a>
        </li>
        <li class="w-1/2 md:w-full">
            <a href="/admin/laporan/rejected"
                class="flex items-center justify-center  h-12  w-full text-gray-900 {{ request()->is('admin/laporan/rejected') ? 'bg-gray-200' : 'bg-white' }}">
                Laporan Rejected
            </a>
        </li>
        {{-- <li class="w-1/3 md:w-full ">
            <a href="/admin/laporan/failed"
                class="flex items-center justify-center  h-12  w-full text-gray-900 {{ request()->is('admin/laporan/failed') ? 'bg-gray-200' : 'bg-white' }}">
                Laporan Failed
            </a>
        </li> --}}
    </ul>
</section>
