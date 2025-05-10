<!-- resources/views/components/sidebar.blade.php -->
<div class="bg-white shadow-lg w-64 flex-shrink-0 hidden md:flex flex-col">
    <div class="flex items-center justify-center h-16 border-b">
        <h1 class="text-2xl font-bold text-blue-600">InvoicePro</h1>
    </div>
    <div class="overflow-y-auto flex-grow">
        <nav class="mt-6 px-4">
            <div class="space-y-2">
                <a href="/" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('dashboard*') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('produk.index') }}" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('produk*') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                    <span>Produk</span>
                </a>
                <a href="{{ route('costumer') }}" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('customers*') ? 'active' : '' }}">
                    <i class="fas fa-users w-5 h-5 mr-3"></i>
                    <span>Customer</span>
                </a>
                <a href="{{ route('quatation.index') }}" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('quatation*') ? 'active' : '' }}">
                    <i class="fas fa-users w-5 h-5 mr-3"></i>
                    <span>Quatation</span>
                </a>
                <a href="{{ route('invoice') }}" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('invoices*') ? 'active' : '' }}">
                    <i class="fas fa-file-invoice w-5 h-5 mr-3"></i>
                    <span>Invoices</span>
                </a>
                <a href="{{ route('PO.index') }}" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('PO*') ? 'active' : '' }}">
                    <i class="fas fa-users w-5 h-5 mr-3"></i>
                    <span>Purchase Order</span>
                </a>
                <a href="{{ route('deliveryOrders') }}" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('delivery-order*') ? 'active' : '' }}">
                    <i class="fa-solid fa-truck-fast w-5 h-5 mr-3"></i>
                    <span>Delivery Order</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('reports*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                    <span>Laporan</span>
                </a>
                <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('settings*') ? 'active' : '' }}">
                    <i class="fas fa-cog w-5 h-5 mr-3"></i>
                    <span>Pengaturan</span>
                </a>
            </div>
        </nav>
    </div>
    <div class="border-t p-4">
        <div class="flex items-center">
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 transition duration-200">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
        </form>
    </div>
</div>

<!-- Mobile sidebar -->
<div class="md:hidden" x-data="{ sidebarOpen: false }">
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black bg-opacity-50"></div>
    
    <div x-show="sidebarOpen" class="fixed inset-y-0 left-0 w-64 z-50 bg-white shadow-lg flex flex-col">
        <div class="flex items-center justify-between h-16 border-b px-4">
            <h1 class="text-xl font-bold text-blue-600">InvoicePro</h1>
            <button @click="sidebarOpen = false" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="overflow-y-auto flex-grow">
            <nav class="mt-6 px-4">
                <div class="space-y-2">
                    <a href="/" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('/') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('produk.index') }}" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('/') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                        <span>Produk</span>
                    </a>
                    <a href="{{ route('costumer') }}" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('customers*') ? 'active' : '' }}">
                        <i class="fas fa-users w-5 h-5 mr-3"></i>
                        <span>Customer</span>
                    </a>
                    <a href="{{ route('invoice') }}" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('invoices*') ? 'active' : '' }}">
                        <i class="fas fa-file-invoice w-5 h-5 mr-3"></i>
                        <span>Invoices</span>
                    </a>
                    <a href="{{ route('deliveryOrders') }}" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('delivery-order*') ? 'active' : '' }}">
                        <i class="fa-solid fa-truck-fast w-5 h-5 mr-3"></i>
                        <span>Delivery Order</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('transactions*') ? 'active' : '' }}">
                        <i class="fas fa-box w-5 h-5 mr-3"></i>
                        <span>Transaksi</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('reports*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                        <span>Laporan</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 {{ request()->is('settings*') ? 'active' : '' }}">
                        <i class="fas fa-cog w-5 h-5 mr-3"></i>
                        <span>Pengaturan</span>
                    </a>
                </div>
            </nav>
        </div>
        <div class="border-t p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 transition duration-200">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>