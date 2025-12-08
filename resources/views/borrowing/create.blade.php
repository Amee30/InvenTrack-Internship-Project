<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight">
            {{ __('Submit Borrowing Request') }}
        </h2>
    </x-slot>
    
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                    <div class="bg-green-100 dark:bg-red-900 border border-white dark:border-gray-700 text-white dark:text-white px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-white">
                    <form method="POST" action="{{ route('pinjam.store') }}">
                        @csrf
                        
                        <input type="hidden" name="barang_id" value="{{ $barangs->id }}">
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-medium mb-2 text-gray-900 dark:text-white">Item Details</h3>
                            <div class="flex items-center mb-4 gap-4">
                                @if($barangs->foto)
                                    <img src="{{ asset('storage/' . $barangs->foto) }}" alt="{{ $barangs->nama_barang }}" class="w-20 h-20 object-contain border border-gray-300 dark:border-gray-600 rounded">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 dark:bg-gray-600 rounded flex items-center justify-center">
                                        <span class="text-gray-500 dark:text-gray-400 text-xs">No Photo</span>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-lg text-gray-900 dark:text-white">{{ $barangs->nama_barang }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Category: {{ $barangs->kategori }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Serial Number: {{ $barangs->serial_number ?? 'No Serial Number' }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Available Stock: {{ $barangs->stok }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Borrowing Date -->
                        <div class="mb-4">
                            <label for="borrowed_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Borrowing Date <span class="text-red-500">*</span>
                            </label>
                            <x-text-input id="borrowed_date" 
                                class="block w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400" 
                                type="date" 
                                name="borrowed_date" 
                                :value="old('borrowed_date', date('Y-m-d'))" 
                                required />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                <svg class="inline w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                Current time will be automatically recorded when you submit
                            </p>
                            <x-input-error :messages="$errors->get('borrowed_date')" class="mt-2" />
                        </div>
                        
                        <!-- Return Date -->
                        <div class="mb-4">
                            <label for="return_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Return Date <span class="text-red-500">*</span>
                            </label>
                            <x-text-input id="return_date" 
                                class="block w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400" 
                                type="date" 
                                name="return_date" 
                                :value="old('return_date', date('Y-m-d', strtotime('+7 days')))" 
                                required />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                <svg class="inline w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                Default return time will be set to 17:00 (5 PM)
                            </p>
                            <x-input-error :messages="$errors->get('return_date')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Purpose of Borrowing <span class="text-red-500">*</span>
                            </label>
                            <textarea id="reason" 
                                name="reason" 
                                rows="4" 
                                class="block mt-1 w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-md shadow-sm" 
                                required 
                                placeholder="Enter the purpose of borrowing">{{ old('reason') }}</textarea>
                            <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                        </div>
                        
                        <div class="flex items-center justify-end mt-6 gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('dashboard') }}" 
                               class="px-6 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-medium rounded-lg transition-colors">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button class="px-6 py-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ __('Submit Borrowing Request') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set minimum date untuk borrowed_date (hari ini)
        document.getElementById('borrowed_date').min = new Date().toISOString().split('T')[0];
        
        // Set minimum date untuk return_date berdasarkan borrowed_date
        document.getElementById('borrowed_date').addEventListener('change', function() {
            document.getElementById('return_date').min = this.value;
            
            // Jika return date lebih kecil dari borrowed date, update return date
            if (document.getElementById('return_date').value < this.value) {
                document.getElementById('return_date').value = this.value;
            }
        });
    </script>
</x-app-layout>