<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $query = Login::where('user_id', auth()->id())->with('folder');

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

        $folders = Folder::where('user_id', auth()->id())->orderBy('name')->get();

        return view('logins.create', compact('folders'));
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
            'folder_id'          => ['nullable', Rule::exists('folders', 'id')->where('user_id', auth()->id())],
        ]);

        Login::create([
            'user_id'            => auth()->id(),
            'folder_id'          => $request->folder_id,
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
        $folders = Folder::where('user_id', auth()->id())->orderBy('name')->get();
        return view('logins.edit', compact('login', 'folders'));
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
            'folder_id'          => ['nullable', Rule::exists('folders', 'id')->where('user_id', auth()->id())],
        ]);

        $login->update([
            'folder_id'          => $request->folder_id,
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