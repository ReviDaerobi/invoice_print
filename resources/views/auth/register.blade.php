<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Invoice System</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .wave-shape {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .wave-shape svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 110px;
        }

        .wave-shape .shape-fill {
            fill: #FFFFFF;
        }
        
        .bg-dots {
            background-image: radial-gradient(rgba(255, 255, 255, 0.15) 2px, transparent 2px);
            background-size: 30px 30px;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-900 via-indigo-800 to-purple-900 min-h-screen flex items-center justify-center p-4">
    <!-- Main Container -->
    <div class="w-full max-w-5xl flex shadow-2xl rounded-3xl overflow-hidden bg-white">
        <!-- Left Side - Image -->
        <div class="hidden md:block w-1/2 relative bg-gradient-to-br from-blue-500 via-indigo-600 to-purple-700 p-12">
            <div class="h-full flex flex-col justify-between relative z-10">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-6">InvoicePro</h2>
                    <p class="text-blue-100 text-xl mb-6">Buat dan kelola invoice Anda dengan cepat dan profesional</p>
                </div>
                
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-white">
                    <h3 class="text-white text-xl font-semibold mb-4">Fitur Utama:</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center text-blue-100">
                            <div class="bg-blue-400/30 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-file-invoice text-white"></i>
                            </div>
                            <span>Buat invoice profesional dengan mudah</span>
                        </li>
                        <li class="flex items-center text-blue-100">
                            <div class="bg-blue-400/30 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-chart-line text-white"></i>
                            </div>
                            <span>Lacak pembayaran secara real-time</span>
                        </li>
                        <li class="flex items-center text-blue-100">
                            <div class="bg-blue-400/30 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-bell text-white"></i>
                            </div>
                            <span>Pengingat otomatis untuk klien</span>
                        </li>
                        <li class="flex items-center text-blue-100">
                            <div class="bg-blue-400/30 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-credit-card text-white"></i>
                            </div>
                            <span>Berbagai metode pembayaran</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Decorative elements -->
                <div class="absolute top-20 right-20 w-20 h-20 bg-white/10 rounded-full"></div>
                <div class="absolute bottom-40 left-10 w-12 h-12 bg-white/10 rounded-full"></div>
                <div class="absolute top-40 left-20 w-16 h-16 bg-indigo-400/20 rounded-full"></div>
            </div>
            
            <!-- Wave shape at bottom -->
            <div class="wave-shape absolute left-0 right-0 bottom-0">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
                </svg>
            </div>
        </div>
        
        <!-- Right Side - Register Form -->
        <div class="w-full md:w-1/2 p-8 md:p-12">
            <div class="text-center md:text-left mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Buat Akun Baru</h1>
                <p class="text-gray-600 mt-2">Daftar untuk mulai menggunakan InvoicePro</p>
            </div>
            
            @if ($errors->any())
            <div class="bg-red-50 text-red-500 p-4 rounded-xl mb-6 border-l-4 border-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-sm flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="name" class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-user text-blue-500"></i>
                        </div>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" 
                            class="w-full pl-11 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            placeholder="John Doe" required>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-blue-500"></i>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" 
                            class="w-full pl-11 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            placeholder="email@example.com" required>
                    </div>
                </div>
                
                <div class="mb-5">
                    <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-blue-500"></i>
                        </div>
                        <input type="password" id="password" name="password" 
                            class="w-full pl-11 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            placeholder="Minimal 8 karakter" required>
                    </div>
                </div>

                <div class="mb-8">
                    <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-blue-500"></i>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation" 
                            class="w-full pl-11 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            placeholder="Konfirmasi password" required>
                    </div>
                </div>
                
                <div class="flex items-center mb-6">
                    <input type="checkbox" id="terms" name="terms" required class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="terms" class="ml-2 block text-gray-700 text-sm">
                        Saya setuju dengan <a href="#" class="text-blue-600 font-medium hover:underline">Syarat & Ketentuan</a> dan <a href="#" class="text-blue-600 font-medium hover:underline">Kebijakan Privasi</a>
                    </label>
                </div>
                
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-bold py-3 px-4 rounded-xl hover:from-blue-700 hover:to-indigo-800 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-lg transform hover:scale-[1.02]">
                    Daftar Sekarang
                </button>
                
                <div class="my-6 flex items-center justify-center">
                    <div class="border-t border-gray-300 flex-grow mr-3"></div>
                    <span class="text-gray-500 text-sm">atau daftar dengan</span>
                    <div class="border-t border-gray-300 flex-grow ml-3"></div>
                </div>
            </form>
            
            <!-- Footer -->
            <div class="text-center mt-6">
                <p class="text-gray-600">Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">Masuk</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>