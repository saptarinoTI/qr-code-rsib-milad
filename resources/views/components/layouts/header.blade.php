 <div class="bg-base-100 border-base-content/20 sticky top-0 z-50 flex border-b lg:ps-75">
     <div class="mx-auto w-full max-w-7xl">
         <nav class="navbar py-2">
             <div class="navbar-start gap-2">
                 <button type="button" class="btn btn-soft btn-square btn-sm lg:hidden" aria-haspopup="dialog"
                     aria-expanded="false" aria-controls="layout-toggle" data-overlay="#layout-toggle">
                     <span class="icon-[tabler--menu-2] size-5.5"></span>
                 </button>

             </div>

             <div class="navbar-end gap-6">
                 <!-- Profile Dropdown -->
                 <div class="dropdown relative inline-flex [--offset:21]">
                     <button id="profile-dropdown" type="button"
                         class="dropdown-toggle avatar btn btn-soft btn-square btn-sm" aria-haspopup="menu"
                         aria-expanded="false" aria-label="Dropdown">
                         <span class="icon-[qlementine-icons--user-16] size-5.5"></span>
                     </button>
                     <ul class="dropdown-menu dropdown-open:opacity-100 hidden w-full max-w-75 space-y-0.5"
                         role="menu" aria-orientation="vertical" aria-labelledby="profile-dropdown">
                         <li class="dropdown-header mb-1 gap-4 px-5 pt-4.5 pb-3.5">
                             <div>
                                 <h6 class="text-base-content mb-0.5 font-bold">{{ ucwords(auth()->user()->email) }}
                                 </h6>
                                 <p class="text-base-content/80 text-sm font-bold">{{ ucwords(auth()->user()->name) }}
                                 </p>
                             </div>
                         </li>
                         {{-- <li>
                             <a class="dropdown-item px-3" href="#">
                                 <span class="icon-[tabler--settings] size-5"></span>
                                 Setting
                             </a>
                         </li> --}}
                         <li class="p-2 pt-1">
                             <form action="{{ route('logout') }}" method="post">
                                 @csrf
                                 <button type="submit"
                                     class="btn btn-sm btn-text btn-error btn-block h-11 justify-start px-3 font-normal">
                                     <span class="icon-[tabler--logout] size-5"></span>
                                     Logout
                                 </button>
                             </form>
                         </li>
                     </ul>
                 </div>
             </div>
         </nav>
     </div>
 </div>
