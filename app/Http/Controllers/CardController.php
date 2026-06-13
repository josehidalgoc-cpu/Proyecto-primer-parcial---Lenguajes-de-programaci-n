<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

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
        if (!auth()->user()->is_premium) {
            return redirect()->route('upgrade.show')
            ->with('warning', 'Suscríbete a Premium para guardar tarjetas.');
        }
        return view('cards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->has('card_number_encrypted')) {
            $request->merge([
                'card_number_encrypted' => preg_replace('/\D/', '', $request->card_number_encrypted)
            ]);
        }

        $request->validate([
            'cardholder_name'       => 'required|string|max:255',
            'card_number_encrypted' => 'required|numeric|digits_between:12,19',
            'expiry_month'          => 'required|numeric|between:01,12',
            'expiry_year'           => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    $month = intval($request->expiry_month);
                    $year = intval($value);

                    // Normalizar año si viene en formato AA (ej: 26 -> 2026)
                    if ($year < 100) {
                        $year += 2000;
                    }

                    $currentYear = intval(date('Y'));
                    $currentMonth = intval(date('m'));

                    if ($year < $currentYear || ($year === $currentYear && $month < $currentMonth)) {
                        $fail('La fecha de expiración debe ser posterior o igual a la fecha actual.');
                    }
                }
            ],
            'cvv_encrypted'         => 'nullable|numeric|digits_between:3,4',
            'brand'                 => 'nullable|string|max:20',
            'notes'                 => 'nullable|string',
        ]);

        Card::create([
            'user_id'               => auth()->id(),
            'cardholder_name'       => $request->cardholder_name,
            'card_number_encrypted' => $request->card_number_encrypted,
            'expiry_month'          => str_pad($request->expiry_month, 2, '0', STR_PAD_LEFT),
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
        $card = Card::findOrFail($id);
        abort_if($card->user_id !== auth()->id(), 403);

        return view('cards.show', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $card = Card::findOrFail($id);

        abort_if($card->user_id !== auth()->id(), 403);

        return view('cards.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $card = Card::findOrFail($id);
        abort_if($card->user_id !== auth()->id(), 403);

        if ($request->has('card_number_encrypted')) {
            $request->merge([
                'card_number_encrypted' => preg_replace('/\D/', '', $request->card_number_encrypted)
            ]);
        }

        $request->validate([
            'cardholder_name'       => 'required|string|max:255',
            'card_number_encrypted' => 'required|numeric|digits_between:12,19',
            'expiry_month'          => 'required|numeric|between:01,12',
            'expiry_year'           => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    $month = intval($request->expiry_month);
                    $year = intval($value);

                    if ($year < 100) {
                        $year += 2000;
                    }

                    $currentYear = intval(date('Y'));
                    $currentMonth = intval(date('m'));

                    if ($year < $currentYear || ($year === $currentYear && $month < $currentMonth)) {
                        $fail('La fecha de expiración debe ser posterior o igual a la fecha actual.');
                    }
                }
            ],
            'cvv_encrypted'         => 'nullable|numeric|digits_between:3,4',
            'brand'                 => 'nullable|string|max:20',
            'notes'                 => 'nullable|string',
        ]);

        $card->update([
            'cardholder_name'       => $request->cardholder_name,
            'card_number_encrypted' => $request->card_number_encrypted,
            'expiry_month'          => str_pad($request->expiry_month, 2, '0', STR_PAD_LEFT),
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
        $card = Card::findOrFail($id);

        abort_if($card->user_id !== auth()->id(), 403);

        $card->delete();

        return redirect()->route('cards.index')->with('success', 'Tarjeta eliminada correctamente.');
    }
}
