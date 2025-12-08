<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight">
            {{ __('Hello ' . Auth::user()->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Menampilkan pesan sukses jika ada --}}
            @if(session('success'))
                <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-white">
                    <!-- Header dengan Title dan Filter -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Available Items</h3>
                        
                        <!-- Category Filter -->
                        <div class="flex items-center gap-2">
                            <label for="categoryFilter" class="text-sm font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                Filter by Category:
                            </label>
                            <form method="GET" action="{{ route('dashboard') }}" id="filterForm" class="flex items-center gap-2">
                                <select 
                                    id="categoryFilter" 
                                    name="kategori" 
                                    onchange="document.getElementById('filterForm').submit()"
                                    class="bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 rounded-md shadow-sm text-sm py-2 px-3 min-w-[150px]">
                                    <option value="all" {{ (!isset($selectedKategori) || $selectedKategori == 'all') ? 'selected' : '' }}>
                                        All Categories
                                    </option>
                                    @foreach($kategori as $kat)
                                        <option value="{{ $kat }}" {{ (isset($selectedKategori) && $selectedKategori == $kat) ? 'selected' : '' }}>
                                            {{ $kat }}
                                        </option>
                                    @endforeach
                                </select>
                                
                                @if(isset($selectedKategori) && $selectedKategori !== 'all')
                                    <a href="{{ route('dashboard') }}" 
                                       class="inline-flex items-center px-3 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-xs font-medium rounded-md transition-colors duration-200"
                                       title="Clear Filter">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>
                    
                    <!-- Grid View untuk Barang -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @forelse($barangs as $barang)
                            <div class="border border-gray-200 dark:border-gray-600 rounded-lg overflow-hidden shadow-md hover:shadow-xl dark:shadow-gray-900/50 transition-shadow duration-300 flex flex-col bg-white dark:bg-gray-700">
                                <!-- Bagian Gambar -->
                                <div class="relative">
                                    @if($barang->foto)
                                        <div class="flex justify-center items-center bg-white dark:bg-gray-800 h-48 p-4">
                                            <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}" 
                                                 class="h-48 w-48 object-contain">
                                        </div>
                                    @else
                                        <div class="w-full h-48 bg-gray-100 dark:bg-gray-600 flex items-center justify-center">
                                            <span class="text-gray-500 dark:text-gray-400 text-xs">No Image</span>
                                        </div>
                                    @endif
                                    
                                    <!-- Badge Kategori di pojok kanan atas gambar -->
                                    <div class="absolute top-2 right-2">
                                        <span class="bg-blue-500 dark:bg-blue-600 text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                                            {{ $barang->kategori }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Bagian Detail -->
                                <div class="p-4 flex-grow flex flex-col">
                                    <div class="flex-grow">
                                        <!-- Nama Barang -->
                                        <h4 class="text-md font-semibold mt-1 text-gray-900 dark:text-white">{{ $barang->nama_barang }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $barang->serial_number ?? '' }}</p>
                                        
                                        <!-- Informasi Stok & Status -->
                                        <div class="flex items-center justify-between mt-2">
                                            <div class="flex items-center">
                                                <span class="text-sm mr-2 text-gray-600 dark:text-gray-400">Stock:</span>
                                                <span class="font-semibold text-lg text-gray-900 dark:text-white">{{ $barang->stok }}</span>
                                            </div>
                                            @if($barang->stok > 0)
                                                <span class="text-xs font-medium text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900 px-2 py-0.5 rounded-full">
                                                    Available
                                                </span>
                                            @else
                                                <span class="text-xs font-medium text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-900 px-2 py-0.5 rounded-full">
                                                    Out of Stock
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Tombol Pinjam -->
                                    <div class="mt-4">
                                        @if($barang->stok > 0)
                                            <a href="{{ route('pinjam.create', $barang->id) }}" class="w-full inline-flex justify-center items-center px-3 py-2 bg-blue-500 dark:bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 dark:hover:bg-blue-700 active:bg-blue-700 dark:active:bg-blue-800 focus:outline-none focus:border-blue-700 dark:focus:border-blue-600 focus:ring ring-blue-300 dark:ring-blue-500 transition ease-in-out duration-150">
                                                Borrow
                                            </a>
                                        @else
                                            <button disabled class="w-full inline-flex justify-center items-center px-3 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-500 dark:text-gray-400 uppercase tracking-widest cursor-not-allowed">
                                                Out of Stock
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No items found</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    @if(isset($selectedKategori) && $selectedKategori !== 'all')
                                        No items available in "{{ $selectedKategori }}" category.
                                    @else
                                        No items available at the moment.
                                    @endif
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>