<div id="drawer-navigation" {{-- class=" min-h-screen z-20 p-4 overflow-y-auto absolute sm:absolute md:static  bg-purple-900 w-64 overflow-hidden"> --}} {{-- class="min-h-screen z-20 p-4  overflow-y-auto absolute sm:absolute md:static  bg-purple-900 w-64 overflow-hidden"> --}}
    class="min-h-screen z-20 p-4  overflow-y-auto absolute sm:absolute md:static  bg-purple-900  w-64 overflow-hidden">
    <div class="flex justify-end transition-transform ease-in-out duration-1000 ">
        <span class="text-white w-full flex items-center justify-start pl-2 text-xl " id="text-menu"> Menu </span>
        <button class="hamburger hamburger--spin is-active m-0  bg-white py-1 px-1 rounded-sm " type="button"
            id="hamburger-sidebar" data-sidebar="open">
            <span class="hamburger-box ">
                <span class="hamburger-inner text-sm "> </span>
            </span>
        </button>
    </div>
    <div class="py-1 mt-2 overflow-y-auto overflow-hidden bg-purple-800 rounded-md">
        <ul class="space-y-2">
            <li>
                <a href="/admin/dashboard"
                    class="flex {{ request()->is('admin/dashboard') ? 'bg-white text-black' : 'text-gray-200' }} items-center py-2 px-3 text-base font-normal  rounded-lg  hover:bg-gray-100 hover:text-black ">
                    <div class="mr-3">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <span class="sidebar-menu flex-1  whitespace-nowrap">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/admin/master-item/kategori"
                    class="flex  {{ request()->is('admin/master-item/*') ? 'bg-white text-black' : 'text-gray-200' }}  items-center py-2 px-3 text-base font-normal   rounded-lg   hover:bg-gray-100 hover:text-black ">
                    <div class="mr-3 ">
                        <i class="fa-solid fa-table text-lg"></i>
                    </div>
                    <span class="sidebar-menu flex-1  whitespace-nowrap">Master Item</span>
                </a>
            </li>
            <li>
                <a href="/admin/item"
                    class="flex {{ request()->is('admin/item*') ? 'bg-white text-black' : 'text-gray-200' }}  items-center py-2 px-3 text-base font-normal rounded-lg  hover:bg-gray-100 hover:text-black ">
                    <div class="mr-3">
                        <i class="fa-solid fa-shop"></i>
                    </div>
                    <span class="sidebar-menu flex-1  whitespace-nowrap">Item</span>

                </a>
            </li>
            @if (auth()->guard('webadmin')->user()->hak_akses == 'karyawan')
                <li>
                    <a href="/admin/list-transaction"
                        class="flex {{ request()->is('admin/list-transaction*') ? 'bg-white text-black' : 'text-gray-200' }}  items-center py-2 px-3 text-base font-normal  rounded-lg  hover:bg-gray-100 hover:text-black ">
                        <div class="mr-3">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                        <span class="sidebar-menu flex-1  whitespace-nowrap">Kelola Transaksi</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="/admin/list-customer"
                    class="flex {{ request()->is('admin/list-customer*') ? 'bg-white text-black' : 'text-gray-200' }}  items-center py-2 px-3 text-base font-normal rounded-lg  hover:bg-gray-100 hover:text-black ">
                    <div class="mr-3">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span class="sidebar-menu flex-1  whitespace-nowrap">List Customer </span>
                </a>
            </li>
            @if (auth()->guard('webadmin')->user()->hak_akses == 'owner')
                <li>
                    <a href="/admin/laporan/confirmed"
                        class="flex {{ request()->is('admin/laporan*') ? 'bg-white text-black' : 'text-gray-200' }} items-center py-2 px-3 text-base font-normal rounded-lg  hover:bg-gray-100 hover:text-black ">
                        <div class="mr-3">
                            <i class="fa-solid fa-file-circle-check"></i>
                        </div>
                        <span class="sidebar-menu flex-1  whitespace-nowrap">Laporan</span>
                    </a>
                </li>
            @endif


        </ul>
    </div>
</div>
