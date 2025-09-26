<x-app-layout>
    <x-slot name="header">
        <h2 class="h3 fw-bold text-primary-brand">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard Utama
        </h2>
        <p class="text-muted mb-0">Selamat datang, {{ Auth::user()->name }}! Ringkasan cepat informasi profil Anda.</p>
    </x-slot>

    <div class="row justify-content-center g-4">
        
        <div class="col-md-4">
            <div class="card shadow-lg border-0 h-100 profile-card-hover">
                <div class="card-body text-center py-5">
                    
                    @if(Auth::user()->photo)
                        <img 
                            src="{{ asset('storage/' . Auth::user()->photo) }}" 
                            alt="Foto Profil {{ Auth::user()->name }}"
                            class="rounded-circle mb-3 flex-shrink-0 profile-avatar" 
                            style="width: 130px; height: 130px; object-fit: cover;"
                        >
                    @else
                        <div class="rounded-circle mx-auto mb-3 flex-shrink-0 d-flex align-items-center justify-content-center text-white profile-avatar avatar-placeholder">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif

                    <h4 class="card-title fw-bold text-primary-brand mt-3 hover-text-blue">Selamat datang!</h4>
                    <h5 class="text-dark">{{ Auth::user()->name }}</h5>
                    <p class="text-muted small mt-3">Perbarui data Anda untuk pengalaman terbaik.</p>
                    
                </div>
                <div class="card-footer bg-light border-0 py-3">
                    <a href="{{ route('profile.edit') }}" class="btn btn-warning btn-lg w-100 animate-btn-hover">
                        <i class="fas fa-user-edit me-2"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-lg border-0 h-100 profile-card-hover">
                <div class="card-header bg-gradient-brand text-white d-flex align-items-center fw-bold py-3">
                    <i class="fas fa-id-card me-2"></i> Detail Informasi Pribadi
                </div>
                <div class="card-body p-4 info-grid-container">
                    <div class="row g-4">
                        
                        <div class="col-md-6">
                            <div class="info-item item-blue-border">
                                <strong class="text-primary-brand d-block mb-1"><i class="fas fa-signature me-2"></i> Nama Lengkap:</strong>
                                {{ Auth::user()->full_name }}
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-item item-secondary-border">
                                <strong class="text-secondary-brand d-block mb-1"><i class="fas fa-hashtag me-2"></i> NIM:</strong>
                                {{ Auth::user()->nim }}
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-item item-blue-border">
                                <strong class="text-primary-brand d-block mb-1"><i class="fas fa-envelope me-2"></i> Email:</strong>
                                {{ Auth::user()->email }}
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-item item-secondary-border">
                                <strong class="text-secondary-brand d-block mb-1"><i class="fas fa-map-marker-alt me-2"></i> Tempat Lahir:</strong>
                                {{ Auth::user()->birth_place }}
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-item item-blue-border">
                                <strong class="text-primary-brand d-block mb-1"><i class="fas fa-calendar-alt me-2"></i> Tanggal Lahir:</strong>
                                {{ \Carbon\Carbon::parse(Auth::user()->birth_date)->isoFormat('D MMMM YYYY') }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item item-secondary-border">
                                <strong class="text-secondary-brand d-block mb-1"><i class="fas fa-check-circle me-2"></i> Status Akun:</strong>
                                Aktif & Terverifikasi
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end small text-muted py-3">
                    <i class="fas fa-history me-1"></i> Data diperbarui: {{ \Carbon\Carbon::parse(Auth::user()->updated_at)->isoFormat('LLL') }}
                </div>
            </div>
        </div>
        
    </div>

    <style>
        /* Warna Brand */
        .text-primary-brand {
            color: #004494 !important;
        }
        .text-secondary-brand {
            color: #0066cc !important;
        }
        .bg-gradient-brand {
            background: linear-gradient(135deg, #004494 0%, #0066cc 100%);
        }
        
        /* Glassmorphism Card Style */
        .profile-card-hover {
             border-radius: 20px !important;
             overflow: hidden;
             background: rgba(255, 255, 255, 0.95);
             backdrop-filter: blur(10px);
             transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .profile-card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25) !important;
        }
        
        /* Profile Avatar */
        .profile-avatar {
            border: 5px solid #004494; 
            box-shadow: 0 8px 16px rgba(0, 68, 148, 0.15); 
            transition: all 0.3s ease;
        }
        .avatar-placeholder {
            font-weight: bold; 
            background: linear-gradient(135deg, #004494 0%, #0066cc 100%);
        }

        /* Info Item Grid */
        .info-grid-container {
            background: linear-gradient(135deg, #f0f8ff 0%, #e6f3ff 100%); 
            border-radius: 15px; 
            border: 1px solid rgba(0, 68, 148, 0.1);
        }

        .info-item {
            color: #333; 
            font-size: 1.1rem; 
            padding: 1rem; 
            background: white; 
            border-radius: 10px; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.05); 
            border-left: 4px solid; 
            cursor: default; 
            transition: all 0.3s ease;
        }
        .item-blue-border {
            border-left-color: #004494;
        }
        .item-secondary-border {
            border-left-color: #0066cc;
        }
    </style>
</x-app-layout>