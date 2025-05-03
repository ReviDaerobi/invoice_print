@extends('layouts.app')

@section('content')
<!-- Main Content -->
<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Top Navigation -->
    <header class="bg-white shadow-sm z-10">
        <div class="px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center md:hidden">
                <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
            <div class="flex-1 md:ml-0 md:mr-auto">
                <h2 class="text-xl font-semibold text-gray-800">Tambah Produk Baru</h2>
            </div>
            <div class="flex items-center space-x-4">
                <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <i class="fas fa-bell text-xl"></i>
                </button>
                <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <i class="fas fa-cog text-xl"></i>
                </button>
                <div class="md:hidden">
                    <button class="flex items-center focus:outline-none">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main class="flex-1 overflow-y-auto bg-gray-50 p-4 sm:p-6 lg:p-8">
        <!-- Action Bar -->
        <div class="mb-6">
            <a href="{{ route('produk.index') }}" class="flex items-center text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>Kembali ke Daftar Produk</span>
            </a>
        </div>

        <!-- Create Product Form -->
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold text-gray-800">Informasi Produk</h3>
                <p class="text-sm text-gray-500 mt-1">Isi informasi produk yang akan ditambahkan ke dalam sistem</p>
            </div>

            <form action="{{ route('produk.store') }}" method="POST" class="p-6">
                @csrf
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Item ID -->
                    <div>
                        <label for="ItemId" class="block text-sm font-medium text-gray-700 mb-1">ID Produk</label>
                        <input type="text" name="ItemId" id="ItemId" value="{{ old('ItemId') }}" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            placeholder="Contoh: PROD001">
                        <p class="mt-1 text-xs text-gray-500">Masukkan ID unik untuk produk ini</p>
                    </div>

                    <!-- Item Name -->
                    <div>
                        <label for="ItemName" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                        <input type="text" name="ItemName" id="ItemName" value="{{ old('ItemName') }}" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            placeholder="Contoh: Laptop ASUS ROG">
                    </div>

                    <!-- Unit -->
                    <div>
                        <label for="Unit" class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
                        <select name="Unit" id="Unit" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">Pilih Satuan</option>
                            <option value="Pcs" {{ old('Unit') == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                            <option value="Box" {{ old('Unit') == 'Box' ? 'selected' : '' }}>Box</option>
                            <option value="Lusin" {{ old('Unit') == 'Lusin' ? 'selected' : '' }}>Lusin</option>
                            <option value="Kg" {{ old('Unit') == 'Kg' ? 'selected' : '' }}>Kg</option>
                            <option value="Set" {{ old('Unit') == 'Set' ? 'selected' : '' }}>Set</option>
                        </select>
                    </div>

                    <!-- Unit Price -->
                    <div>
                        <label for="UnitPrice" class="block text-sm font-medium text-gray-700 mb-1">Harga Satuan (Rp)</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="text" name="UnitPrice" id="UnitPrice" value="{{ old('UnitPrice') }}" 
                                class="w-full pl-10 pr-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                placeholder="0,00" 
                                aria-describedby="price-currency">
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('produk.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection