@extends('Layouts.productLayout')
@section('content')
    <div class="flex justify-center min-h-screen items-center">
        <div class="">
            @if(session('message'))
                <div class="alert bg-green-200 py-2 px-10 rounded mt-2 alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <form action="{{route('verify.email')}}" method="post" class="bg-white p-5 text-center rounded">
                @csrf
            <h2 class="text-2xl mb-2 font-bold">Please Verify Your Mail !</h2>
            <p>Verify Mail Link is ready to Sent on <a href="" class="text-orange-600 underline">{{$user->email}}</a></p>
             <input type="hidden" value="{{$user->email}}" name="email">    
            <button class="bg-orange-600 text-white py-2 px-5 rounded mt-3">Send Mail</button>
            </form>
        </div>
    </div>
@endsection