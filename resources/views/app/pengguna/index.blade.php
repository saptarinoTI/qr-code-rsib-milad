<x-app>
    <x-slot:title>Pengguna - {{ config('app.name') }}</x-slot:title>

    <x-slot:header>Pengguna</x-slot:header>

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

            <div class="w-full py-2">
                <a href="{{ route('pengguna.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
            </div>

            <table id="users-table" class="table min-w-full">
                <thead>
                    <tr>
                        <th><span class="flex items-center">Nama</span></th>
                        <th><span class="flex items-center">Username</span></th>
                        <th><span class="flex items-center">Role</span></th>
                        <th><span class="flex items-center">Aksi</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td class="text-sm text-gray-900 whitespace-nowrap">{{ ucwords($data->name) }}</td>
                            <td class="text-sm">{{ $data->username }}</td>
                            <td class="text-sm">{{ ucwords($data->role) }}</td>
                            <td>
                                <div class="flex">
                                    <a href="{{ route('pengguna.edit', $data->id) }}"
                                        class="btn btn-circle btn-text btn-sm" aria-label="Action button">
                                        <span class="icon-[tabler--pencil] size-4.5"></span>
                                    </a>
                                    <form action="{{ route('pengguna.destroy', $data->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-circle btn-text btn-sm" aria-label="Action button">
                                            <span class="icon-[tabler--trash] size-4.5 bg-error"></span>
                                        </button>
                                    </form>
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
