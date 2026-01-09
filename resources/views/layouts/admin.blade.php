<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Sistem Pakar')</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
        }
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background-color: #f8fafc;
        }
        
        .sidebar {
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            transition: all 0.3s ease;
        }
        
        .sidebar-nav a {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .sidebar-nav a.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--primary);
        }
        
        .sidebar-nav a.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: var(--primary);
        }
        
        .sidebar-nav a:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.05);
        }
        
        .admin-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .admin-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }
        
        .stat-card {
            border-left: 5px solid;
            padding-left: 1.5rem;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
            padding: 0.625rem 1.25rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }
        
        .btn-secondary {
            background-color: #64748b;
            color: white;
            padding: 0.625rem 1.25rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background-color: #475569;
        }
        
        .btn-danger {
            background-color: var(--danger);
            color: white;
            padding: 0.625rem 1.25rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-danger:hover {
            background-color: #dc2626;
        }
        
        .table-header {
            background: linear-gradient(90deg, #f8fafc 0%, #f1f5f9 100%);
            font-weight: 600;
            color: #475569;
        }
        
        .table-row:hover {
            background-color: #f8fafc;
        }
        
        .form-control {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .badge-primary {
            background-color: #e0e7ff;
            color: var(--primary-dark);
        }
        
        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }
        
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }
        
        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }
        
        .alert-warning {
            background-color: #fef3c7;
            color: #92400e;
            border-left: 4px solid #f59e0b;
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e0e7ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: 600;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }
        
        .page-link {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            color: #4b5563;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .page-link:hover {
            background-color: #f3f4f6;
        }
        
        .page-link.active {
            background-color: var(--primary);
            color: white;
        }
    </style>
    
    @yield('styles')
