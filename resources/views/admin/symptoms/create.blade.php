@extends('layouts.admin')

@section('title', 'Tambah Gejala Baru - Sistem Pakar')
@section('page-title', 'Tambah Gejala Baru')
@section('page-subtitle', 'Tambahkan gejala baru ke dalam sistem')

@section('styles')
<style>
    .step-indicator {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .step {
        display: flex;
        align-items: center;
    }
    
    .step-number {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        margin-right: 0.75rem;
        border: 2px solid;
    }
    
    .step.active .step-number {
        background-color: #4f46e5;
        color: white;
        border-color: #4f46e5;
    }
    
    .step.inactive .step-number {
        background-color: white;
        color: #9ca3af;
        border-color: #e5e7eb;
    }
    
    .step-line {
        width: 80px;
        height: 2px;
        background-color: #e5e7eb;
        margin: 0 1rem;
    }
    
    .step-text {
        font-size: 0.875rem;
        font-weight: 500;
        color: #6b7280;
    }
    
    .step.active .step-text {
        color: #4f46e5;
    }
</style>
@endsection

@section('content')
<div class="admin-card max-w-4xl mx-auto">
    <!-- Step Indicator -->
    <div class="p-6 border-b border-gray-100">
        <div class="step-indicator">
            <div class="step active">
                <div class="step-number">1</div>
                <div class="step-text">Informasi Dasar</div>
            </div>
            <div class="step-line"></div>
            <div class="step inactive">
                <div class="step-number">2</div>
                <div class="step-text">Hubungkan Penyakit</div>
            </div>
            <div class="step-line"></div>
            <div class="step inactive">
                <div class="step-number">3</div>
                <div class="step-text">Konfirmasi</div>
            </div>
        </div>
        
        <div class="flex justify-between items-center mt-2">
            <div>
                <h3 class="text-xl font-bold text-gray-800">Form Tambah Gejala</h3>
                <p class="text-gray-600 mt-1">Isi form berikut untuk menambahkan gejala baru</p>
            </div>
            <a href="{{ route('admin.symptoms') }}" 
               class="btn-secondary flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>
    
    <!-- Form -->
    <form action="{{ route('admin.symptoms.store') }}" method="POST" class="p-6">
        @csrf
        
        <!-- Form Section 1: Basic Information -->
        <div class="mb-8">
            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <span class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-info-circle text-blue-600"></i>
                </span>
                Informasi Dasar Gejala
            </h4>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Code Field -->
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                        Kode Gejala *
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="code" 
                               name="code" 
                               value="{{ old('code') }}"
                               class="form-control pl-4 pr-12 @error('code') border-red-500 @enderror"
                               placeholder="G01"
                               required>
                        <div class="absolute right-3 top-3">
                            <span class="text-xs text-gray-400 font-mono">G__</span>
                        </div>
                    </div>
                    @error('code')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500">
                        <i class="fas fa-lightbulb mr-1"></i> Gunakan format G diikuti angka (contoh: G01, G02)
                    </p>
                </div>
                
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Gejala *
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           class="form-control @error('name') border-red-500 @enderror"
                           placeholder="Contoh: Mata merah"
                           required>
                    @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Description Field -->
            <div class="mt-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi Gejala
                    <span class="text-xs font-normal text-gray-500 ml-2">(Opsional)</span>
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="4"
                          class="form-control @error('description') border-red-500 @enderror"
                          placeholder="Jelaskan gejala secara detail...">{{ old('description') }}</textarea>
                @error('description')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div class="mt-2 text-xs text-gray-500 flex justify-between">
                    <span><i class="fas fa-info-circle mr-1"></i> Deskripsi membantu diagnosis lebih akurat</span>
                    <span id="charCount">0/500 karakter</span>
                </div>
            </div>
        </div>
        
        <!-- Form Section 2: Disease Connection -->
        <div class="mb-8 border-t border-gray-100 pt-8">
            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <span class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-link text-purple-600"></i>
                </span>
                Hubungkan dengan Penyakit
                <span class="ml-2 text-xs font-normal text-gray-500">(Opsional)</span>
            </h4>
            
            <div>
                <label for="disease_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Pilih Penyakit Terkait
                </label>
                <select id="disease_id" 
                        name="disease_id"
                        class="form-control @error('disease_id') border-red-500 @enderror">
                    <option value="">-- Pilih Penyakit (Opsional) --</option>
                    @foreach($diseases as $disease)
                    <option value="{{ $disease->id }}" {{ old('disease_id') == $disease->id ? 'selected' : '' }}>
                        [{{ $disease->code }}] {{ $disease->name }}
                    </option>
                    @endforeach
                </select>
                @error('disease_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                
                <!-- Quick Stats -->
                @if($diseases->count() > 0)
                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm font-medium text-gray-700 mb-2">Statistik Penyakit:</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-3 bg-white rounded-lg">
                            <p class="text-2xl font-bold text-gray-800">{{ $diseases->count() }}</p>
                            <p class="text-xs text-gray-500">Total Penyakit</p>
                        </div>
                        <div class="text-center p-3 bg-white rounded-lg">
                            <p class="text-2xl font-bold text-gray-800">
                                {{ $diseases->where('severity', 'tinggi')->count() }}
                            </p>
                            <p class="text-xs text-gray-500">Penyakit Berat</p>
                        </div>
                    </div>
                </div>
                @else
                <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-yellow-500 mt-0.5 mr-3"></i>
                        <div>
                            <p class="text-sm font-medium text-yellow-800">Belum ada data penyakit</p>
                            <p class="text-sm text-yellow-700 mt-1">Hubungkan gejala nanti setelah membuat penyakit terlebih dahulu.</p>
                            <a href="{{ route('admin.diseases.create') }}" class="text-sm text-yellow-800 hover:text-yellow-900 font-medium inline-flex items-center mt-2">
                                <i class="fas fa-plus mr-1"></i> Buat Penyakit
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Form Section 3: Preview & Submit -->
        <div class="border-t border-gray-100 pt-8">
            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <span class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-check-circle text-green-600"></i>
                </span>
                Konfirmasi & Simpan
            </h4>
            
            <!-- Preview Card -->
            <div class="mb-6 admin-card p-6">
                <h5 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">Preview Data</h5>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-500">Kode</p>
                        <p id="previewCode" class="text-sm font-medium text-gray-800">{{ old('code') ?: 'G01' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Nama</p>
                        <p id="previewName" class="text-sm font-medium text-gray-800">{{ old('name') ?: 'Mata merah' }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-xs text-gray-500">Deskripsi</p>
                        <p id="previewDescription" class="text-sm text-gray-600 mt-1">{{ old('description') ?: 'Deskripsi akan muncul di sini' }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-xs text-gray-500">Penyakit Terkait</p>
                        <p id="previewDisease" class="text-sm text-gray-600 mt-1">
                            {{ old('disease_id') ? $diseases->find(old('disease_id'))?->name : 'Belum dipilih' }}
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="flex flex-col-reverse md:flex-row md:items-center md:justify-between">
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('admin.symptoms') }}" 
                       class="inline-flex items-center text-gray-600 hover:text-gray-900">
                        <i class="fas fa-times mr-2"></i> Batalkan
                    </a>
                </div>
                
                <div class="flex space-x-3">
                    <button type="button" 
                            onclick="resetForm()"
                            class="btn-secondary">
                        <i class="fas fa-redo mr-2"></i> Reset
                    </button>
                    
                    <button type="submit" 
                            class="btn-primary flex items-center">
                        <i class="fas fa-save mr-2"></i> Simpan Gejala
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Character counter for description
    const descriptionInput = document.getElementById('description');
    const charCount = document.getElementById('charCount');
    
    if (descriptionInput && charCount) {
        descriptionInput.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length}/500 karakter`;
            
            if (length > 500) {
                charCount.className = 'text-xs text-red-600';
            } else if (length > 450) {
                charCount.className = 'text-xs text-yellow-600';
            } else {
                charCount.className = 'text-xs text-gray-500';
            }
        });
        
        // Trigger initial count
        descriptionInput.dispatchEvent(new Event('input'));
    }
    
    // Live preview update
    const codeInput = document.getElementById('code');
    const nameInput = document.getElementById('name');
    const diseaseSelect = document.getElementById('disease_id');
    
    const previewCode = document.getElementById('previewCode');
    const previewName = document.getElementById('previewName');
    const previewDescription = document.getElementById('previewDescription');
    const previewDisease = document.getElementById('previewDisease');
    
    if (codeInput && previewCode) {
        codeInput.addEventListener('input', function() {
            previewCode.textContent = this.value || 'G01';
        });
    }
    
    if (nameInput && previewName) {
        nameInput.addEventListener('input', function() {
            previewName.textContent = this.value || 'Mata merah';
        });
    }
    
    if (descriptionInput && previewDescription) {
        descriptionInput.addEventListener('input', function() {
            previewDescription.textContent = this.value || 'Deskripsi akan muncul di sini';
        });
    }
    
    if (diseaseSelect && previewDisease) {
        diseaseSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            previewDisease.textContent = selectedOption.text || 'Belum dipilih';
        });
    }
    
    // Reset form
    function resetForm() {
        if (confirm('Apakah Anda yakin ingin mereset form? Semua data yang telah diisi akan hilang.')) {
            document.querySelector('form').reset();
            previewCode.textContent = 'G01';
            previewName.textContent = 'Mata merah';
            previewDescription.textContent = 'Deskripsi akan muncul di sini';
            previewDisease.textContent = 'Belum dipilih';
        }
    }
    
    // Form validation before submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const code = codeInput.value.trim();
        const name = nameInput.value.trim();
        
        if (!code || !name) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi!');
            return false;
        }
        
        // Validate code format (G followed by numbers)
        if (!/^G\d+$/i.test(code)) {
            e.preventDefault();
            alert('Format kode tidak valid! Gunakan format G diikuti angka (contoh: G01, G02)');
            codeInput.focus();
            return false;
        }
    });
</script>
@endsection