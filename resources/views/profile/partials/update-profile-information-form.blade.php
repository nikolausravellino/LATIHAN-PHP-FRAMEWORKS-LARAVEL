<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold leading-tight text-gray-900 dark:text-white sm:text-4xl">
            <i class="fas fa-user-edit mr-2 text-yellow-500"></i> Edit Profil
        </h2>
        <p class="mt-2 text-lg text-gray-600 dark:text-gray-300">Perbarui informasi pribadi Anda dan kelola keamanan akun.</p>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Bagian Informasi Profil -->
            <div class="transform-gpu overflow-hidden rounded-[20px] bg-white p-8 shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl dark:bg-gray-800 border border-gray-200 dark:border-gray-700 mb-8">
                <div class="text-center">
                    <h4 class="mt-4 text-2xl font-bold text-gray-900 dark:text-white">Kelola Informasi Profil</h4>
                    <p class="text-lg text-gray-600 dark:text-gray-400">Perbarui data Anda untuk pengalaman terbaik.</p>
                </div>

                <!-- Form utama tanpa aksi, hanya untuk menampilkan input -->
                <div class="mt-6 space-y-6" id="profile-display-form">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <!-- Nama Pengguna (Username) -->
                        <div class="relative">
                            <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Nama Pengguna</label>
                            <div class="input-group">
                                <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name"
                                    class="form-input pl-12 border-4 border-gray-400 dark:border-gray-500">
                                <i class="fas fa-user input-icon"></i>
                            </div>
                            @error('name')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="relative">
                            <label for="full_name" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Nama Lengkap</label>
                            <div class="input-group">
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name', Auth::user()->full_name) }}" required autocomplete="full_name"
                                    class="form-input pl-12 border-4 border-gray-400 dark:border-gray-500">
                                <i class="fas fa-signature input-icon"></i>
                            </div>
                            @error('full_name')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIM -->
                        <div class="relative">
                            <label for="nim" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">NIM</label>
                            <div class="input-group">
                                <input type="text" id="nim" name="nim" value="{{ old('nim', Auth::user()->nim) }}" required autocomplete="nim"
                                    class="form-input pl-12 border-4 border-gray-400 dark:border-gray-500">
                                <i class="fas fa-hashtag input-icon"></i>
                            </div>
                            @error('nim')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="relative">
                            <label for="birth_place" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Tempat Lahir</label>
                            <div class="input-group">
                                <input type="text" id="birth_place" name="birth_place" value="{{ old('birth_place', Auth::user()->birth_place) }}" required autocomplete="birth_place"
                                    class="form-input pl-12 border-4 border-gray-400 dark:border-gray-500">
                                <i class="fas fa-map-marker-alt input-icon"></i>
                            </div>
                            @error('birth_place')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="relative">
                            <label for="birth_date" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Tanggal Lahir</label>
                            <div class="input-group">
                                <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', Auth::user()->birth_date) }}" required autocomplete="birth_date"
                                    class="form-input pl-12 border-4 border-gray-400 dark:border-gray-500">
                                <i class="fas fa-calendar-alt input-icon"></i>
                            </div>
                            @error('birth_date')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <hr class="my-8 border-t border-gray-200 dark:border-gray-700">

                    <div class="flex items-center gap-4">
                        <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="#confirmUpdateModal">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Modal Konfirmasi Pembaruan Profil -->
<div class="modal fade" id="confirmUpdateModal" tabindex="-1" aria-labelledby="confirmUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border border-info border-3">
            <form method="post" action="{{ route('profile.update') }}" id="update-form">
                @csrf
                @method('patch')

                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title text-info" id="confirmUpdateLabel">
                        <i class="fas fa-info-circle me-2"></i> Konfirmasi Pembaruan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body pt-0">
                    <p class="text-muted mt-3">
                        Apakah anda sudah yakin untuk mengisi perubahan biodata anda? Mohon masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin melakukan perubahan.
                    </p>

                    <div class="mb-3">
                        <label for="current_password" class="form-label visually-hidden">Kata Sandi</label>
                        <input
                            id="current_password"
                            name="current_password"
                            type="password"
                            class="form-control"
                            placeholder="Kata Sandi Anda"
                        />
                        @error('current_password', 'updateProfile')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Input tersembunyi untuk data formulir -->
                    <input type="hidden" name="name" id="modal-name">
                    <input type="hidden" name="full_name" id="modal-full_name">
                    <input type="hidden" name="nim" id="modal-nim">
                    <input type="hidden" name="birth_place" id="modal-birth_place">
                    <input type="hidden" name="birth_date" id="modal-birth_date">
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info ms-3">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.getElementById('confirmUpdateModal');
        modalElement.addEventListener('show.bs.modal', function() {
            // Salin nilai dari form utama ke input tersembunyi di modal
            document.getElementById('modal-name').value = document.getElementById('name').value;
            document.getElementById('modal-full_name').value = document.getElementById('full_name').value;
            document.getElementById('modal-nim').value = document.getElementById('nim').value;
            document.getElementById('modal-birth_place').value = document.getElementById('birth_place').value;
            document.getElementById('modal-birth_date').value = document.getElementById('birth_date').value;
        });
    });
</script>
