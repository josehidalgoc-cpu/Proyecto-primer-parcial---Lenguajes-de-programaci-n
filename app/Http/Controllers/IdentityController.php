<?php

namespace App\Http\Controllers;

use App\Models\Identity;
use Illuminate\Http\Request;

class IdentityController extends Controller
{
    public function index(Request $request) {

        $query = Identity::where('user_id', auth()->id());

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $identities = $query->latest()->get();

        return view('identities.index', compact('identities'));

    }

    public function create() {

        return view('identities.create');

    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required|string|max:255',
            'full_name' => 'nullable|string|max:255',
            'username' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'company' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Identity::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'company' => $request->company,
            'notes' => $request->notes,
        ]);

        return redirect()->route('identities.index')->with('success', 'Identidad guardada correctamente.');

    }

    public function show(Identity $identity){

        abort_if($identity->user_id !== auth()->id(), 403);
        return view('identities.show', compact('identity'));
    
    }

    public function edit(Identity $identity){

        abort_if($identity->user_id !== auth()->id(), 403);
        return view('identities.edit', compact('identity'));
    
    }

    public function update(Request $request, Identity $identity) {
        
        abort_if($identity->user_id !== auth()->id(), 403);

        $request->validate([
            'title' => 'required|string|max:255',
            'full_name' => 'nullable|string|max:255',
            'username' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'company' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $identity->update([
            'title' => $request->title,
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'company' => $request->company,
            'notes' => $request->notes,
        ]);

        return redirect()->route('identities.index')->with('success', 'Identidad actualizada correctamente.');

    }

    public function destroy(Identity $identity){

        abort_if($identity->user_id !== auth()->id(), 403);
        $identity->delete();
        return redirect()->route('identities.index')->with('success', 'Identidad eliminada correctamente.');
        
    }
}