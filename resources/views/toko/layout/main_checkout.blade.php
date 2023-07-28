<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('head')
    @vite('resources/css/app.css')
    @yield('styles')

</head>


<body>
    <nav class="p-5 flex  border">
        <div class="w-1/3 ">
            <a href="/checkout/cart" class="font-semibold"> <i class="fas fa-chevron-left"></i> <span
                    class="hidden md:inline">Kembali
                    Berbelanja</span></a>
        </div>
        <div class="w-1/3 text-center font-extrabold text-sm md:text-md">
            <h5>OUTLAWS STUDIO</h5>
        </div>
        <div class="w-1/3 ">
        </div>
    </nav>


    <nav class="p-4 md:flex hidden  border bg-gray-100">
        <div class="w-1/3">
            <span>Butuh Bantuan?</span>
        </div>
        <div class="w-1/3 text-center">
            <a href=""><i class="fab fa-whatsapp"></i> 082332112343</a>
        </div>
        <div class="w-1/3">

        </div>
    </nav>

    <!-- body -->
    <div class="w-screen  flex flex-wrap pt-10 px-6">
        <!-- pengirman dan pembayaran -->
        @yield('container-checkout')




    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    @yield('script')
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</body>

</html>
