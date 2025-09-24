<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar ToDo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .completed {
            text-decoration: line-through;
            color: #6b7280; /* Warna abu-abu */
        }
        /* Custom Keyframes for Animations */
        @keyframes glowing-red {
            0% { box-shadow: 0 0 0 0 rgba(254, 138, 113, 0.7); }
            100% { box-shadow: 0 0 0 10px rgba(254, 138, 113, 0); }
        }
        @keyframes glowing-green {
            0% { box-shadow: 0 0 0 0 rgba(46, 113, 42, 0.7); }
            100% { box-shadow: 0 0 0 10px rgba(46, 113, 42, 0); }
        }
        /* Custom Animation Classes */
        .animate-border-red {
            animation: glowing-red 1.5s infinite;
        }
        .animate-border-green {
            animation: glowing-green 1.5s infinite;
        }
    </style>
</head>
<body class="bg-[#4a4e4d] font-sans antialiased">
    <div class="container mx-auto p-8">
        <div class="bg-[#f6cd61] rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-[#4a4e4d]">Daftar ToDo</h1>
                <a href="{{ route('todos.create') }}" class="bg-[#0e9aa7] hover:bg-[#3da4ab] text-white font-semibold py-2 px-4 rounded-lg transition duration-300">Buat ToDo Baru</a>
            </div>

            @if(session('success'))
                <div class="bg-[#fe8a71] border-l-4 border-[#4a4e4d] text-[#4a4e4d] px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if($todos->isEmpty())
                <p class="text-center text-[#4a4e4d]">Belum ada ToDo. Silakan buat yang baru!</p>
            @else
                <ul class="space-y-4">
                    @foreach($todos as $todo)
                        <li class="p-4 bg-white rounded-lg flex items-center justify-between shadow-sm border-l-4 {{ $todo->completed ? 'border-[#2e712a] animate-border-green' : 'border-[#fe8a71] animate-border-red' }}">
                            <div class="flex-grow">
                                <h2 class="text-xl font-semibold text-[#4a4e4d] {{ $todo->completed ? 'completed' : '' }}">{{ $todo->title }}</h2>
                                <p class="text-[#4a4e4d] {{ $todo->completed ? 'completed' : '' }}">{{ $todo->description }}</p>
                                @if($todo->completed)
                                    <p class="text-xs text-[#2e712a] mt-1">Selesai pada: {{ \Carbon\Carbon::parse($todo->completed_at)->locale('id')->isoFormat('D MMMM YYYY') }}</p>
                                @endif
                            </div>
                            
                            <div class="flex space-x-2">
                                <a href="{{ route('todos.edit', $todo->id) }}" class="text-[#0e9aa7] hover:text-[#3da4ab] transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-7-9l4 4L11 11l-4 4-4-4V5a2 2 0 012-2h11a2 2 0 012 2v4a2 2 0 002-2m-7-9l4 4L11 11" />
                                    </svg>
                                </a>
                                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ToDo ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[#fe8a71] hover:text-[#f6cd61] transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10H8a2 2 0 01-2-2V4a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</body>
</html>