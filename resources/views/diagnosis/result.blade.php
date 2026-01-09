@extends('layouts.app')

@section('title', 'Hasil Diagnosa - Sistem Pakar')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-6">

    <!-- Header -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6 text-center">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-blue-800 mb-2">Hasil Diagnosa</h1>
        <p class="text-gray-600">Berdasarkan gejala yang Anda pilih</p>
    </div>

    <!-- Patient Info -->
    @if($patientName || $age)
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-6">
        <h3 class="font-semibold text-blue-700 mb-3">Informasi Pasien</h3>
        <div class="grid md:grid-cols-2 gap-4">
            @if($patientName)
            <div class="bg-white p-4 rounded-lg border">
                <div class="text-sm text-gray-500">Nama</div>
                <div class="font-medium text-gray-800">{{ $patientName }}</div>
            </div>
            @endif
            @if($age)
            <div class="bg-white p-4 rounded-lg border">
                <div class="text-sm text-gray-500">Usia</div>
                <div class="font-medium text-gray-800">{{ $age }} tahun</div>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Diagnosis Result -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Kesimpulan Diagnosa</h2>

        @if($disease->code !== 'UNKNOWN')
            <div class="bg-green-50 border border-green-200 rounded-lg p-5 mb-4">
                <p class="text-green-800 text-lg">
                    Berdasarkan aturan yang ada, sistem menyimpulkan bahwa pasien
                    <span class="font-bold">mengalami {{ $disease->name }}</span>
                    <span class="text-sm text-green-700">({{ $disease->code }})</span>.
                </p>
            </div>
        @else
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-5 mb-4">
                <p class="text-gray-700 text-lg">
                    Tidak ditemukan penyakit mata yang sesuai dengan aturan sistem.
                </p>
            </div>
        @endif

        @if(isset($disease->description) && $disease->description)
        <div class="mb-4">
            <h3 class="font-semibold text-gray-700 mb-2">Deskripsi Penyakit</h3>
            <p class="text-gray-700 leading-relaxed">{{ $disease->description }}</p>
        </div>
        @endif
    </div>

    <!-- Matched Symptoms -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">
            Gejala yang Terpenuhi
        </h3>

        @if(count($matchedSymptoms) > 0)
            <ul class="space-y-2">
                @foreach($matchedSymptoms as $symptom)
                <li class="flex items-start bg-green-50 border border-green-200 p-3 rounded-lg">
                    <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="text-gray-800">{{ $symptom }}</span>
                </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">
                Tidak ada gejala yang sepenuhnya memenuhi aturan diagnosis.
            </p>
        @endif
    </div>

    <!-- Recommendation -->
    <div class="bg-blue-600 text-white rounded-xl p-6 mb-6">
        <h3 class="text-xl font-semibold mb-3">Rekomendasi</h3>
        <p class="leading-relaxed">
            {{ $disease->recommendation ?? 'Disarankan untuk berkonsultasi dengan dokter spesialis mata.' }}
        </p>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col md:flex-row justify-between gap-4">
        <div class="flex gap-3">
            <a href="{{ route('diagnosis.create') }}"
               class="px-5 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">
                Diagnosa Baru
            </a>
            <a href="{{ route('diagnosis.history') }}"
               class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200">
                Riwayat Diagnosa
            </a>
        </div>
        <a href="{{ route('diagnosis.index') }}"
           class="px-5 py-2.5 bg-gray-800 text-white rounded-lg font-medium hover:bg-gray-900">
            Kembali ke Beranda
        </a>
    </div>

    <!-- Disclaimer -->
    <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-xl p-6">
        <h4 class="font-bold text-yellow-800 mb-2">Peringatan Medis</h4>
        <p class="text-yellow-700">
            Hasil diagnosa ini hanya bersifat informasi awal dan
            <strong>tidak menggantikan diagnosis dokter</strong>.
            Silakan konsultasi ke dokter spesialis mata untuk pemeriksaan lanjutan.
        </p>
    </div>

</div>
@endsection
