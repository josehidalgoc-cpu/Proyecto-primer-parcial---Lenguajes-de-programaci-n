<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index()
    {
        $folders = Folder::where('user_id', auth()->id())
            ->withCount(['identities', 'secureNotes', 'cards', 'logins'])
            ->latest()
            ->get();

        return view('folders.index', compact('folders'));
    }

    public function create()
    {
        return view('folders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Folder::create([
            'user_id' => auth()->id(),
            'name'    => $request->name,
        ]);

        return redirect()->route('folders.index')->with('success', 'Carpeta creada correctamente.');
    }

    public function show(Folder $folder)
    {
        abort_if($folder->user_id !== auth()->id(), 403);

        $folder->load(['identities', 'secureNotes', 'cards', 'logins']);

        return view('folders.show', compact('folder'));
    }

    public function edit(Folder $folder)
    {
        abort_if($folder->user_id !== auth()->id(), 403);
        return view('folders.edit', compact('folder'));
    }

    public function update(Request $request, Folder $folder)
    {
        abort_if($folder->user_id !== auth()->id(), 403);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $folder->update([
            'name' => $request->name,
        ]);

        return redirect()->route('folders.index')->with('success', 'Carpeta actualizada correctamente.');
    }

    public function destroy(Folder $folder)
    {
        abort_if($folder->user_id !== auth()->id(), 403);
        $folder->delete();
        return redirect()->route('folders.index')->with('success', 'Carpeta eliminada. Los items que contenía ya no están agrupados, pero siguen en tu bóveda.');
    }
}