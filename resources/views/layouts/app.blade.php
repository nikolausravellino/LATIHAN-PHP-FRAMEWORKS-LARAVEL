<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <style>
            /* Warna Brand */
            .text-primary-brand {
                color: #004494 !important;
            }
            .bg-primary-brand {
                background-color: #004494 !important;
            }
            .bg-header-custom {
                background-color: #f7f9fc !important; 
                border-bottom: 1px solid #e0e0e0;
                position: sticky; 
                top: 0;
                z-index: 1020;
            }
            
            /* Lebar Sidebar */
            :root {
                --sidebar-width: 500px;
            }

            /* ---------------------------------- */
            /* SIDEBAR STYLES (Offcanvas Modifikasi) */
            /* ---------------------------------- */
            
            .offcanvas-start {
                width: var(--sidebar-width);
                background-color: #212529;
                color: white;
                box-shadow: 5px 0 10px rgba(0,0,0,0.3);
                border-right: none;
                transition: transform 0.3s ease;
            }
            
            /* Konten Utama (Page Content) - KOREKSI UTAMA DI SINI */
            #page-content-wrapper {
                transition: margin-left 0.3s ease, width 0.3s ease;
                width: 100%;
                /* Pastikan margin kiri di kondisi normal (sidebar tertutup) adalah NOL */
                margin-left: 0; 
            }

            /* Saat Sidebar Terbuka, Konten Bergeser ke Kanan */
            #page-content-wrapper.sidebar-open {
                margin-left: var(--sidebar-width);
                width: calc(100% - var(--sidebar-width));
            }

            /* Style Menu Sidebar */
            .sidebar-heading {
                padding: 1.5rem 1rem;
                font-size: 1.2rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .list-group-item {
                border: none;
                padding: 0.75rem 1.25rem;
                color: rgba(255, 255, 255, 0.8);
                transition: all 0.3s;
                background-color: transparent;
            }

            .list-group-item:hover, .list-group-item.active {
                background-color: #0066cc;
                color: white;
            }
            
            .profile-sidebar-footer {
                padding: 1rem;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                margin-top: auto; 
            }
            
            /* HOVER TRIGGER AREA */
            #sidebar-trigger-area {
                position: fixed;
                top: 0;
                left: 0;
                width: 15px; 
                height: 100vh;
                z-index: 1100; 
                cursor: pointer;
            }

        </style>

    </head>
    <body class="font-sans antialiased bg-light">

        <div id="sidebar-trigger-area"></div>

        <div class="d-flex" id="wrapper">
            
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
                
                <div class="offcanvas-header pb-0">
                    <div class="sidebar-heading text-warning fw-bold w-100">
                        <i class="fas fa-lock me-2"></i> AuthX Panel
                    </div>
                </div>
                
                <div class="offcanvas-body d-flex flex-column pt-0">
                    
                    <div class="list-group list-group-flush">
                        <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home me-2"></i> Dashboard
                        </a>
                    </div>
                    
                    <div class="profile-sidebar-footer">
                        <div class="dropdown">
                            <a class="btn btn-secondary w-100 dropdown-toggle text-start" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark w-100" aria-labelledby="profileDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-cog me-2"></i> Pengaturan Akun
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i> Log Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="page-content-wrapper" class="w-100">
                
                <header class="bg-header-custom shadow-sm py-3">
                    <div class="container-fluid d-flex align-items-center">
                        
                        <button 
                            class="btn btn-primary-brand-custom shadow-sm me-3" 
                            id="sidebarToggle" 
                            data-bs-toggle="offcanvas" 
                            data-bs-target="#offcanvasSidebar" 
                            aria-controls="offcanvasSidebar"
                        >
                             <i class="fas fa-bars"></i>
                        </button>
                        <div class="flex-grow-1">
                            {{ isset($header) ? $header : '' }}
                        </div>

                    </div>
                    <style>
                        .btn-primary-brand-custom {
                            background-color: #004494;
                            color: white;
                            border: 1px solid #004494;
                        }
                        .btn-primary-brand-custom:hover {
                            background-color: #0066cc;
                            border-color: #0066cc;
                            color: white;
                        }
                    </style>
                </header>
                
                <main class="py-4">
                    <div class="container-fluid">
                        {{ $slot }}
                    </div>
                </main>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const offcanvasElement = document.getElementById('offcanvasSidebar');
                const pageContent = document.getElementById('page-content-wrapper');
                const triggerArea = document.getElementById('sidebar-trigger-area');
                
                const sidebar = new bootstrap.Offcanvas(offcanvasElement, {
                    backdrop: false,
                    scroll: true
                });

                let isManualOpen = false; 

                // ------------------------------------
                // 1. LOGIKA KONTEN BERGESER
                // ------------------------------------
                // Menambahkan kelas saat sidebar terbuka
                offcanvasElement.addEventListener('shown.bs.offcanvas', function () {
                    pageContent.classList.add('sidebar-open');
                });

                // Menghapus kelas saat sidebar tertutup
                offcanvasElement.addEventListener('hidden.bs.offcanvas', function () {
                    pageContent.classList.remove('sidebar-open');
                });
                
                // ------------------------------------
                // 2. LOGIKA TOGGLE MANUAL
                // ------------------------------------
                const sidebarToggle = document.getElementById('sidebarToggle');
                sidebarToggle.addEventListener('click', function() {
                    // Toggle status manual
                    isManualOpen = !offcanvasElement.classList.contains('show'); 
                });
                
                // ------------------------------------
                // 3. LOGIKA HOVER OTOMATIS
                // ------------------------------------
                
                // BUKA: Saat kursor masuk ke area pemicu
                triggerArea.addEventListener('mouseenter', function() {
                    if (!offcanvasElement.classList.contains('show') && !isManualOpen) {
                        sidebar.show();
                    }
                });

                // TUTUP: Saat kursor meninggalkan offcanvas (sidebar)
                offcanvasElement.addEventListener('mouseleave', function() {
                    if (!isManualOpen) {
                        sidebar.hide();
                    }
                });
                
                // Reset status isManualOpen jika ditutup oleh tombol/ESC
                offcanvasElement.addEventListener('hide.bs.offcanvas', function() {
                    if (isManualOpen) {
                        isManualOpen = false;
                    }
                });


            });
        </script>

    </body>
</html>