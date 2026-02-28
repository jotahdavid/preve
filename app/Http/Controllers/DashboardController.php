<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

final class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $user = Auth::user();
        $now = now();

        $latestTransactions = $user
            ->transactions()
            ->with('category')
            ->limit(5)
            ->orderBy('transaction_date', 'desc')
            ->get();

        $totalIncome = $user->transactions()->inMonth($now)->paid($now)->income()->sum('amount');
        $totalExpenses = $user->transactions()->inMonth($now)->paid($now)->expense()->sum('amount');
        $availableBalance = $totalIncome - $totalExpenses;

        $pendingExpenses = $user->transactions()->inMonth($now)->pending($now)->expense()->sum('amount');
        $forecast = $availableBalance - $pendingExpenses;

        return Inertia::render('Dashboard', compact(
            'latestTransactions',
            'availableBalance',
            'forecast',
        ));
    }
}
