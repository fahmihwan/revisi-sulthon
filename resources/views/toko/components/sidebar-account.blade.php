<div class="w-full  md:w-80 border  border-gray-300 h-1/2 ml-5 my-2 py-4 ">
    <ul>
        <li>
            <a href="/customer/account"
                class="border-l-[5px] block px-4 py-3 {{ request()->is('customer/account') ? 'border-black bg-gray-200' : 'border-white hover:border-black hover:bg-gray-200 ' }} ">
                Akun
                Saya</a>
        </li>
        <li>
            <a href="/customer/order-history"
                class="border-l-[5px] block px-4 py-3 {{ request()->is('customer/order-history*') ? 'border-black bg-gray-200' : 'border-white hover:border-black hover:bg-gray-200 ' }} ">
                Pesanan
            </a>
        </li>
        <li>
            <a href="/customer/wish-list"
                class="border-l-[5px] block px-4 py-3 {{ request()->is('customer/wish-list') ? 'border-black bg-gray-200' : 'border-white hover:border-black hover:bg-gray-200 ' }} ">
                Wish List
            </a>
        </li>
        <hr class="mx-3 border-gray-300">
        <li>
            <a href="/customer/address"
                class="border-l-[5px] block px-4 py-3 {{ request()->is('customer/address*') ? 'border-black bg-gray-200' : 'border-white hover:border-black hover:bg-gray-200 ' }} ">
                Alamat</a>
        </li>
        <li>
            <a href="/customer/account/edit"
                class="border-l-[5px] block px-4 py-3 {{ request()->is('customer/account/edit') ? 'border-black bg-gray-200' : 'border-white hover:border-black hover:bg-gray-200 ' }} ">
                Informasi Akun
            </a>
        </li>
    </ul>
</div>
