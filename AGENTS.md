# AGENTS.md - SME Rating Indonesia (SRI) Development Rules

## Role & Goal
You are a senior full-stack Laravel developer. Your goal is to build a functional web prototype for "SRI (SME Rating Indonesia)" connected to a MySQL database, following the technical PDF documentation and the clean, modern fintech style of the reference site.

## Tech Stack
- Laravel 11, Blade Templates, Tailwind CSS, Alpine.js
- Chart.js (via CDN) for data visualizations
- MySQL with Eloquent ORM & Seeders

## Visual Identity
- Clean fintech UI: slate/off-white background (#F8FAFC), crisp white card panels, borders in slate-200, deep corporate blue (#1E40AF) for accents, and vivid blue (#2563EB) for buttons.

## Strict Business Process Flow (6 Steps)
The application flow must follow these 6 sequential steps:
1. Pendaftaran Pengguna: Landing page, Signup, and Login.
2. Pengisian Data Calon Debitur: Profil Diri, Profil Usaha, Laporan Keuangan 3 periode, Data Agunan, Profil Manajemen, and Asesmen Karakter Kewirausahaan (Big-Five Likert 1-5).
3. Proses dan Hasil Pemeringkatan: Automated scoring calculation (5C, 4P, Character), visual charts, and Certificate generation (e.g., Rating Bb / 740).
4. Pengajuan dan Rekomendasi: System recommends suitable financing based on the scoring rating.
5. Pilihan Pengajuan: User selects a submission track: Kredit, Penjaminan Cash Loan, or Penjaminan Non-Cash Loan.
6. Kolaborasi Mitra: Matching with financial institutions (Banks, Non-Bank LK, Guarantee agencies) with transaction ID modal confirmation (TRX...).

## Flow Logic Rules
- Steps 4, 5, and 6 must be locked until Step 2 is completed and Step 3 produces an active rating.
- Always provide DatabaseSeeders so all 6 steps can be demoed immediately with preloaded data.