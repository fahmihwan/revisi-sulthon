@auth
    @if (!auth()->user()->hasVerifiedEmail())
        @if (session('send-link-email'))
            <div class="bg-green-200 text-green-800 p-2 block ">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('send-link-email') }}
            </div>
        @else
            <span class=" bg-red-600 p-2 block text-white">
                <i class="fa-solid fa-circle-xmark"></i> This account is not confirmed. <form
                    action="/email/verification-notification" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-300 hover:text-blue-600 underline"> Click Here</button>
                </form> to resend confirmation email.
            </span>
        @endif
    @endif
@endauth
