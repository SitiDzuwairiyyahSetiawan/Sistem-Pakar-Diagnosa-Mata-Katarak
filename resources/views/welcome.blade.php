@extends('layouts.app')

@section('title', 'Sistem Pakar Diagnosa Penyakit Mata - EyeCare')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden section-padding">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-blue-50 z-0"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            
            <!-- Left Content -->
            <div class="space-y-8">
                <div class="inline-flex items-center gap-3 bg-blue-100 text-blue-700 px-5 py-2 rounded-full text-sm font-medium">
                    <i class="fas fa-brain"></i>
                    <span>Sistem Pakar Berbasis Aturan IF-THEN</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 leading-tight">
                    Mata Sehat,
                    <span class="text-gradient block mt-2">Masa Depan Cerah</span>
                </h1>
                
                <p class="text-xl text-gray-600 leading-relaxed">
                    Sistem cerdas untuk identifikasi awal penyakit mata. Deteksi dini 6 penyakit mata 
                    dengan metode forward chaining yang akurat dan mudah digunakan.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-5 pt-4">
                    <a href="{{ route('diagnosis.create') }}" 
                       class="btn-primary text-white px-10 py-4 rounded-xl font-bold text-lg shadow-xl inline-flex items-center justify-center gap-3">
                        <i class="fas fa-play-circle text-2xl"></i>
                        Mulai Diagnosa Gratis
                    </a>
                    
                    <a href="#services" 
                       class="bg-white border-2 border-blue-200 text-blue-700 px-10 py-4 rounded-xl font-semibold text-lg hover:bg-blue-50 transition inline-flex items-center justify-center gap-3">
                        <i class="fas fa-info-circle"></i>
                        Pelajari Layanan
                    </a>
                </div>
                
                <!-- Trust Badges -->
                <div class="pt-8">
                    <p class="text-gray-500 mb-4">Didukung oleh:</p>
                    <div class="flex flex-wrap items-center gap-8">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">Akurat</p>
                                <p class="text-sm text-gray-500">Basis aturan medis</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-clock text-blue-600 text-2xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">Cepat</p>
                                <p class="text-sm text-gray-500">Hanya 5 menit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Content - Hero Image -->
            <div class="relative">
                <div class="relative">
                    <img src="{{ asset('images/img1.jpg') }}" 
                         alt="Eye Care Illustration" 
                         class="rounded-3xl shadow-2xl w-full">
                    
                    <!-- Floating Stats Card -->
                    <div class="absolute -bottom-6 -right-6 bg-white rounded-2xl shadow-2xl p-8 w-64">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-blue-600 mb-2">99%</div>
                            <p class="text-gray-600 font-medium">Akurasi Sistem</p>
                            <div class="flex justify-center mt-3">
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="section-padding bg-white" id="services">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Layanan Unggulan Kami</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                EyeCare menyediakan berbagai layanan untuk menjaga kesehatan mata Anda dengan teknologi terkini
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-10">
            <!-- Feature 1 -->
            <div class="bg-gradient-to-br from-blue-50 to-white rounded-3xl p-10 card-hover border border-blue-100">
                <div class="w-20 h-20 bg-gradient-primary rounded-2xl flex items-center justify-center mb-8">
                    <i class="fas fa-stethoscope text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Diagnosa Lengkap</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Mendiagnosa 6 jenis penyakit mata utama dengan sistem berbasis aturan IF-THEN dan metode forward chaining.
                </p>
                <a href="{{ route('diagnosis.create') }}" class="text-blue-600 font-semibold inline-flex items-center gap-2 hover:gap-3 transition-all">
                    Mulai Sekarang
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <!-- Feature 2 -->
            <div class="bg-gradient-to-br from-green-50 to-white rounded-3xl p-10 card-hover border border-green-100">
                <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-8">
                    <i class="fas fa-history text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Riwayat Digital</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Semua hasil diagnosa tersimpan rapi untuk pemantauan kesehatan mata Anda dari waktu ke waktu.
                </p>
                <a href="{{ route('diagnosis.history') }}" class="text-green-600 font-semibold inline-flex items-center gap-2 hover:gap-3 transition-all">
                    Lihat Riwayat
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <!-- Feature 3 -->
            <div class="bg-gradient-to-br from-purple-50 to-white rounded-3xl p-10 card-hover border border-purple-100">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-8">
                    <i class="fas fa-file-medical text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Laporan Detail</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Hasil diagnosa dilengkapi dengan penjelasan lengkap dan saran tindakan yang dapat dilakukan.
                </p>
                <a href="{{ route('diagnosis.index') }}" class="text-purple-600 font-semibold inline-flex items-center gap-2 hover:gap-3 transition-all">
                    Contoh Laporan
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Diseases Section -->
<section class="section-padding bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Penyakit yang Dapat Didiagnosa</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Sistem kami mampu mengidentifikasi 6 jenis penyakit mata yang umum dijumpai
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach([
                ['icon' => 'fas fa-cloud', 'color' => 'bg-blue-100', 'icon_color' => 'text-blue-600', 'title' => 'Katarak (P1)', 'desc' => 'Lensa mata menjadi keruh sehingga penglihatan buram', 'symptoms' => 'Penglihatan buram, silau, warna memudar'],
                ['icon' => 'fas fa-tint', 'color' => 'bg-green-100', 'icon_color' => 'text-green-600', 'title' => 'Glaukoma Akut (P2)', 'desc' => 'Tekanan bola mata meningkat secara mendadak', 'symptoms' => 'Nyeri mata, sakit kepala, melihat halo'],
                ['icon' => 'fas fa-eye-dropper', 'color' => 'bg-red-100', 'icon_color' => 'text-red-600', 'title' => 'Konjungtivitis (P3)', 'desc' => 'Radang pada selaput mata yang menutupi bola mata', 'symptoms' => 'Mata merah, gatal, kotoran mata'],
                ['icon' => 'fas fa-layer-group', 'color' => 'bg-purple-100', 'icon_color' => 'text-purple-600', 'title' => 'Ablasio Retina (P4)', 'desc' => 'Lepasnya retina dari posisi normalnya', 'symptoms' => 'Kilatan cahaya, bayangan gelap'],
                ['icon' => 'fas fa-water', 'color' => 'bg-yellow-100', 'icon_color' => 'text-yellow-600', 'title' => 'Sindrom Mata Kering (P5)', 'desc' => 'Produksi air mata tidak mencukupi', 'symptoms' => 'Mata perih, berair, sensitif cahaya'],
                ['icon' => 'fas fa-chart-line', 'color' => 'bg-indigo-100', 'icon_color' => 'text-indigo-600', 'title' => 'Degenerasi Makula (P6)', 'desc' => 'Kerusakan makula di bagian tengah retina', 'symptoms' => 'Penglihatan tengah buram, garis bengkok']
            ] as $disease)
            <div class="bg-white rounded-2xl p-8 card-hover shadow-lg border border-gray-200">
                <div class="flex items-start gap-6 mb-6">
                    <div class="w-16 h-16 {{ $disease['color'] }} rounded-2xl flex items-center justify-center">
                        <i class="{{ $disease['icon'] }} {{ $disease['icon_color'] }} text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $disease['title'] }}</h4>
                        <p class="text-gray-600 text-sm">{{ $disease['desc'] }}</p>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-sm font-semibold text-gray-700 mb-2">Gejala Utama:</p>
                    <p class="text-gray-600 text-sm">{{ $disease['symptoms'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="section-padding bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Cara Kerja Sistem</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Hanya dalam 3 langkah mudah, dapatkan hasil diagnosa awal penyakit mata
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-10">
            <div class="relative">
                <div class="text-center">
                    <div class="w-24 h-24 bg-gradient-primary rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto mb-8 shadow-lg">
                        1
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Pilih Gejala</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Pilih gejala yang Anda alami dari daftar gejala yang tersedia
                    </p>
                </div>
                <div class="hidden md:block absolute top-12 right-0 transform translate-x-1/2">
                    <i class="fas fa-arrow-right text-3xl text-blue-300"></i>
                </div>
            </div>
            
            <div class="relative">
                <div class="text-center">
                    <div class="w-24 h-24 bg-gradient-primary rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto mb-8 shadow-lg">
                        2
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Analisis Sistem</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Sistem memproses gejala dengan forward chaining dan aturan IF-THEN
                    </p>
                </div>
                <div class="hidden md:block absolute top-12 right-0 transform translate-x-1/2">
                    <i class="fas fa-arrow-right text-3xl text-blue-300"></i>
                </div>
            </div>
            
            <div class="text-center">
                <div class="w-24 h-24 bg-gradient-primary rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto mb-8 shadow-lg">
                    3
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Hasil & Rekomendasi</h3>
                <p class="text-gray-600 leading-relaxed">
                    Dapatkan hasil diagnosa dan rekomendasi tindakan yang dapat dilakukan
                </p>
            </div>
        </div>
        
        <div class="text-center mt-16">
            <a href="{{ route('diagnosis.create') }}" 
               class="btn-primary text-white px-12 py-5 rounded-xl font-bold text-lg shadow-xl inline-flex items-center justify-center gap-3">
                <i class="fas fa-play-circle text-2xl"></i>
                Coba Sekarang - Gratis!
            </a>
            <p class="text-gray-500 mt-4 text-sm">
                Tidak perlu registrasi atau pembayaran
            </p>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding bg-gradient-primary relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-white rounded-full translate-x-1/2 translate-y-1/2"></div>
    </div>
    
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h2 class="text-4xl md:text-5xl font-bold mb-8">
            Jaga Kesehatan Mata Anda Hari Ini
        </h2>
        <p class="text-blue-100 text-xl mb-12 leading-relaxed">
            Deteksi dini dapat mencegah komplikasi serius. 
            Mulai perjalanan kesehatan mata Anda dengan diagnosa awal yang akurat.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <a href="{{ route('diagnosis.create') }}" 
               class="bg-white text-blue-700 px-10 py-5 rounded-xl font-bold text-lg hover:bg-blue-50 transition shadow-2xl inline-flex items-center justify-center gap-3">
                <i class="fas fa-play-circle text-2xl"></i>
                Mulai Diagnosa Sekarang
            </a>
            
            <a href="#services" 
               class="bg-white/20 backdrop-blur-sm border-2 border-white/30 text-white px-10 py-5 rounded-xl font-semibold text-lg hover:bg-white/30 transition inline-flex items-center justify-center gap-3">
                <i class="fas fa-question-circle"></i>
                Punya Pertanyaan?
            </a>
        </div>
    </div>
</section>

<!-- Disclaimer -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-l-8 border-yellow-400 rounded-r-2xl p-8 shadow-lg">
            <div class="flex items-start gap-6">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-yellow-600 text-4xl"></i>
                </div>
                <div class="space-y-4">
                    <h4 class="text-2xl font-bold text-yellow-800 mb-2">Peringatan Penting</h4>
                    <p class="text-yellow-700 text-lg leading-relaxed">
                        Sistem ini hanya untuk tujuan informasi dan identifikasi awal penyakit mata. 
                        <strong class="underline">Hasil diagnosa tidak menggantikan pemeriksaan dokter spesialis mata.</strong>
                    </p>
                    <p class="text-yellow-600">
                        Segera konsultasikan dengan dokter untuk diagnosis yang akurat dan penanganan yang tepat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection