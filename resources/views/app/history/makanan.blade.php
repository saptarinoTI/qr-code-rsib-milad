<x-app>
    <x-slot:title>History Makanan - {{ config('app.name') }}</x-slot:title>

    <x-slot:header>History Makanan</x-slot:header>

    @if (session()->has('message'))
        <div class="{{ session('type') == 'success' ? 'bg-green-200/20 text-green-500 border-green' : 'bg-red-200/20 text-red-500 border-red' }}border rounded-lg mb-4 removing:translate-x-5 removing:opacity-0 flex items-center gap-4 transition duration-300 ease-in-out p-3 text-sm"
            role="alert" id="dismiss-alert1">
            {{ session('message') }}
            <button class="ms-auto cursor-pointer leading-none" data-remove-element="#dismiss-alert1"
                aria-label="Close Button">
                <span class="icon-[tabler--x] size-4"></span>
            </button>
        </div>
    @endif


    <div class="card w-full">

        <div class="card-body border-base-content/20">

            <table id="users-table" class="table min-w-full">
                <thead>
                    <tr>
                        <th><span class="flex items-center">Nama Karyawan</span></th>
                        <th><span class="flex items-center">Unit</span></th>
                        <th><span class="flex items-center">Rebusan</span></th>
                        <th><span class="flex items-center">Snack</span></th>
                        <th><span class="flex items-center">Nasi</span></th>
                        <th><span class="flex items-center">Aksi</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td class="text-sm text-gray-900 whitespace-nowrap">
                                {{ strtoupper($data->peserta->nama_karyawan) }}
                            </td>
                            <td class="text-sm">{{ strtoupper($data->peserta->unit) }}</td>
                            <td class="text-sm">
                                @if ($data->rebusan_pagi)
                                    <span class="icon-[ci--check-all] size-6 bg-success"></span>
                                @else
                                    <span class="icon-[charm--cross] size-6 bg-error"></span>
                                @endif
                            </td>
                            <td class="text-sm">
                                @if ($data->snack)
                                    <span class="icon-[ci--check-all] size-6 bg-success"></span>
                                @else
                                    <span class="icon-[charm--cross] size-6 bg-error"></span>
                                @endif
                            </td>
                            <td class="text-sm">
                                @if ($data->pulang_nasi)
                                    <span class="icon-[ci--check-all] size-6 bg-success"></span>
                                @else
                                    <span class="icon-[charm--cross] size-6 bg-error"></span>
                                @endif
                            </td>
                            <td>
                                <div class="flex">
                                    <a href="{{ route('history-scan-makanan.edit', $data->id) }}"
                                        class="btn btn-circle btn-text btn-sm" aria-label="Action button">
                                        <span class="icon-[tabler--pencil] size-5"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @section('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (document.getElementById("users-table") && typeof simpleDatatables.DataTable !== 'undefined') {
                    const dataTable = new simpleDatatables.DataTable("#users-table", {
                        searchable: true,
                        sortable: false
                    });
                }
            });
        </script>
    @endsection
</x-app>
