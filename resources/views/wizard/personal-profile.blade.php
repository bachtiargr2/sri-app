@include('wizard.layout', ['title' => 'Lengkapi Profil Diri Anda', 'slot' => $slot ?? ''])

<!-- Card Container -->
<div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
    
    <!-- Title Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-4 border-b border-slate-100">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Lengkapi Profil Diri Anda ({{ $business->business_type === 'perorangan' ? 'Perseorangan' : 'Perusahaan' }})</h2>
            <p class="text-xs text-slate-500">Informasi identitas debitur, NIK KTP, NPWP, dan verifikasi SLIK OJK.</p>
        </div>
        <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
            Tahap 1 dari 4
        </span>
    </div>

    <form method="POST" action="{{ route('wizard.save-personal-profile') }}" class="space-y-6">
        @csrf

        <!-- Section 1: Data Utama Pemohon -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Nama Lengkap -->
            <div>
                <label for="full_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap (Tanpa Gelar)</label>
                <input type="text" 
                       id="full_name" 
                       name="full_name" 
                       value="{{ old('full_name', $profile->full_name) }}" 
                       required 
                       placeholder="Contoh: Jessica Pangestu"
                       class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                <x-input-error :messages="$errors->get('full_name')" class="mt-1" />
            </div>

            <!-- Jabatan di Perusahaan -->
            <div>
                <label for="position" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Jabatan di Perusahaan</label>
                <input type="text" 
                       id="position" 
                       name="position" 
                       value="{{ old('position', $profile->position) }}" 
                       placeholder="Contoh: Direktur Utama / Pemilik Usaha"
                       class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Email Korespondensi</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $profile->email) }}" 
                       required 
                       placeholder="Contoh: jess@gmail.com"
                       class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Nomor Telepon -->
            <div>
                <label for="phone_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nomor Telepon / WhatsApp</label>
                <input type="text" 
                       id="phone_number" 
                       name="phone_number" 
                       value="{{ old('phone_number', $profile->phone_number) }}" 
                       placeholder="Contoh: 082177766899"
                       class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Tempat, Tanggal Lahir -->
            <div>
                <label for="birth_place_date" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tempat, Tanggal Lahir</label>
                <input type="text" 
                       id="birth_place_date" 
                       name="birth_place_date" 
                       value="{{ old('birth_place_date', $profile->birth_place_date) }}" 
                       placeholder="Contoh: Jakarta, 19/11/1980"
                       class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- No. KTP / NIK -->
            <div>
                <label for="id_card_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">No. KTP / NIK</label>
                <input type="text" 
                       id="id_card_number" 
                       name="id_card_number" 
                       value="{{ old('id_card_number', $profile->id_card_number) }}" 
                       placeholder="16 Digit NIK KTP"
                       class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- No. NPWP -->
            <div>
                <label for="npwp" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">No. NPWP Pribadi</label>
                <input type="text" 
                       id="npwp" 
                       name="npwp" 
                       value="{{ old('npwp', $profile->npwp) }}" 
                       placeholder="Contoh: 8383892020389"
                       class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <!-- Penghasilan / Pinjaman -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Apakah Memiliki Fasilitas Pinjaman Aktif?</label>
                <div class="flex items-center gap-6 pt-2">
                    <label class="inline-flex items-center gap-2 cursor-pointer text-xs text-slate-700">
                        <input type="radio" name="has_existing_loans" value="1" {{ old('has_existing_loans', $profile->has_existing_loans) ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                        <span>Ya, ada pinjaman</span>
                    </label>
                    <label class="inline-flex items-center gap-2 cursor-pointer text-xs text-slate-700">
                        <input type="radio" name="has_existing_loans" value="0" {{ !old('has_existing_loans', $profile->has_existing_loans) ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                        <span>Tidak ada</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Alamat Domisili -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 pt-2">
            <div class="md:col-span-3">
                <label for="address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Lengkap Tempat Tinggal</label>
                <textarea id="address" 
                          name="address" 
                          rows="2" 
                          placeholder="Jalan, nomor rumah, RT/RW, kelurahan/kecamatan"
                          class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">{{ old('address', $profile->address) }}</textarea>
            </div>

            <div>
                <label for="city" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kota / Kabupaten</label>
                <input type="text" id="city" name="city" value="{{ old('city', $profile->city) }}" placeholder="Contoh: Jakarta Selatan" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <div>
                <label for="province" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Provinsi</label>
                <input type="text" id="province" name="province" value="{{ old('province', $profile->province) }}" placeholder="Contoh: DKI Jakarta" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>

            <div>
                <label for="postal_code" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kode Pos</label>
                <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $profile->postal_code) }}" placeholder="Contoh: 12345" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-xs text-slate-900 focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/20 transition">
            </div>
        </div>

        <!-- Section 2: Data Riwayat Credit Scoring (Gambar 7) -->
        <div class="p-5 rounded-2xl bg-blue-50/60 border border-blue-200 space-y-4">
            <h4 class="text-xs font-bold text-blue-900 uppercase tracking-wider">Hasil Credit Scoring Pendukung Lainnya (SLIK OJK / IdScore)</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-2">Riwayat Pengecekan Skor Kredit:</label>
                    <div class="flex flex-wrap gap-4 text-xs">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="credit_scoring_source" value="slik" checked class="text-blue-600">
                            <span class="font-bold text-slate-800">SLIK OJK</span>
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="credit_scoring_source" value="idscore" class="text-blue-600">
                            <span>MyIdScore</span>
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="credit_scoring_source" value="none" class="text-blue-600">
                            <span>Tidak Ada</span>
                        </label>
                    </div>
                </div>
                <div>
                    <label for="existing_scoring_value" class="block text-xs font-semibold text-slate-700 mb-1">Nilai Scoring (Jika Ada):</label>
                    <input type="number" 
                           id="existing_scoring_value" 
                           name="existing_scoring_value" 
                           value="{{ old('existing_scoring_value', $profile->existing_scoring_value) }}" 
                           placeholder="Contoh: 740" 
                           class="w-full rounded-xl border-slate-200 bg-white px-4 py-2 text-xs text-slate-900 focus:border-blue-600">
                </div>
            </div>
        </div>

        <!-- Section 3: Data Pasangan (Gambar 8 & 9) -->
        <div x-data="{ hasSpouse: {{ old('has_spouse', $profile->has_spouse ? 'true' : 'false') }} }" class="space-y-4 pt-4 border-t border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Data Pasangan (Opsional / Perseorangan)</h4>
                    <p class="text-[11px] text-slate-500">Wajib diisi jika status menikah dan mengajukan penjaminan perseorangan.</p>
                </div>
                <div class="flex items-center gap-4 text-xs">
                    <label class="inline-flex items-center gap-1.5 cursor-pointer">
                        <input type="radio" name="has_spouse" value="1" @click="hasSpouse = true" :checked="hasSpouse" class="text-blue-600">
                        <span>Menikah</span>
                    </label>
                    <label class="inline-flex items-center gap-1.5 cursor-pointer">
                        <input type="radio" name="has_spouse" value="0" @click="hasSpouse = false" :checked="!hasSpouse" class="text-blue-600">
                        <span>Belum / Tidak Ada</span>
                    </label>
                </div>
            </div>

            <div x-show="hasSpouse" class="grid grid-cols-1 md:grid-cols-2 gap-4 p-5 rounded-2xl bg-slate-50 border border-slate-200">
                <div>
                    <label for="spouse_name" class="block text-[11px] font-bold text-slate-700 mb-1">Nama Pasangan</label>
                    <input type="text" id="spouse_name" name="spouse_name" value="{{ old('spouse_name', $profile->spouse_name) }}" placeholder="Nama lengkap pasangan" class="w-full rounded-xl border-slate-200 bg-white px-3.5 py-2 text-xs">
                </div>
                <div>
                    <label for="spouse_phone" class="block text-[11px] font-bold text-slate-700 mb-1">Nomor Telepon Pasangan</label>
                    <input type="text" id="spouse_phone" name="spouse_phone" value="{{ old('spouse_phone', $profile->spouse_phone) }}" placeholder="Nomor HP/WA" class="w-full rounded-xl border-slate-200 bg-white px-3.5 py-2 text-xs">
                </div>
                <div>
                    <label for="spouse_birth_place_date" class="block text-[11px] font-bold text-slate-700 mb-1">Tempat & Tanggal Lahir Pasangan</label>
                    <input type="text" id="spouse_birth_place_date" name="spouse_birth_place_date" value="{{ old('spouse_birth_place_date', $profile->spouse_birth_place_date) }}" placeholder="Kota, Tgl Lahir" class="w-full rounded-xl border-slate-200 bg-white px-3.5 py-2 text-xs">
                </div>
                <div>
                    <label for="spouse_id_card_number" class="block text-[11px] font-bold text-slate-700 mb-1">No. KTP Pasangan</label>
                    <input type="text" id="spouse_id_card_number" name="spouse_id_card_number" value="{{ old('spouse_id_card_number', $profile->spouse_id_card_number) }}" placeholder="16 Digit NIK" class="w-full rounded-xl border-slate-200 bg-white px-3.5 py-2 text-xs">
                </div>
                <div>
                    <label for="spouse_occupation" class="block text-[11px] font-bold text-slate-700 mb-1">Pekerjaan Pasangan</label>
                    <input type="text" id="spouse_occupation" name="spouse_occupation" value="{{ old('spouse_occupation', $profile->spouse_occupation) }}" placeholder="Pekerjaan saat ini" class="w-full rounded-xl border-slate-200 bg-white px-3.5 py-2 text-xs">
                </div>
                <div>
                    <label for="spouse_monthly_income" class="block text-[11px] font-bold text-slate-700 mb-1">Penghasilan Pasangan per Bulan (Rp)</label>
                    <input type="number" id="spouse_monthly_income" name="spouse_monthly_income" value="{{ old('spouse_monthly_income', $profile->spouse_monthly_income) }}" placeholder="Nominal Rp" class="w-full rounded-xl border-slate-200 bg-white px-3.5 py-2 text-xs">
                </div>
                <div class="md:col-span-2">
                    <label for="family_card_number" class="block text-[11px] font-bold text-slate-700 mb-1">Nomor Kartu Keluarga (KK)</label>
                    <input type="text" id="family_card_number" name="family_card_number" value="{{ old('family_card_number', $profile->family_card_number) }}" placeholder="16 Digit No KK" class="w-full rounded-xl border-slate-200 bg-white px-3.5 py-2 text-xs">
                </div>
            </div>
        </div>

        <!-- Submit Button (Gambar 9: Save Changes) -->
        <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-100">
            <a href="{{ route('wizard.overview') }}" class="px-6 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                Kembali
            </a>
            <button type="submit" 
                    class="px-8 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold rounded-xl shadow-lg shadow-blue-500/25 transition duration-150 text-xs flex items-center gap-2">
                Simpan & Lanjutkan ke Profil Usaha &rarr;
            </button>
        </div>
    </form>
</div>
