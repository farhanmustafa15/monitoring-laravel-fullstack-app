@extends('layout')

@section('layout')
    <div class="h-full w-full flex flex-col pt-8 justify-between">

        {{-- choose dbs --}}
        <div class="flex justify-end px-6 mb-5">

            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm rounded-lg w-56 py-2.5 justify-center text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">Pilih Database<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdown"
                class="z-10 hidden w-56 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="{{ url('/admin/dashboard/rumah-jamur') }}"
                            class="block text-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Rumah Jamur</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/dashboard/tugas-akhir') }}"
                            class="block px-4 py-2 text-center hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tugas
                            Akhir</a>
                    </li>
                </ul>
            </div>


        </div>

        {{-- temperature | humidity --}}
        <div class="flex justify-between gap-x-4 px-6 mb-10">
            {{-- temperature --}}
            <div class="flex flex-col w-full gap-y-2 border-blue-600 ">
                <h5 class="text-xl font-bold text-black dark:text-white-color">Suhu</h5>
                <div
                    class="w-full h-fit bg-white-color dark:bg-gray-800 py-4 px-4 rounded-2xl border dark:border-gray-600 shadow-sm shadow-blue-600 dark:shadow-white">
                    <div class="flex gap-4 justify-center items-center">
                        <div class="dark:bg-gray-700 bg-gray-200 p-3 rounded-full">
                            <img src="{{ asset('assets/dashboard/temperature.svg') }}" class="" alt="">
                        </div>
                        <div class="flex flex-col justify-center w-full">
                            <p class="text-[##93A3AB] font-medium text-black dark:text-white-color">suhu</p>
                            <h5 class="text-black dark:text-white-color text-xl font-bold">
                                @isset($tugasAkhirData)
                                    @foreach ($tugasAkhirData as $key => $value)
                                        @if ($key === 'avgt')
                                            {{ $value }}&percnt;
                                        @endif
                                    @endforeach
                                @endisset

                                @isset($rumahJamurData)
                                    @foreach ($rumahJamurData as $key => $value)
                                        @if ($key === 'avgt')
                                            {{ $value }}&percnt;
                                        @endif
                                    @endforeach
                                @endisset
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

            {{-- humidity --}}
            <div class="flex flex-col w-full gap-y-2">
                <h5 class="text-xl font-bold text-black dark:text-white-color">Kelembapan</h5>
                <div
                    class="w-full h-fit bg-white-color dark:bg-gray-800 py-4 px-4 rounded-2xl border dark:border-gray-600 shadow-sm shadow-blue-600 dark:shadow-white">
                    <div class="flex gap-3 justify-center items-center">
                        <div class="dark:bg-gray-700 bg-gray-200 p-3 rounded-full">
                            <img src="{{ asset('assets/dashboard/humidity.svg') }}" alt="">
                        </div>
                        <div class="flex flex-col justify-center w-full">
                            <p class="text-[##93A3AB] font-medium text-black dark:text-white-color">Kelembapan</p>
                            <h5 class="text-black dark:text-white-color text-xl font-bold">
                                @isset($tugasAkhirData)
                                    @foreach ($tugasAkhirData as $key => $value)
                                        @if ($key === 'avgh')
                                            {{ $value }}&percnt;
                                        @endif
                                    @endforeach
                                @endisset

                                @isset($rumahJamurData)
                                    @foreach ($rumahJamurData as $key => $value)
                                        @if ($key === 'avgh')
                                            {{ $value }}&percnt;
                                        @endif
                                    @endforeach
                                @endisset
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- graph & avgh | avgt --}}
        <div class="w-full h-80 flex justify-between gap-x-4 px-6">
            {{-- graph --}}
            <canvas id="lineChartAvgt" width="330" height="200"></canvas>
            <canvas id="lineChartAvgh" width="330" height="200"></canvas>

        </div>

        <div class="flex justify-between gap-20 p-4 md:p-6 mt-0">
            {{-- history --}}
            <div class="flex flex-col w-full gap-y-5">
                <h1 class="text-2xl font-bold text-black dark:text-white-color">Latest</h1>
                {{-- table --}}
                <div class="relative overflow-x-auto sm:rounded-lg w-full shadow-sm shadow-blue-600 dark:shadow-white">
                    <div class="relative overflow-x-auto">
                        <table
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border dark:border-gray-600">
                            <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                                <tr class="grid grid-cols-3">
                                    <th scope="col"
                                        class="px-6 py-3 border-r border-b dark:border-gray-700 border-gray-200">
                                        <p
                                            class="text-center font-medium text-base text-gray-900 whitespace-nowrap dark:text-white-color">
                                            Suhu
                                        </p>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 border-r border-b dark:border-gray-700 border-gray-200">
                                        <p
                                            class="text-center font-medium text-base text-gray-900 whitespace-nowrap dark:text-white-color">
                                            Kelembapan
                                        </p>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 border-r border-b dark:border-gray-700 border-gray-200">
                                        <p
                                            class="text-center font-medium text-base text-gray-900 whitespace-nowrap dark:text-white-color">
                                            Hasil
                                        </p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="grid grid-cols-3">
                                    @isset($tugasAkhirData)
                                        <td
                                            class="px-6 py-3 bg-white dark:bg-gray-800 border-r border-b dark:border-gray-700 border-gray-200 flex items-center justify-center">
                                            @foreach ($tugasAkhirData as $key => $value)
                                                @if ($key === 'avgt')
                                                    <p
                                                        class="text-center font-medium text-base text-gray-900 whitespace-nowrap dark:text-white-color">
                                                        {{ $value }}&percnt;
                                                    </p>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td
                                            class="px-6 py-3 bg-white dark:bg-gray-800 border-r border-b dark:border-gray-700 border-gray-200 flex items-center justify-center">
                                            @foreach ($tugasAkhirData as $key => $value)
                                                @if ($key === 'avgh')
                                                    <p
                                                        class="text-center font-medium text-base text-gray-900 whitespace-nowrap dark:text-white-color">
                                                        {{ $value }}&percnt;
                                                    </p>
                                                @endif
                                            @endforeach
                                        </td>
                                    @endisset

                                    @isset($rumahJamurData)
                                        <td
                                            class="px-6 py-3 bg-white dark:bg-gray-800 border-r border-b dark:border-gray-700 border-gray-200 flex items-center justify-center">
                                            @foreach ($rumahJamurData as $key => $value)
                                                @if ($key === 'avgt')
                                                    <p
                                                        class="text-center font-medium text-base text-gray-900 whitespace-nowrap dark:text-white-color">
                                                        {{ $value }}&percnt;
                                                    </p>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td
                                            class="px-6 py-3 bg-white dark:bg-gray-800 border-r border-b dark:border-gray-700 border-gray-200 flex items-center justify-center">
                                            @foreach ($rumahJamurData as $key => $value)
                                                @if ($key === 'avgh')
                                                    <p
                                                        class="text-center font-mediu text-base text-gray-900 whitespace-nowrap dark:text-white-color">
                                                        {{ $value }}&percnt;
                                                    </p>
                                                @endif
                                            @endforeach
                                        </td>
                                    @endisset

                                    <td
                                        class="px-6 py-3 flex justify-center border-r border-b dark:border-gray-700 border-gray-200">
                                        <div class="bg-blue-600 rounded-full w-min px-6 py-2">
                                            <p
                                                class="text-center font-medium text-base text-white-color whitespace-nowrap dark:text-white-color">
                                                Rendah
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
