<x-app>
    <x-slot:title>Dashboard - {{ config('app.name') }}</x-slot:title>

    <x-slot:header>Dashboard</x-slot:header>

    <div class="flex gap-4 w-full lg:flex-row flex-col">
        <div class="card w-full">
            <div class="card-body border-base-content/20">
                <div class="flex flex-1 flex-col gap-4">
                    <div class="text-base-content flex items-center gap-2">
                        <div class="avatar avatar-placeholder">
                            <div class="bg-base-200 rounded-field size-9">
                                <span class="icon-[solar--users-group-two-rounded-bold-duotone] size-6"></span>
                            </div>
                        </div>
                        <h5 class="text-base font-bold p-0 m-0">Peserta</h5>
                    </div>
                    <div>
                        <div class="text-base-content text-2xl font-bold">{{ count($all) }}</div>
                        <span class="text-blue-500 font-medium text-sm">Total Peserta</span>

                    </div>
                </div>
            </div>
        </div>

        <div class="card w-full">
            <div class="card-body border-base-content/20">
                <div class="flex flex-1 flex-col gap-4">
                    <div class="text-base-content flex items-center gap-2">
                        <div class="avatar avatar-placeholder">
                            <div class="bg-base-200 rounded-field size-9">
                                <span class="icon-[solar--user-check-rounded-bold-duotone] size-6"></span>
                            </div>
                        </div>
                        <h5 class="text-base font-bold p-0 m-0">Peserta Hadir</h5>
                    </div>
                    <div>
                        <div class="text-base-content text-2xl font-bold">{{ count($hadir) }}</div>
                        <span class="font-medium text-sm text-green-500">Total Peserta</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card w-full">
            <div class="card-body border-base-content/20">
                <div class="flex flex-1 flex-col gap-4">
                    <div class="text-base-content flex items-center gap-2">
                        <div class="avatar avatar-placeholder">
                            <div class="bg-base-200 rounded-field size-9">
                                <span class="icon-[solar--user-cross-rounded-bold-duotone] size-6"></span>
                            </div>
                        </div>
                        <h5 class="text-base font-bold p-0 m-0">Peserta Tidak Hadir</h5>
                    </div>
                    <div>
                        <div class="text-base-content text-2xl font-bold">{{ count($tidakHadir) }}</div>
                        <span class="text-red-500 font-medium text-sm">Total Peserta</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 flex gap-4 w-full lg:flex-row flex-col">
        {{-- <div class="card w-full">
            <div class="card-body border-base-content/20">
                <div class="flex flex-1 flex-col gap-4">
                    <div class="text-base-content flex items-center gap-2">
                        <div class="avatar avatar-placeholder">
                            <div class="bg-base-200 rounded-field size-9">
                                <span class="icon-[fluent--food-egg-16-filled] size-6"></span>
                            </div>
                        </div>
                        <h5 class="text-base font-bold p-0 m-0">Rebusan</h5>
                    </div>
                    <div>
                        <div class="text-base-content text-2xl font-bold">{{ count($rebusan) }}</div>
                        <span class="text-blue-500 font-medium text-sm">Total Telah Diambil</span>

                    </div>
                </div>
            </div>
        </div>

        <div class="card w-full">
            <div class="card-body border-base-content/20">
                <div class="flex flex-1 flex-col gap-4">
                    <div class="text-base-content flex items-center gap-2">
                        <div class="avatar avatar-placeholder">
                            <div class="bg-base-200 rounded-field size-9">
                                <span class="icon-[ion--fast-food] size-6"></span>
                            </div>
                        </div>
                        <h5 class="text-base font-bold p-0 m-0">Snack</h5>
                    </div>
                    <div>
                        <div class="text-base-content text-2xl font-bold">{{ count($snack) }}</div>
                        <span class="font-medium text-sm text-green-500">Total Telah Diambil</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card w-full">
            <div class="card-body border-base-content/20">
                <div class="flex flex-1 flex-col gap-4">
                    <div class="text-base-content flex items-center gap-2">
                        <div class="avatar avatar-placeholder">
                            <div class="bg-base-200 rounded-field size-9">
                                <span class="icon-[fa6-solid--bowl-food] size-6"></span>
                            </div>
                        </div>
                        <h5 class="text-base font-bold p-0 m-0">Nasi Kotak</h5>
                    </div>
                    <div>
                        <div class="text-base-content text-2xl font-bold">{{ count($nasi) }}</div>
                        <span class="text-red-500 font-medium text-sm">Total Telah Diambil</span>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</x-app>
