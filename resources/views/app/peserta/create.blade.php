<x-app>
    <x-slot:title>Tambah Peserta - {{ config('app.name') }}</x-slot:title>

    <x-slot:header>Tambah Peserta</x-slot:header>

    <div class="card w-full">
        <div class="card-body border-base-content/20">

            <form action="{{ route('peserta.store') }}" method="POST">
                @csrf

                <x-custom.input label="Nama Karyawan" name="nama_karyawan" />
                <x-custom.input label="Unit Kerja" name="unit" />

                <div class="mt-5">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
                </div>
            </form>

        </div>
    </div>
</x-app>
