@extends('layouts.admin')

@section('title', 'Kelola Gejala - Sistem Pakar')
@section('page-title', 'Manajemen Gejala')
@section('page-subtitle', 'Kelola data gejala untuk sistem diagnosa')

@section('content')
<div class="space-y-6">
    <!-- Header dengan Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Gejala</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $symptoms->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-stethoscope text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <span class="text-xs text-gray-500">Updated just now</span>
            </div>
        </div>
        
        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Terkait Penyakit</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $symptoms->whereNotNull('disease_id')->count() }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-link text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <span class="text-xs text-green-600">+{{ $symptoms->whereNotNull('disease_id')->count() }} linked</span>
            </div>
        </div>
        
        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Tanpa Penyakit</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $symptoms->whereNull('disease_id')->count() }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-unlink text-yellow-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <span class="text-xs text-yellow-600">Need attention</span>
            </div>
        </div>
        
        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Penyakit Tersedia</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $diseases->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-eye text-purple-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.diseases') }}" class="text-xs text-purple-600 hover:text-purple-800">View all →</a>
            </div>
        </div>
    </div>
    
    <!-- Main Content Card -->
    <div class="admin-card">
        <!-- Card Header -->
        <div class="p-6 border-b border-gray-100">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Gejala</h3>
                    <p class="text-gray-600 mt-1">Kelola semua gejala dalam sistem</p>
                </div>
                
                <div class="mt-4 md:mt-0 flex space-x-3">
                    <!-- Search Bar -->
                    <div class="relative">
                        <input type="text" 
                               placeholder="Cari gejala..." 
                               class="form-control pl-10 pr-4 py-2 w-64"
                               id="searchInput">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    
                    <!-- Filter Dropdown -->
                    <div class="relative">
                        <select class="form-control pl-3 pr-8 py-2 appearance-none bg-white">
                            <option value="">Semua Status</option>
                            <option value="linked">Terkait Penyakit</option>
                            <option value="unlinked">Belum Terkait</option>
                        </select>
                        <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
                    </div>
                    
                    <!-- Add Button -->
                    <a href="{{ route('admin.symptoms.create') }}" 
                       class="btn-primary flex items-center">
                        <i class="fas fa-plus mr-2"></i> Tambah Baru
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="table-header">
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            <div class="flex items-center">
                                <span>Kode</span>
                                <i class="fas fa-sort ml-1 text-gray-400 cursor-pointer"></i>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Nama Gejala
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Penyakit Terkait
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Status
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($symptoms as $symptom)
                    <tr class="table-row">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="badge badge-primary font-mono">{{ $symptom->code }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-start">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $symptom->name }}</div>
                                    @if($symptom->description)
                                    <div class="text-sm text-gray-500 mt-1 max-w-md">
                                        {{ Str::limit($symptom->description, 120) }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($symptom->disease)
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-eye text-indigo-600 text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $symptom->disease->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $symptom->disease->code }}</div>
                                </div>
                            </div>
                            @else
                            <div class="flex items-center text-gray-400">
                                <i class="fas fa-unlink mr-2"></i>
                                <span class="text-sm">Belum dihubungkan</span>
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($symptom->disease)
                            <span class="badge badge-success flex items-center w-24 justify-center">
                                <i class="fas fa-check-circle mr-1"></i> Terhubung
                            </span>
                            @else
                            <span class="badge badge-warning flex items-center w-24 justify-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> Pending
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.symptoms.edit', $symptom->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 transition-colors"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <button class="text-gray-400 hover:text-gray-600 transition-colors"
                                        title="Quick View"
                                        onclick="showDetail('{{ $symptom->code }}', '{{ $symptom->name }}', '{{ $symptom->description }}', '{{ $symptom->disease ? $symptom->disease->name : 'Belum terhubung' }}')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                
                                <form action="{{ route('admin.symptoms.destroy', $symptom->id) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 transition-colors"
                                            title="Hapus"
                                            onclick="return confirmDelete()">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="text-gray-400">
                                <i class="fas fa-stethoscope text-4xl mb-4"></i>
                                <p class="text-lg font-medium text-gray-500">Belum ada data gejala</p>
                                <p class="text-gray-400 mt-2">Mulai dengan menambahkan gejala pertama</p>
                                <a href="{{ route('admin.symptoms.create') }}" 
                                   class="btn-primary inline-flex items-center mt-4">
                                    <i class="fas fa-plus mr-2"></i> Tambah Gejala Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Card Footer -->
        @if($symptoms->count() > 0)
        <div class="p-6 border-t border-gray-100">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div class="text-sm text-gray-500">
                    Menampilkan <span class="font-medium">{{ $symptoms->count() }}</span> dari <span class="font-medium">{{ $symptoms->count() }}</span> gejala
                </div>
                
                <div class="mt-4 md:mt-0">
                    <nav class="pagination">
                        <button class="page-link">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="page-link active">1</button>
                        <button class="page-link">2</button>
                        <button class="page-link">3</button>
                        <button class="page-link">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Quick Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="admin-card p-6">
            <h4 class="font-semibold text-gray-800 mb-4">Tips & Best Practices</h4>
            <ul class="space-y-3 text-sm text-gray-600">
                <li class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                    <span>Pastikan kode gejala unik dan konsisten</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                    <span>Hubungkan gejala dengan penyakit yang relevan</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                    <span>Gunakan deskripsi yang jelas dan spesifik</span>
                </li>
            </ul>
        </div>
        
        <div class="admin-card p-6">
            <h4 class="font-semibold text-gray-800 mb-4">Status Sistem</h4>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Database</span>
                    <span class="badge badge-success">Online</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Cache</span>
                    <span class="badge badge-success">Aktif</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Logging</span>
                    <span class="badge badge-warning">Monitoring</span>
                </div>
            </div>
        </div>
        
        <div class="admin-card p-6">
            <h4 class="font-semibold text-gray-800 mb-4">Quick Actions</h4>
            <div class="space-y-3">
                <a href="{{ route('admin.diseases') }}" 
                   class="flex items-center justify-between p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                    <span class="text-sm font-medium">Lihat Semua Penyakit</span>
                    <i class="fas fa-arrow-right text-gray-400"></i>
                </a>
                <a href="{{ route('admin.histories') }}" 
                   class="flex items-center justify-between p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                    <span class="text-sm font-medium">Cek Riwayat Diagnosa</span>
                    <i class="fas fa-arrow-right text-gray-400"></i>
                </a>
                <button class="flex items-center justify-between w-full p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors"
                        onclick="exportData()">
                    <span class="text-sm font-medium">Export Data Gejala</span>
                    <i class="fas fa-download text-gray-400"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black bg-opacity-50" onclick="closeDetail()"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-md">
        <div class="admin-card">
            <div class="p-6 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800">Detail Gejala</h3>
                    <button onclick="closeDetail()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</label>
                        <p id="detailCode" class="mt-1 text-lg font-mono font-semibold"></p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Gejala</label>
                        <p id="detailName" class="mt-1 text-gray-800"></p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Penyakit Terkait</label>
                        <p id="detailDisease" class="mt-1"></p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</label>
                        <p id="detailDescription" class="mt-1 text-gray-600"></p>
                    </div>
                </div>
            </div>
            <div class="p-6 border-t border-gray-100 bg-gray-50 rounded-b-lg">
                <div class="flex justify-end space-x-3">
                    <button onclick="closeDetail()" class="btn-secondary">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
    
    // Show detail modal
    function showDetail(code, name, description, disease) {
        document.getElementById('detailCode').textContent = code;
        document.getElementById('detailName').textContent = name;
        document.getElementById('detailDescription').textContent = description || 'Tidak ada deskripsi';
        document.getElementById('detailDisease').textContent = disease;
        document.getElementById('detailModal').classList.remove('hidden');
    }
    
    // Close detail modal
    function closeDetail() {
        document.getElementById('detailModal').classList.add('hidden');
    }
    
    // Confirm delete
    function confirmDelete() {
        return confirm('Apakah Anda yakin ingin menghapus gejala ini? Tindakan ini tidak dapat dibatalkan.');
    }
    
    // Export data
    function exportData() {
        alert('Fitur export data akan segera hadir!');
    }
    
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        // Add tooltip functionality
        const tooltipElements = document.querySelectorAll('[title]');
        tooltipElements.forEach(el => {
            el.addEventListener('mouseenter', function(e) {
                const tooltip = document.createElement('div');
                tooltip.className = 'fixed z-50 px-3 py-2 text-sm text-white bg-gray-900 rounded-lg shadow-lg';
                tooltip.textContent = this.getAttribute('title');
                document.body.appendChild(tooltip);
                
                const rect = this.getBoundingClientRect();
                tooltip.style.left = rect.left + 'px';
                tooltip.style.top = (rect.top - 40) + 'px';
                
                this._tooltip = tooltip;
            });
            
            el.addEventListener('mouseleave', function() {
                if (this._tooltip) {
                    this._tooltip.remove();
                }
            });
        });
    });
</script>

<style>
    /* Additional custom styles */
    .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .badge-primary {
        background-color: #e0e7ff;
        color: #4f46e5;
    }
    
    .badge-success {
        background-color: #d1fae5;
        color: #059669;
    }
    
    .badge-warning {
        background-color: #fef3c7;
        color: #d97706;
    }
    
    .table-row:hover {
        background-color: #f8fafc;
    }
    
    .page-link {
        min-width: 2.5rem;
        height: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: #6b7280;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .page-link:hover {
        background-color: #f3f4f6;
        color: #374151;
    }
    
    .page-link.active {
        background-color: #4f46e5;
        color: white;
    }
</style>
@endsection