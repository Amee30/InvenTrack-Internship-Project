<x-admin-layout>
    <x-slot name="title">
        QR Scanner
    </x-slot>

    <div class="flex flex-col min-h-screen">
        <div class="flex-grow py-4 sm:py-8 mt-2 sm:mt-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-4 sm:p-6">
                        <!-- Header -->
                        <div class="mb-4 sm:mb-6">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-white">QR Code Scanner</h2>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 mt-1">Scan QR code for pickup or return items</p>
                        </div>

                        <!-- Tab Selector -->
                        <div class="mb-4 sm:mb-6 border-b border-gray-200 dark:border-gray-700 overflow-x-auto">
                            <div class="flex space-x-2 sm:space-x-4 min-w-max">
                                <button id="tab-pickup" onclick="switchScannerTab('pickup')" 
                                        class="px-4 sm:px-6 py-2 sm:py-3 font-medium text-sm sm:text-base text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400 transition-colors whitespace-nowrap">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                    <span class="hidden sm:inline">Pickup Items</span>
                                    <span class="sm:hidden">Pickup</span>
                                </button>
                                <button id="tab-return" onclick="switchScannerTab('return')" 
                                        class="px-4 sm:px-6 py-2 sm:py-3 font-medium text-sm sm:text-base text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors whitespace-nowrap">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                    </svg>
                                    <span class="hidden sm:inline">Return Items</span>
                                    <span class="sm:hidden">Return</span>
                                </button>
                                <button id="tab-identify" onclick="switchScannerTab('identify')" 
                                        class="px-4 sm:px-6 py-2 sm:py-3 font-medium text-sm sm:text-base text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors whitespace-nowrap">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <span class="hidden sm:inline">Identify Item</span>
                                    <span class="sm:hidden">Identify</span>
                                </button>
                            </div>
                        </div>

                        <!-- Scanner Container -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                            <!-- Camera Preview - ORDER 1 (Atas pada mobile/tablet) -->
                            <div class="order-1">
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 sm:p-4 mb-3 sm:mb-4 border border-gray-200 dark:border-gray-600">
                                    <div class="flex items-center justify-between mb-2">
                                        <h3 class="text-base sm:text-lg font-medium text-gray-900 dark:text-white" id="scanner-title">Scan QR for Pickup</h3>
                                        <span id="scanner-status" class="px-2 sm:px-3 py-1 text-xs font-semibold rounded-full bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200">
                                            Ready
                                        </span>
                                    </div>
                                </div>

                                <!-- Camera View -->
                                <div class="relative bg-black rounded-lg overflow-hidden border-2 border-gray-300 dark:border-gray-600" style="height: 300px; sm:height: 350px; lg:height: 400px;">
                                    <div id="qr-reader" class="w-full h-full"></div>
                                    <!-- Guide Box (Visual Only - Not Restricting Scan Area) -->
                                    <div id="scan-region" class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                        <div class="border-4 border-blue-500 dark:border-blue-400 rounded-lg opacity-50" style="width: 200px; height: 200px; max-width: 80%; max-height: 80%;"></div>
                                    </div>
                                    <!-- Info Text -->
                                    <div class="absolute bottom-4 left-0 right-0 text-center pointer-events-none">
                                        <p class="text-white text-xs sm:text-sm bg-black bg-opacity-50 inline-block px-3 py-1 rounded">
                                            QR can be detected anywhere in camera view
                                        </p>
                                    </div>
                                </div>

                                <!-- Scanner Controls -->
                                <div class="mt-3 sm:mt-4 space-y-2">
                                    <button id="start-scan" onclick="startScanner()" 
                                            class="w-full bg-blue-600 dark:bg-blue-500 text-white px-3 sm:px-4 py-2 sm:py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors flex items-center justify-center text-sm sm:text-base">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Start Scanner
                                    </button>
                                    <button id="stop-scan" onclick="stopScanner()" 
                                            class="w-full bg-red-600 dark:bg-red-500 text-white px-3 sm:px-4 py-2 sm:py-3 rounded-lg hover:bg-red-700 dark:hover:bg-red-600 transition-colors hidden flex items-center justify-center text-sm sm:text-base">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path>
                                        </svg>
                                        Stop Scanner
                                    </button>
                                </div>

                                <!-- Instructions -->
                                <div class="mt-3 sm:mt-4 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg p-3 sm:p-4">
                                    <h4 class="font-semibold text-blue-900 dark:text-blue-200 text-xs sm:text-sm mb-2">Instructions:</h4>
                                    <ul class="text-xs text-blue-800 dark:text-blue-300 space-y-1 list-disc list-inside">
                                        <li>Click "Start Scanner" to activate camera</li>
                                        <li>Position QR code anywhere in camera view</li>
                                        <li>Hold steady until detected (box is just a guide)</li>
                                        <li>Scanner will auto-process the code</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Result Display - ORDER 2 (Bawah pada mobile/tablet) -->
                            <div class="order-2">
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 sm:p-4 mb-3 sm:mb-4 border border-gray-200 dark:border-gray-600">
                                    <h3 class="text-base sm:text-lg font-medium text-gray-900 dark:text-white">Scan Result</h3>
                                </div>

                                <div id="scan-result" class="bg-white dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-lg p-4 sm:p-6 min-h-[300px] sm:min-h-[350px] lg:min-h-[400px] flex items-center justify-center">
                                    <div class="text-center text-gray-400 dark:text-gray-500">
                                        <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                        </svg>
                                        <p class="text-base sm:text-lg font-medium text-gray-600 dark:text-gray-300">Waiting for scan...</p>
                                        <p class="text-xs sm:text-sm mt-1">Scan a QR code to see the result</p>
                                    </div>
                                </div>

                                <!-- Recent Scans -->
                                <div class="mt-3 sm:mt-4">
                                    <h4 class="font-semibold text-xs sm:text-sm mb-2 text-gray-900 dark:text-white">Recent Activity</h4>
                                    <div id="recent-scans" class="space-y-2 max-h-64 overflow-y-auto">
                                        <!-- Recent scans will appear here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script>
        let html5QrCode;
        let currentMode = 'pickup';
        let isScanning = false;

        // Auto-switch tab berdasarkan query parameter
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const mode = urlParams.get('mode');
            
            if (mode === 'return') {
                switchScannerTab('return');
                // Auto-start scanner jika dari link return
                setTimeout(() => {
                    startScanner();
                }, 500);
            } else if (mode === 'pickup') {
                switchScannerTab('pickup');
                // Auto-start scanner jika dari link pickup
                setTimeout(() => {
                    startScanner();
                }, 500);
            } else if (mode === 'identify') {
                switchScannerTab('identify');
                // Auto-start scanner jika dari link identify
                setTimeout(() => {
                    startScanner();
                }, 500);
            }
        });

        function switchScannerTab(mode) {
            if (isScanning) {
                if (!confirm('Scanner is running. Stop and switch tab?')) {
                    return;
                }
                stopScanner();
            }

            currentMode = mode;
            
            // Update tab styling - Responsive with dark mode
            const baseClass = 'px-4 sm:px-6 py-2 sm:py-3 font-medium text-sm sm:text-base transition-colors whitespace-nowrap';
            const activeClass = baseClass + ' text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400';
            const inactiveClass = baseClass + ' text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300';
            
            document.getElementById('tab-pickup').className = mode === 'pickup' ? activeClass : inactiveClass;
            document.getElementById('tab-return').className = mode === 'return' ? activeClass : inactiveClass;
            document.getElementById('tab-identify').className = mode === 'identify' ? activeClass : inactiveClass;
            
            // Update title
            let titleText = 'Scan QR for Pickup';
            if (mode === 'return') titleText = 'Scan QR for Return';
            if (mode === 'identify') titleText = 'Scan QR to Identify Item';
            document.getElementById('scanner-title').textContent = titleText;
            
            // Reset result
            displayWaitingState();
            
            // Update URL parameter without reload
            const url = new URL(window.location);
            url.searchParams.set('mode', mode);
            window.history.pushState({}, '', url);
        }

        function startScanner() {
            const config = { 
                fps: 10,
                aspectRatio: 1.0,
                // Tambahan config untuk meningkatkan detection
                rememberLastUsedCamera: true,
                supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
            };
            
            html5QrCode = new Html5Qrcode("qr-reader");
            
            html5QrCode.start(
                { facingMode: "environment" }, // Gunakan kamera belakang
                config,
                onScanSuccess,
                onScanFailure
            ).then(() => {
                isScanning = true;
                document.getElementById('start-scan').classList.add('hidden');
                document.getElementById('stop-scan').classList.remove('hidden');
                updateStatus('Scanning...', 'bg-blue-500 dark:bg-blue-600 text-white');
            }).catch(err => {
                console.error('Error starting camera:', err);
                
                // Coba fallback tanpa facingMode
                html5QrCode.start(
                    { facingMode: "user" }, // Coba kamera depan
                    config,
                    onScanSuccess,
                    onScanFailure
                ).then(() => {
                    isScanning = true;
                    document.getElementById('start-scan').classList.add('hidden');
                    document.getElementById('stop-scan').classList.remove('hidden');
                    updateStatus('Scanning...', 'bg-blue-500 dark:bg-blue-600 text-white');
                }).catch(err2 => {
                    alert('Error starting camera: ' + err2 + '\n\nPlease allow camera permission.');
                    updateStatus('Error', 'bg-red-500 dark:bg-red-600 text-white');
                });
            });
        }

        function stopScanner() {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    isScanning = false;
                    document.getElementById('start-scan').classList.remove('hidden');
                    document.getElementById('stop-scan').classList.add('hidden');
                    updateStatus('Ready', 'bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200');
                }).catch(err => {
                    console.error('Error stopping scanner:', err);
                });
            }
        }

        function onScanSuccess(decodedText, decodedResult) {
            // Stop scanner sementara
            updateStatus('Processing...', 'bg-yellow-500 dark:bg-yellow-600 text-white');
            stopScanner();
            
            // Process the QR code
            processQrCode(decodedText);
        }

        function onScanFailure(error) {
            // Handle scan failure silently (tidak perlu log setiap frame)
        }

        function processQrCode(qrCode) {
            // Handle identify mode - redirect to item details
            if (currentMode === 'identify') {
                processIdentifyMode(qrCode);
                return;
            }
            
            const url = currentMode === 'pickup' 
                ? '{{ route("admin.qr.pickup") }}'
                : '{{ route("admin.qr.return") }}';
            
            // Show loading
            document.getElementById('scan-result').innerHTML = `
                <div class="text-center">
                    <svg class="animate-spin h-10 w-10 sm:h-12 sm:w-12 mx-auto text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="mt-3 sm:mt-4 text-sm sm:text-base text-gray-600 dark:text-gray-300">Processing QR Code...</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 break-all px-2">${qrCode}</p>
                </div>
            `;
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ qr_code: qrCode })
            })
            .then(response => response.json())
            .then(data => {
                displayResult(data, qrCode);
                if (data.success) {
                    updateStatus('Success', 'bg-green-500 dark:bg-green-600 text-white');
                    addToRecentActivity(data, currentMode);
                } else {
                    updateStatus('Failed', 'bg-red-500 dark:bg-red-600 text-white');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                displayResult({
                    success: false,
                    message: 'Network error. Please try again.'
                }, qrCode);
                updateStatus('Error', 'bg-red-500 dark:bg-red-600 text-white');
            });
        }

        function displayResult(data, qrCode) {
            const resultDiv = document.getElementById('scan-result');
            
            if (data.success) {
                resultDiv.innerHTML = `
                    <div class="w-full">
                        <div class="bg-green-50 dark:bg-green-900/30 border-2 border-green-200 dark:border-green-800 rounded-lg p-4 sm:p-6">
                            <div class="flex items-center mb-4">
                                <svg class="w-10 h-10 sm:w-12 sm:h-12 text-green-500 dark:text-green-400 mr-3 sm:mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <h4 class="text-lg sm:text-xl font-bold text-green-800 dark:text-green-200">Success!</h4>
                                    <p class="text-xs sm:text-sm text-green-600 dark:text-green-300">${currentMode === 'pickup' ? 'Item Picked Up' : 'Item Returned'}</p>
                                </div>
                            </div>
                            
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-3 sm:p-4 space-y-2 sm:space-y-3 mb-4 text-sm sm:text-base border border-green-200 dark:border-green-700">
                                <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-200 dark:border-gray-700 pb-2 gap-1">
                                    <span class="font-semibold text-gray-700 dark:text-gray-300">Item:</span>
                                    <span class="text-gray-900 dark:text-white break-words">${data.data.barang}</span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-200 dark:border-gray-700 pb-2 gap-1">
                                    <span class="font-semibold text-gray-700 dark:text-gray-300">Borrower:</span>
                                    <span class="text-gray-900 dark:text-white break-words">${data.data.peminjam}</span>
                                </div>
                                ${data.data.tanggal_kembali ? `
                                    <div class="flex flex-col sm:flex-row sm:justify-between gap-1">
                                        <span class="font-semibold text-gray-700 dark:text-gray-300">Due Date:</span>
                                        <span class="text-gray-900 dark:text-white">${data.data.tanggal_kembali}</span>
                                    </div>
                                ` : ''}
                                <div class="flex flex-col sm:flex-row sm:justify-between text-xs pt-2 border-t border-gray-200 dark:border-gray-700 gap-1">
                                    <span class="text-gray-500 dark:text-gray-400">QR Code:</span>
                                    <span class="font-mono text-gray-600 dark:text-gray-300 break-all">${qrCode}</span>
                                </div>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-2">
                                <button onclick="startScanner()" 
                                        class="flex-1 bg-green-600 dark:bg-green-500 text-white px-3 sm:px-4 py-2 sm:py-3 rounded-lg hover:bg-green-700 dark:hover:bg-green-600 transition-colors font-medium text-sm sm:text-base">
                                    Scan Next Item
                                </button>
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="flex-1 bg-gray-600 dark:bg-gray-700 text-white px-3 sm:px-4 py-2 sm:py-3 rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 transition-colors font-medium text-center text-sm sm:text-base">
                                    Back to Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                resultDiv.innerHTML = `
                    <div class="w-full">
                        <div class="bg-red-50 dark:bg-red-900/30 border-2 border-red-200 dark:border-red-800 rounded-lg p-4 sm:p-6">
                            <div class="flex items-center mb-4">
                                <svg class="w-10 h-10 sm:w-12 sm:h-12 text-red-500 dark:text-red-400 mr-3 sm:mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <h4 class="text-lg sm:text-xl font-bold text-red-800 dark:text-red-200">Failed!</h4>
                                    <p class="text-xs sm:text-sm text-red-600 dark:text-red-300">Unable to process</p>
                                </div>
                            </div>
                            
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-3 sm:p-4 mb-4 border border-red-200 dark:border-red-700">
                                <p class="text-red-700 dark:text-red-300 font-medium text-sm sm:text-base break-words">${data.message}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 font-mono break-all">QR: ${qrCode}</p>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-2">
                                <button onclick="startScanner()" 
                                        class="flex-1 bg-red-600 dark:bg-red-500 text-white px-3 sm:px-4 py-2 sm:py-3 rounded-lg hover:bg-red-700 dark:hover:bg-red-600 transition-colors font-medium text-sm sm:text-base">
                                    Try Again
                                </button>
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="flex-1 bg-gray-600 dark:bg-gray-700 text-white px-3 sm:px-4 py-2 sm:py-3 rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 transition-colors font-medium text-center text-sm sm:text-base">
                                    Back to Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            }
        }

        function displayWaitingState() {
            document.getElementById('scan-result').innerHTML = `
                <div class="text-center text-gray-400 dark:text-gray-500">
                    <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                    </svg>
                    <p class="text-base sm:text-lg font-medium text-gray-600 dark:text-gray-300">Waiting for scan...</p>
                    <p class="text-xs sm:text-sm mt-1">Scan a QR code to see the result</p>
                </div>
            `;
        }

        function updateStatus(text, className) {
            const status = document.getElementById('scanner-status');
            status.textContent = text;
            status.className = `px-2 sm:px-3 py-1 text-xs font-semibold rounded-full ${className}`;
        }

        function addToRecentActivity(data, mode) {
            const recentDiv = document.getElementById('recent-scans');
            const time = new Date().toLocaleTimeString('id-ID');
            const modeText = mode === 'pickup' ? 'Pickup' : 'Return';
            const modeColor = mode === 'pickup' ? 'bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200' : 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200';
            
            const item = document.createElement('div');
            item.className = 'bg-gray-50 dark:bg-gray-700 rounded p-2 sm:p-3 text-xs sm:text-sm border border-gray-200 dark:border-gray-600';
            item.innerHTML = `
                <div class="flex justify-between items-center gap-2">
                    <div class="min-w-0 flex-1">
                        <span class="font-medium block truncate text-gray-900 dark:text-white">${data.data.barang}</span>
                        <p class="text-xs text-gray-600 dark:text-gray-400 truncate">${data.data.peminjam}</p>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <span class="px-2 py-1 rounded text-xs font-semibold ${modeColor} whitespace-nowrap">${modeText}</span>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">${time}</p>
                    </div>
                </div>
            `;
            
            recentDiv.insertBefore(item, recentDiv.firstChild);
            
            // Limit to 5 recent items
            while (recentDiv.children.length > 5) {
                recentDiv.removeChild(recentDiv.lastChild);
            }
        }

        function processIdentifyMode(qrCode) {
            // Show loading
            document.getElementById('scan-result').innerHTML = `
                <div class="text-center">
                    <svg class="animate-spin h-10 w-10 sm:h-12 sm:w-12 mx-auto text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="mt-3 sm:mt-4 text-sm sm:text-base text-gray-600 dark:text-gray-300">Identifying item...</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 break-all px-2">${qrCode}</p>
                </div>
            `;
            
            // Fetch item by QR code
            fetch(`{{ url('/admin/barang/identify') }}?qr_code=${encodeURIComponent(qrCode)}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.barang_id) {
                    // Redirect to item management page with item highlighted
                    window.location.href = `{{ url('/admin/barang') }}?highlight=${data.barang_id}`;
                } else {
                    // Show error
                    displayResult({
                        success: false,
                        message: data.message || 'Item not found. Please check the QR code.'
                    }, qrCode);
                    updateStatus('Not Found', 'bg-red-500 dark:bg-red-600 text-white');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                displayResult({
                    success: false,
                    message: 'Network error. Please try again.'
                }, qrCode);
                updateStatus('Error', 'bg-red-500 dark:bg-red-600 text-white');
            });
        }

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            if (html5QrCode && isScanning) {
                html5QrCode.stop();
            }
        });
        
        // NO NEED resize handler karena tidak ada qrbox
    </script>
</x-admin-layout>