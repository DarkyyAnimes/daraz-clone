@extends('Layouts.productLayout')

@section('content')
    <div class="flex justify-center min-h-screen items-center">
        <div class="">
            @if(session('message'))
                <div class="alert bg-green-200 py-2 px-10 rounded mt-2 alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <form action="{{ route('resend.verify.email') }}" method="post" class="bg-white p-5 text-center rounded">
                @csrf
                <h2 class="text-2xl mb-2 font-bold">Mail Sent!</h2>
                <p>Verify Mail Link is ready to be sent to <a href="#" class="text-orange-600 underline">{{ $user->email }}</a></p>
                <input type="hidden" value="{{ $user->email }}" name="email">

                <div id="timer" class="text-orange-600 font-bold mt-3"></div>

                <button class="bg-orange-600 text-white py-2 px-5 rounded mt-3" id="resendBtn" disabled>Resend Mail</button>
            </form>
        </div>
    </div>

    <script>
        // Timer logic
        var countdown = 90; // Countdown time in seconds
        var timerDisplay = document.getElementById('timer');
        var resendBtn = document.getElementById('resendBtn');

        function updateTimer() {
            timerDisplay.innerHTML = "Resend in " + countdown + " seconds";
            countdown--;

            if (countdown < 0) {
                clearInterval(timerInterval);
                timerDisplay.innerHTML = "You can resend now";
                resendBtn.disabled = false;
            }
        }

        var timerInterval = setInterval(updateTimer, 1000);
    </script>
@endsection
