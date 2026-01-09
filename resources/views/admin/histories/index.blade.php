@extends('layouts.admin')

@section('title', 'Riwayat Diagnosa - Admin')
@section('page-title', 'Riwayat Diagnosa')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Riwayat Diagnosa</h2>
            <p class="text-gray-600 mt-1">Total: {{ $histories->total() }} riwayat</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.histories.export.csv') }}" 
               class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg">
                <i class="fas fa-download mr-2"></i> Export CSV
            </a>
        </div>
    </div>
    
    <div class="admin-card p-6">
        @if($histories->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Pasien</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Penyakit</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kecocokan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($histories as $history)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-500">#{{ $history->id }}</td>
                        <td class="px-4 py-3 text-sm">
                            {{ $history->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 py-3">
                            <div>
                                <p class="font-medium">{{ $history->patient_name ?: 'Anonim' }}</p>
                                @if($history->age)
                                <p class="text-sm text-gray-500">{{ $history->age }} tahun</p>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $matchPercent = $history->disease_code !== 'UNKNOWN' ? 100 : 0;
                            @endphp

                            <div class="flex items-center">
                                <div class="w-24 bg-gray-200 rounded-full h-2 mr-3">
                                    <div
                                        class="h-2 rounded-full {{ $matchPercent === 100 ? 'bg-green-600' : 'bg-gray-400' }}"
                                        style="width: {{ $matchPercent }}%">
                                    </div>
                                </div>

                                <span class="text-sm font-semibold {{ $matchPercent === 100 ? 'text-green-600' : 'text-gray-500' }}">
                                    {{ $matchPercent }}%
                                </span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex space-x-3">
                                <a href="{{ route('admin.histories.show', $history->id) }}" 
                                   target="_blank"
                                   class="text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                                <form action="{{ route('admin.histories.destroy', $history->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Hapus riwayat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $histories->links() }}
        </div>
        @else
        <div class="text-center py-12 text-gray-500">
            <i class="fas fa-history text-4xl mb-4"></i>
            <p class="text-lg">Belum ada riwayat diagnosa</p>
        </div>
        @endif
    </div>
</div>
@endsection