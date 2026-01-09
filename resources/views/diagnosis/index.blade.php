@extends('layouts.app')

@section('title', 'Layanan - Sistem Pakar Diagnosa Penyakit Mata')

@section('content')

<!-- Page Header -->
<div class="bg-gradient-primary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="mb-10">
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}" class="text-blue-100 hover:text-white inline-flex items-center text-lg">
                            <i class="fas fa-home mr-3"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-chevron-right text-blue-200 mx-3"></i>
                    </li>
                    <li aria-current="page">
                        <span class="text-white font-semibold text-lg">Layanan</span>
                    </li>
                </ol>
            </nav>
            
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Layanan Diagnosa<br>
                <span class="text-blue-200">Penyakit Mata</span>
            </h1>
            <p class="text-blue-100 text-xl max-w-3xl leading-relaxed">
                EyeCare menyediakan sistem diagnosa penyakit mata berbasis aturan IF-THEN dengan metode forward chaining.
                Pilih layanan yang sesuai dengan kebutuhan Anda.
            </p>
        </div>
    </div>
</div>

<!-- Services Section -->
<section class="section-padding">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 mb-20">
            
            <!-- Main Service -->
            <div class="space-y-8">
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-200">
                    <div class="bg-gradient-primary p-12 text-white">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="text-3xl font-bold mb-2">Diagnosa Lengkap</h3>
                                <p class="text-blue-100 text-lg">6 Penyakit Mata • Forward Chaining</p>
                            </div>
                            <span class="bg-white/20 px-6 py-2 rounded-full text-sm font-bold">LAYANAN UTAMA</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="bg-white/20 rounded-xl p-4">
                                <i class="fas fa-clock text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold">5 Menit</p>
                                <p class="text-blue-100">Waktu Diagnosa</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-12">
                        <p class="text-gray-600 text-lg mb-10 leading-relaxed">
                            Sistem akan memandu Anda melalui serangkaian pertanyaan gejala untuk mengidentifikasi 
                            kemungkinan penyakit mata dengan metode forward chaining yang akurat.
                        </p>
                        
                        <div class="space-y-6 mb-12">
                            @foreach([
                                'Diagnosa 6 penyakit mata utama',
                                'Metode forward chaining yang akurat',
                                'Riwayat diagnosa tersimpan otomatis',
                                'Hasil real-time dengan penjelasan lengkap',
                                'Saran tindakan awal yang dapat dilakukan',
                                'Tidak perlu registrasi atau biaya'
                            ] as $feature)
                            <div class="flex items-center gap-4">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                                <span class="text-gray-700 text-lg">{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                        
                        <a href="{{ route('diagnosis.create') }}" 
                           class="block w-full btn-primary text-white text-center py-5 rounded-xl font-bold text-xl shadow-xl hover:shadow-2xl transition">
                            <i class="fas fa-play-circle mr-3 text-2xl"></i>
                            Mulai Diagnosa Sekarang
                        </a>
                        
                        <p class="text-center text-gray-500 text-lg mt-6">
                            Gratis • Langsung digunakan • Tanpa registrasi
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Side Panels -->
            <div class="space-y-8">
                <!-- How It Works -->
                <div class="bg-gradient-to-br from-blue-50 to-white rounded-3xl p-10 border border-blue-200 shadow-lg">
                    <h4 class="text-2xl font-bold text-blue-800 mb-8 flex items-center gap-3">
                        <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-cogs text-blue-600 text-xl"></i>
                        </div>
                        Cara Kerja Sistem
                    </h4>
                    <ol class="space-y-8">
                        @foreach([
                            ['num' => '01', 'title' => 'Input Gejala', 'desc' => 'Pilih gejala yang dialami dari daftar gejala'],
                            ['num' => '02', 'title' => 'Proses Forward Chaining', 'desc' => 'Sistem memproses dengan metode forward chaining'],
                            ['num' => '03', 'title' => 'Analisis Aturan IF-THEN', 'desc' => 'Mencocokkan dengan basis aturan penyakit'],
                            ['num' => '04', 'title' => 'Hasil & Rekomendasi', 'desc' => 'Dapatkan hasil diagnosa dan saran']
                        ] as $step)
                        <li class="flex gap-6">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gradient-primary rounded-2xl flex items-center justify-center text-white text-xl font-bold">
                                    {{ $step['num'] }}
                                </div>
                            </div>
                            <div>
                                <h5 class="text-lg font-bold text-gray-900 mb-2">{{ $step['title'] }}</h5>
                                <p class="text-gray-600">{{ $step['desc'] }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ol>
                </div>
                
                <!-- History Panel -->
                <div class="bg-white rounded-3xl p-10 shadow-lg border border-gray-200">
                    <h4 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                        <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-history text-green-600 text-xl"></i>
                        </div>
                        Riwayat Diagnosa
                    </h4>
                    <div class="space-y-6">
                        <p class="text-gray-600 leading-relaxed">
                            Pantau perkembangan kesehatan mata Anda dengan melihat riwayat diagnosa sebelumnya.
                            Semua hasil tersimpan secara otomatis dan dapat diakses kapan saja.
                        </p>
                        <div class="bg-green-50 rounded-2xl p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-gray-700 font-semibold">Diagnosa Tersimpan</p>
                                    <p class="text-3xl font-bold text-green-600">∞</p>
                                </div>
                                <i class="fas fa-infinity text-green-400 text-4xl"></i>
                            </div>
                            <p class="text-sm text-gray-600">Riwayat tidak terbatas</p>
                        </div>
                        <a href="{{ route('diagnosis.history') }}" 
                           class="block w-full bg-green-100 text-green-700 text-center py-4 rounded-xl font-bold hover:bg-green-200 transition">
                            <i class="fas fa-folder-open mr-2"></i>
                            Lihat Riwayat Diagnosa
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Diseases Table -->
        <div class="mb-20">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Detail Penyakit yang Didiagnosa</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Sistem EyeCare dapat mengidentifikasi 6 jenis penyakit mata berikut
                </p>
            </div>
            
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gradient-primary text-white">
                                <th class="py-8 px-10 text-left text-lg font-bold">Kode</th>
                                <th class="py-8 px-10 text-left text-lg font-bold">Nama Penyakit</th>
                                <th class="py-8 px-10 text-left text-lg font-bold">Deskripsi</th>
                                <th class="py-8 px-10 text-left text-lg font-bold">Gejala Utama</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach([
                                ['code' => 'P1', 'name' => 'Katarak', 'desc' => 'Kekeruhan pada lensa mata', 'symptoms' => 'Penglihatan buram, silau, warna memudar'],
                                ['code' => 'P2', 'name' => 'Glaukoma Akut', 'desc' => 'Peningkatan tekanan intraokular', 'symptoms' => 'Nyeri mata, sakit kepala, melihat halo'],
                                ['code' => 'P3', 'name' => 'Konjungtivitis', 'desc' => 'Radang selaput mata', 'symptoms' => 'Mata merah, gatal, kotoran mata'],
                                ['code' => 'P4', 'name' => 'Ablasio Retina', 'desc' => 'Lepasnya retina dari posisi normal', 'symptoms' => 'Kilatan cahaya, bayangan gelap'],
                                ['code' => 'P5', 'name' => 'Sindrom Mata Kering', 'desc' => 'Produksi air mata tidak cukup', 'symptoms' => 'Mata perih, berair, sensitif cahaya'],
                                ['code' => 'P6', 'name' => 'Degenerasi Makula', 'desc' => 'Kerusakan makula di retina', 'symptoms' => 'Penglihatan tengah buram, garis bengkok']
                            ] as $disease)
                            <tr class="hover:bg-blue-50 transition group">
                                <td class="py-8 px-10">
                                    <div class="flex items-center gap-4">
                                        <span class="inline-flex items-center justify-center w-14 h-14 bg-gradient-primary text-white rounded-xl font-bold text-xl group-hover:scale-110 transition">
                                            {{ $disease['code'] }}
                                        </span>
                                    </div>
                                </td>
                                <td class="py-8 px-10">
                                    <div class="font-bold text-gray-900 text-lg">{{ $disease['name'] }}</div>
                                </td>
                                <td class="py-8 px-10">
                                    <p class="text-gray-600">{{ $disease['desc'] }}</p>
                                </td>
                                <td class="py-8 px-10">
                                    <p class="text-gray-600">{{ $disease['symptoms'] }}</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Final CTA -->
        <div class="text-center">
            <div class="mb-12">
                <h3 class="text-4xl font-bold text-gray-900 mb-8">Siap Memulai Diagnosa?</h3>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Jaga kesehatan mata Anda dengan deteksi dini. Sistem kami siap membantu mengidentifikasi 
                    kemungkinan penyakit mata dengan akurat dan cepat.
                </p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="{{ route('diagnosis.create') }}" 
                   class="btn-primary text-white px-14 py-6 rounded-2xl font-bold text-xl shadow-2xl hover:shadow-3xl transition inline-flex items-center justify-center gap-4">
                    <i class="fas fa-play-circle text-3xl"></i>
                    Mulai Diagnosa Sekarang
                </a>
                
                <a href="{{ url('/') }}" 
                   class="bg-white border-2 border-blue-200 text-blue-700 px-14 py-6 rounded-2xl font-semibold text-xl hover:bg-blue-50 transition inline-flex items-center justify-center gap-4">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>
            
            <p class="text-gray-500 mt-10 text-lg">
                ⚡ <span class="font-semibold">Gratis selamanya</span> • Tidak ada batasan penggunaan
            </p>
        </div>
    </div>
</section>

<!-- Final Disclaimer -->
<section class="py-16 bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-red-50 to-orange-50 border-l-8 border-red-500 rounded-r-3xl p-12 shadow-xl">
            <div class="flex items-start gap-8">
                <div class="flex-shrink-0">
                    <div class="w-20 h-20 bg-red-100 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-exclamation-circle text-red-600 text-3xl"></i>
                    </div>
                </div>
                <div class="space-y-6">
                    <h4 class="text-3xl font-bold text-red-800 mb-4">Peringatan Medis Penting</h4>
                    <div class="space-y-4">
                        <p class="text-red-700 text-lg leading-relaxed">
                            <strong>⚠️ PERHATIAN:</strong> Sistem ini hanya untuk tujuan informasi dan identifikasi awal. 
                            <span class="underline font-bold">Tidak dimaksudkan sebagai pengganti nasihat medis profesional.</span>
                        </p>
                        <ul class="space-y-3 text-red-600 list-disc pl-6">
                            <li>Hasil diagnosa tidak menggantikan pemeriksaan dokter spesialis mata</li>
                            <li>Konsultasikan selalu dengan dokter untuk diagnosis yang akurat</li>
                            <li>Pengobatan harus berdasarkan rekomendasi dokter profesional</li>
                            <li>Dalam keadaan darurat, segera hubungi rumah sakit terdekat</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection