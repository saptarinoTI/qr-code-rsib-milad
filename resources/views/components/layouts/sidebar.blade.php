 <aside id="layout-toggle"
     class="overlay overlay-open:translate-x-0 drawer drawer-start inset-y-0 start-0 hidden h-full [--auto-close:lg] sm:w-75 lg:z-50 lg:block lg:translate-x-0 lg:shadow-none"
     aria-label="Sidebar" tabindex="-1">
     <div class="drawer-body border-base-content/20 h-full border-e p-0">
         <div class="flex h-full max-h-full flex-col">
             <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3 lg:hidden"
                 aria-label="Close" data-overlay="#layout-toggle">
                 <span class="icon-[tabler--x] size-5"></span>
             </button>
             <a href="{{ route('login') }}" class="flex items-center justify-start px-6 gap-1 mt-5 mb-1">
                 <img src="{{ asset('img/LogoMILAD31RSIB.png') }}" alt="" class="w-6" />
                 <h2 class="text-base-content font-bold leading-none relative top-[4px]">Milad RSIB</h2>
             </a>
             <div class="h-full overflow-y-auto">
                 <ul class="menu menu-sm gap-1 px-4">
                     <!-- Dashboard -->
                     <li class="text-base-content/50 mt-2.5 p-2 text-xs uppercase">Dashboard</li>
                     <li>
                         <a href="{{ route('login') }}"
                             class="px-2 font-medium text-sm {{ request()->is('dashboard*') ? ' menu-active' : '' }}">
                             <span class="icon-[solar--code-scan-bold-duotone] size-5"></span>
                             Dashboard
                         </a>
                     </li>

                     <li class="text-base-content/50 mt-2.5 p-2 text-xs uppercase">Data Master</li>
                     <!-- Content Performance -->
                     <li>
                         <a href="{{ route('peserta.index') }}"
                             class="px-2 font-medium text-sm {{ request()->is(patterns: 'peserta*') ? ' menu-active' : '' }}">
                             <span class="icon-[solar--users-group-two-rounded-bold-duotone] size-5"></span>
                             Data Peserta
                         </a>
                     </li>

                     <li class="text-base-content/50 mt-2.5 p-2 text-xs uppercase">Transaksi</li>
                     <li>
                         <a href="{{ route('undangan.index') }}"
                             class="px-2 font-medium text-sm {{ request()->is(patterns: 'undangan*') ? ' menu-active' : '' }}">
                             <span class="icon-[solar--qr-code-bold-duotone] size-5"></span>
                             Scan Kehadiran
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('makanan.index') }}"
                             class="px-2 font-medium text-sm {{ request()->is(patterns: 'makanan*') ? ' menu-active' : '' }}">
                             <span class="icon-[solar--donut-bitten-bold-duotone] size-5"></span>
                             Scan Makanan
                         </a>
                     </li>
                     @if (auth()->user()->role == 'admin')
                         <li>
                             <a href="{{ route('doorprize.index') }}"
                                 class="px-2 font-medium text-sm {{ request()->is(patterns: 'doorprize*') ? ' menu-active' : '' }}">
                                 <span class="icon-[duo-icons--confetti] size-5"></span>
                                 Doorprize
                             </a>
                         </li>
                     @endif

                     <li class="text-base-content/50 mt-2.5 p-2 text-xs uppercase">History</li>
                     <li>
                         <a href="{{ route('history-scan.index') }}"
                             class="px-2 font-medium text-sm {{ request()->is(patterns: 'history-scan') ? ' menu-active' : '' }}">
                             <span class="icon-[duo-icons--check-circle] size-5"></span>
                             History Kehadiran
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('history-scan-makanan.index') }}"
                             class="px-2 font-medium text-sm {{ request()->is(patterns: 'history-scan-makanan*') ? ' menu-active' : '' }}">
                             <span class="icon-[solar--check-read-bold-duotone] size-5"></span>
                             History Makanan
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('history-doorprize.index') }}"
                             class="px-2 font-medium text-sm {{ request()->is(patterns: 'history-doorprize*') ? ' menu-active' : '' }}">
                             <span class="icon-[duo-icons--approved] size-5"></span>
                             History Doorprize
                         </a>
                     </li>

                     @if (auth()->user()->role == 'admin')
                         <li class="text-base-content/50 mt-2.5 p-2 text-xs uppercase">Manajemen Pengguna</li>
                         <li>
                             <a href="{{ route('pengguna.index') }}"
                                 class="px-2 font-medium text-sm {{ request()->is(patterns: 'pengguna*') ? ' menu-active' : '' }}">
                                 <span class="icon-[duo-icons--user] size-5"></span>
                                 Data Pengguna
                             </a>
                         </li>
                     @endif
                 </ul>
             </div>
         </div>
     </div>
 </aside>
