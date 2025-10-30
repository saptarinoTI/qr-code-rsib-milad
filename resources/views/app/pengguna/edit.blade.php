<x-app>
    <x-slot:title>Ubah Pengguna - {{ config('app.name') }}</x-slot:title>

    <x-slot:header>Ubah Pengguna</x-slot:header>

    <div class="card w-full">
        <div class="card-body border-base-content/20">

            <form action="{{ route('pengguna.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <x-custom.input label="Nama Lengkap" name="name" value="{{ $data->name }}" />
                <x-custom.input label="Username" name="username" value="{{ $data->username }}" />
                <x-custom.input label="Password" name="password" type="password" />
                <x-custom.input label="Role" name="role" value="petugas" />

                <div class="mt-5">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
                </div>
            </form>

        </div>
    </div>
</x-app>
