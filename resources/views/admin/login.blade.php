<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Sistem Pakar</title>
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .login-header {
            background: linear-gradient(90deg, #1e40af 0%, #3b82f6 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="login-card w-full max-w-md">
        <!-- Header -->
        <div class="login-header text-white p-6 rounded-t-2xl text-center">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-brain text-blue-600 text-3xl"></i>
            </div>
            <h1 class="text-2xl font-bold">Admin Panel</h1>
            <p class="text-blue-200 mt-1">Sistem Pakar Diagnosa Penyakit Mata</p>
        </div>
        
        <!-- Login Form -->
        <div class="p-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Masuk ke Dashboard</h2>
            
            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                    <div>
                        @foreach($errors->all() as $error)
                        <p class="text-red-700">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2 font-medium">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </label>
                    <input type="email" name="email" required 
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="admin@expert-system.com"
                           value="{{ old('email') }}">
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2 font-medium">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <input type="password" name="password" required 
                           class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="••••••••">
                </div>
                
                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-300">
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                </button>
            </form>
            
            <div class="mt-8 pt-6 border-t text-center text-gray-600 text-sm">
                <p>Login hanya untuk administrator sistem</p>
                <p class="mt-2">
                    <i class="fas fa-info-circle mr-2"></i>
                    Default: administrator
                </p>
                <a href="{{ route('diagnosis.index') }}" class="inline-block mt-4 text-blue-600 hover:text-blue-800">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Sistem Diagnosa
                </a>
            </div>
        </div>
    </div>
</body>
</html>