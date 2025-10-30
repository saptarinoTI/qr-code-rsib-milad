<x-app>
    <x-slot:title>Ubah History Makanan - {{ config('app.name') }}</x-slot:title>

    <x-slot:header>Ubah History Makanan</x-slot:header>

    <div class="card w-full">
        <div class="card-body border-base-content/20">

            <form action="{{ route('history-scan-makanan.put', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="label-text">Nama Karyawan</label>
                    <input type="text" class="input text-[13px] focus:border-0 focus:outline-0"
                        value="{{ $data->peserta->nama_karyawan }}" readonly disabled />
                </div>
                <div class="mb-3">
                    <label class="label-text">Unit</label>
                    <input type="text" class="input text-[13px] focus:border-0 focus:outline-0"
                        value="{{ $data->peserta->unit }}" readonly disabled />
                </div>
                <div class="mb-3">
                    <label class="label-text">Rebusan Pagi</label>
                    <div class="flex items-center gap-1">
                        <input type="radio" name="rebusan_pagi" class="radio radio-sm" id="rebusan_pagi_0" value="1" {{ $data->rebusan_pagi ? "checked" : "" }} />
                        <label class="label-text text-[13px] font-medium" for="rebusan_pagi_0"> Sudah Diambil </label>
                    </div>
                    <div class="flex items-center gap-1">
                        <input type="radio" name="rebusan_pagi" class="radio radio-sm" id="rebusan_pagi_1" value="0" {{ !$data->rebusan_pagi ? "checked" : "" }} />
                        <label class="label-text text-[13px] font-medium" for="rebusan_pagi_1"> Belum Diambil </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="label-text">Snack</label>
                    <div class="flex items-center gap-1">
                        <input type="radio" name="snack" class="radio radio-sm" id="snack_0" value="1" {{ $data->snack ? "checked" : "" }} />
                        <label class="label-text text-[13px] font-medium" for="snack_0"> Sudah Diambil </label>
                    </div>
                    <div class="flex items-center gap-1">
                        <input type="radio" name="snack" class="radio radio-sm" id="snack_1" value="0" {{ !$data->snack ? "checked" : "" }} />
                        <label class="label-text text-[13px] font-medium" for="snack_1"> Belum Diambil </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="label-text">Nasi Pulang</label>
                    <div class="flex items-center gap-1">
                        <input type="radio" name="pulang_nasi" class="radio radio-sm" id="pulang_nasi_0" value="1" {{ $data->pulang_nasi ? "checked" : "" }} />
                        <label class="label-text text-[13px] font-medium" for="pulang_nasi_0"> Sudah Diambil </label>
                    </div>
                    <div class="flex items-center gap-1">
                        <input type="radio" name="pulang_nasi" class="radio radio-sm" id="pulang_nasi_1" value="0" {{ !$data->pulang_nasi ? "checked" : "" }} />
                        <label class="label-text text-[13px] font-medium" for="pulang_nasi_1"> Belum Diambil </label>
                    </div>
                </div>


                <div class="mt-5">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
                </div>
            </form>

        </div>
    </div>
</x-app>
