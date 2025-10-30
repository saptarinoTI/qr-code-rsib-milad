<x-app>
    <x-slot:title>Ubah Peserta - {{ config('app.name') }}</x-slot:title>

    <x-slot:header>Ubah Peserta</x-slot:header>

    <div class="card w-full">
        <div class="card-body border-base-content/20">

            <form action="{{ route('peserta.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <x-custom.input label="Nama Karyawan" name="nama_karyawan" value="{{ $data->nama_karyawan }}" />
                <x-custom.input label="Unit Kerja" name="unit" value="{{ $data->unit }}" />

                <div class="mt-5">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
                </div>
            </form>

        </div>
    </div>
</x-app>
