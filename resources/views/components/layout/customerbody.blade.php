<x-layout.body> 
    <x-slot:links>
        <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet"> 
        <link href="{{ asset('css/responsive.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/table.css') }}" rel="stylesheet">
    </x-slot:links>

    <x-customer.topbar /> 
    <x-customer.sidebar /> 

    {{ $slot }}

    <x-slot:scripts>
        <script src="{{ asset('js/alert.js') }}"></script>
        <script src="{{ asset('js/sweetalert.min.js') }}"></script> 
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script> 
        {{ $scripts ?? '' }}
    </x-slot:scripts>
</x-layout.body>