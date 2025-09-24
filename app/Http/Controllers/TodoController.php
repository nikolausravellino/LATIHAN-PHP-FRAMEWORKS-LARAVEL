<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Menampilkan daftar semua ToDo.
     */
    public function index()
    {
        $todos = Todo::orderBy('completed')->orderByDesc('created_at')->get();
        return view('todos.index', compact('todos'));
    }

    /**
     * Menampilkan form untuk membuat ToDo baru.
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Menyimpan ToDo baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('todos.index')->with('success', 'ToDo berhasil dibuat!');
    }

    /**
     * Menampilkan form untuk mengedit ToDo yang ada.
     */
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    /**
     * Memperbarui ToDo di database.
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $completed = $request->has('completed');

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $completed,
            'completed_at' => $completed? now() : null,
        ]);

        return redirect()->route('todos.index')->with('success', 'ToDo berhasil diperbarui!');
    }

    /**
     * Menghapus ToDo dari database.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')->with('success', 'ToDo berhasil dihapus!');
    }
}
