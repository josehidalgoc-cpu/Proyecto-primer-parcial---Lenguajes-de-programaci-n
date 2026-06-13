<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $query = Login::where('user_id', auth()->id());

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $logins = $query->latest()->get();

        return view('logins.index', compact('logins'));
    }

    public function create()
    {
        if (!auth()->user()->is_premium) {
            return redirect()->route('upgrade.show')
                ->with('warning', 'Suscríbete a Premium para guardar logins.');
        }

        return view('logins.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->is_premium) {
            return redirect()->route('upgrade.show')
                ->with('warning', 'Suscríbete a Premium para guardar logins.');
        }

        $request->validate([
            'title'              => 'required|string|max:255',
            'username'           => 'nullable|string|max:255',
            'email'              => 'nullable|email|max:255',
            'password_encrypted' => 'required|string',
            'url'                => 'nullable|url',
            'notes'              => 'nullable|string',
        ]);

        Login::create([
            'user_id'            => auth()->id(),
            'title'              => $request->title,
            'username'           => $request->username,
            'email'              => $request->email,
            'password_encrypted' => $request->password_encrypted,
            'url'                => $request->url,
            'notes'              => $request->notes,
        ]);

        return redirect()->route('logins.index')->with('success', 'Login guardado correctamente.');
    }

    public function show(Login $login)
    {
        abort_if($login->user_id !== auth()->id(), 403);
        return view('logins.show', compact('login'));
    }

    public function edit(Login $login)
    {
        abort_if($login->user_id !== auth()->id(), 403);
        return view('logins.edit', compact('login'));
    }

    public function update(Request $request, Login $login)
    {
        abort_if($login->user_id !== auth()->id(), 403);

        $request->validate([
            'title'              => 'required|string|max:255',
            'username'           => 'nullable|string|max:255',
            'email'              => 'nullable|email|max:255',
            'password_encrypted' => 'required|string',
            'url'                => 'nullable|url',
            'notes'              => 'nullable|string',
        ]);

        $login->update([
            'title'              => $request->title,
            'username'           => $request->username,
            'email'              => $request->email,
            'password_encrypted' => $request->password_encrypted,
            'url'                => $request->url,
            'notes'              => $request->notes,
        ]);

        return redirect()->route('logins.index')->with('success', 'Login actualizado correctamente.');
    }

    public function destroy(Login $login)
    {
        abort_if($login->user_id !== auth()->id(), 403);
        $login->delete();
        return redirect()->route('logins.index')->with('success', 'Login eliminado correctamente.');
    }
}