<x-admin-layout>
    <x-slot name="title">
        Item Audit
    </x-slot>

    <div class="flex flex-col min-h-screen">
        <div class="flex-grow py-4 sm:py-8 mt-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                {{-- Flash Messages --}}
                @if (session('success'))
                    <div
                        class="mb-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded relative">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div
                        class="mb-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-200 px-4 py-3 rounded relative">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">

                        {{-- Header --}}
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-amber-100 dark:bg-amber-900 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Item Audit</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Verify item presence by room</p>
                                </div>
                            </div>

                            {{-- Location Selector --}}
                            <form method="GET" action="{{ route('admin.audit.index') }}"
                                class="flex items-center gap-2">
                                <label
                                    class="text-sm font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap">Room:</label>
                                <select name="location_id" onchange="this.form.submit()"
                                    class="bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-md shadow-sm text-sm py-2 px-3 focus:border-amber-500 dark:focus:border-amber-400 focus:ring-amber-500 min-w-[200px]">
                                    <option value="">-- Select Room to Audit --</option>
                                    @foreach ($locations as $loc)
                                        <option value="{{ $loc->id }}"
                                            {{ $location_id == $loc->id ? 'selected' : '' }}>
                                            {{ $loc->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>

                        @if (!$location_id)
                            {{-- No room selected state --}}
                            <div class="text-center py-16">
                                <svg class="mx-auto h-16 w-16 text-gray-300 dark:text-gray-600 mb-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Select a room to
                                    begin audit</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Choose a location from the dropdown
                                    above to see its items.</p>
                            </div>
                        @elseif($barangs->isEmpty())
                            {{-- Room selected but no items --}}
                            <div class="text-center py-16">
                                <svg class="mx-auto h-16 w-16 text-gray-300 dark:text-gray-600 mb-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">No items in this room
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    "{{ $selectedLocation->name }}" has no items assigned to it yet.
                                </p>
                            </div>
                        @else
                            {{-- Category Summary --}}
                            <div class="mb-6">
                                <h4
                                    class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 uppercase tracking-wider">
                                    Summary — {{ $selectedLocation->name }}
                                    <span
                                        class="ml-2 px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 dark:bg-amber-900 text-amber-800 dark:text-amber-200">
                                        {{ $barangs->count() }} total items
                                    </span>
                                </h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($categorySummary as $cat => $count)
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                            {{ $cat }}: {{ $count }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Items Table --}}
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Item</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Asset Tag</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Category</th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Audit Status</th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($barangs as $barang)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                                                id="row-{{ $barang->id }}">
                                                {{-- Item Name --}}
                                                <td class="px-4 py-4">
                                                    <div class="flex items-center gap-3">
                                                        @if ($barang->foto)
                                                            <img src="{{ asset('storage/' . $barang->foto) }}"
                                                                alt=""
                                                                class="w-10 h-10 rounded-lg object-cover flex-shrink-0">
                                                        @else
                                                            <div
                                                                class="w-10 h-10 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center flex-shrink-0">
                                                                <svg class="w-4 h-4 text-gray-400" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                                </svg>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <p
                                                                class="text-sm font-medium text-gray-900 dark:text-white">
                                                                {{ $barang->nama_barang }}</p>
                                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                                {{ $barang->model ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                </td>

                                                {{-- Asset Tag --}}
                                                <td class="px-4 py-4">
                                                    @if ($barang->asset_tag)
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-mono font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                                            {{ $barang->asset_tag }}
                                                        </span>
                                                    @elseif($barang->serial_number)
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-mono font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                                                            SN: {{ $barang->serial_number }}
                                                        </span>
                                                    @else
                                                        <span class="text-xs text-gray-400 dark:text-gray-500">—</span>
                                                    @endif
                                                </td>

                                                {{-- Category --}}
                                                <td class="px-4 py-4">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                                        {{ $barang->kategori }}
                                                    </span>
                                                </td>

                                                {{-- Audit Status --}}
                                                <td class="px-4 py-4 text-center">
                                                    @if ($barang->audit_status === 'available')
                                                        <span
                                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                                            <svg class="w-3 h-3" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Available
                                                        </span>
                                                    @elseif($barang->audit_status === 'unavailable')
                                                        <span
                                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                                                            <svg class="w-3 h-3" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Lost
                                                        </span>
                                                    @else
                                                        <span
                                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            Not Audited
                                                        </span>
                                                    @endif
                                                </td>

                                                {{-- Actions --}}
                                                <td class="px-4 py-4">
                                                    <div class="flex items-center justify-center gap-2">
                                                        {{-- Available Button --}}
                                                        <form
                                                            action="{{ route('admin.audit.available', $barang->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit"
                                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-600 hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600 text-white text-xs font-semibold rounded-lg transition-colors"
                                                                title="Mark as Available">
                                                                <svg class="w-3.5 h-3.5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M5 13l4 4L19 7" />
                                                                </svg>
                                                                Available
                                                            </button>
                                                        </form>

                                                        {{-- Not Available Button --}}
                                                        <button type="button"
                                                            onclick="openNotAvailableModal({{ $barang->id }}, '{{ addslashes($barang->nama_barang) }}', '{{ addslashes($barang->asset_tag ?? ($barang->serial_number ?? '')) }}')"
                                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-600 hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 text-white text-xs font-semibold rounded-lg transition-colors"
                                                            title="Mark as Not Available">
                                                            <svg class="w-3.5 h-3.5" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                            Not Available
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== NOT AVAILABLE MODAL ===== --}}
    <div id="notAvailableModal"
        class="fixed inset-0 bg-gray-600 dark:bg-gray-900 bg-opacity-60 dark:bg-opacity-75 overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
        <div
            class="relative mx-auto p-6 border border-gray-200 dark:border-gray-700 w-full max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800">

            {{-- Modal Header --}}
            <div class="flex justify-between items-start mb-5">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Item Not Available</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1" id="modalItemDesc">—</p>
                </div>
                <button onclick="closeNotAvailableModal()"
                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 ml-4">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <p class="text-sm text-gray-600 dark:text-gray-400 mb-5">
                What happened to this item?
            </p>

            {{-- Choice Buttons --}}
            <div id="choicePanel" class="space-y-3">
                {{-- Lost Button --}}
                <form id="lostForm" method="POST" action="">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-4 p-4 border-2 border-red-200 dark:border-red-800 hover:border-red-400 dark:hover:border-red-600 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/40 rounded-xl transition-colors text-left group">
                        <div
                            class="w-10 h-10 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-red-200 dark:group-hover:bg-red-800 transition-colors">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-red-700 dark:text-red-300">Lost / Hilang</p>
                            <p class="text-xs text-red-500 dark:text-red-400">Item will be moved to the "Lost" location
                            </p>
                        </div>
                    </button>
                </form>

                {{-- Move Button --}}
                <button type="button" onclick="showMovePanel()"
                    class="w-full flex items-center gap-4 p-4 border-2 border-amber-200 dark:border-amber-800 hover:border-amber-400 dark:hover:border-amber-600 bg-amber-50 dark:bg-amber-900/20 hover:bg-amber-100 dark:hover:bg-amber-900/40 rounded-xl transition-colors text-left group">
                    <div
                        class="w-10 h-10 bg-amber-100 dark:bg-amber-900 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-amber-200 dark:group-hover:bg-amber-800 transition-colors">
                        <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-amber-700 dark:text-amber-300">Moved to Another Location
                        </p>
                        <p class="text-xs text-amber-500 dark:text-amber-400">Select the room where the item was found
                        </p>
                    </div>
                </button>
            </div>

            {{-- Move Location Panel (hidden by default) --}}
            <div id="movePanel" class="hidden mt-4">
                <div class="flex items-center gap-2 mb-4">
                    <button type="button" onclick="hideMovePanel()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </button>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Select destination room:</p>
                </div>

                <form id="moveForm" method="POST" action="">
                    @csrf
                    <select name="new_location_id" id="newLocationSelect" required
                        class="w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-md shadow-sm text-sm py-2.5 px-3 mb-4 focus:border-amber-500 dark:focus:border-amber-400 focus:ring-amber-500">
                        <option value="">-- Select location --</option>
                        @foreach ($locations as $loc)
                            <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                        @endforeach
                    </select>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeNotAvailableModal()"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-white text-sm font-medium rounded-lg transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-amber-600 hover:bg-amber-700 dark:bg-amber-500 dark:hover:bg-amber-600 text-white text-sm font-semibold rounded-lg transition-colors">
                            Confirm Move
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        let currentBarangId = null;

        function openNotAvailableModal(barangId, name, tag) {
            currentBarangId = barangId;

            // Set item description
            document.getElementById('modalItemDesc').textContent = name + (tag ? ' · ' + tag : '');

            // Set form actions
            document.getElementById('lostForm').action = `/admin/audit/${barangId}/lost`;
            document.getElementById('moveForm').action = `/admin/audit/${barangId}/move`;

            // Reset to choice panel
            document.getElementById('choicePanel').classList.remove('hidden');
            document.getElementById('movePanel').classList.add('hidden');
            document.getElementById('newLocationSelect').value = '';

            document.getElementById('notAvailableModal').classList.remove('hidden');
        }

        function closeNotAvailableModal() {
            document.getElementById('notAvailableModal').classList.add('hidden');
        }

        function showMovePanel() {
            document.getElementById('choicePanel').classList.add('hidden');
            document.getElementById('movePanel').classList.remove('hidden');
        }

        function hideMovePanel() {
            document.getElementById('movePanel').classList.add('hidden');
            document.getElementById('choicePanel').classList.remove('hidden');
        }

        // Close modal on backdrop click
        document.getElementById('notAvailableModal').addEventListener('click', function(e) {
            if (e.target === this) closeNotAvailableModal();
        });

        // Close modal on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeNotAvailableModal();
        });
    </script>

</x-admin-layout>
