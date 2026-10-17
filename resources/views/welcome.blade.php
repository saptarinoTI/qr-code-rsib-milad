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

    <header class="w-full fixed top-0 z-40 bg-transparent transition-all duration-300 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center justify-center space-x-1.5 cursor-pointer"
                    onclick="window.scrollTo({top:0, behavior:'smooth'})">
                    <i data-lucide="sparkles" class="h-4 w-4 text-accent-amber"></i>

                    <h1
                        class="font-heading text-sm font-bold tracking-wider text-primary-50 transition-colors duration-300">
                        Milad 32 - RS Islam Bontang
                    </h1>
                </div>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex text-sm font-medium text-primary-50">
                    <a href="#beranda"
                        class="px-3.5 py-2 rounded-lg hover:text-primary-500 hover:bg-primary-50 text-sm transition">Beranda</a>
                    <a href="{{ route('downloadqrcode') }}"
                        class="px-3.5 py-2 rounded-lg hover:text-primary-500 hover:bg-primary-50 text-sm transition">Download
                        QRCode</a>
                    <a href="#doorprize"
                        class="px-3.5 py-2 rounded-lg hover:text-primary-500 hover:bg-primary-50 text-sm transition">History
                        Doorprize</a>
                    <a href="{{ route('login') }}"
                        class="px-3.5 py-2 rounded-lg bg-primary-500 text-primary-50 transition">Masuk</a>
                </nav>

                <!-- Mobile Menu Button -->
                <div class="flex md:hidden">
                    <button id="mobile-menu-btn"
                        class="p-2 rounded-lg text-primary-50 hover:text-primary-600 hover:bg-primary-50 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke-width="1.5"
                            class="solar solar-widget-3-bold-duotone text-white hover:text-teal-700">
                            <g
                                style="color: var(--solar-secondary-color, currentColor); opacity: var(--solar-secondary-opacity, 0.5)">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M1.75 6.5C1.75 3.87665 3.87665 1.75 6.5 1.75C9.12335 1.75 11.25 3.87665 11.25 6.5C11.25 9.12335 9.12335 11.25 6.5 11.25C3.87665 11.25 1.75 9.12335 1.75 6.5Z"
                                    fill="currentColor"
                                    style="color: var(--solar-secondary-color, currentColor); opacity: var(--solar-secondary-opacity, 0.5)" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.75 17.5C12.75 14.8766 14.8766 12.75 17.5 12.75C20.1234 12.75 22.25 14.8766 22.25 17.5C22.25 20.1234 20.1234 22.25 17.5 22.25C14.8766 22.25 12.75 20.1234 12.75 17.5Z"
                                    fill="currentColor"
                                    style="color: var(--solar-secondary-color, currentColor); opacity: var(--solar-secondary-opacity, 0.5)" />
                            </g>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M22.25 6.5C22.25 3.87665 20.1234 1.75 17.5 1.75C14.8766 1.75 12.75 3.87665 12.75 6.5C12.75 9.12335 14.8766 11.25 17.5 11.25C20.1234 11.25 22.25 9.12335 22.25 6.5Z"
                                fill="currentColor" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M11.25 17.5C11.25 14.8766 9.12335 12.75 6.5 12.75C3.87665 12.75 1.75 14.8766 1.75 17.5C1.75 20.1234 3.87665 22.25 6.5 22.25C9.12335 22.25 11.25 20.1234 11.25 17.5Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu"
            class="hidden md:hidden bg-white border-b border-slate-200 px-4 pt-2 pb-6 space-y-2 shadow-xl">
            <a href="#beranda"
                class="block px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-primary-50 hover:text-primary-500">Beranda</a>
            <a href="#qrcode"
                class="block px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-primary-50 hover:text-primary-500">Download
                QRCode</a>
            <a href="#doorprize"
                class="block px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-primary-50 hover:text-primary-500">History
                Doorprize</a>
            <a href="{{ route('login') }}"
                class="block px-3 py-2 rounded-md bg-sm font-medium bg-slate-700 hover:text-primary-50 hover:bg-primary-500">Masuk</a>
        </div>
    </header>


    <section id="beranda"
        class="font-white gradient-hero relative py-24 lg:py-36 overflow-hidden min-h-screen flex items-center">
        <!-- Radial Spotlight Glow -->
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[500px] bg-primary-500/10 rounded-full blur-[140px] pointer-events-none">
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">

            <!-- Sub-Badge -->
            <div data-aos="fade-down"
                class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-transparent border border-primary-500/35 text-primary-100/70 text-xs font-medium tracking-wider uppercase mb-8">
                <span class="w-1.5 h-1.5 rounded-full bg-primary-100/70 animate-ping"></span>
                MILAD KE-32 RS ISLAM BONTANG
            </div>

            <!-- Professional Headline -->
            <h1 data-aos="fade-up" data-aos-delay="100"
                class="text-3xl sm:text-4xl lg:text-5xl font-heading font-black text-primary-50 leading-tight tracking-tight mb-8">
                Merayakan Kebersamaan, <br class="hidden sm:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-100 via-teal-500 to-amber-600">
                    Mengabdi dengan Sepenuh Hati.
                </span>
            </h1>

            <!-- Narrative Subtext -->
            <p data-aos="fade-up" data-aos-delay="200"
                class="text-sm md:text-base text-slate-300 max-w-3xl mx-auto font-medium leading-relaxed mb-10">
                Rayakan perjalanan dan kebersamaan dalam Milad Rumah Sakit Islam Bontang Ke-32.
                Pererat silaturahmi, tingkatkan solidaritas, dan kobarkan semangat untuk terus
                berkarya serta memberikan pelayanan terbaik dengan sepenuh hati.
            </p>

            <!-- Hero Action CTA Buttons -->
            <div data-aos="fade-up" data-aos-delay="300"
                class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('downloadqrcode') }}"
                    class="w-full sm:w-auto px-8 py-4 rounded-xl bg-primary-500 text-white font-heading font-medium text-sm tracking-normal hover:bg-primary-600 hover:scale-105 active:scale-95 transition-all flex items-center justify-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke-width="1.5" class="solar solar-download-minimalistic-bold-duotone">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M3 14.25C3.41421 14.25 3.75 14.5858 3.75 15C3.75 16.4354 3.75159 17.4365 3.85315 18.1919C3.9518 18.9257 4.13225 19.3142 4.40901 19.591C4.68577 19.8678 5.07435 20.0482 5.80812 20.1469C6.56347 20.2484 7.56459 20.25 9 20.25H15C16.4354 20.25 17.4365 20.2484 18.1919 20.1469C18.9257 20.0482 19.3142 19.8678 19.591 19.591C19.8678 19.3142 20.0482 18.9257 20.1469 18.1919C20.2484 17.4365 20.25 16.4354 20.25 15C20.25 14.5858 20.5858 14.25 21 14.25C21.4142 14.25 21.75 14.5858 21.75 15V15.0549C21.75 16.4225 21.75 17.5248 21.6335 18.3918C21.5125 19.2919 21.2536 20.0497 20.6517 20.6516C20.0497 21.2536 19.2919 21.5125 18.3918 21.6335C17.5248 21.75 16.4225 21.75 15.0549 21.75H8.94513C7.57754 21.75 6.47522 21.75 5.60825 21.6335C4.70814 21.5125 3.95027 21.2536 3.34835 20.6517C2.74643 20.0497 2.48754 19.2919 2.36652 18.3918C2.24996 17.5248 2.24998 16.4225 2.25 15.0549C2.25 15.0366 2.25 15.0183 2.25 15C2.25 14.5858 2.58579 14.25 3 14.25Z"
                            fill="currentColor"
                            style="color: var(--solar-secondary-color, currentColor); opacity: var(--solar-secondary-opacity, 0.5)" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 16.75C12.2106 16.75 12.4114 16.6615 12.5535 16.5061L16.5535 12.1311C16.833 11.8254 16.8118 11.351 16.5061 11.0715C16.2004 10.792 15.726 10.8132 15.4465 11.1189L12.75 14.0682V3C12.75 2.58579 12.4142 2.25 12 2.25C11.5858 2.25 11.25 2.58579 11.25 3V14.0682L8.55353 11.1189C8.27403 10.8132 7.79963 10.792 7.49393 11.0715C7.18823 11.351 7.16698 11.8254 7.44648 12.1311L11.4465 16.5061C11.5886 16.6615 11.7894 16.75 12 16.75Z"
                            fill="currentColor" />
                    </svg>
                    Download QRCode
                </a>
                <a href="#"
                    class="w-full sm:w-auto px-8 py-4 rounded-xl bg-white border border-slate-300 text-slate-700 hover:text-primary-600 font-heading font-medium text-sm tracking-normal hover:border-primary-500 transition-all flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke-width="1.5" class="solar solar-history-bold-duotone">
                        <path
                            d="M12 7.25C12.4142 7.25 12.75 7.58579 12.75 8V11.6893L15.0303 13.9697C15.3232 14.2626 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2626 15.3232 13.9697 15.0303L11.5429 12.6036C11.3554 12.416 11.25 12.1617 11.25 11.8964V8C11.25 7.58579 11.5858 7.25 12 7.25Z"
                            fill="currentColor"
                            style="color: var(--solar-secondary-color, currentColor); opacity: var(--solar-secondary-opacity, 0.5)" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.07868 5.06891C8.87402 1.27893 15.0437 1.31923 18.8622 5.13778C22.6824 8.95797 22.7211 15.1313 18.9262 18.9262C15.1312 22.7211 8.95793 22.6824 5.13774 18.8622C2.87389 16.5984 1.93904 13.5099 2.34047 10.5812C2.39672 10.1708 2.775 9.88377 3.18537 9.94002C3.59575 9.99627 3.88282 10.3745 3.82658 10.7849C3.4866 13.2652 4.27782 15.881 6.1984 17.8016C9.44288 21.0461 14.6664 21.0646 17.8655 17.8655C21.0646 14.6664 21.046 9.44292 17.8015 6.19844C14.5587 2.95561 9.33889 2.93539 6.13935 6.12957L6.88705 6.13333C7.30126 6.13541 7.63535 6.47288 7.63327 6.88709C7.63119 7.3013 7.29372 7.63539 6.87951 7.63331L4.33396 7.62052C3.92269 7.61845 3.58981 7.28556 3.58774 6.8743L3.57495 4.32874C3.57286 3.91454 3.90696 3.57707 4.32117 3.57498C4.73538 3.5729 5.07285 3.907 5.07493 4.32121L5.07868 5.06891Z"
                            fill="currentColor" />
                    </svg>
                    History Doorprize
                </a>
            </div>

        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <script>
        // Tutup menu setelah link diklik
        document.querySelectorAll('#mobile-menu a[href^="#"]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                const target = document.querySelector(targetId);

                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }

                mobileMenu.classList.add('hidden');
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const header = document.querySelector('header');
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');

            if (!header) return;

            // =========================
            // Navbar Scroll Effect
            // =========================
            const handleNavbarScroll = () => {
                const isScrolled = window.scrollY > 20;

                const logo = header.querySelector('h1');
                const logoIcon = header.querySelector('[data-lucide="sparkles"]');

                const desktopLinks = header.querySelectorAll('nav a');

                if (isScrolled) {
                    // Navbar
                    header.classList.remove('bg-transparent');
                    header.classList.add(
                        'bg-white',
                        'backdrop-blur-md',
                        'shadow-md'
                    );

                    // Logo text
                    logo?.classList.remove('text-primary-50');
                    logo?.classList.add('text-slate-800');

                    // Logo icon
                    logoIcon?.classList.remove('text-accent-amber');
                    logoIcon?.classList.add('text-primary-500');

                    // Desktop navigation
                    desktopLinks.forEach((link) => {
                        link.classList.remove('text-primary-50');
                        link.classList.add('text-slate-700');
                    });

                    // Mobile button
                    mobileMenuBtn?.classList.remove('text-primary-50');
                    mobileMenuBtn?.classList.add('text-slate-700');

                } else {
                    // Navbar
                    header.classList.add('bg-transparent');
                    header.classList.remove(
                        'bg-white',
                        'backdrop-blur-md',
                        'shadow-md'
                    );

                    // Logo text
                    logo?.classList.add('text-primary-50');
                    logo?.classList.remove('text-slate-800');

                    // Logo icon
                    logoIcon?.classList.add('text-accent-amber');
                    logoIcon?.classList.remove('text-primary-500');

                    // Desktop navigation
                    desktopLinks.forEach((link) => {
                        link.classList.add('text-primary-50');
                        link.classList.remove('text-slate-700');
                    });

                    // Mobile button
                    mobileMenuBtn?.classList.add('text-primary-50');
                    mobileMenuBtn?.classList.remove('text-slate-700');
                }
            };

            window.addEventListener('scroll', handleNavbarScroll);

            // Jalankan sekali saat halaman pertama kali dibuka
            handleNavbarScroll();


            // =========================
            // Mobile Menu
            // =========================
            mobileMenuBtn?.addEventListener('click', () => {
                mobileMenu?.classList.toggle('hidden');

                const isOpen = !mobileMenu?.classList.contains('hidden');

                if (isOpen) {
                    menuIcon?.setAttribute('data-lucide', 'x');
                } else {
                    menuIcon?.setAttribute('data-lucide', 'menu');
                }

                // Render ulang icon Lucide
                if (window.lucide) {
                    lucide.createIcons();
                }
            });


            // =========================
            // Mobile Navigation
            // =========================
            mobileMenu?.querySelectorAll('a[href^="#"]').forEach((link) => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();

                    const targetId = link.getAttribute('href');
                    const target = document.querySelector(targetId);

                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start',
                        });
                    }

                    // Tutup mobile menu
                    mobileMenu.classList.add('hidden');

                    // Kembalikan icon hamburger
                    menuIcon?.setAttribute('data-lucide', 'menu');

                    if (window.lucide) {
                        lucide.createIcons();
                    }
                });
            });
        });
    </script>
</body>

</html>
