<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('hamburgers-master/dist/hamburgers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('style')
    @vite('resources/css/app.css')
</head>

<body>

    @include('cms.layouts.topbar')

    <div class="flex">
        @include('cms.layouts.sidebar')
        <div class="pl-20 sm:pl-20 md:p-5 w-full bg-gray-50 ">
            @yield('container')
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script>
        $(document).ready(function() {

            $('#hamburger-sidebar').click(function() {
                $(this).toggleClass('is-active')

                if ($(this).hasClass('is-active')) {
                    $('#drawer-navigation').addClass('w-64').removeClass('w-20')
                    $('.sidebar-menu').removeClass('hidden')
                    $('#text-menu').removeClass('hidden')
                } else {
                    $('#drawer-navigation').removeClass('w-64').addClass('w-20')
                    $('.sidebar-menu').addClass('hidden')
                    $('#text-menu').addClass('hidden')
                }

            })

        })
    </script>

    @yield('script')

    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</body>

</html>
