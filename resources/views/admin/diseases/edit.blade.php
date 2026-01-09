@extends('layouts.admin')

@section('title', 'Edit Penyakit - Admin')
@section('page-title', 'Edit Penyakit')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="admin-card p-6">
        <form action="{{ route('admin.diseases.update', $disease->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Kode Penyakit *</label>
                    <input type="text" name="code" required 
                           value="{{ old('code', $disease->code) }}"
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           maxlength="10">
                    <p class="text-gray-500 text-sm mt-1">Kode unik (P1, P2, dst)</p>
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Nama Penyakit *</label>
                    <input type="text" name="name" required 
                           value="{{ old('name', $disease->name) }}"
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            
            <div class="mt-6">
                <label class="block text-gray-700 font-medium mb-2">Deskripsi *</label>
                <textarea name="description" required rows="3"
                          class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $disease->description) }}</textarea>
            </div>
            
            <div class="mt-6">
                <label class="block text-gray-700 font-medium mb-2">Gejala Utama *</label>
                <textarea name="symptoms_description" required rows="3"
                          class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('symptoms_description', $disease->symptoms_description) }}</textarea>
            </div>
            
            <div class="mt-6">
                <label class="block text-gray-700 font-medium mb-2">Rekomendasi *</label>
                <textarea name="recommendation" required rows="3"
                          class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('recommendation', $disease->recommendation) }}</textarea>
            </div>
            
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('admin.diseases') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg">
                    Update Penyakit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
