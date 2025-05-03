@extends('layouts.app')

@section('content')
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
                <h2 class="text-xl font-semibold text-gray-800">Buat Customer Baru</h2>
            </div>
        </div>
    </header>
    
    <!-- Page Content -->
    <main class="flex-1 overflow-y-auto bg-gray-50 p-4 sm:p-6 lg:p-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-4 sm:p-6 border-b">
                    <h3 class="text-lg font-medium text-gray-900">Informasi Customer</h3>
                    <p class="mt-1 text-sm text-gray-500">Lengkapi informasi customer di bawah ini.</p>
                </div>
                
                <form action="{{ route('customers.store') }}" method="POST" class="p-4 sm:p-6 space-y-6">
                    @csrf
                    
                    <!-- Customer Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Customer</label>
                            <input type="text" name="nama" id="nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('nama') }}" required>
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="no_telp" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                            <input type="text" name="no_telp" id="no_telp" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('no_telp') }}">
                            @error('no_telp')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="contact_person" class="block text-sm font-medium text-gray-700">Contact Person</label>
                            <input type="text" name="contact_person" id="contact_person" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('contact_person') }}">
                            @error('contact_person')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Address Information -->
                    <div class="space-y-4">
                        <div>
                            <label for="alamat_1" class="block text-sm font-medium text-gray-700">Alamat 1</label>
                            <input type="text" name="alamat_1" id="alamat_1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('alamat_1') }}" required>
                            @error('alamat_1')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="alamat_2" class="block text-sm font-medium text-gray-700">Alamat 2 (Opsional)</label>
                            <input type="text" name="alamat_2" id="alamat_2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('alamat_2') }}">
                            @error('alamat_2')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="alamat_3" class="block text-sm font-medium text-gray-700">Alamat 3 (Opsional)</label>
                            <input type="text" name="alamat_3" id="alamat_3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('alamat_3') }}">
                            @error('alamat_3')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-5 border-t">
                            <a href="{{ route('costumer') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection