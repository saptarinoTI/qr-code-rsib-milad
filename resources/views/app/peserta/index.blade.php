<x-app>
    <x-slot:title>Peserta - {{ config('app.name') }}</x-slot:title>

    <x-slot:header>Peserta</x-slot:header>

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

            @if (auth()->user()->role == 'admin')
                <div class="w-full py-2">
                    <a href="{{ route('peserta.create') }}" class="btn btn-primary btn-sm py-4">Tambah Data</a>
                </div>
            @endif

            <table id="users-table" class="table min-w-full">
                <thead>
                    <tr>
                        <th><span class="flex items-center text-gray-900">Nama Karyawan</span></th>
                        <th><span class="flex items-center text-gray-900">Unit</span></th>
                        <th><span class="flex items-center text-gray-900">Qr Code (Slug)</span></th>
                        <th><span class="flex items-center text-gray-900">Status Hadir</span></th>
                        <th><span class="flex items-center text-gray-900">Waktu Absen</span></th>
                        <th><span class="flex items-center text-gray-900">Aksi</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td class="text-[13px] font-medium text-gray-900">{{ strtoupper($data->nama_karyawan) }}
                            </td>
                            <td class="text-[13px] font-medium text-gray-900">{{ strtoupper($data->unit) }}</td>
                            <td class="text-[13px] font-medium text-gray-900">{{ $data->qr_code }}</td>
                            <td class="text-[13px] font-medium text-gray-900">
                                {{ $data->status_hadir ? 'HADIR' : 'TIDAK HADIR' }}</td>
                            <td class="text-[13px] font-medium text-gray-900">
                                {{ $data->waktu_absen ? \Carbon\Carbon::parse($data->waktu_absen)->format('H:i:s') : '-' }}
                            </td>

                            <td>
                                <div class="flex">
                                    @if (auth()->user()->role == 'admin')
                                        <a href="{{ route('peserta.edit', $data->id) }}"
                                            class="btn btn-circle btn-text btn-sm" aria-label="Action button">
                                            <span class="icon-[tabler--pencil] size-5"></span>
                                        </a>
                                        <form action="{{ route('peserta.destroy', $data->id) }}" method="post"
                                            class="peserta-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-circle btn-text btn-sm" aria-label="Action button">
                                                <span class="icon-[tabler--trash] size-5 bg-error"></span>
                                            </button>
                                        </form>
                                    @endif
                                    @if (!$data->status_hadir)
                                        <form action="{{ route('peserta.verif', $data->id) }}" method="post"
                                            class="peserta-verif">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-circle btn-text btn-sm" aria-label="Action button">
                                                <span
                                                    class="icon-[solar--check-circle-broken] size-5 bg-primary"></span>
                                            </button>
                                        </form>
                                    @endif
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

                const verifForms = document.querySelectorAll('.peserta-verif');
                const hapusForms = document.querySelectorAll('.peserta-hapus');

                verifForms.forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault(); // cegah submit langsung

                        Swal.fire({
                            title: 'Verifikasi Peserta?',
                            text: 'Apakah Anda yakin ingin memverifikasi peserta ini?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, verifikasi!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit(); // lanjut submit jika dikonfirmasi
                            }
                        });
                    });
                });
                hapusForms.forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault(); // cegah submit langsung

                        Swal.fire({
                            title: 'Hapus Peserta?',
                            text: 'Apakah Anda yakin ingin hapus peserta ini?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit(); // lanjut submit jika dikonfirmasi
                            }
                        });
                    });
                });
            });
        </script>
    @endsection
</x-app>
