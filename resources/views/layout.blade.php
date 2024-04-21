@extends('components.header')

@section('header')
@endsection

<body>
    {{-- Hide this block on extra-large screens --}}
    <div class="hidden xl:block w-full h-full bg-[#F8FAFB] dark:bg-gray-800 mx-auto">
        @include('components.navbar')
        <div class="flex w-full bg-[#F8FAFB] dark:bg-gray-800">
            @include('components.sidebar')
            @yield('layout')
        </div>
    </div>
    @include('components.miscellaneous.not-ready-responsive')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>
