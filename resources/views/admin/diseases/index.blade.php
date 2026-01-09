@extends('layouts.admin')

@section('title', 'Kelola Penyakit - Admin')
@section('page-title', 'Data Penyakit')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Daftar Penyakit</h2>
            <p class="text-gray-600 mt-1">Total: {{ $diseases->count() }} penyakit</p>
        </div>
        <a href="{{ route('admin.diseases.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">
            <i class="fas fa-plus mr-2"></i> Tambah
        </a>
    </div>
    
    <div class="admin-card p-6">
        @if($diseases->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($diseases as $disease)
            <div class="border rounded-lg p-5 hover:shadow-md transition duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="font-bold text-blue-600 text-lg">{{ $disease->code }}</span>
                        <h3 class="text-lg font-semibold text-gray-800 mt-1">{{ $disease->name }}</h3>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.diseases.edit', $disease->id) }}" 
                           class="text-blue-600 hover:text-blue-800 p-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.diseases.destroy', $disease->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Hapus {{ $disease->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 p-1">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mt-3 line-clamp-2">{{ $disease->description }}</p>
                <div class="mt-4 pt-4 border-t">
                    <p class="text-sm text-gray-500">
                        <i class="fas fa-stethoscope mr-2"></i>
                        {{ $disease->symptoms_count }} gejala
                    </p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12 text-gray-500">
            <i class="fas fa-eye-slash text-4xl mb-4"></i>
            <p class="text-lg">Belum ada data penyakit</p>
        </div>
        @endif
    </div>
</div>
@endsection