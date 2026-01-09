@extends('layouts.app')

@section('title', 'Riwayat Diagnosa - Sistem Pakar')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
            <h1 class="text-3xl font-bold text-blue-800">Riwayat Diagnosa</h1>
            <a href="{{ route('diagnosis.create') }}" 
               class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                + Diagnosa Baru
            </a>
        </div>
        
        @if($histories->count() > 0)
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="w-full">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold text-gray-700">Tanggal</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-700">Nama Pasien</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-700">Penyakit</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-700">Kecocokan</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $history)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">
                            {{ $history->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="py-3 px-4">
                            <div class="font-medium">{{ $history->patient_name ?: 'Tidak diisi' }}</div>
                            @if($history->age)
                            <div class="text-sm text-gray-500">{{ $history->age }} tahun</div>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <div class="font-semibold">{{ $history->disease_code }}:</div>
                            <div class="text-gray-700">{{ $history->disease_name }}</div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                <span class="font-semibold {{ $history->confidence_level >= 80 ? 'text-green-600' : ($history->confidence_level >= 50 ? 'text-yellow-600' : 'text-red-600') }} mr-3">
                                    {{ number_format($history->confidence_level, 1) }}%
                                </span>
                                <div class="w-20 bg-gray-200 rounded-full h-2">
                                    <div class="h-2 rounded-full {{ $history->confidence_level >= 80 ? 'bg-green-500' : ($history->confidence_level >= 50 ? 'bg-yellow-500' : 'bg-red-500') }}" 
                                         style="width: {{ $history->confidence_level }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <button
                                onclick="showHistoryDetail('{{ route('diagnosis.history.detail', $history->id) }}')"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 text-sm text-gray-500">
            Total {{ $histories->count() }} riwayat diagnosa
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Riwayat</h3>
            <p class="text-gray-500 mb-6">Lakukan diagnosa terlebih dahulu untuk melihat riwayat di sini</p>
            <a href="{{ route('diagnosis.create') }}" 
               class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                Mulai Diagnosa Pertama
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Modal for Detail -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-50">
    <div class="bg-white rounded-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Detail Diagnosa</h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="modalContent">
                <!-- Content loaded via AJAX -->
            </div>
        </div>
    </div>
</div>

<script>
function showHistoryDetail(url) {
    // Show loading
    document.getElementById('modalContent').innerHTML = `
        <div class="text-center py-12">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
            <p class="mt-4 text-gray-600">Memuat data...</p>
        </div>
    `;
    
    document.getElementById('detailModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Load content
    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error('Network error');
            return response.text();
        })
        .then(html => {
            document.getElementById('modalContent').innerHTML = html;
        })
        .catch(error => {
            document.getElementById('modalContent').innerHTML = `
                <div class="text-center py-8">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Gagal Memuat Data</h3>
                    <p class="text-gray-600 mb-4">Terjadi kesalahan saat memuat detail diagnosa.</p>
                    <button onclick="showHistoryDetail('${url}')" 
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Coba Lagi
                    </button>
                </div>
            `;
        });
}

function closeModal() {
    document.getElementById('detailModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal on outside click
document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('detailModal').classList.contains('hidden')) {
        closeModal();
    }
});
</script>

<style>
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

.rounded-xl {
    border-radius: 0.75rem;
}

/* Modal animation */
#detailModal {
    animation: fadeIn 0.2s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Responsive table */
@media (max-width: 768px) {
    .overflow-x-auto {
        font-size: 0.875rem;
    }
    
    .overflow-x-auto th,
    .overflow-x-auto td {
        padding: 0.75rem 0.5rem;
    }
}
</style>
@endsection