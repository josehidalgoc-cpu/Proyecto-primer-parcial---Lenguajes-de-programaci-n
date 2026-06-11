<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = Card::where('user_id', auth()->id())->latest()->get();

        return view('cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cardholder_name'       => 'required|string|max:255',
            'card_number_encrypted' => 'required|string',
            'expiry_month'          => 'required|string|size:2',
            'expiry_year'           => 'required|string|size:4',
            'cvv_encrypted'         => 'nullable|string',
            'brand'                 => 'nullable|string|max:20',
            'notes'                 => 'nullable|string',
        ]);

        Card::create([
            'user_id'               => auth()->id(),
            'cardholder_name'       => $request->cardholder_name,
            'card_number_encrypted' => $request->card_number_encrypted,
            'expiry_month'          => $request->expiry_month,
            'expiry_year'           => $request->expiry_year,
            'cvv_encrypted'         => $request->cvv_encrypted,
            'brand'                 => $request->brand,
            'notes'                 => $request->notes,
        ]);

        return redirect()->route('cards.index')->with('success', 'Tarjeta guardada correctamente.');
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
        abort_if($card->user_id !== auth()->id(), 403);

        return view('cards.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if($card->user_id !== auth()->id(), 403);

        $request->validate([
            'cardholder_name'       => 'required|string|max:255',
            'card_number_encrypted' => 'required|string',
            'expiry_month'          => 'required|string|size:2',
            'expiry_year'           => 'required|string|size:4',
            'cvv_encrypted'         => 'nullable|string',
            'brand'                 => 'nullable|string|max:20',
            'notes'                 => 'nullable|string',
        ]);

        $card->update([
            'cardholder_name'       => $request->cardholder_name,
            'card_number_encrypted' => $request->card_number_encrypted,
            'expiry_month'          => $request->expiry_month,
            'expiry_year'           => $request->expiry_year,
            'cvv_encrypted'         => $request->cvv_encrypted,
            'brand'                 => $request->brand,
            'notes'                 => $request->notes,
        ]);

        return redirect()->route('cards.index')->with('success', 'Tarjeta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if($card->user_id !== auth()->id(), 403);

        $card->delete();

        return redirect()->route('cards.index')->with('success', 'Tarjeta eliminada correctamente.');
    }
}
