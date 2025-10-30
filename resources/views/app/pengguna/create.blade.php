<x-app>
    <x-slot:title>Tambah Pengguna - {{ config('app.name') }}</x-slot:title>

    <x-slot:header>Tambah Pengguna</x-slot:header>

    <div class="card w-full">
        <div class="card-body border-base-content/20">

            <form action="{{ route('pengguna.store') }}" method="POST">
                @csrf

                <x-custom.input label="Nama Lengkap" name="name" />
                <x-custom.input label="Username" name="username" />
                <x-custom.input label="Password" name="password" type="password" />
                <x-custom.input label="Role" name="role" value="petugas" />

                <div class="mt-5">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
                </div>
            </form>

        </div>
    </div>
</x-app>
