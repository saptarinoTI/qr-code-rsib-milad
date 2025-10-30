<x-app>
    <x-slot:title>History Doorprize - {{ config('app.name') }}</x-slot:title>

    <x-slot:header>History Doorprize</x-slot:header>

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
                        <th><span class="flex items-center">Status</span></th>
                        @if (auth()->user()->role == 'admin')
                            <th><span class="flex items-center">Aksi</span></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td class="text-sm text-gray-900 whitespace-nowrap">{{ strtoupper($data->peserta->nama_karyawan) }}
                            </td>
                            <td class="text-sm">{{ strtoupper($data->peserta->unit) }}</td>
                            <td class="text-sm">
                                @if ($data->status != "hangus")
                                 <span class="icon-[ci--check-all] size-6 bg-success"></span><span class="text-sm font-medium text-green-600">Hadir</span>
                                    @else
                                     <span class="icon-[charm--cross] size-6 bg-error"></span><span class="text-sm font-medium text-red-600">Hangus</span>
                                @endif
                            </td>
                            @if (auth()->user()->role == 'admin')
                                <td>
                                    <div class="flex">
                                        <form action="{{ route('history-scan.update', $data->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-circle btn-text btn-sm" aria-label="Action button">
                                                <span class="icon-[solar--trash-bin-minimalistic-2-bold-duotone] size-4.5 bg-error"></span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
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
