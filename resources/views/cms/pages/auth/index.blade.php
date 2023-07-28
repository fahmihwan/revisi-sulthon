<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('hamburgers-master/dist/hamburgers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
</head>

<body class="bg-purple-700">

    <div class="flex justify-center items-center h-screen  ">

        <div class="shadow-md w-96 bg-purple-900 rounded-lg">
            <div class="m-4 bg-purple-900 p-5 rounded-lg">
                <div class="pb-10 ">
                    <h1 class="text-white font-bold text-center text-2xl ">Login </h1>
                    <p class="text-center text-white text-sm">Dashboard Outlaws Studio</p>
                </div>
                @if ($errors->any())
                    <div class="flex p-2 mb-4 text-sm text-red-700 bg-red-100 rounded-lg " role="alert">
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
                <form action="/admin/auth/dashboard/authenticate" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="username" class="block mb-2 text-sm font-medium text-white">Your
                            username</label>
                        <input type="username" id="username" name="username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="username" required>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-white">Your
                            password</label>
                        <input type="password" id="password" placeholder="password" name="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                    </div>
                    <div class="flex items-start mb-6">
                        <div class="flex items-center h-5">
                            <input id="remember" type="checkbox" value=""
                                class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300">
                        </div>
                        <label for="remember" class="ml-2 text-sm font-medium text-white">Remember
                            me</label>
                    </div>
                    <button type="submit"
                        class="text-white bg-purple-500  hover:bg-purple-600 w-full py-3 rounded-full">Submit</button>
                </form>
            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</body>

</html>
