@extends('Layouts.productLayout')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger bg-red-200 py-2 px-15">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('message'))
    <div class="alert bg-green-200 py-2 px-15 alert-success">
        {{ session('message') }}
    </div>
@endif
<form action="{{route('user.register')}}" method="POST" enctype="multipart/form-data">
  @csrf

<div class="flex h-screen  items-center my-32 justify-center ">
    <div class="grid bg-white rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
      <div class="flex justify-center py-4">
        <div class="flex bg-orange-600 rounded-full md:p-4 p-2 border-2 border-orange-300">
            <img width="120"
            src="https://icms-image.slatic.net/images/ims-web/e6ac6883-1158-4663-bda4-df5a1aa066e5.png"
            alt="">
        </div>
      </div>
  
      <div class="flex justify-center">
        <div class="flex">
          <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Register</h1>
        </div>
      </div>
  
      <div class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Full Name</label>
        <input name="name" class="py-2 px-3 rounded-lg border-2 border-orange-300 mt-1 focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent" type="text" placeholder="John Doe*" />
      </div>
  
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
        <div class="grid grid-cols-1">
          <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Email</label>
          <input name="email" class="py-2 px-3 rounded-lg border-2 border-orange-300 mt-1 focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent" type="text" placeholder="example@helloworld.com" />
        </div>
        <div class="grid grid-cols-1">
          <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Phone no.</label>
          <input name="phone_no" class="py-2 px-3 rounded-lg border-2 border-orange-300 mt-1 focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent" type="text" placeholder="+977 01 723434" />
        </div>
      </div>
  
      <div class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Gender</label>
        <select name="gender" class="py-2 px-3 rounded-lg border-2 border-orange-300 mt-1 focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent">
          <option value="m">Male</option>
          <option value="f">Female</option>
          <option value="o">Other</option>
        </select>
      </div>

  
      <div class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Address</label>
        <input name="address" class="py-2 px-3 rounded-lg border-2 border-orange-300 mt-1 focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent" type="text" placeholder="Kathmandu, Nepal" />
      </div>

      <div class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Password</label>
        <input name="password" type="password" class="py-2 px-3 rounded-lg border-2 border-orange-300 mt-1 focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent" type="text" placeholder="*********" />
      </div>

      <div class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Confirm Password</label>
        <input type="password" name="password_confirmation" class="py-2 px-3 rounded-lg border-2 border-orange-300 mt-1 focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent" type="text" placeholder="*********" />
      </div>
  
      <div class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Upload Profile Photo</label>
          <div class='flex items-center justify-center w-full'>
              <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-orange-300 group'>
                  <div class='flex flex-col items-center justify-center pt-7'>
                    <svg class="w-10 h-10 text-orange-400 group-hover:text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <p class='lowercase text-sm text-gray-400 group-hover:text-orange-600 pt-1 tracking-wider'>Select a photo</p>
                  </div>
                <input type="file" name="image_path" class="hidden" />
              </label>
          </div>
      </div>
     
      <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5'>
        <button type="reset" class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancel</button>
        <button type="submit" class='w-auto bg-orange-500 hover:bg-orange-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Register</button>
      </div>
      <p class="text-center mb-5">Register as a <a class="text-orange-600" href="{{route('view.seller.register')}}">Seller</a></p>
    </div>
  </div>
</form>
@endsection
