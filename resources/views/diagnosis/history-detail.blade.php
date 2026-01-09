@extends('layouts.app')

@section('title', 'Detail Diagnosa')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Detail Diagnosa</h1>
    <p><strong>Nama Pasien:</strong> {{ $history->patient_name }}</p>
    <p><strong>Usia:</strong> {{ $history->age ?? '-' }} thn</p>
    <p><strong>Penyakit:</strong> {{ $history->disease_name }} ({{ $history->disease_code }})</p>
    <p><strong>Kecocokan:</strong> {{ $history->confidence_level }}%</p>
    <p><strong>Gejala Dipilih:</strong> {{ $history->symptoms_selected }}</p>
    <p><strong>Rekomendasi:</strong> {{ $history->recommendation }}</p>

    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 mt-4 inline-block">Kembali</a>
</div>
@endsection
