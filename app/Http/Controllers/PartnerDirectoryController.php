<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartnerDirectoryController extends Controller
{
    /**
     * Bab 5: Halaman Direktori Mitra dan Afiliasi SRI (Gambar 39 - 41)
     */
    public function index(Request $request): View
    {
        $category = $request->query('category');
        $track = $request->query('track');
        $query = $request->query('q');

        $partnersQuery = Partner::where('is_active', true);

        if ($category && $category !== 'all') {
            $partnersQuery->where('category', $category);
        }

        if ($track && $track !== 'all') {
            $partnersQuery->whereJsonContains('supported_tracks', $track);
        }

        if ($query) {
            $partnersQuery->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('code', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            });
        }

        $partners = $partnersQuery->orderBy('category')->get();

        $categories = [
            'all' => 'Semua Kategori',
            'Bank' => 'Perbankan (Bank BUMN/Swasta)',
            'LK Non-Bank' => 'LK Non-Bank & Fintech',
            'Lembaga Penjaminan' => 'Lembaga Penjaminan (Jamkrindo / Jamkrida)',
            'Pendamping Usaha' => 'Pendamping Usaha & Inkubator',
        ];

        return view('partners.index', compact('partners', 'category', 'track', 'query', 'categories'));
    }
}
