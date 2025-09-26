<section class="p-0">
    <header class="mb-4">
        <h2 class="h4 fw-bold text-danger">
            Hapus Akun
        </h2>

        <p class="mt-1 text-muted">
            Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
        </p>
    </header>

    <button type="button" class="btn btn-danger btn-lg shadow-sm" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        <i class="fas fa-trash-alt me-2"></i> Hapus Akun
    </button>

    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border border-danger border-3">
                <form method="post" action="{{ route('profile.destroy') }}" class="p-3">
                    @csrf
                    @method('delete')

                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title text-danger" id="confirmUserDeletionLabel">
                            <i class="fas fa-exclamation-triangle me-2"></i> Apakah Anda yakin ingin menghapus akun Anda?
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body pt-0">
                        <p class="text-muted mt-3">
                            Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Mohon masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label visually-hidden">Kata Sandi</label> 
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control"
                                placeholder="Kata Sandi Anda"
                            />
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        
                        <button type="submit" class="btn btn-danger ms-3">
                            Hapus Akun Permanen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>