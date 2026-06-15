<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Folder;
use Illuminate\Validation\Rule;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::where('user_id', auth()->id())->with('folder')->latest()->get();

        return view('cards.index', compact('cards'));
    }

    public function create()
    {
        if (!auth()->user()->is_premium) {
            return redirect()->route('upgrade.show')
            ->with('warning', 'Suscríbete a Premium para guardar tarjetas.');
        }

        $folders = Folder::where('user_id', auth()->id())->orderBy('name')->get();

        return view('cards.create', compact('folders'));
    }

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
            'folder_id'             => ['nullable', Rule::exists('folders', 'id')->where('user_id', auth()->id())],
        ]);

        Card::create([
            'user_id'               => auth()->id(),
            'folder_id'             => $request->folder_id,
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

    public function show(string $id)
    {
        $card = Card::findOrFail($id);
        abort_if($card->user_id !== auth()->id(), 403);

        return view('cards.show', compact('card'));
    }

    public function edit(string $id)
    {
        $card = Card::findOrFail($id);
        abort_if($card->user_id !== auth()->id(), 403);

        $folders = Folder::where('user_id', auth()->id())->orderBy('name')->get();

        return view('cards.edit', compact('card', 'folders'));
    }

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
            'folder_id'             => ['nullable', Rule::exists('folders', 'id')->where('user_id', auth()->id())],
        ]);

        $card->update([
            'folder_id'             => $request->folder_id,
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

    public function destroy(string $id)
    {
        $card = Card::findOrFail($id);
        abort_if($card->user_id !== auth()->id(), 403);

        $card->delete();

        return redirect()->route('cards.index')->with('success', 'Tarjeta eliminada correctamente.');
    }
}