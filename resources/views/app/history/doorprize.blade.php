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
                        <th><span class="flex items-center">No. Undian</span></th>
                        <th><span class="flex items-center">Status</span></th>
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
                            <td class="text-sm font-bold">
                                # {{ $data->no_undian }}
                            </td>
                            <td class="text-sm font-bold">
                                @if ($data->status == 'hadir')
                                    <span class="text-green-600">Diambil</span>
                                @elseif($data->status == 'hangus')
                                    <span class="text-red-600">Hangus</span>
                                @endif
                            </td>
                            <td class="text-sm">
                                @if ($data->status == 'hadir')
                                    <form action="{{ route('history-doorprize.update', $data->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="hangus">
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke-width="1.5"
                                                class="solar solar-close-circle-bold-duotone text-red-600">
                                                <path
                                                    d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z"
                                                    fill="currentColor"
                                                    style="color: var(--solar-secondary-color, currentColor); opacity: var(--solar-secondary-opacity, 0.5)" />
                                                <path
                                                    d="M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
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
