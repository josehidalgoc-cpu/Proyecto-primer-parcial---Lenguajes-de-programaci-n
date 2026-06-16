<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpgradeController extends Controller
{
    public function show()
    {
        return view('upgrade.index');
    }

    public function activate(Request $request)
    {
        $request->validate([
            'cardholder_name'  => 'required|string|max:255',
            'card_number'      => 'required|string|size:16',
            'expiry_month'     => 'required|string|size:2',
            'expiry_year'      => 'required|string|size:4',
            'cvv'              => 'required|string|min:3|max:4',
        ]);

        $request->user()->update(['is_premium' => true]);

        return redirect()->route('dashboard')->with('success', '¡Bienvenido a Premium! Ya puedes guardar ilimitados logins y tarjetas.');
    }
}
