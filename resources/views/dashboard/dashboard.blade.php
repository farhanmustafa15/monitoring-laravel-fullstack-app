@extends('layout')

@section('layout')
    <div class="flex flex-col">

        {{-- choose dbs --}}
        <div class="p-4 md:p-6 flex justify-end">

            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">Pilih Database<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdown"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="{{ url('/admin/dashboard/rumah-jamur') }}"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Rumah Jamur</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/dashboard/tugas-akhir') }}"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tugas
                            Akhir</a>
                    </li>
                </ul>
            </div>


        </div>

        {{-- graph --}}
        <div class="flex flex-col">
            <canvas id="lineChart" width="400" height="200"></canvas>
        </div>

        <div class="flex justify-between gap-20 p-4 md:p-6 mt-11">
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
                                <h5 class="text-black dark:text-white-color text-xl font-bold">
                                    @isset($tugasAkhirData)
                                        @foreach ($tugasAkhirData as $key => $value)
                                            @if ($key === 'avgt')
                                                {{ $value }}&#8451;
                                            @endif
                                        @endforeach
                                    @endisset

                                    @isset($rumahJamurData)
                                        @foreach ($rumahJamurData as $key => $value)
                                            @if ($key === 'avgt')
                                                {{ $value }}&#8451;
                                            @endif
                                        @endforeach
                                    @endisset
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
                                <h5 class="text-black dark:text-white-color text-xl font-bold">
                                    @isset($tugasAkhirData)
                                        @foreach ($tugasAkhirData as $key => $value)
                                            @if ($key === 'avgh')
                                                {{ $value }}&#8451;
                                            @endif
                                        @endforeach
                                    @endisset

                                    @isset($rumahJamurData)
                                        @foreach ($rumahJamurData as $key => $value)
                                            @if ($key === 'avgh')
                                                {{ $value }}&#8451;
                                            @endif
                                        @endforeach
                                    @endisset
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            {{-- col 2 --}}
            {{-- history --}}
            <div class="flex flex-col w-full gap-y-5">
                <h1 class="text-2xl font-bold text-black dark:text-white-color">Latest</h1>
                {{-- table --}}


                <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">



                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border dark:border-gray-600">
                            <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        <p class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white-color">
                                            Suhu
                                        </p>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <p class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white-color">
                                            Kelembapan
                                        </p>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <p class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white-color">
                                            Hasil
                                        </p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @isset($tugasAkhirData)
                                    <td class="px-6 py-4 bg-white dark:bg-gray-800">
                                        @foreach ($tugasAkhirData as $key => $value)
                                        @if ($key === 'avgt')
                                        <p class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white-color">
                                            {{ $value }}&#8451;
                                        </p>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 bg-white dark:bg-gray-800">
                                        @foreach ($tugasAkhirData as $key => $value)
                                        @if ($key === 'avgh')
                                        <p class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white-color">
                                            {{ $value }}&#8451;
                                        </p>
                                        @endif
                                        @endforeach
                                    </td>
                                    @endisset
                    
                                    @isset($rumahJamurData)
                                    <td class="px-6 py-4 bg-white dark:bg-gray-800">
                                        @foreach ($rumahJamurData as $key => $value)
                                        @if ($key === 'avgt')
                                        <p class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white-color">
                                            {{ $value }}&#8451;
                                        </p>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 bg-white dark:bg-gray-800">
                                        @foreach ($rumahJamurData as $key => $value)
                                        @if ($key === 'avgh')
                                        <p class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white-color">
                                            {{ $value }}&#8451;
                                        </p>
                                        @endif
                                        @endforeach
                                    </td>
                                    @endisset
                    
                                    <td class="px-6 py-4">
                                        <div class="bg-blue-600 rounded-full">
                                            <p class="text-center font-medium text-white-color whitespace-nowrap dark:text-white-color">
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
