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
        <!-- ---------- HEADER ---------- -->
        @include('components.layouts.header')
        <!-- ---------- END HEADER ---------- -->

        <!-- ---------- MAIN SIDEBAR ---------- -->
        @include('components.layouts.sidebar')
        <!-- ---------- END MAIN SIDEBAR ---------- -->

        <div class="flex grow flex-col lg:ps-75">
            <!-- ---------- MAIN CONTENT ---------- -->
            <main class="mx-auto w-full max-w-7xl flex-1 p-6">

                <h3 class="font-semibold text-xl mb-3">{{ $header ?? 'Title Page' }}</h3>

                {{ $slot }}

            </main>
            <!-- ---------- END MAIN CONTENT ---------- -->

            <!-- ---------- FOOTER CONTENT ---------- -->
            <footer class="mx-auto w-full max-w-7xl px-6 py-3.5">
                <div class="flex items-center justify-between gap-3 text-sm max-lg:flex-col">
                    <p class="text-gray-500 text-center text-sm">
                        &copy;2025 - Sistem Informasi Bantuan PKT
                    </p>
                </div>
            </footer>
            <!-- ---------- END FOOTER CONTENT ---------- -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" defer></script>
    @yield('script')
</body>

</html>