</head>
<body class="text-gray-800">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="sidebar w-64 text-white flex-shrink-0 hidden lg:block">
            <div class="p-6">
                <div class="flex items-center space-x-3">
                    <div class="avatar">
                        <i class="fas fa-brain"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Sistem Pakar</h1>
                        <p class="text-sm text-slate-300">Diagnosa Penyakit Mata</p>
                    </div>
                </div>
            </div>
            
            <div class="sidebar-nav mt-8">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3 w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>
                
                <div class="px-6 py-3 text-slate-400 text-xs font-semibold uppercase tracking-wider mt-6">
                    Manajemen Data
                </div>
                
                <a href="{{ route('admin.diseases') }}" 
                   class="flex items-center px-6 py-3 {{ request()->routeIs('admin.diseases*') ? 'active' : '' }}">
                    <i class="fas fa-eye mr-3 w-5 text-center"></i>
                    <span>Penyakit</span>
                </a>
                
                <a href="{{ route('admin.symptoms') }}" 
                   class="flex items-center px-6 py-3 {{ request()->routeIs('admin.symptoms*') ? 'active' : '' }}">
                    <i class="fas fa-stethoscope mr-3 w-5 text-center"></i>
                    <span>Gejala</span>
                    @if(request()->routeIs('admin.symptoms*'))
                    <span class="ml-auto bg-blue-500 text-xs px-2 py-1 rounded-full">Active</span>
                    @endif
                </a>
                
                <a href="{{ route('admin.histories') }}" 
                   class="flex items-center px-6 py-3 {{ request()->routeIs('admin.histories*') ? 'active' : '' }}">
                    <i class="fas fa-history mr-3 w-5 text-center"></i>
                    <span>Riwayat</span>
                </a>
                
                <div class="px-6 py-3 text-slate-400 text-xs font-semibold uppercase tracking-wider mt-6">
                    Akun
                </div>
                
                <a href="{{ route('admin.profile') }}" 
                   class="flex items-center px-6 py-3 {{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
                    <i class="fas fa-user mr-3 w-5 text-center"></i>
                    <span>Profil</span>
                </a>
                
                <form method="POST" action="{{ route('admin.logout') }}" class="px-6 py-3">
                    @csrf
                    <button type="submit" class="flex items-center w-full text-left text-slate-300 hover:text-white">
                        <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
            
            <div class="mt-auto p-6 text-center text-slate-400 text-sm">
                <div class="flex items-center justify-center space-x-2 mb-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span>Sistem Aktif</span>
                </div>
                <p>© 2024 Sistem Pakar</p>
                <p class="text-xs mt-1">v1.0.0</p>
            </div>
        </div>
        
        <!-- Mobile Header -->
        <div class="lg:hidden fixed top-0 left-0 right-0 bg-white shadow-sm z-50">
            <div class="flex items-center justify-between p-4">
                <div class="flex items-center space-x-3">
                    <button id="mobile-menu-toggle" class="text-gray-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div>
                        <h2 class="text-lg font-semibold">@yield('page-title', 'Dashboard')</h2>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="avatar">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile Sidebar -->
        <div id="mobile-sidebar" class="fixed inset-0 z-50 lg:hidden" style="display: none;">
            <div class="absolute inset-0 bg-black bg-opacity-50" id="mobile-sidebar-overlay"></div>
            <div class="absolute inset-y-0 left-0 w-64 sidebar">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div class="avatar">
                                <i class="fas fa-brain"></i>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold">Sistem Pakar</h1>
                                <p class="text-sm text-slate-300">Admin Panel</p>
                            </div>
                        </div>
                        <button id="mobile-menu-close" class="text-white">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                
                <div class="sidebar-nav mt-4">
                    <!-- Mobile Navigation Items (same as desktop) -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </a>
                    
                    <div class="px-6 py-3 text-slate-400 text-xs font-semibold uppercase">Manajemen Data</div>
                    
                    <a href="{{ route('admin.diseases') }}" 
                       class="flex items-center px-6 py-3 {{ request()->routeIs('admin.diseases*') ? 'active' : '' }}">
                        <i class="fas fa-eye mr-3"></i> Penyakit
                    </a>
                    
                    <a href="{{ route('admin.symptoms') }}" 
                       class="flex items-center px-6 py-3 {{ request()->routeIs('admin.symptoms*') ? 'active' : '' }}">
                        <i class="fas fa-stethoscope mr-3"></i> Gejala
                    </a>
                    
                    <a href="{{ route('admin.histories') }}" 
                       class="flex items-center px-6 py-3 {{ request()->routeIs('admin.histories*') ? 'active' : '' }}">
                        <i class="fas fa-history mr-3"></i> Riwayat
                    </a>
                    
                    <div class="px-6 py-3 text-slate-400 text-xs font-semibold uppercase">Akun</div>
                    
                    <a href="{{ route('admin.profile') }}" 
                       class="flex items-center px-6 py-3 {{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
                        <i class="fas fa-user mr-3"></i> Profil
                    </a>
                    
                    <form method="POST" action="{{ route('admin.logout') }}" class="px-6 py-3">
                        @csrf
                        <button type="submit" class="flex items-center w-full text-left text-slate-300 hover:text-white">
                            <i class="fas fa-sign-out-alt mr-3"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm border-b p-4 lg:p-6">
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center">
                    <div class="mb-4 lg:mb-0">
                        <h2 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-gray-600 mt-1">@yield('page-subtitle', 'Sistem Pakar Diagnosa Penyakit Mata')</p>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="hidden lg:flex items-center space-x-3 bg-gray-50 px-4 py-2 rounded-lg">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <button id="notification-btn" class="p-2 text-gray-600 hover:text-blue-600 relative">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>
                        </div>
                        
                        <div class="hidden lg:block">
                            <div class="text-sm text-gray-500">
                                {{ now()->format('l, d F Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content Area -->
            <main class="flex-1 p-4 lg:p-6">
                <!-- Flash Messages -->
                @if(session('success'))
                <div class="alert alert-success mb-6">
                    <i class="fas fa-check-circle mr-3 text-lg"></i>
                    <span>{{ session('success') }}</span>
                    <button class="ml-auto text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif
                
                @if(session('error'))
                <div class="alert alert-danger mb-6">
                    <i class="fas fa-exclamation-circle mr-3 text-lg"></i>
                    <span>{{ session('error') }}</span>
                    <button class="ml-auto text-red-700 hover:text-red-900" onclick="this.parentElement.style.display='none'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif
                
                @if(session('warning'))
                <div class="alert alert-warning mb-6">
                    <i class="fas fa-exclamation-triangle mr-3 text-lg"></i>
                    <span>{{ session('warning') }}</span>
                    <button class="ml-auto text-yellow-700 hover:text-yellow-900" onclick="this.parentElement.style.display='none'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif
                
                <!-- Main Content -->
                @yield('content')
            </main>
            
            <!-- Footer -->
            <footer class="bg-white border-t p-4 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} Sistem Pakar Diagnosa Penyakit Mata. All rights reserved.</p>
                <p class="mt-1">v1.0.0 • Last updated: {{ now()->format('d M Y') }}</p>
            </footer>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', function() {
            document.getElementById('mobile-sidebar').style.display = 'block';
        });
        
        document.getElementById('mobile-menu-close')?.addEventListener('click', function() {
            document.getElementById('mobile-sidebar').style.display = 'none';
        });
        
        document.getElementById('mobile-sidebar-overlay')?.addEventListener('click', function() {
            document.getElementById('mobile-sidebar').style.display = 'none';
        });
        
        // Notification Toggle
        document.getElementById('notification-btn')?.addEventListener('click', function() {
            alert('Fitur notifikasi akan segera hadir!');
        });
        
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.opacity = '0';
                setTimeout(() => alert.style.display = 'none', 300);
            });
        }, 5000);
        
        // Form validation enhancement
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading state to submit buttons
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
                        submitBtn.disabled = true;
                    }
                });
            });
            
            // Confirm delete actions
            document.querySelectorAll('form[action*="destroy"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>