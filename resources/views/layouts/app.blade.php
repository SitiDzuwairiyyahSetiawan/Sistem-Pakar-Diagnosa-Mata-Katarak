<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EyeCare')</title>

    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { 
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }
        
        .bg-gradient-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        
        .text-gradient {
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .section-padding {
            padding-top: 5rem;
            padding-bottom: 5rem;
        }
        
        @media (min-width: 768px) {
            .section-padding {
                padding-top: 6rem;
                padding-bottom: 6rem;
            }
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }
    </style>

    @yield('styles')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

<!-- Navbar -->
<nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-primary rounded-xl flex items-center justify-center text-white text-xl shadow-md">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-2xl font-bold text-gray-900 leading-none">
                        Eye<span class="text-blue-600">Care</span>
                    </span>
                    <span class="text-xs text-gray-500">Sistem Pakar</span>
                </div>
            </a>

            <!-- Menu -->
            <div class="hidden md:flex gap-10">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 font-medium transition flex items-center gap-2">
                    <i class="fas fa-home text-sm"></i>
                    Beranda
                </a>
                <a href="{{ route('diagnosis.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition flex items-center gap-2">
                    <i class="fas fa-concierge-bell text-sm"></i>
                    Layanan
                </a>
                <a href="{{ route('diagnosis.create') }}" class="text-gray-700 hover:text-blue-600 font-medium transition flex items-center gap-2">
                    <i class="fas fa-stethoscope text-sm"></i>
                    Diagnosa
                </a>
                <a href="{{ route('diagnosis.history') }}" class="text-gray-700 hover:text-blue-600 font-medium transition flex items-center gap-2">
                    <i class="fas fa-history text-sm"></i>
                    Riwayat
                </a>
            </div>

            <!-- CTA Button -->
            <div class="flex items-center gap-4">
                <a href="{{ route('diagnosis.create') }}" 
                   class="btn-primary text-white px-6 py-3 rounded-xl font-medium shadow-md flex items-center gap-2">
                    <i class="fas fa-play-circle"></i>
                    Mulai Diagnosa
                </a>
            </div>

        </div>
    </div>
</nav>

<!-- Content -->
<main class="flex-grow">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-4 gap-12">
            
            <!-- About -->
            <div class="space-y-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-eye text-white text-xl"></i>
                    </div>
                    <div>
                        <span class="text-2xl font-bold">EyeCare</span>
                        <p class="text-gray-400 text-sm mt-1">Sistem Pakar Diagnosa Mata</p>
                    </div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Sistem cerdas berbasis aturan IF-THEN untuk membantu identifikasi awal penyakit mata secara cepat dan akurat.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-400 transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-pink-600 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-6 pb-2 border-b border-gray-800">Menu Utama</h3>
                <ul class="space-y-4">
                    <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Beranda</a></li>
                    <li><a href="{{ route('diagnosis.index') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Layanan</a></li>
                    <li><a href="{{ route('diagnosis.create') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Diagnosa</a></li>
                    <li><a href="{{ route('diagnosis.history') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Riwayat</a></li>
                </ul>
            </div>

            <!-- Penyakit -->
            <div>
                <h3 class="text-lg font-semibold mb-6 pb-2 border-b border-gray-800">Penyakit</h3>
                <ul class="space-y-4">
                    <li class="text-gray-400 flex items-center gap-2"><i class="fas fa-dot-circle text-blue-400 text-xs"></i> Katarak</li>
                    <li class="text-gray-400 flex items-center gap-2"><i class="fas fa-dot-circle text-green-400 text-xs"></i> Glaukoma Akut</li>
                    <li class="text-gray-400 flex items-center gap-2"><i class="fas fa-dot-circle text-red-400 text-xs"></i> Konjungtivitis</li>
                    <li class="text-gray-400 flex items-center gap-2"><i class="fas fa-dot-circle text-purple-400 text-xs"></i> Ablasio Retina</li>
                    <li class="text-gray-400 flex items-center gap-2"><i class="fas fa-dot-circle text-purple-400 text-xs"></i> Sindrom Mata Kering</li>
                    <li class="text-gray-400 flex items-center gap-2"><i class="fas fa-dot-circle text-purple-400 text-xs"></i> Degenerasi Makula</li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="text-lg font-semibold mb-6 pb-2 border-b border-gray-800">Kontak</h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-envelope text-blue-400 mt-1"></i>
                        <div>
                            <p class="text-gray-400 text-sm">Email</p>
                            <p class="text-white">health@eyecare.id</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-phone text-blue-400 mt-1"></i>
                        <div>
                            <p class="text-gray-400 text-sm">Telepon</p>
                            <p class="text-white">(021) 1234-5678</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt text-blue-400 mt-1"></i>
                        <div>
                            <p class="text-gray-400 text-sm">Alamat</p>
                            <p class="text-white">Jakarta, Indonesia</p>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 mt-12 pt-8 text-center">
            <p class="text-gray-500 text-sm">
                &copy; 2026 EyeCare - Sistem Pakar Diagnosa Penyakit Mata. Hak Cipta Dilindungi.
            </p>
            <p class="text-gray-600 text-xs mt-2">
                Hasil diagnosa tidak menggantikan pemeriksaan dokter spesialis mata.
            </p>
        </div>
    </div>
</footer>

@yield('scripts')
</body>
</html>