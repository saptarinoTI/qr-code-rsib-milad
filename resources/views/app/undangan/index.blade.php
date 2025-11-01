<x-app>
    <x-slot:title>Scan Kehadiran - {{ config('app.name') }}</x-slot:title>

    <x-slot:header>Scan Kehadiran</x-slot:header>

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


            <!-- Main -->
            <section>
                <div class="container mt-4">
                    <div id="qr-reader" class="mb-3"></div>
                    <div id="qr-reader-results" class="mb-3"></div>
                </div>
            </section>
        </div>
    </div>

    @section('script')
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
        <script src="{{ asset('vendor/html5-qrcode.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.3/dist/sweetalert2.all.min.js"></script>
        <script>
            var resultContainer = $('#qr-reader-results');
            var lastResult, countResults = 0;
            var isProcessing = false; // cegah multiple requests

            function onScanSuccess(decodedText, decodedResult) {
                // if (decodedText !== lastResult && !isProcessing) {
                if (isProcessing) return;
                isProcessing = true;
                ++countResults;
                lastResult = decodedText;

                /* Render hasil dari qr code */
                var formData = {
                    _token: "{{ csrf_token() }}",
                    qr_code: decodedText
                };
                $.ajax({
                    type: "POST",
                    url: "{{ route('undangan.store') }}",
                    data: formData,
                    dataType: "json",
                    success: function(response) {

                        if (response.status == "success") {
                            Swal.fire({
                                icon: response.status,
                                title: "Berhasil!",
                                timer: 3500,
                                html: `
                                        ${response.message}. <br /> <strong>Nama Karyawan : ${response.peserta.nama_karyawan}</strong>
                                    `,
                                showConfirmButton: false
                            });
                        }
                        if (response.status == "error") {

                            Swal.fire({
                                icon: response.status,
                                title: "Gagal!",
                               text: response.message,
                                timer: 3500,
                                // showConfirmButton: false
                            });
                        }

                    },
                    error: function(xhr, status, error) {
                        resultContainer.html(`
                            <div class="alert alert-danger" role="alert">
                                <h5 class="alert-heading">Error</h5>
                                Terjadi kesalahan: ${error}
                            </div>
                        `);

                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Terjadi kesalahan sistem",
                            timer: 3000
                        });
                    },
                    complete: function() {
                        /* Reset processing flag setelah request selesai */
                        setTimeout(() => {
                            isProcessing = false;
                        }, 3000);
                    }
                });
            }
            // }

            // function onScanFailure(error) {
            //     /* Handle scan failure, but ignore most errors */
            //     console.warn(`QR error = ${error}`);
            // }

            /* Inisialisasi qr code */
            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", {
                    fps: 30, // Reduced from 60 untuk performa lebih baik
                    qrbox: {
                        width: 500,
                        height: 500
                    },
                    supportedScanTypes: [
                        Html5QrcodeScanType.SCAN_TYPE_CAMERA
                    ]
                });
            // html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            html5QrcodeScanner.render(onScanSuccess);
        </script>
    @endsection
</x-app>
