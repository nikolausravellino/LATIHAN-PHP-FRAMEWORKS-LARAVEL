<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat ToDo Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#4a4e4d] font-sans antialiased">
    <div class="container mx-auto p-8">
        <div class="bg-gradient-to-br from-[#f6cd61] to-[#fe8a71] rounded-xl shadow-lg p-6 animate-fadeIn">
            <h1 class="text-3xl font-bold text-[#4a4e4d] mb-6">Buat ToDo Baru</h1>
            
            <form action="{{ route('todos.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-[#4a4e4d] font-bold mb-2">Judul ToDo</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full px-3 py-2 border border-[#4a4e4d] bg-white/50 text-[#4a4e4d] rounded-md shadow-sm placeholder-[#4a4e4d] focus:outline-none focus:ring-2 focus:ring-[#0e9aa7] focus:border-[#0e9aa7] sm:text-sm" required>
                    @error('title')
                        <p class="text-red-600 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="description" class="block text-[#4a4e4d] font-bold mb-2">Keterangan</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full px-3 py-2 border border-[#4a4e4d] bg-white/50 text-[#4a4e4d] rounded-md shadow-sm placeholder-[#4a4e4d] focus:outline-none focus:ring-2 focus:ring-[#0e9aa7] focus:border-[#0e9aa7] sm:text-sm"></textarea>
                </div>
                
                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-[#0e9aa7] hover:bg-[#3da4ab] text-white font-semibold py-2 px-4 rounded-lg transform transition duration-300 hover:scale-105">
                        Simpan ToDo
                    </button>
                    <a href="{{ route('todos.index') }}" class="ml-2 bg-[#4a4e4d] hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transform transition duration-300 hover:translate-y-px">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>