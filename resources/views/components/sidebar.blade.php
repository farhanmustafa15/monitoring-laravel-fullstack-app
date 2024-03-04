@yield('sidebar')
    <div class="flex flex-col justify-between items-center bg-white-color py-5 h-full">
        <div class="flex flex-col items-center">
            {{-- brand title --}}
            <div class="flex items-center gap-2">
                {{-- image --}}
                <img src="{{ asset('assets/dashboard/brand.svg') }}" alt="description of myimage" class="w-10 h-10 mr-2">
                <h5 class="text-3xl font-semibold">Monitoring</h5>
            </div>
            {{-- content menu --}}
            <div class="items-center flex flex-col mt-14">
                {{-- button isnt resolved --}}
                {{-- button isnt resolved --}}

                <button class="h-14 w-44 bg-white-color hover:bg-[#EDF4FF] rounded-lg">
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('assets/dashboard/menu-1.svg') }}" alt="description of myimage"
                            class="w-6 h-6 mr-2">
                        <p class="text-lg font-bold text-primary-color">Suhu Realtime</p>
                    </div>
                </button>
            </div>


        </div>
        {{-- button isnt resolved --}}
        <button class="h-14 w-44 bg-white-color hover:bg-[#EDF4FF] rounded-lg">
            <div class="flex items-center justify-center">
                <img src="{{ asset('assets/dashboard/collapse.svg') }}" alt="description of myimage"
                    class="w-6 h-6 mr-2">
                <p class="text-lg font-bold text-primary-color">Suhu Realtime</p>
            </div>
        </button>
    </div>
