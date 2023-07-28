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
    <div class="flex justify-between p-3">
        <span class="font-light text-sm">Sub Total</span>
        <span>Rp. {{ number_format($total_harga, 0, '', '.') }}</span>
    </div>
    <div class="flex justify-between pb-3 px-3">
        <div class="font-light text-sm">
            <p>Pengiriman</p>
            <p class="text-sm"><span id="kurir">JNE - regular</span></p>
        </div>

        <span>Rp. <span id="sub-total">12.000</span></span>
    </div>
    <div class="border-t flex justify-between p-3 ">
        <span class="font-light text-sm">Total</span>
        <span class="font-extrabold">Rp. <span id="total"
                data-total="{{ $total_harga }}">{{ number_format($total_harga, 0, '', '.') }}</span></span>
    </div>
</div>
