<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            
            <div class="row align-items-center">
                
                <div class="col-2 text-start">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
                        <i class="fas fa-arrow-left me-1"></i> Dashboard
                    </a>
                </div>
                
                <div class="col-8 text-center">
                    <h2 class="h3 fw-bold text-primary-brand mb-0">
                        <i class="fas fa-user-circle me-2"></i> Pengaturan Akun
                    </h2>
                    <p class="text-muted small mb-0">Kelola informasi profil, password, dan keamanan akun Anda.</p>
                </div>
                
                <div class="col-2">
                    </div>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            
            <div class="col-md-8">
                
                <div class="card shadow-lg mb-4 border-0 rounded-3">
                    <div class="card-header bg-gradient-brand text-white fw-bold py-3 rounded-top-3">
                        <i class="fas fa-info-circle me-2"></i> Informasi Profil
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card shadow-lg mb-4 border-0 rounded-3">
                    <div class="card-header bg-primary text-white fw-bold py-3 rounded-top-3">
                        <i class="fas fa-key me-2"></i> Perbarui Password
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="card shadow-lg mb-4 border-0 rounded-3">
                    <div class="card-header bg-danger text-white fw-bold py-3 rounded-top-3">
                        <i class="fas fa-trash-alt me-2"></i> Hapus Akun
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <style>
        .text-primary-brand {
            color: #004494 !important;
        }
        .bg-gradient-brand {
            background: linear-gradient(135deg, #004494 0%, #0066cc 100%);
        }
        .card-header.rounded-top-3 {
            border-top-left-radius: 0.3rem !important; 
            border-top-right-radius: 0.3rem !important;
        }
    </style>
</x-app-layout>