@extends('layouts.admin')

@section('title', 'Profil Admin - Admin')
@section('page-title', 'Profil Admin')

@section('content')
<div class="max-w-3xl mx-auto">

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR MESSAGE --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Info -->
        <div class="lg:col-span-1">
            <div class="admin-card p-6">
                <div class="text-center">
                    <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-shield text-blue-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h3>
                    <p class="text-gray-600 mt-1">{{ $user->email }}</p>
                    <div class="mt-3">
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full font-semibold">
                            Administrator
                        </span>
                    </div>
                    <div class="mt-6 text-sm text-gray-500">
                        <p>
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Bergabung: {{ $user->created_at->format('d M Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Form -->
        <div class="lg:col-span-2">
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Update Profil</h3>

                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nama</label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                required
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Email</label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                required
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="border-t pt-6">
                            <h4 class="text-md font-semibold text-gray-800 mb-4">Ubah Password</h4>

                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Password Saat Ini</label>
                                <input
                                    type="password"
                                    name="current_password"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 mb-2">Password Baru</label>
                                    <input
                                        type="password"
                                        name="new_password"
                                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2">Konfirmasi Password</label>
                                    <input
                                        type="password"
                                        name="new_password_confirmation"
                                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <p class="text-gray-500 text-sm mt-4">
                                <i class="fas fa-info-circle mr-2"></i>
                                Kosongkan jika tidak ingin mengubah password
                            </p>
                        </div>

                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
