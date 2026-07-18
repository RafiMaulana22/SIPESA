 <header class="header">
     <div class="header-content">
         <nav class="navbar navbar-expand">
             <div class="collapse navbar-collapse justify-content-between">
                 <div class="header-left">
                     <div class="dashboard_bar">
                         {{ ucwords(trim(str_replace(['_', '-', '.', 'index'], ' ', Route::currentRouteName()))) }}
                     </div>
                 </div>
                 <ul class="navbar-nav header-right">
                     <li class="nav-item dropdown notification_dropdown">
                         <a class="nav-link bell dz-theme-mode" href="javascript:void(0);" aria-label="theme-mode">
                             <i id="icon-light" class="fas fa-sun"></i>
                             <i id="icon-dark" class="fas fa-moon"></i>

                         </a>
                     </li>
                     <li class="nav-item dropdown header-profile">
                         <a class="nav-link d-flex align-items-center" href="javascript:void(0)" role="button"
                             data-bs-toggle="dropdown">

                             @php
                                 $nama = Auth::user()->name;
                                 $inisial = collect(explode(' ', trim($nama)))
                                     ->map(fn($item) => strtoupper(substr($item, 0, 1)))
                                     ->take(2)
                                     ->implode('');
                             @endphp

                             <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm me-2"
                                 style="
                                    width:42px;
                                    height:42px;
                                    font-size:14px;
                                    background:linear-gradient(135deg,#4f46e5,#2563eb);
                                    flex-shrink:0;
                                  ">
                                 {{ $inisial }}
                             </div>

                             <div class="header-info">
                                 <span class="text-black">
                                     <strong>{{ Auth::user()->name }}</strong>
                                 </span>

                                 <p class="fs-12 mb-0">
                                     {{ Auth::user()->role == 'kepala_desa' ? 'Kepala Desa' : 'Operator' }}
                                 </p>
                             </div>

                         </a>
                         <div class="dropdown-menu dropdown-menu-end">
                             <a href="/profile" class="dropdown-item ai-icon">
                                 <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                     width="18" height="18" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round">
                                     <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                     <circle cx="12" cy="7" r="4"></circle>
                                 </svg>
                                 <span class="ms-2">Profile </span>
                             </a>
                             <form action="{{ route('logout') }}" method="POST">
                                 @csrf
                                 <button type="submit" class="dropdown-item ai-icon">
                                     <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                         width="18" height="18" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round">
                                         <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                         <polyline points="16 17 21 12 16 7"></polyline>
                                         <line x1="21" y1="12" x2="9" y2="12"></line>
                                     </svg>
                                     <span class="ms-2">Logout </span>
                                 </button>
                             </form>
                         </div>
                     </li>
                 </ul>
             </div>
         </nav>
     </div>
 </header>
