<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('img/LogoMILAD31RSIB.png') }}" type="image/x-icon">
    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="bg-base-200 flex min-h-screen flex-col">
        <!-- ---------- MAIN CONTENT ---------- -->
        <main class="mx-auto w-full max-w-7xl flex-1 p-6">

            <div class="mb-10">
                <h3 class="font-bold text-lg">Peserta Milad 32 RS Islam Bontang</h3>
                <p class="text-gray-500">Cari nama dan tekan QRCode untuk download QRCode</p>
            </div>


            <div class="card w-full">

                <div class="card-body border-base-content/20">

                    <table id="users-table" class="table min-w-full">
                        <thead>
                            <tr>
                                <th><span class="flex items-center text-gray-900">Aksi</span></th>
                                <th><span class="flex items-center text-gray-900">Nama Karyawan</span></th>
                                <th><span class="flex items-center text-gray-900">Unit</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>
                                        <a href="{{ route('peserta.qrgenerate', $data->id) }}"
                                            class="text-teal-700 font-bold">QRCode
                                        </a>
                                    </td>
                                    <td class="text-[13px] font-medium text-gray-900">
                                        {{ strtoupper($data->nama_karyawan) }}
                                    </td>
                                    <td class="text-[13px] font-medium text-gray-900">{{ strtoupper($data->unit) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </main>
    </div>
    <!-- ---------- END MAIN CONTENT ---------- -->

    <!-- ---------- FOOTER CONTENT ---------- -->
    <footer class="mx-auto w-full max-w-7xl px-6 py-3.5">
        <div class="flex items-center justify-between gap-3 text-sm max-lg:flex-col">
            <p class="text-gray-500 text-center text-xs font-semibold">
                ©{{ date('Y') }} - Milad RS. Islam Bontang
            </p>
        </div>
    </footer>
    <!-- ---------- END FOOTER CONTENT ---------- -->


    <a href="{{ route('landing') }}"
        class="fixed bottom-6 right-6 z-50
           flex h-12 w-12 items-center justify-center
           rounded-full bg-teal-600 text-white
           shadow-sm shadow-teal-600/30
           transition duration-300
           hover:scale-110 hover:bg-teal-700
           active:scale-95"
        aria-label="Kembali ke Halaman Utama">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-undo-2 preview-icon">
            <path d="M9 14 4 9l5-5"></path>
            <path d="M4 9h10.5a5.5 5.5 0 0 1 5.5 5.5a5.5 5.5 0 0 1-5.5 5.5H11"></path>
        </svg>
    </a>

    < <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" defer></script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.26.3/dist/sweetalert2.all.min.js "></script>

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

            // verifForms.forEach(form => {
            //     form.addEventListener('submit', function(e) {
            //         e.preventDefault(); // cegah submit langsung

            //         Swal.fire({
            //             title: 'Verifikasi Peserta?',
            //             text: 'Apakah Anda yakin ingin memverifikasi peserta ini?',
            //             icon: 'question',
            //             showCancelButton: true,
            //             confirmButtonColor: '#3085d6',
            //             cancelButtonColor: '#d33',
            //             confirmButtonText: 'Ya, verifikasi!',
            //             cancelButtonText: 'Batal'
            //         }).then((result) => {
            //             if (result.isConfirmed) {
            //                 form.submit(); // lanjut submit jika dikonfirmasi
            //             }
            //         });
            //     });
            // });
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
</body>

</html>
