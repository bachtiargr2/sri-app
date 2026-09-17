@include('wizard.layout', ['title' => 'Lengkapi Profil Usaha', 'slot' => $slot ?? ''])

<!-- Card Container -->
<div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
    
    <!-- Title Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-4 border-b border-slate-100">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Lengkapi Profil Usaha</h2>
            <p class="text-xs text-slate-500">Informasi kapasitas organisasi, legalitas akta, dan rekam jejak operasional usaha.</p>
        </div>
        <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
            Tahap 2 dari 4
        </span>
    </div>

    <form method="POST" action="{{ route('wizard.save-business-profile') }}" class="space-y-6">
        @csrf

        <!-- Main Form Fields Grid (Gambar 10) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            
            <!-- Nama Usaha -->
            <div>
                <label for="business_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Usaha (Lengkap Tanpa Singkatan)</label>
                <input type="text" 
                       id="business_name" 
                       name="business_name" 
                       value="{{ old('business_name', $business->business_name) }}" 
                       required 
                       placeholder="Contoh: PT Maju Bersama Sejahtera"
                       class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                <x-input-error :messages="$errors->get('business_name')" class="mt-1" />
            </div>

            <!-- Tahun Berdiri -->
            <div>
                <label for="established_year" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tahun Berdiri / Mulai Beroperasi</label>
                <input type="number" 
                       id="established_year" 
                       name="established_year" 
                       value="{{ old('established_year', $business->established_year ?? 2015) }}" 
                       min="1900" 
                       max="{{ date('Y') }}"
                       placeholder="Contoh: 2015"
                       class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Bentuk Usaha (Radio PT, CV, Koperasi, Lainnya) -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Bentuk Usaha</label>
                <div class="flex flex-wrap gap-4 pt-2 text-xs">
                    @foreach(['PT' => 'PT', 'CV' => 'CV', 'UD' => 'UD', 'Koperasi' => 'Koperasi', 'Lainnya' => 'Lainnya'] as $val => $label)
                        <label class="inline-flex items-center gap-1.5 cursor-pointer">
                            <input type="radio" 
                                   name="legal_form" 
                                   value="{{ $val }}" 
                                   {{ old('legal_form', $business->legal_form ?? 'PT') === $val ? 'checked' : '' }} 
                                   class="text-blue-600 focus:ring-blue-500">
                            <span class="font-medium text-slate-800">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Telepon Usaha -->
            <div>
                <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Telepon Perusahaan / Kantor</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $business->phone) }}" placeholder="Contoh: 0215150000" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Alamat Usaha -->
            <div class="md:col-span-2">
                <label for="business_address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Lengkap Kantor / Tempat Usaha</label>
                <textarea id="business_address" 
                          name="business_address" 
                          rows="2" 
                          placeholder="Jalan, gedung, nomor, kota, provinsi, kode pos"
                          class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">{{ old('business_address', $business->business_address) }}</textarea>
            </div>

            <!-- Email Usaha -->
            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Email Perusahaan</label>
                <input type="email" id="email" name="email" value="{{ old('email', $business->email) }}" placeholder="corporate@domain.com" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Link Website -->
            <div>
                <label for="website" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Link Website Perusahaan</label>
                <input type="text" id="website" name="website" value="{{ old('website', $business->website) }}" placeholder="https://..." class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Sosial Media -->
            <div>
                <label for="social_media" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Akun Sosial Media Usaha</label>
                <input type="text" id="social_media" name="social_media" value="{{ old('social_media', $business->social_media) }}" placeholder="@akun_instagram / linkedin" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- NPWP Usaha -->
            <div>
                <label for="npwp" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">NPWP Badan Usaha</label>
                <input type="text" id="npwp" name="npwp" value="{{ old('npwp', $business->npwp) }}" placeholder="Nomor Pokok Wajib Pajak Usaha" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- No. Akta Pendirian -->
            <div>
                <label for="deed_establishment_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">No. Akta Pendirian Usaha</label>
                <input type="text" id="deed_establishment_number" name="deed_establishment_number" value="{{ old('deed_establishment_number', $business->deed_establishment_number) }}" placeholder="Nomor Akta Notaris / SK Kemenkumham" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- No. Akta Perubahan Terakhir -->
            <div>
                <label for="deed_amendment_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">No. Akta Perubahan Terakhir</label>
                <input type="text" id="deed_amendment_number" name="deed_amendment_number" value="{{ old('deed_amendment_number', $business->deed_amendment_number) }}" placeholder="Nomor Akta Perubahan Notaris Terakhir" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Direktur Utama -->
            <div>
                <label for="main_director" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Direktur Utama</label>
                <input type="text" id="main_director" name="main_director" value="{{ old('main_director', $business->main_director) }}" placeholder="Nama Direktur Utama" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Direktur Lainnya -->
            <div>
                <label for="other_directors" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Direktur Lainnya (Jika Ada)</label>
                <input type="text" id="other_directors" name="other_directors" value="{{ old('other_directors', $business->other_directors) }}" placeholder="Daftar nama jajaran direksi" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Komisaris Utama -->
            <div>
                <label for="main_commissioner" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Komisaris Utama</label>
                <input type="text" id="main_commissioner" name="main_commissioner" value="{{ old('main_commissioner', $business->main_commissioner) }}" placeholder="Nama Komisaris Utama" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Komisaris Lainnya -->
            <div>
                <label for="other_commissioners" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Komisaris Lainnya</label>
                <input type="text" id="other_commissioners" name="other_commissioners" value="{{ old('other_commissioners', $business->other_commissioners) }}" placeholder="Daftar nama dewan komisaris" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Jumlah Karyawan -->
            <div>
                <label for="employee_count" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Jumlah Karyawan (Tetap & Kontrak)</label>
                <input type="number" id="employee_count" name="employee_count" value="{{ old('employee_count', $business->employee_count ?? 25) }}" min="1" placeholder="Jumlah personil" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Klasifikasi & Range Omzet -->
            <div>
                <label for="revenue_range" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Range Omzet Usaha per Tahun</label>
                <select id="revenue_range" name="revenue_range" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                    <option value="< Rp 300 Juta (Mikro)" {{ old('revenue_range', $business->revenue_range) === '< Rp 300 Juta (Mikro)' ? 'selected' : '' }}>< Rp 300 Juta (Mikro)</option>
                    <option value="Rp 300 Juta - Rp 2.5 Miliar (Kecil)" {{ old('revenue_range', $business->revenue_range) === 'Rp 300 Juta - Rp 2.5 Miliar (Kecil)' ? 'selected' : '' }}>Rp 300 Juta - Rp 2.5 Miliar (Kecil)</option>
                    <option value="Rp 2.5 Miliar - Rp 50 Miliar (Menengah)" {{ old('revenue_range', $business->revenue_range) === 'Rp 2.5 Miliar - Rp 50 Miliar (Menengah)' || empty($business->revenue_range) ? 'selected' : '' }}>Rp 2.5 Miliar - Rp 50 Miliar (Menengah)</option>
                    <option value="> Rp 50 Miliar (Besar)" {{ old('revenue_range', $business->revenue_range) === '> Rp 50 Miliar (Besar)' ? 'selected' : '' }}>> Rp 50 Miliar (Besar)</option>
                </select>
            </div>

            <!-- Deskripsi Usaha dan Produk -->
            <div class="md:col-span-2">
                <label for="business_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Usaha dan Produk yang Ditawarkan</label>
                <textarea id="business_description" 
                          name="business_description" 
                          rows="3" 
                          placeholder="Jelaskan secara deskriptif mengenai model bisnis, target pasar, produk unggulan, dan keunggulan kompetitif usaha Anda..."
                          class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">{{ old('business_description', $business->business_description) }}</textarea>
            </div>

            <!-- Perizinan Produk -->
            <div class="md:col-span-2">
                <label for="product_permits" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Daftar Perizinan Produk yang Dimiliki</label>
                <input type="text" id="product_permits" name="product_permits" value="{{ old('product_permits', $business->product_permits) }}" placeholder="Contoh: NIB, Izin Edar BPOM/Kemenkes, Sertifikasi Halal, ISO 9001:2015, SNI" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>
        </div>

        <!-- Pertanyaan Defisit Giro (Gambar 10) -->
        <div class="p-5 rounded-2xl bg-amber-50/70 border border-amber-200 space-y-2">
            <label class="block text-xs font-bold text-amber-950 leading-relaxed">
                Apakah perusahaan pernah mengalami kekurangan dana pada rekening giro pada saat penarikan cek/bilyet giro?
            </label>
            <div class="flex items-center gap-6 pt-1 text-xs">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="has_giro_deficit" value="1" {{ old('has_giro_deficit', $business->has_giro_deficit) ? 'checked' : '' }} class="text-amber-600">
                    <span class="font-medium text-slate-800">Ya, pernah</span>
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="has_giro_deficit" value="0" {{ !old('has_giro_deficit', $business->has_giro_deficit) ? 'checked' : '' }} class="text-amber-600">
                    <span class="font-bold text-emerald-800">Tidak pernah (Rekomendasi)</span>
                </label>
            </div>
        </div>

        <!-- Upload Buttons (Gambar 10) -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
            <button type="button" class="py-2.5 px-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Upload Foto Tempat Usaha
            </button>
            <button type="button" class="py-2.5 px-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Upload Dokumentasi Produk
            </button>
            <button type="button" class="py-2.5 px-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Upload Akta / NIB Usaha
            </button>
        </div>

        <!-- Submit Button (Gambar 10: Save Changes) -->
        <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-100">
            <a href="{{ route('wizard.personal-profile') }}" class="px-6 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                &larr; Profil Diri
            </a>
            <button type="submit" 
                    class="px-8 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold rounded-xl shadow-lg shadow-blue-500/25 transition duration-150 text-xs flex items-center gap-2">
                Simpan & Lanjutkan ke Laporan Keuangan &rarr;
            </button>
        </div>
    </form>
</div>
