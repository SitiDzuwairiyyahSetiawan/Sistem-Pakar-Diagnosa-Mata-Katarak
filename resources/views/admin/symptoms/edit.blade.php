@extends('layouts.admin')

@section('title', 'Edit Gejala - Sistem Pakar')
@section('page-title', 'Edit Gejala')

@section('content')
<div class="admin-card p-6 max-w-4xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Form Edit Gejala</h2>
            <p class="text-gray-600 mt-1">Ubah data gejala untuk sistem diagnosa</p>
        </div>
        <a href="{{ route('admin.symptoms') }}" 
           class="text-gray-600 hover:text-gray-900 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.symptoms.update', $symptom->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Kode Gejala -->
            <div>
                <label for="code" class="block text-sm font-medium text-gray-700 mb-1">
                    Kode Gejala *
                </label>
                <input type="text" 
                       id="code" 
                       name="code" 
                       value="{{ old('code', $symptom->code) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('code') border-red-500 @enderror"
                       required>
                @error('code')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Penyakit Terkait -->
            <div>
                <label for="disease_id" class="block text-sm font-medium text-gray-700 mb-1">
                    Penyakit Terkait
                </label>
                <select id="disease_id" 
                        name="disease_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('disease_id') border-red-500 @enderror">
                    <option value="">-- Pilih Penyakit (Opsional) --</option>
                    @foreach($diseases as $disease)
                    <option value="{{ $disease->id }}" 
                        {{ old('disease_id', $symptom->disease_id) == $disease->id ? 'selected' : '' }}>
                        {{ $disease->code }} - {{ $disease->name }}
                    </option>
                    @endforeach
                </select>
                @error('disease_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Nama Gejala -->
        <div class="mt-6">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Nama Gejala *
            </label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   value="{{ old('name', $symptom->name) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                   required>
            @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div class="mt-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                Deskripsi Gejala
            </label>
            <textarea id="description" 
                      name="description" 
                      rows="4"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $symptom->description) }}</textarea>
            @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Informasi Tambahan -->
        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <h3 class="text-sm font-medium text-blue-800 mb-2">
                <i class="fas fa-info-circle mr-2"></i>Informasi Gejala
            </h3>
            <div class="grid grid-cols-2 gap-4 text-sm text-blue-700">
                <div>
                    <span class="font-medium">Dibuat:</span>
                    {{ $symptom->created_at->format('d M Y H:i') }}
                </div>
                <div>
                    <span class="font-medium">Diupdate:</span>
                    {{ $symptom->updated_at->format('d M Y H:i') }}
                </div>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.symptoms') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 flex items-center">
                    <i class="fas fa-save mr-2"></i> Update Gejala
                </button>
            </div>
        </div>
    </form>
</div>
@endsection