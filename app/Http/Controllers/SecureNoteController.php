<?php

namespace App\Http\Controllers;

use App\Models\SecureNote;
use Illuminate\Http\Request;


class SecureNoteController extends Controller
{
    
    public function index(Request $request)
    {
        $query = SecureNote::where('user_id', auth()->id());

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $secureNotes = $query->latest()->get();
        return view('secure-notes.index', compact('secureNotes'));
    }

    public function create()
    {
        return view('secure-notes.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content_encrypted' => 'required|string',
        ]);

        SecureNote::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content_encrypted' => $request->content_encrypted,
        ]);

        return redirect()->route('secure-notes.index')->with('success', 'Nota guardada correctamente.');
    }
    

    public function show(SecureNote $secureNote)
    {
        abort_if($secureNote->user_id !== auth()->id(), 403);
        return view('secure-notes.show', compact('secureNote'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SecureNote $secureNote)
    {
        abort_if($secureNote->user_id !== auth()->id(), 403);
        return view('secure-notes.edit', compact('secureNote'));
    }

    
    public function update(Request $request, SecureNote $secureNote)
    {
        abort_if($secureNote->user_id !== auth()->id(), 403);

        $request->validate([
            'title' => 'required|string|max:255',
            'content_encrypted' => 'required|string',
        ]);

        $secureNote->update([
            'title' => $request->title,
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
