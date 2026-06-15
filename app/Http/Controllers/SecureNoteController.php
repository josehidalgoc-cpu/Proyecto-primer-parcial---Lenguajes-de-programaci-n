<?php

namespace App\Http\Controllers;

use App\Models\SecureNote;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SecureNoteController extends Controller
{
    public function index(Request $request)
    {
        $query = SecureNote::where('user_id', auth()->id())->with('folder');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $secureNotes = $query->latest()->get();

        return view('secure-notes.index', compact('secureNotes'));
    }

    public function create()
    {
        $folders = Folder::where('user_id', auth()->id())->orderBy('name')->get();
        return view('secure-notes.create', compact('folders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'content_encrypted' => 'required|string',
            'folder_id'         => ['nullable', Rule::exists('folders', 'id')->where('user_id', auth()->id())],
        ]);

        SecureNote::create([
            'user_id'           => auth()->id(),
            'folder_id'         => $request->folder_id,
            'title'             => $request->title,
            'content_encrypted' => $request->content_encrypted,
        ]);

        return redirect()->route('secure-notes.index')->with('success', 'Nota guardada correctamente.');
    }

    public function show(SecureNote $secureNote)
    {
        abort_if($secureNote->user_id !== auth()->id(), 403);
        return view('secure-notes.show', compact('secureNote'));
    }

    public function edit(SecureNote $secureNote)
    {
        abort_if($secureNote->user_id !== auth()->id(), 403);
        $folders = Folder::where('user_id', auth()->id())->orderBy('name')->get();
        return view('secure-notes.edit', compact('secureNote', 'folders'));
    }

    public function update(Request $request, SecureNote $secureNote)
    {
        abort_if($secureNote->user_id !== auth()->id(), 403);

        $request->validate([
            'title'             => 'required|string|max:255',
            'content_encrypted' => 'required|string',
            'folder_id'         => ['nullable', Rule::exists('folders', 'id')->where('user_id', auth()->id())],
        ]);

        $secureNote->update([
            'folder_id'         => $request->folder_id,
            'title'             => $request->title,
            'content_encrypted' => $request->content_encrypted,
        ]);

        return redirect()->route('secure-notes.index')->with('success', 'Nota actualizada correctamente.');
    }

    public function destroy(SecureNote $secureNote)
    {
        abort_if($secureNote->user_id !== auth()->id(), 403);
        $secureNote->delete();
        return redirect()->route('secure-notes.index')->with('success', 'Nota eliminada correctamente.');
    }
}