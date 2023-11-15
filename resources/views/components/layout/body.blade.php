<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-behavior: smooth; scroll-padding: var(--scroll-padding, 10rem);">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('storage/system/logo.png') }}" type="image/x-icon">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.css"  rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">
    {{ $links ?? '' }}
</head>
<body class="bg-[#F1F5F9]">
    {{ $slot }}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    {{ $scripts ?? '' }} 
</body>
</html>