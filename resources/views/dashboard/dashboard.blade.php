@extends('layout')

@section('layout')
    <div class="flex flex-col gap-y-11">
        {{-- graph --}}

        <div class=" p-4 md:p-6">
            <div class="w-full h-fit rounded-lg">
                <div class="flex justify-between">
                    <div>
                        <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white-color pb-2">32.4k</h5>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Users this week</p>
                    </div>
                    <div
                        class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                        12%
                        <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13V1m0 0L1 5m4-4 4 4" />
                        </svg>
                    </div>
                </div>
                <div id="area-chart" class="bg-white dark:bg-gray-800"></div>
                <div
                    class="bg-white dark:bg-gray-800 grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                    <div class="flex justify-between items-center pt-5">
                        <!-- Button -->
                        <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                            data-dropdown-placement="bottom"
                            class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-whbg-white-color"
                            type="button">
                            Last 7 days
                            <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="lastDaysdropdown"
                            class="z-10 hidden bg-white-color divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownDefaultButton">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-whbg-white-color">Yesterday</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-whbg-white-color">Today</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-whbg-white-color">Last
                                        7 days</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-whbg-white-color">Last
                                        30 days</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-whbg-white-color">Last
                                        90 days</a>
                                </li>
                            </ul>
                        </div>
                        <a href="#"
                            class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                            Users Report
                            <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-between gap-20 p-4 md:p-6">
            {{-- col 1 --}}
            <div class="w-[350px] flex flex-col gap-y-10">

                <div class="flex flex-col w-full gap-y-5">
                    <h5 class="text-2xl font-bold text-black dark:text-white-color">Suhu</h5>
                    <div
                        class="w-full h-fit bg-white-color dark:bg-gray-800 py-9 px-5 rounded-2xl border dark:border-gray-600">
                        <div class="flex gap-3 justify-center items-center">
                            <img src="{{ asset('assets/dashboard/temperatur-up.svg') }}" alt="">
                            <div class="flex flex-col justify-center w-full">
                                <p class="text-[##93A3AB] font-medium text-black dark:text-white-color">suhu</p>
                                <h5 class=" text-black dark:text-white-color text-xl font-bold">@foreach ($tugasAkhirData as $key => $value)
                                    @if ($key === 'avgt')
                                       {{ $value }}&#8451;
                                    @endif
                                @endforeach
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col w-full gap-y-5">
                    <h5 class="text-2xl font-bold text-black dark:text-white-color">Kelembapan</h5>
                    <div
                        class="w-full h-fit bg-white-color dark:bg-gray-800 py-9 px-5 rounded-2xl border dark:border-gray-600">
                        <div class="flex gap-3 justify-center items-center">
                            <img src="{{ asset('assets/dashboard/temperatur-up.svg') }}" alt="">
                            <div class="flex flex-col justify-center w-full">
                                <p class="text-[##93A3AB] font-medium text-black dark:text-white-color">Kelembapan</p>
                                <h5 class="text-xl font-bold text-black dark:text-white-color">
                                    @foreach ($tugasAkhirData as $key => $value)
                                        @if ($key === 'avgh')
                                           {{ $value }}&#x25;
                                        @endif
                                    @endforeach
                                </h5>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            {{-- col 2 --}}
            {{-- history --}}
            <div class="flex flex-col w-full gap-y-5">
                <h1 class="text-2xl font-bold text-black dark:text-white-color">Recent</h1>
                {{-- table --}}


                <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">



                    <div class="relative overflow-x-auto ">
                        <table
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border dark:border-gray-600">
                            <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Product name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Color
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Apple MacBook Pro 17"
                                    </th>
                                    <td class="px-6 py-4">
                                        Silver
                                    </td>
                                    <td class="px-6 py-4">
                                        Laptop
                                    </td>
                                    <td class="px-6 py-4">
                                        $2999
                                    </td>
                                </tr>
                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Microsoft Surface Pro
                                    </th>
                                    <td class="px-6 py-4">
                                        White
                                    </td>
                                    <td class="px-6 py-4">
                                        Laptop PC
                                    </td>
                                    <td class="px-6 py-4">
                                        $1999
                                    </td>
                                </tr>
                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Magic Mouse 2
                                    </th>
                                    <td class="px-6 py-4">
                                        Black
                                    </td>
                                    <td class="px-6 py-4">
                                        Accessories
                                    </td>
                                    <td class="px-6 py-4">
                                        $99
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
