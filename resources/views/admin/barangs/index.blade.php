<x-admin-layout>
    <x-slot name="title">
        Item Management
    </x-slot>

    <div class="flex flex-col min-h-screen">
        <div class="flex-grow py-4 sm:py-8 mt-4">
            <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Menampilkan pesan sukses jika ada --}}
                @if(session('success'))
                    <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
    
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-4 sm:p-6 text-gray-900 dark:text-white">
                        <!-- Header dengan Title, Filter, dan Add Button -->
                        <div class="flex flex-col gap-4 mb-4 sm:mb-6">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                                <h3 class="text-lg sm:text-xl font-medium text-gray-900 dark:text-white">Item List</h3>
                                
                                <!-- Add Item Button - Mobile First -->
                                <a href="{{ route('admin.barang.create') }}" 
                                   class="inline-flex items-center justify-center bg-blue-500 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm sm:text-base transition-colors w-full sm:w-auto">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Add Item
                                </a>
                            </div>

                            <!-- Category Filter -->
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                                <label for="categoryFilter" class="text-sm font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap sm:min-w-fit">
                                    Filter:
                                </label>
                                <form method="GET" action="{{ route('admin.barang.index') }}" id="filterForm" class="flex items-center gap-2 flex-1">
                                    <select 
                                        id="categoryFilter" 
                                        name="kategori" 
                                        onchange="document.getElementById('filterForm').submit()"
                                        class="flex-1 sm:flex-none bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 rounded-md shadow-sm text-sm py-2 px-3 sm:min-w-[200px]">
                                        <option value="all" {{ (!request('kategori') || request('kategori') == 'all') ? 'selected' : '' }}>
                                            All Categories
                                        </option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}" {{ request('kategori') == $category ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    @if(request('kategori') && request('kategori') !== 'all')
                                        <a href="{{ route('admin.barang.index') }}" 
                                           class="inline-flex items-center px-2 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-xs font-medium rounded-md transition-colors duration-200"
                                           title="Clear Filter">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </a>
                                    @endif
                                </form>
                            </div>

                            <!-- Filter Info Badge -->
                            @if(request('kategori') && request('kategori') !== 'all')
                                <div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs sm:text-sm font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                        <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                        </svg>
                                        Filtered by: {{ request('kategori') }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Desktop Table View -->
                        <div class="hidden lg:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Photo</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Item Name</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stock</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse($barangs as $barang)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if($barang->foto)
                                                <div class="flex justify-center">
                                                    <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}" class="w-20 h-20 object-cover rounded-lg shadow-sm">
                                                </div>
                                            @else
                                                <div class="w-20 h-20 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center mx-auto">
                                                    <span class="text-gray-500 dark:text-gray-400 text-xs">No Image</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-center items-center gap-2">
                                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $barang->nama_barang }}</span>
                                                @if($barang->is_hidden)
                                                    <span class="px-2 py-0.5 text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full">
                                                        Hidden
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="flex justify-center items-center px-2.5 py-0.5 rounded-full text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $barang->kategori }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="flex justify-center items-center px-2.5 py-0.5 rounded-full text-sm font-medium 
                                                {{ $barang->stok > 0 ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' : 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200' }}">
                                                {{ $barang->stok }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex items-center justify-center space-x-3">
                                                <!-- Details Button -->
                                                <button type="button" 
                                                    onclick="showModal('{{ $barang->id }}')"
                                                    class="p-1 border border-gray-300 dark:border-gray-600 rounded-full text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900 hover:border-blue-400 dark:hover:border-blue-500 transition-colors duration-200"
                                                    title="View Details">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                                    </svg>
                                                </button>
                                                
                                                <!-- Edit Button -->
                                                <a href="{{ route('admin.barang.edit', $barang->id) }}" 
                                                   class="p-1 border border-gray-300 dark:border-gray-600 rounded-full text-indigo-600 dark:text-indigo-400 hover:bg-indigo-100 dark:hover:bg-indigo-900 hover:border-indigo-400 dark:hover:border-indigo-500 transition-colors duration-200"
                                                   title="Edit Item">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                <!-- Toggle Visibility Button -->
                                                <form action="{{ route('admin.barang.toggleVisibility', $barang->id) }}" 
                                                      method="POST" 
                                                      class="inline-flex">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="p-1 border border-gray-300 dark:border-gray-600 rounded-full {{ $barang->is_hidden ? 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:border-gray-400 dark:hover:border-gray-500' : 'text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-900 hover:border-green-400 dark:hover:border-green-500' }} transition-colors duration-200"
                                                            title="{{ $barang->is_hidden ? 'Show Item' : 'Hide Item' }}">
                                                        @if($barang->is_hidden)
                                                            <!-- Eye Slash Icon (Hidden) -->
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                                            </svg>
                                                        @else
                                                            <!-- Eye Icon (Visible) -->
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                            </svg>
                                                        @endif
                                                    </button>
                                                </form>

                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.barang.destroy', $barang->id) }}" 
                                                      method="POST" 
                                                      class="inline-flex"
                                                      onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="p-1 border border-gray-300 dark:border-gray-600 rounded-full text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900 hover:border-red-400 dark:hover:border-red-500 transition-colors duration-200"
                                                            title="Delete Item">
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m13-8l-4 4-3-3-6 6"></path>
                                                </svg>
                                                <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-1">
                                                    @if(request('kategori') && request('kategori') !== 'all')
                                                        No items found in "{{ request('kategori') }}" category
                                                    @else
                                                        No item data available
                                                    @endif
                                                </h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    @if(request('kategori') && request('kategori') !== 'all')
                                                        Try selecting a different category or clear the filter.
                                                    @else
                                                        Start by adding your first item.
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="lg:hidden space-y-4">
                            @forelse($barangs as $barang)
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 border border-gray-200 dark:border-gray-600">
                                <!-- Image di atas -->
                                <div class="flex justify-center mb-3 pb-3 border-b border-gray-200 dark:border-gray-600">
                                    @if($barang->foto)
                                        <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}" class="w-32 h-32 object-cover rounded-lg shadow-sm">
                                    @else
                                        <div class="w-32 h-32 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                                            <span class="text-gray-500 dark:text-gray-400 text-xs">No Image</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Name & Category dibawah gambar -->
                                <div class="mb-3 pb-3 border-b border-gray-200 dark:border-gray-600">
                                    <h4 class="text-base font-semibold text-gray-900 dark:text-white break-words mb-2 text-center">{{ $barang->nama_barang }}</h4>
                                    <div class="flex justify-center">
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                            {{ $barang->kategori }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Stock -->
                                <div class="mb-3 pb-3 border-b border-gray-200 dark:border-gray-600">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1 text-center">Stock</p>
                                    <div class="flex justify-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium 
                                            {{ $barang->stok > 0 ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' : 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200' }}">
                                            {{ $barang->stok }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-wrap gap-2">
                                    <button type="button" 
                                        onclick="showModal('{{ $barang->id }}')"
                                        class="flex-1 min-w-[calc(50%-0.25rem)] inline-flex items-center justify-center px-3 py-2 bg-blue-500 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                        </svg>
                                        Details
                                    </button>
                                    
                                    <a href="{{ route('admin.barang.edit', $barang->id) }}" 
                                       class="flex-1 min-w-[calc(50%-0.25rem)] inline-flex items-center justify-center px-3 py-2 bg-indigo-500 hover:bg-indigo-700 dark:bg-indigo-600 dark:hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>

                                    <!-- Toggle Visibility Button -->
                                    <form action="{{ route('admin.barang.toggleVisibility', $barang->id) }}" 
                                          method="POST" 
                                          class="flex-1 min-w-[calc(50%-0.25rem)]">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full inline-flex items-center justify-center px-3 py-2 {{ $barang->is_hidden ? 'bg-gray-500 hover:bg-gray-700 dark:bg-gray-600 dark:hover:bg-gray-700' : 'bg-green-500 hover:bg-green-700 dark:bg-green-600 dark:hover:bg-green-700' }} text-white text-xs font-semibold rounded-lg transition-colors">
                                            @if($barang->is_hidden)
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                                </svg>
                                                Show
                                            @else
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Hide
                                            @endif
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.barang.destroy', $barang->id) }}" 
                                          method="POST" 
                                          class="flex-1 min-w-[calc(50%-0.25rem)]"
                                          onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full inline-flex items-center justify-center px-3 py-2 bg-red-500 hover:bg-red-700 dark:bg-red-600 dark:hover:bg-red-700 text-white text-xs font-semibold rounded-lg transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-12">
                                <svg class="w-12 h-12 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m13-8l-4 4-3-3-6 6"></path>
                                </svg>
                                <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-1">
                                    @if(request('kategori') && request('kategori') !== 'all')
                                        No items found in "{{ request('kategori') }}" category
                                    @else
                                        No item data available
                                    @endif
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    @if(request('kategori') && request('kategori') !== 'all')
                                        Try selecting a different category or clear the filter.
                                    @else
                                        Start by adding your first item.
                                    @endif
                                </p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                
                <!-- Pagination -->
                @if($barangs->hasPages())
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4 border border-gray-200 dark:border-gray-700">
                        <div class="p-4">
                            {{ $barangs->appends(['kategori' => request('kategori')])->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Modal Detail Barang -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 dark:bg-gray-900 bg-opacity-50 dark:bg-opacity-75 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-4 sm:top-20 mx-auto p-4 sm:p-5 border border-gray-200 dark:border-gray-700 w-11/12 max-w-4xl shadow-lg rounded-md bg-white dark:bg-gray-800 my-4">
            <div class="flex flex-col">
                <div class="flex justify-between items-center pb-3 sm:pb-4 border-b border-gray-200 dark:border-gray-700 mb-3 sm:mb-4">
                    <h3 class="text-lg sm:text-xl font-medium text-gray-900 dark:text-white" id="modalTitle">Item Details</h3>
                    <button class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 p-1" onclick="closeModal()">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Loading State -->
                <div id="modalLoading" class="text-center py-8">
                    <svg class="animate-spin h-8 w-8 mx-auto text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="mt-2 text-sm sm:text-base text-gray-600 dark:text-gray-400">Loading...</p>
                </div>
                
                <!-- Modal Content -->
                <div id="modalContent" class="mt-2 hidden">
                    <div class="flex flex-col md:flex-row gap-4 sm:gap-6">
                        <!-- Item Info -->
                        <div class="md:w-1/2">
                            <div class="space-y-3 sm:space-y-4">
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-1">Item Name</p>
                                    <p class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white break-words" id="productName">-</p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-1">Category</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200" id="productCategory">-</span>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-1">Manufacturer</p>
                                    <p class="text-sm sm:text-base text-gray-900 dark:text-white break-all" id="productManufacturer">-</p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-1">Models</p>
                                    <p class="text-sm sm:text-base text-gray-900 dark:text-white break-all" id="productModel">-</p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-1">Serial Number</p>
                                    <p class="text-sm sm:text-base text-gray-900 dark:text-white break-all" id="productSerial">-</p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-1">Asset Tag</p>
                                    <p class="text-sm sm:text-base text-gray-900 dark:text-white break-all" id="productAssetTag">-</p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-1">Stock</p>
                                    <span id="productStockContainer"></span>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-1">Added</p>
                                    <p class="text-sm sm:text-base text-gray-900 dark:text-white break-all" id="productCreated">-</p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-1">Updated</p>
                                    <p class="text-sm sm:text-base text-gray-900 dark:text-white break-all" id="productUpdated">-</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- QR Code Section -->
                        <div class="md:w-1/2">
                            <div class="bg-gray-50 dark:bg-gray-700 p-3 sm:p-4 rounded-lg border border-gray-200 dark:border-gray-600">
                                <h4 class="text-sm font-semibold mb-3 text-gray-700 dark:text-gray-300">QR Code</h4>
                                <div id="qrCodeContainer" class="flex flex-col items-center">
                                    <div class="bg-white dark:bg-white p-2 sm:p-3 rounded shadow-sm mb-2 sm:max-w-none">
                                        <!-- QR Code SVG will be loaded here -->
                                    </div>
                                    <p class="text-xs font-mono text-gray-600 dark:text-gray-400 break-all text-center" id="qrCodeText">-</p>
                                </div>
                                <button onclick="printModalQr()" 
                                        class="mt-3 w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white px-3 py-2 rounded text-xs sm:text-sm transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                    </svg>
                                    Print QR Code
                                </button>
                            </div>
                            
                            <!-- Usage Info -->
                            <div class="mt-4 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 p-3 rounded-lg">
                                <h5 class="font-semibold text-blue-900 dark:text-blue-200 text-xs sm:text-sm mb-2">How to Use:</h5>
                                <ul class="text-xs text-blue-800 dark:text-blue-300 space-y-1 list-disc list-inside">
                                    <li>Scan when picking up items</li>
                                    <li>Scan when returning items</li>
                                    <li>Print and attach to physical item</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-3 sm:pt-4">
                    <button class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-white text-sm font-medium rounded-md w-full sm:w-auto transition-colors" 
                            onclick="closeModal()">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript untuk Modal -->
    <script>
        function showModal(id) {
            // Buka modal dan tampilkan loading
            const modal = document.getElementById('detailModal');
            const loading = document.getElementById('modalLoading');
            const content = document.getElementById('modalContent');
            
            modal.classList.remove('hidden');
            loading.classList.remove('hidden');
            content.classList.add('hidden');
            
            // Fetch item details
            fetch(`/admin/barang/${id}/details`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Update item details
                    document.getElementById('modalTitle').innerText = 'Item Details: ' + data.nama_barang;
                    document.getElementById('productName').innerText = data.nama_barang;
                    document.getElementById('productCategory').innerText = data.kategori;
                    document.getElementById('productManufacturer').innerText = data.manufacturer || '-';
                    document.getElementById('productModel').innerText = data.model || '-';
                    document.getElementById('productAssetTag').innerText = data.asset_tag || '-';
                    document.getElementById('productSerial').innerText = data.serial_number || '-';
                    document.getElementById('productCreated').innerText = data.created_at + ' (' + data.created_at_diff + ')';
                    document.getElementById('productUpdated').innerText = data.updated_at + ' (' + data.updated_at_diff + ')';
                    
                    // Update stock with badge
                    const stockBadgeClass = data.stok > 0 ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' : 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200';
                    document.getElementById('productStockContainer').innerHTML = `
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium ${stockBadgeClass}">
                            ${data.stok}
                        </span>
                    `;
                    
                    // Load QR Code
                    return fetch(`/admin/barang/${id}/qr-code`);
                })
                .then(response => response.json())
                .then(qrData => {
                    // Render QR Code SVG
                    const qrContainer = document.getElementById('qrCodeContainer');
                    qrContainer.querySelector('.bg-white').innerHTML = qrData.qr_code;
                    document.getElementById('qrCodeText').innerText = qrData.code;
                    
                    // Sembunyikan loading, tampilkan content
                    loading.classList.add('hidden');
                    content.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching item details:', error);
                    loading.classList.add('hidden');
                    content.innerHTML = `
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="mt-2 text-sm sm:text-base text-red-600 dark:text-red-400">Failed to load item details</p>
                            <button onclick="closeModal()" class="mt-4 px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded text-sm transition-colors">
                                Close
                            </button>
                        </div>
                    `;
                    content.classList.remove('hidden');
                });
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
        
        function printModalQr() {
            const qrContent = document.getElementById('qrCodeContainer').innerHTML;
            const qrCode = document.getElementById('qrCodeText').innerText;
            const itemName = document.getElementById('productName').innerText;
            
            const printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Print QR Code - ' + qrCode + '</title>');
            printWindow.document.write('<style>');
            printWindow.document.write('body { font-family: Arial, sans-serif; text-align: center; padding: 20px; }');
            printWindow.document.write('h2 { margin-bottom: 20px; }');
            printWindow.document.write('svg { max-width: 300px; height: auto; }');
            printWindow.document.write('.qr-code { margin: 20px 0; }');
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write('<h2>' + itemName + '</h2>');
            printWindow.document.write('<div class="qr-code">' + qrContent + '</div>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            
            // Tunggu sebentar agar content ter-load
            setTimeout(() => {
                printWindow.print();
            }, 250);
        }

        // Tutup modal jika mengklik area di luar modal
        window.onclick = function(event) {
            const modal = document.getElementById('detailModal');
            if (event.target == modal) {
                closeModal();
            }
        }
        
        // Tutup modal dengan ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        // Auto-open modal jika ada parameter highlight dari QR scan
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const highlightId = urlParams.get('highlight');
            
            if (highlightId) {
                // Buka modal detail barang
                showModal(highlightId);
                
                // Optional: Remove highlight parameter dari URL setelah modal dibuka
                const url = new URL(window.location);
                url.searchParams.delete('highlight');
                window.history.replaceState({}, '', url);
            }
        });
    </script>
</x-admin-layout>