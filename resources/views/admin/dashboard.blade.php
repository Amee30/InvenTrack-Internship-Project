<x-admin-layout>
    <!-- Hapus div wrapper flex flex-col -->
    <div class="flex-grow py-4 sm:py-8 mt-2 sm:mt-4">
        <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Statistik Dashboard -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 mb-6 sm:mb-8 mt-4">
                <!-- Total Stok Barang -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="h-10 w-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4zM3 8a2 2 0 00-2 2v6a2 2 0 002 2h14a2 2 0 002-2v-6a2 2 0 00-2-2H3zm6.5 4a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400 truncate">Total Stock</p>
                            <p class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">{{ $totalBarangs }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Jenis Barang -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="h-10 w-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400 truncate">Item Types</p>
                            <p class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">{{ $totalJenisBarang }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Barang Masuk -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="h-10 w-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400 truncate">Items In</p>
                            <p class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">{{ $barangMasuk }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Barang Keluar -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="h-10 w-10 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" transform="rotate(180 10 10)"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400 truncate">Items Out</p>
                            <p class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">{{ $barangKeluar }}</p>
                        </div>
                    </div>
                </div>

                <!-- Peminjaman Aktif -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="h-10 w-10 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400 truncate">Active Borrowers</p>
                            <p class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">{{ $activeBorrowers }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Total User -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="h-10 w-10 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400 truncate">Total User</p>
                            <p class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">{{ $totalUser }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Peminjaman -->
            <div>
                <h2 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white mb-4">List of Borrowers</h2>
                
                <!-- Tabel Peminjaman -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4 border border-gray-200 dark:border-gray-700">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div class="p-4 sm:p-6 text-gray-900 dark:text-white">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-3 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">No</th>
                                            <th class="px-3 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Borrower</th>
                                            <th class="px-3 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Item</th>
                                            <th class="px-3 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase hidden md:table-cell">Return Date</th>
                                            <th class="px-3 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase hidden lg:table-cell">Reason</th>
                                            <th class="px-3 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                                            <th class="px-3 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse($borrowing as $index => $peminjaman)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            <td class="px-3 sm:px-6 py-4 text-center">
                                                <span class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ ($borrowing->currentPage() - 1) * $borrowing->perPage() + $loop->iteration }}
                                                </span>
                                            </td>
                                            <td class="px-3 sm:px-6 py-4">
                                                <div class="flex items-center justify-center">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ $peminjaman->user->name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-3 sm:px-6 py-4">
                                                <div class="text-sm text-center text-gray-900 dark:text-white">{{ $peminjaman->barang->nama_barang }}</div>
                                                <div class="text-xs text-center text-gray-500 dark:text-gray-400">SN: {{ $peminjaman->barang->serial_number }}</div>
                                            </td>
                                            <td class="px-3 sm:px-6 py-4 hidden md:table-cell">
                                                <div class="flex justify-center">
                                                    <span class="text-sm text-gray-900 dark:text-white">
                                                        {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-3 sm:px-6 py-4 hidden lg:table-cell">
                                                <div class="flex justify-center">
                                                    <span class="text-sm text-gray-900 dark:text-white">
                                                        {{ Str::limit($peminjaman->reason, 30) ?? 'No reason' }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-3 sm:px-6 py-4">
                                                <div class="flex justify-center">
                                                @if($peminjaman->status == 'pending')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">
                                                        Pending
                                                    </span>
                                                @elseif($peminjaman->status == 'waiting_pickup')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-teal-100 dark:bg-teal-900 text-teal-800 dark:text-teal-200">
                                                        Waiting Pickup
                                                    </span>
                                                @elseif($peminjaman->status == 'borrowed')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200" title="Waiting for user to request return">
                                                        Borrowed
                                                    </span>
                                                @elseif($peminjaman->status == 'waiting_return')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200">
                                                        Return Request
                                                    </span>
                                                @elseif($peminjaman->status == 'returned')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                                        Returned
                                                    </span>
                                                @elseif($peminjaman->status == 'rejected')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                                                        Rejected
                                                    </span>
                                                @endif
                                                </div>
                                            </td>
                                            <td class="px-3 sm:px-6 py-4 text-center">
                                                <div class="flex items-center justify-center space-x-2">
                                                    @if($peminjaman->status == 'pending')
                                                        <button 
                                                            onclick="openApprovalModal(
                                                                '{{ $peminjaman->id }}',
                                                                '{{ $peminjaman->user->name }}',
                                                                '{{ $peminjaman->user->department }}',
                                                                '{{ $peminjaman->user->phone_number }}',
                                                                '{{ $peminjaman->barang->serial_number }}',
                                                                '{{ $peminjaman->barang->nama_barang }}',
                                                                '{{ $peminjaman->tanggal_pinjam }}',
                                                                '{{ $peminjaman->tanggal_kembali }}',
                                                                '{{ $peminjaman->reason }}'
                                                            )"
                                                            class="p-1 bg-green-100 dark:bg-green-900 hover:bg-green-200 dark:hover:bg-green-800 text-green-600 dark:text-green-400 rounded transition-colors"
                                                            title="Approve Borrowing">
                                                            <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </button>
                                                        <button 
                                                            onclick="openRejectModal(
                                                                '{{ $peminjaman->id }}',
                                                                '{{ $peminjaman->user->name }}',
                                                                '{{ $peminjaman->user->department }}',
                                                                '{{ $peminjaman->user->phone_number }}',
                                                                '{{ $peminjaman->barang->serial_number }}',
                                                                '{{ $peminjaman->barang->nama_barang }}',
                                                                '{{ $peminjaman->tanggal_pinjam }}',
                                                                '{{ $peminjaman->tanggal_kembali }}',
                                                                '{{ $peminjaman->reason }}'
                                                            )"
                                                            class="p-1 bg-red-100 dark:bg-red-900 hover:bg-red-200 dark:hover:bg-red-800 text-red-600 dark:text-red-400 rounded transition-colors"
                                                            title="Reject Borrowing">
                                                            <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </button>
                                                    @elseif($peminjaman->status == 'borrowed')
                                                        <a href="{{ route('admin.qr-scanner', ['mode' => 'return']) }}" 
                                                           class="p-1 bg-orange-100 dark:bg-orange-900 hover:bg-orange-200 dark:hover:bg-orange-800 text-orange-600 dark:text-orange-400 rounded transition-colors inline-block"
                                                           title="Scan QR to return item">
                                                            <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                                            </svg>
                                                        </a>
                                                    @elseif($peminjaman->status == 'waiting_pickup')
                                                        <a href="{{ route('admin.qr-scanner', ['mode' => 'pickup']) }}" 
                                                           class="p-1 bg-blue-100 dark:bg-blue-900 hover:bg-blue-200 dark:hover:bg-blue-800 text-blue-600 dark:text-blue-400 rounded transition-colors inline-block"
                                                           title="Scan QR to confirm pickup">
                                                            <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                                            </svg>
                                                        </a>
                                                    @elseif($peminjaman->status == 'waiting_return')
                                                        <a href="{{ route('admin.qr-scanner', ['mode' => 'return']) }}" 
                                                           class="p-1 bg-purple-100 dark:bg-purple-900 hover:bg-purple-200 dark:hover:bg-purple-800 text-purple-600 dark:text-purple-400 rounded transition-colors inline-block"
                                                           title="Scan QR to confirm return">
                                                            <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                                            </svg>
                                                        </a>
                                                    @elseif($peminjaman->status == 'returned' || $peminjaman->status == 'rejected')
                                                        <span class="p-1 text-xs text-gray-400 dark:text-gray-500">-</span>
                                                    @endif
                                                    
                                                    <a href="{{ route('pinjam.show', $peminjaman->id) }}" 
                                                       class="p-1 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-400 rounded transition-colors"
                                                       title="View Details">
                                                        <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                                <div class="flex flex-col items-center">
                                                    <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m13-8l-4 4-3-3-6 6"></path>
                                                    </svg>
                                                    <p class="text-sm">No borrowing data available</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $borrowing->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Approval -->
    <x-modal name="approval-modal" focusable>
        <div class="p-6 bg-gray-800">
            <h2 class="text-lg font-medium text-white mb-4">
                Borrowing Confirmation
            </h2>
            
            <div class="mb-4 border border-gray-700 rounded-lg p-4 bg-gray-700">
                <div class="mb-2">
                    <span class="font-medium text-white">Borrower:</span>
                    <span id="modal-peminjam" class="text-sm text-white"></span>
                </div>

                <div class="mb-2">
                    <span class="font-medium text-white">Department:</span>
                    <span id="modal-department" class="text-sm text-white"></span>
                </div>

                <div class="mb-2">
                    <span class="font-medium text-white">Phone Number:</span>
                    <span id="modal-phone_number" class="text-sm text-white"></span>
                </div>
                
                <div class="mb-2">
                    <span class="font-medium text-white">Item:</span>
                    <span id="modal-barang" class="text-sm text-white"></span>
                </div>

                <div class="mb-2">
                    <span class="font-medium text-white">Serial Number:</span>
                    <span id="modal-serial-number" class="text-sm text-white"></span>
                </div>
                
                <div class="mb-2">
                    <span class="font-medium text-white">Borrowing Date:</span>
                    <span id="modal-tanggal-pinjam" class="text-sm text-white"></span>
                </div>
                
                <div class="mb-2">
                    <span class="font-medium text-white">Return Date:</span>
                    <span id="modal-tanggal-kembali" class="text-sm text-white"></span>
                </div>
                
                <div class="mb-2">
                    <span class="font-medium text-white">Reason for Borrowing:</span>
                    <p id="modal-reason" class="text-sm text-white mt-1"></p>
                </div>
            </div>
            
            <!-- Tab untuk pilih approve atau reject -->
            <div class="mb-4 border-b border-gray-600">
                <div class="flex">
                    <button type="button" id="tab-approve" 
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-t-md active-tab"
                            onclick="switchTab('approve')">
                        Approve
                    </button>
                    <button type="button" id="tab-reject" 
                            class="px-4 py-2 ml-3 text-sm font-medium text-white bg-gray-600 rounded-t-md"
                            onclick="switchTab('reject')">
                        Reject
                    </button>
                </div>
            </div>
            
            <!-- Form untuk approve -->
            <div id="content-approve" class="mb-4">
                <form id="approval-form" method="POST">
                    @csrf
                    <div class="flex justify-end space-x-3">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            Cancel
                        </x-secondary-button>
                        <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md">
                            Approve
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Form untuk reject -->
            <div id="content-reject" class="mb-4 hidden">
                <form id="reject-form" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="reject_reason" class="block text-sm font-medium text-white mb-2">
                            Reason for Rejection <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="reject_reason" 
                            name="reject_reason" 
                            rows="3"
                            class="w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Enter reason for rejection..."
                            required></textarea>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            Cancel
                        </x-secondary-button>
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">
                            Reject
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-modal>

    <script>
        function openApprovalModal(id, peminjam, department, phone_number, serialNumber, barang, tanggalPinjam, tanggalKembali, reason) {
            switchTab('approve');
            document.getElementById('approval-form').action = '{{ url("admin/peminjaman") }}/' + id + '/approve';
            document.getElementById('reject-form').action = '{{ url("admin/peminjaman") }}/' + id + '/reject';
            populateModalData(peminjam, department, phone_number, serialNumber, barang, tanggalPinjam, tanggalKembali, reason);
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'approval-modal' }));
        }
        
        function openRejectModal(id, peminjam, department, phone_number, serialNumber, barang, tanggalPinjam, tanggalKembali, reason) {
            document.getElementById('approval-form').action = '{{ url("admin/peminjaman") }}/' + id + '/approve';
            document.getElementById('reject-form').action = '{{ url("admin/peminjaman") }}/' + id + '/reject';
            populateModalData(peminjam, department, phone_number, serialNumber, barang, tanggalPinjam, tanggalKembali, reason);
            switchTab('reject');
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'approval-modal' }));
        }
        
        function populateModalData(peminjam, department, phone_number, serialNumber, barang, tanggalPinjam, tanggalKembali, reason) {
            document.getElementById('modal-peminjam').textContent = peminjam || 'N/A';
            document.getElementById('modal-department').textContent = department || 'N/A';
            document.getElementById('modal-phone_number').textContent = phone_number || 'N/A';
            document.getElementById('modal-serial-number').textContent = serialNumber || 'N/A';
            document.getElementById('modal-barang').textContent = barang;
            document.getElementById('modal-tanggal-pinjam').textContent = formatDate(tanggalPinjam);
            document.getElementById('modal-tanggal-kembali').textContent = formatDate(tanggalKembali);
            document.getElementById('modal-reason').textContent = reason || 'N/A';
            document.getElementById('reject_reason').value = '';
        }
        
        function switchTab(tab) {
            document.getElementById('tab-approve').classList.remove('bg-green-600', 'bg-gray-600');
            document.getElementById('tab-reject').classList.remove('bg-red-600', 'bg-gray-600');
            
            if (tab === 'approve') {
                document.getElementById('tab-approve').classList.add('bg-green-600');
                document.getElementById('tab-reject').classList.add('bg-gray-600');
                document.getElementById('content-approve').classList.remove('hidden');
                document.getElementById('content-reject').classList.add('hidden');
            } else {
                document.getElementById('tab-approve').classList.add('bg-gray-600');
                document.getElementById('tab-reject').classList.add('bg-red-600');
                document.getElementById('content-approve').classList.add('hidden');
                document.getElementById('content-reject').classList.remove('hidden');
            }
        }
        
        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        }
    </script>
    
    <!-- Floating Export Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <div class="relative group">
            <a href="{{ route('admin.export.options') }}" 
               class="flex items-center justify-center w-14 h-14 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-arrow-down-fill" viewBox="0 0 16 16">
                    <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M8 5a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5A.5.5 0 0 1 8 5"/>
                </svg>
            </a>
            
            <div class="absolute bottom-full right-0 mb-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none">
                <div class="bg-gray-900 text-white text-xs rounded py-1 px-3 whitespace-nowrap">
                    Export Data
                    <div class="absolute top-full right-4 w-2 h-2 bg-gray-900 transform rotate-45"></div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>