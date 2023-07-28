<nav class="flex justify-between shadow-md border">
    <div class="">
        {{-- logo --}}
        <div class=" inline-block p-3">
            <a href="" class="font-bold">
                Outlaws Studio Dashboard
            </a>

        </div>
    </div>

    <button id="dropdownDefault" data-dropdown-toggle="dropdown"
        class="text-black  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center "
        type="button"> <span class="mr-1 text-gray-400">{{ Auth::guard('webadmin')->user()->hak_akses }}</span>
        <span>{{ Auth::guard('webadmin')->user()->nama }}</span>
        <i class="ml-2 fa-solid fa-caret-down"></i>
    </button>
    <!-- Dropdown menu -->
    <div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700"
        data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 129px, 0px);">
        <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownDefault">
            <li>
                <a href="/admin/auth" class="block py-2 px-4 hover:bg-gray-100  ">Setting
                    Account</a>
            </li>
            <li>
                <form method="POST" action="/admin/auth/dashboard/logout">
                    @csrf
                    <button type="submit" class="py-2 px-4 hover:bg-gray-100 inline-block w-full text-left  ">
                        Sign out
                    </button>
                </form>
                {{-- <a href="/admin/auth/dashboard/login"
                    class="block py-2 px-4 hover:bg-gray-100  ">Sign
                    out</a> --}}
            </li>
        </ul>
    </div>

</nav>
