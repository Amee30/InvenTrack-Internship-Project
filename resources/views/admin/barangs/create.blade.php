<x-admin-layout>
    <x-slot name="title">
        Add New Item
    </x-slot>

    <div class="flex flex-col min-h-screen">
        <div class="flex-grow py-8 mt-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('admin.barang.index') }}" 
                       class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Items List
                    </a>
                </div>

                <!-- Form Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6 text-gray-900 dark:text-white">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Add New Item</h3>
                        </div>
                        
                        <form method="POST" action="{{ route('admin.barang.store') }}" enctype="multipart/form-data" class="space-y-6">
                            @csrf
    
                            <!-- Item Name -->
                            <div>
                                <label for="nama_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Item Name <span class="text-red-500">*</span>
                                </label>
                                <x-text-input 
                                    id="nama_barang" 
                                    class="block mt-1 w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400" 
                                    type="text" 
                                    name="nama_barang" 
                                    :value="old('nama_barang')" 
                                    required 
                                    autofocus 
                                    placeholder="Enter item name" />
                                <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                            </div>
    
                            <!-- Category -->
                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Category <span class="text-red-500">*</span>
                                </label>
                                <x-text-input 
                                    id="kategori" 
                                    class="block mt-1 w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400" 
                                    type="text" 
                                    name="kategori" 
                                    :value="old('kategori')" 
                                    required 
                                    placeholder="Enter category" />
                                <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                            </div>
    
                            <!-- Serial Number -->
                            <div>
                                <label for="serial_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Serial Number
                                </label>
                                <x-text-input 
                                    id="serial_number" 
                                    class="block mt-1 w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400" 
                                    type="text" 
                                    name="serial_number" 
                                    :value="old('serial_number')" 
                                    placeholder="Enter serial number (optional)" />
                                <x-input-error :messages="$errors->get('serial_number')" class="mt-2" />
                            </div>
    
                            <!-- Initial Stock -->
                            <div>
                                <label for="stok" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Initial Stock <span class="text-red-500">*</span>
                                </label>
                                <x-text-input 
                                    id="stok" 
                                    class="block mt-1 w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400" 
                                    type="number" 
                                    name="stok" 
                                    :value="old('stok', 1)" 
                                    required 
                                    min="1"
                                    placeholder="Enter initial stock quantity" />
                                <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                            </div>
    
                            <!-- Source -->
                            <div>
                                <label for="source" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Source <span class="text-red-500">*</span>
                                </label>
                                <x-text-input 
                                    id="source" 
                                    class="block mt-1 w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400" 
                                    type="text" 
                                    name="source" 
                                    :value="old('source')" 
                                    required 
                                    placeholder="Example: From Warehouse" />
                                <x-input-error :messages="$errors->get('source')" class="mt-2" />
                            </div>
    
                            <!-- Item Photo -->
                            <div>
                                <label for="foto" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Item Photo
                                </label>
                                <div id="dropzone" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg hover:border-gray-400 dark:hover:border-gray-500 transition-colors cursor-pointer">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                            <label for="foto" class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Upload a file</span>
                                                <input id="foto" type="file" name="foto" class="sr-only" accept="image/*" onchange="previewImage(event)" />
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG up to 2MB</p>
                                    </div>
                                </div>
                                
                                <!-- Image Preview -->
                                <div id="imagePreview" class="mt-4 hidden">
                                    <img id="preview" class="rounded-lg border border-gray-300 dark:border-gray-600 max-h-64 mx-auto" alt="Preview" />
                                    <button type="button" onclick="removeImage()" class="mt-2 mx-auto block text-sm text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                                        Remove Image
                                    </button>
                                </div>
                                
                                <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                            </div>
    
                            <!-- Action Buttons -->
                            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <a href="{{ route('admin.barang.index') }}" 
                                   class="px-6 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-medium rounded-lg transition-colors">
                                    Cancel
                                </a>
                                <x-primary-button class="px-6 py-2">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Submit Item
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('foto');
        
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        // Highlight drop zone when item is dragged over it
        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight(e) {
            dropzone.classList.add('border-indigo-500', 'dark:border-indigo-400', 'bg-indigo-50', 'dark:bg-indigo-900/20');
        }
        
        function unhighlight(e) {
            dropzone.classList.remove('border-indigo-500', 'dark:border-indigo-400', 'bg-indigo-50', 'dark:bg-indigo-900/20');
        }
        
        // Handle dropped files
        dropzone.addEventListener('drop', handleDrop, false);
        
        // Handle click on dropzone
        dropzone.addEventListener('click', function(e) {
            if (e.target.id !== 'foto' && !e.target.closest('label[for="foto"]')) {
                fileInput.click();
            }
        });
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                // Validate file type
                const file = files[0];
                const validTypes = ['image/png', 'image/jpeg', 'image/jpg'];
                
                if (!validTypes.includes(file.type)) {
                    alert('Please upload only PNG, JPG, or JPEG files.');
                    return;
                }
                
                // Validate file size (2MB = 2097152 bytes)
                if (file.size > 2097152) {
                    alert('File size must be less than 2MB.');
                    return;
                }
                
                // Create a new FileList and assign to input
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
                
                // Preview the image
                previewImage({ target: { files: [file] } });
            }
        }

        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            
            if (file) {
                // Validate file type
                const validTypes = ['image/png', 'image/jpeg', 'image/jpg'];
                if (!validTypes.includes(file.type)) {
                    alert('Please upload only PNG, JPG, or JPEG files.');
                    fileInput.value = '';
                    return;
                }
                
                // Validate file size (2MB)
                if (file.size > 2097152) {
                    alert('File size must be less than 2MB.');
                    fileInput.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
            }
        }
        
        function removeImage() {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            const fileInput = document.getElementById('foto');
            
            preview.src = '';
            previewContainer.classList.add('hidden');
            fileInput.value = '';
        }
    </script>
</x-admin-layout>