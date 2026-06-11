<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Card;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLogins = Login::where('user_id', auth()->id())->count();
        $totalCards  = Card::where('user_id', auth()->id())->count();

        return view('dashboard', compact('totalLogins', 'totalCards'));
    }
}