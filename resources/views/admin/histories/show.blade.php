@extends('layouts.admin')

@section('title', 'Detail Riwayat Diagnosa')
@section('page-title', 'Detail Riwayat Diagnosa')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header -->
    <div class="admin-card p-6">
        <h1 class="text-2xl font-bold text-blue-700">
            {{ $history->disease_name }} ({{ $history->disease_code }})
        </h1>
        <p class="text-gray-500 mt-1">
            {{ $history->created_at->format('d F Y, H:i') }}
        </p>

        <div class="mt-4">
            <span class="text-4xl font-bold text-green-600">
                {{ $history->confidence_level }}%
            </span>
            <p class="text-gray-600">Tingkat Kecocokan</p>
        </div>
    </div>

    <!-- Patient Info -->
    <div class="admin-card p-6">
        <h2 class="text-lg font-semibold mb-4">Data Pasien</h2>
        <p><strong>Nama:</strong> {{ $history->patient_name ?? 'Anonim' }}</p>
        <p><strong>Usia:</strong> {{ $history->age ?? '-' }} tahun</p>
    </div>

    <!-- Symptoms -->
    <div class="admin-card p-6">
        <h2 class="text-lg font-semibold mb-4">Gejala yang Dilaporkan</h2>

        @foreach(json_decode($history->symptoms_detail, true) ?? [] as $symptom)
            <div class="border-b py-2">
                <span class="font-semibold">{{ $symptom['code'] }}</span> :
                <span class="{{ $symptom['answer'] === 'YA' ? 'text-green-600' : 'text-red-600' }}">
                    {{ $symptom['answer'] }}
                </span>
                <p class="text-gray-600 text-sm">{{ $symptom['description'] }}</p>
            </div>
        @endforeach
    </div>

    <!-- Recommendation -->
    <div class="admin-card p-6">
        <h2 class="text-lg font-semibold mb-2">Rekomendasi</h2>
        <p class="text-gray-700">{{ $history->recommendation }}</p>
    </div>

</div>
@endsection
