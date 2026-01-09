@extends('layouts.admin')

@section('title', 'Dashboard Admin - Sistem Pakar')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="admin-card stat-card border-l-4 border-blue-500 p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Penyakit</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalDiseases }}</h3>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-eye text-blue-600 text-xl"></i>
                </div>
            </div>
            <p class="text-gray-600 text-sm mt-4">
                <i class="fas fa-info-circle mr-1"></i>
                6 jenis penyakit mata
            </p>
        </div>
        
        <div class="admin-card stat-card border-l-4 border-green-500 p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Gejala</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalSymptoms }}</h3>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-stethoscope text-green-600 text-xl"></i>
                </div>
            </div>
            <p class="text-gray-600 text-sm mt-4">
                <i class="fas fa-info-circle mr-1"></i>
                30 gejala klinis
            </p>
        </div>
        
        <div class="admin-card stat-card border-l-4 border-purple-500 p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Diagnosa</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalHistories }}</h3>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-history text-purple-600 text-xl"></i>
                </div>
            </div>
            <p class="text-gray-600 text-sm mt-4">
                <i class="fas fa-calendar-day mr-1"></i>
                {{ $todayHistories }} hari ini
            </p>
        </div>
        
        <div class="admin-card stat-card border-l-4 border-yellow-500 p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Admin</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">1</h3>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-shield text-yellow-600 text-xl"></i>
                </div>
            </div>
            <p class="text-gray-600 text-sm mt-4">
                <i class="fas fa-user mr-1"></i>
                {{ Auth::user()->name }}
            </p>
        </div>
    </div>
    
    <!-- Simple Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Penyakit Stats -->
        <div class="admin-card p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-chart-bar mr-2"></i> Statistik Penyakit
            </h3>
            <div class="space-y-3">
                @foreach($diseaseStats as $stat)
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">{{ $stat->disease_name }}</span>
                    <div class="flex items-center">
                        <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                            <div class="bg-blue-500 h-2 rounded-full" 
                                 style="width: {{ ($stat->count / max($totalHistories, 1)) * 100 }}%"></div>
                        </div>
                        <span class="font-semibold">{{ $stat->count }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Weekly Stats -->
        <div class="admin-card p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-calendar-alt mr-2"></i> 7 Hari Terakhir
            </h3>
            <div class="space-y-3">
                @foreach($weeklyStats as $stat)
                <div class="flex items-center justify-between">
                    @php
                        $date = new DateTime($stat->date);
                        $dayName = $date->format('D');
                        $dayNumber = $date->format('d');
                        $indonesianDays = [
                            'Sun' => 'Ming', 'Mon' => 'Sen', 'Tue' => 'Sel', 
                            'Wed' => 'Rab', 'Thu' => 'Kam', 'Fri' => 'Jum', 'Sat' => 'Sab'
                        ];
                    @endphp
                    <span class="text-gray-700">{{ $indonesianDays[$dayName] }}, {{ $dayNumber }}</span>
                    <div class="flex items-center">
                        <span class="font-semibold mr-3">{{ $stat->count }} diagnosa</span>
                        <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm">
                            {{ $stat->count }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- Recent Histories -->
    <div class="admin-card p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-clock mr-2"></i> Riwayat Diagnosa Terbaru
            </h3>
            <a href="{{ route('admin.histories') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        
        @if($recentHistories->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Pasien</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Penyakit</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kecocokan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($recentHistories as $history)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">
                            {{ $history->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $history->patient_name ?: 'Anonim' }}
                            @if($history->age)
                            <span class="text-gray-500">({{ $history->age }} thn)</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="font-medium">{{ $history->disease_name }}</span>
                            <span class="text-gray-500 text-xs ml-2">({{ $history->disease_code }})</span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $history->confidence_level >= 80 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $history->confidence_level }}%
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('diagnosis.history.detail', $history->id) }}" 
                               target="_blank"
                               class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-8 text-gray-500">
            <i class="fas fa-history text-3xl mb-3"></i>
            <p>Belum ada riwayat diagnosa</p>
        </div>
        @endif
    </div>
    
    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.diseases') }}" class="admin-card p-6 hover:shadow-lg transition duration-300">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-plus text-blue-600"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Kelola Penyakit</h4>
                    <p class="text-sm text-gray-600 mt-1">Lihat dan tambah penyakit</p>
                </div>
            </div>
        </a>
        
        <a href="{{ route('admin.symptoms') }}" class="admin-card p-6 hover:shadow-lg transition duration-300">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-plus text-green-600"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Kelola Gejala</h4>
                    <p class="text-sm text-gray-600 mt-1">Lihat dan tambah gejala</p>
                </div>
            </div>
        </a>
        
        <a href="{{ route('admin.histories.export.csv') }}" class="admin-card p-6 hover:shadow-lg transition duration-300">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-download text-purple-600"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Export Data</h4>
                    <p class="text-sm text-gray-600 mt-1">Download riwayat dalam CSV</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection