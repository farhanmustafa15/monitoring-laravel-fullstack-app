@extends('components.header')

@section('header')
@endsection

<body class="w-[1440px] h-full grid grid-cols-mentoring-layout bg-[#F8FAFB] mx-auto ">

    @include('components.sidebar')
    @yield('layout')
    <script src="{{ asset('js/graph.js') }}"></script>
</body>

</html>
