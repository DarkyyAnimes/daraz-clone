<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product | Daraz Nepal's Fisrt Online Shopping app</title>
    <script src="https://cdn.tailwindcss.com"></script>
   
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .active{
    background-color: rgb(248, 248, 248) !important;
}
    </style>
</head>

<body>
     <div class="flex">
        <nav class="w-1/5 bg-orange-600 text-white min-h-screen">
            @include('Partials.Seller.header')
        </nav>
        <div class="main w-4/5 p-10">
           @yield('content')
        </div>
    </div>
   
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownBtn = document.querySelector('.dropdown-btn');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            dropdownBtn.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });

        // Initialize DataTable after the document is loaded           
        });
    </script>
</body>

</html>