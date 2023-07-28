@if (auth()->guard('webadmin')->user()->hak_akses == 'karyawan')
    <ul
        class="flex flex-wrap md:flex-nowrap text-sm font-medium text-center text-gray-500 rounded-lg divide-x divide-gray-200 shadow  ">
        <li class="w-full">
            <a href="/admin/item/{{ $link }}/show"
                class="inline-block p-4 w-full text-gray-900 {{ request()->is('admin/item/*/show') ? 'bg-purple-100' : 'bg-white hover:bg-gray-50' }} rounded-l-lg  focus:outline-none"
                aria-current="page">
                <i class="fa-solid fa-circle-info"> </i> Detail</a>
        </li>
        <li class="w-full">
            <a href="/admin/item/{{ $link }}/tambah-stok"
                class="inline-block p-4 w-full text-gray-900 {{ request()->is('admin/item/*/tambah-stok') ? 'bg-purple-100' : 'bg-white hover:bg-gray-50' }}  focus:outline-none  ">
                <i class="fa-solid fa-plus"></i> Tambah Stok Item
            </a>
        </li>
        <li class="w-full">
            <a href="/admin/item/{{ $link }}/edit"
                class="inline-block p-4 w-full {{ request()->is('admin/item/*/edit') ? 'bg-purple-100' : 'bg-white hover:bg-gray-50' }}  focus:outline-none  ">
                <i class="fa-solid fa-pen-to-square"></i> Edit Item
            </a>
        </li>
        <li class="w-full">

            <form action="/admin/item/{{ $link }}" method="post">
                @method('DELETE')
                @csrf
                <button onclick="return confirm('apakah anda yakin ingin menghapus item ini?')"
                    class="inline-block p-4 w-full bg-white rounded-r-lg hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                    <i class="fa-solid fa-trash-can"></i>
                    Delete Item
                </button>
            </form>
        </li>

    </ul>
@endif
