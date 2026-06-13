<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Card;
use App\Models\SecureNote;
use App\Models\Identity;

class DashboardController extends Controller
{
    public function index() {

        $user = auth()->user();

        $totalLogins = $user->logins()->count();
        $totalCards = $user->cards()->count();
        $totalNotes = $user->secureNotes()->count();
        $totalIdentities = $user->identities()->count();
        
        $recentLogins = $user->logins()->latest()->take(5)->get()->map(function ($item) {
            return ['title' => $item->title, 'type' => 'Login', 'date' => $item->created_at, 'route' => 'logins.index'];
        });

        $recentCards = $user->cards()->latest()->take(5)->get()->map(function ($item) {
            return ['title' => $item->cardholder_name, 'type' => 'Tarjeta', 'date' => $item->created_at, 'route' => 'cards.index'];
        });

        $recentNotes = $user->secureNotes()->latest()->take(5)->get()->map(function ($item) {
            return ['title' => $item->title, 'type' => 'Nota', 'date' => $item->created_at, 'route' => 'secure-notes.index'];
        });

        $recentIdentities = $user->identities()->latest()->take(5)->get()->map(function ($item) {
            return ['title' => $item->title, 'type' => 'Identidad', 'date' => $item->created_at, 'route' => 'identities.index'];
        });

        $recentActivity = $recentLogins->concat($recentCards)->concat($recentNotes)->concat($recentIdentities)->sortByDesc('date')->take(6)->values();

        return view('dashboard', compact(
            'totalLogins', 'totalCards', 'totalNotes', 'totalIdentities', 'recentActivity'
        ));

    }
}