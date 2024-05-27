@extends('layout')

@section('layout')
    {{-- History --}}
    <div class="pt-8 w-full h-full">

        {{-- Choose database --}}
        <div class="flex justify-end mb-5">
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
                        <a href="{{ url('/admin/history/rumah-jamur') }}"
                            class="block text-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Rumah Jamur</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/history/tugas-akhir') }}"
                            class="block px-4 py-2 text-center hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tugas
                            Akhir</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex px-6 flex-col md:flex-row gap-10">
            {{-- temperature --}}
            <div class="w-full h-[450px] flex flex-col gap-y-4">
                <h1 class="text-2xl font-bold text-black dark:text-white-color">Suhu</h1>

                <div class="relative overflow-x-auto sm:rounded-lg w-full shadow-sm shadow-blue-600 dark:shadow-white">
                    <div class="relative overflow-x-auto">
                        <table
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border dark:border-gray-600">
                            <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                                <tr class="grid grid-cols-2">
                                    <th scope="col"
                                        class="px-6 py-3 border-r border-b dark:border-gray-700 border-gray-200 bg-gray-100 dark:bg-gray-600">
                                        <p
                                            class="text-center font-medium text-base text-gray-900 whitespace-nowrap dark:text-white-color">
                                            ID</p>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 border-r border-b dark:border-gray-700 border-gray-200 bg-gray-100 dark:bg-gray-600">
                                        <p
                                            class="text-center font-medium text-base text-gray-900 whitespace-nowrap dark:text-white-color">
                                            Suhu</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($avgtData)
                                    @foreach ($avgtData as $key => $value)
                                        <tr class="grid grid-cols-2">
                                            <td
                                                class="px-6 py-3 bg-white dark:bg-gray-800 border-r border-b dark:border-gray-700 border-gray-200 flex items-center justify-center">
                                                <p
                                                    class="text-center font-medium text-base text-gray-900 whitespace-nowrap dark:text-white-color">
                                                    {{ $key }}
                                                </p>
                                            </td>
                                            <td
                                                class="px-6 py-3 bg-white dark:bg-gray-800 border-r border-b dark:border-gray-700 border-gray-200 flex items-center justify-center">
                                                <p
                                                    class="text-center font-medium text-base text-gray-900 whitespace-nowrap dark:text-white-color">
                                                    {{ $value }}&percnt;
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- humidity --}}
            <div class="w-full h-[450px] flex flex-col gap-y-4">
                <h1 class="text-2xl font-bold text-black dark:text-white-color">Kelembapan</h1>

                <div class="relative overflow-x-auto sm:rounded-lg w-full shadow-sm shadow-blue-600 dark:shadow-white">
                    <div class="relative overflow-x-auto">
                        <table
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border dark:border-gray-600">
                            <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                                <tr class="grid grid-cols-2">
                                    <th scope="col"
                                        class="px-6 py-3 border-r border-b dark:border-gray-700 border-gray-200 bg-gray-100 dark:bg-gray-600">
                                        <p
                                            class="text-center font-medium text-base text-gray-900 whitespace-nowrap dark:text-white-color">
                                            ID</p>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 border-r border-b dark:border-gray-700 border-gray-200 bg-gray-100 dark:bg-gray-600">
                                        <p
                                            class="text-center font-medium text-base text-gray-900 whitespace-nowrap dark:text-white-color">
                                            Kelembapan</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($avghData)
                                    @foreach ($avghData as $key => $value)
                                        <tr class="grid grid-cols-2">
                                            <td
                                                class="px-6 py-3 bg-white dark:bg-gray-800 border-r border-b dark:border-gray-700 border-gray-200 flex items-center justify-center">
                                                <p
                                                    class="text-center font-medium text-base text-gray-900 whitespace-nowrap dark:text-white-color">
                                                    {{ $key }}
                                                </p>
                                            </td>
                                            <td
                                                class="px-6 py-3 bg-white dark:bg-gray-800 border-r border-b dark:border-gray-700 border-gray-200 flex items-center justify-center">
                                                <p
                                                    class="text-center font-medium text-base text-gray-900 whitespace-nowrap dark:text-white-color">
                                                    {{ $value }}&percnt;
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
