<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        /* Include Tailwind CSS styles */
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
    </style>
</head>
<body class="font-sans text-gray-900 leading-normal bg-gray-100">

<div class="max-w-2xl mx-auto py-8 bg-white shadow-lg rounded-lg overflow-hidden">
    <h2 class="text-2xl font-semibold mb-4 text-orangered-600">Email Verification</h2>
    <p class="mb-4">Hi <span class="font-semibold">{{ $user->name }},</span></p>
    <p class="mb-4">
        Thank you for registering on our website. Please click the link below to verify your email address:
    </p>
    <p class="mb-4">
        <a href="{{ $verificationUrl }}" class="text-orangered-500 hover:text-orangered-600">Verify Email</a>
    </p>
    <p class="mb-4">
        If you didn't register on our website, you can ignore this email.
    </p>
    <p class="mb-4">Regards,</p>
    <p class="mb-4">Daraz team</p>
</div>

</body>
</html>
