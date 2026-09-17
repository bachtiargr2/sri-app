<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureScoredDebtor
{
    /**
     * Handle an incoming request.
     * Pastikan user memiliki skor pemeringkatan (Tahap 3) aktif sebelum mengakses Tahap 4, 5, dan 6.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $scoring = $user->creditScoring;
        $hasCharacter = $user->questionnaires()->where('category', 'entrepreneurship_character')->count() >= 20;
        $hasFinancial = $user->financialReports()->count() >= 3;

        if (!$scoring || !$hasCharacter || !$hasFinancial) {
            return redirect()->route('dashboard')->with('error', 'Akses Terkunci: Anda harus menyelesaikan Pengisian Data (Tahap 2) dan Pemeringkatan (Tahap 3) terlebih dahulu sebelum dapat mengajukan fasilitas kredit atau penjaminan.');
        }

        return $next($request);
    }
}
