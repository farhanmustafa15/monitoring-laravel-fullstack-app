@extends('components.header')

@section('header')
@endsection

<body class="w-full h-full bg-[#F8FAFB] dark:bg-gray-800 mx-auto ">
    @include('components.navbar')
    <div class="grid sm:grid-cols-xl-mentoring-layout xl:grid-cols-mentoring-layout justify-center pt-16">
        @include('components.sidebar')
        @yield('layout')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</body>

</html>
