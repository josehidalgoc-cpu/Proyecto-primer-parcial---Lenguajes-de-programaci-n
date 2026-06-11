<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Login::where('user_id', auth()->id());

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $logins = $query->latest()->get();

        return view('logins.index', compact('logins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('logins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'              => 'required|string|max:255',
            'username'           => 'nullable|string|max:255',
            'password_encrypted' => 'required|string',
            'url'                => 'nullable|url',
            'notes'              => 'nullable|string',
        ]);

        Login::create([
            'user_id'            => auth()->id(),
            'title'              => $request->title,
            'username'           => $request->username,
            'password_encrypted' => $request->password_encrypted,
            'url'                => $request->url,
            'notes'              => $request->notes,
        ]);

        return redirect()->route('logins.index')->with('success', 'Login guardado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         abort_if($login->user_id !== auth()->id(), 403);

        return view('logins.edit', compact('login'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if($login->user_id !== auth()->id(), 403);

        $request->validate([
            'title'              => 'required|string|max:255',
            'username'           => 'nullable|string|max:255',
            'password_encrypted' => 'required|string',
            'url'                => 'nullable|url',
            'notes'              => 'nullable|string',
        ]);

        $login->update([
            'title'              => $request->title,
            'username'           => $request->username,
            'password_encrypted' => $request->password_encrypted,
            'url'                => $request->url,
            'notes'              => $request->notes,
        ]);

        return redirect()->route('logins.index')->with('success', 'Login actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if($login->user_id !== auth()->id(), 403);

        $login->delete();

        return redirect()->route('logins.index')->with('success', 'Login eliminado correctamente.');
    }
}
