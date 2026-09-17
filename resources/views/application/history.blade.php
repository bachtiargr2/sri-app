<x-app-layout>
    <div class="py-8 bg-[#F8FAFC]" x-data="{
        showSuccessModal: {{ session('trx_success') ? 'true' : 'false' }},
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Breadcrumb Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200">
                <div>
                    <div class="flex items-center gap-2 text-xs text-blue-600 font-bold mb-1">
                        <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                        <span>/</span>
                        <span class="text-slate-500 uppercase">Histori Pengajuan Fasilitas</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Daftar Pengajuan Pembiayaan & Penjaminan</h1>
                    <p class="text-xs text-slate-500 mt-1">Pantau status verifikasi dan underwriting dari mitra perbankan serta lembaga penjaminan secara berkala.</p>
                </div>

                <a href="{{ route('apply.choose') }}" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md shadow-blue-500/25 transition flex items-center gap-2">
                    <span>+ Buat Pengajuan Baru</span>
                </a>
            </div>

            <!-- List Table of Applications -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                @if($applications->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-600 uppercase text-[10px] font-black tracking-wider">
                                    <th class="py-4 px-6">No. Transaksi (TRX)</th>
                                    <th class="py-4 px-6">Mitra Finansial</th>
                                    <th class="py-4 px-6">Jalur Fasilitas</th>
                                    <th class="py-4 px-6">Plafon Dimohon</th>
                                    <th class="py-4 px-6">Tenor</th>
                                    <th class="py-4 px-6">Status Pengajuan</th>
                                    <th class="py-4 px-6 text-right">Tanggal Submit</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-800">
                                @foreach($applications as $app)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="py-4 px-6 font-mono font-bold text-blue-900">
                                            {{ $app->trx_id }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="font-bold text-slate-900">{{ $app->partner->name ?? 'Mitra Perbankan' }}</div>
                                            <span class="text-[10px] text-slate-500">{{ $app->selected_product_name ?? 'Fasilitas Pembiayaan' }}</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            @if($app->submission_track === 'kredit')
                                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase bg-blue-50 text-blue-700 border border-blue-200">
                                                    Kredit Bank
                                                </span>
                                            @elseif($app->submission_track === 'cash_loan')
                                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                    Penjaminan Cash
                                                </span>
                                            @else
                                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase bg-purple-50 text-purple-700 border border-purple-200">
                                                    Non-Cash Loan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 font-bold text-slate-900">
                                            Rp {{ number_format($app->loan_amount, 0, ',', '.') }}
                                        </td>
                                        <td class="py-4 px-6 font-semibold text-slate-700">
                                            {{ $app->tenor_months }} Bulan
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-blue-50 text-blue-800 border border-blue-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                                                Terkirim / Dalam Proses
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-right text-slate-500 text-[11px]">
                                            {{ $app->created_at->format('d M Y, H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-16 text-center space-y-3">
                        <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mx-auto">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h4 class="text-sm font-bold text-slate-800">Belum Ada Pengajuan</h4>
                        <p class="text-xs text-slate-500">Anda belum mengirimkan permohonan kredit atau penjaminan ke mitra finansial.</p>
                        <a href="{{ route('apply.choose') }}" class="inline-block mt-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-sm transition">
                            Mulai Pengajuan &rarr;
                        </a>
                    </div>
                @endif
            </div>

        </div>

        <!-- Success Modal Pop-Up matching Bab 4 & 6 Confirmation (TRX...) -->
        @if(session('trx_success'))
            <div x-show="showSuccessModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-sm">
                <div class="bg-white rounded-3xl max-w-lg w-full p-8 border border-slate-200 shadow-2xl relative space-y-6 animate-fadeIn text-center">
                    
                    <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto shadow-sm ring-8 ring-emerald-50">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>

                    <div class="space-y-1">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-800 mb-1">
                            ✓ Pengajuan Berhasil Terkirim
                        </span>
                        <h3 class="text-xl font-black text-slate-900">Konfirmasi Pengajuan Fasilitas</h3>
                        <p class="text-xs text-slate-500">Permohonan Anda telah diteruskan secara digital ke sistem mitra finansial terkait.</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-blue-50/60 border border-blue-100 text-left space-y-2 text-xs">
                        <div class="flex justify-between items-center pb-2 border-b border-blue-100">
                            <span class="text-slate-600 font-bold uppercase text-[10px]">ID Pengajuan:</span>
                            <span class="font-mono font-black text-blue-900 text-sm">{{ session('trx_success')['trx_id'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Mitra Lembaga:</span>
                            <strong class="text-slate-900">{{ session('trx_success')['partner_name'] }}</strong>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Nominal Plafon:</span>
                            <strong class="text-blue-900 font-bold">Rp {{ number_format(session('trx_success')['amount'], 0, ',', '.') }}</strong>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Jalur Pengajuan:</span>
                            <span class="capitalize font-bold text-slate-800">{{ str_replace('_', ' ', session('trx_success')['track']) }}</span>
                        </div>
                    </div>

                    <p class="text-[11px] text-slate-400 leading-relaxed">
                        Tim analis mitra akan memvalidasi data dan Sertifikat Rating SRI Anda dalam waktu 1-3 hari kerja.
                    </p>

                    <div class="pt-2">
                        <button type="button" @click="showSuccessModal = false" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold text-xs rounded-xl shadow-lg shadow-blue-500/25 transition">
                            Tutup & Pantau Histori
                        </button>
                    </div>

                </div>
            </div>
        @endif

    </div>
</x-app-layout>
