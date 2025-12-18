<x-admin-layout>
    <x-slot name="title">
        Category Management
    </x-slot>

    <div class="flex flex-col min-h-screen">
        <div class="flex-grow py-4 sm:py-8 mt-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded relative">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Error Message -->
                @if(session('error'))
                    <div class="mb-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-200 px-4 py-3 rounded relative">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <!-- Header -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Categories</h3>
                            </div>

                            <button onclick="openAddModal()" 
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-semibold rounded-lg transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Add Category
                            </button>
                        </div>

                        <!-- Categories Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Description
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Items Count
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse($categories as $category)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $category->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                                    {{ $category->description ?? '-' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                                    {{ $category->barangs->count() }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex items-center justify-center space-x-3">
                                                    <button onclick="openEditModal({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}')" 
                                                            class="p-1 border border-gray-300 dark:border-gray-600 rounded-full text-indigo-600 dark:text-indigo-400 hover:bg-indigo-100 dark:hover:bg-indigo-900 hover:border-indigo-400 dark:hover:border-indigo-500 transition-colors duration-200"
                                                            title="Edit Category">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                    </button>

                                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" 
                                                          method="POST" 
                                                          onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="p-1 border border-gray-300 dark:border-gray-600 rounded-full text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900 hover:border-red-400 dark:hover:border-red-500 transition-colors duration-200"
                                                                title="Delete Category">
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-12 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                </svg>
                                                <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">No categories found</p>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">Get started by creating a new category</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="addModal" class="fixed inset-0 bg-gray-600 dark:bg-gray-900 bg-opacity-50 dark:bg-opacity-75 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border border-gray-200 dark:border-gray-700 w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Add New Category</h3>
                    <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="add_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Category Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="add_name" 
                               name="name" 
                               required
                               class="w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 rounded-md shadow-sm"
                               placeholder="Enter category name">
                    </div>

                    <div class="mb-4">
                        <label for="add_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description
                        </label>
                        <textarea id="add_description" 
                                  name="description" 
                                  rows="3"
                                  class="w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 rounded-md shadow-sm"
                                  placeholder="Enter description (optional)"></textarea>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" 
                                onclick="closeAddModal()"
                                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-medium rounded-lg transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-medium rounded-lg transition-colors">
                            Add Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 dark:bg-gray-900 bg-opacity-50 dark:bg-opacity-75 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border border-gray-200 dark:border-gray-700 w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Edit Category</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Category Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="edit_name" 
                               name="name" 
                               required
                               class="w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="edit_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description
                        </label>
                        <textarea id="edit_description" 
                                  name="description" 
                                  rows="3"
                                  class="w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 rounded-md shadow-sm"></textarea>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" 
                                onclick="closeEditModal()"
                                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-medium rounded-lg transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-medium rounded-lg transition-colors">
                            Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }

        function openEditModal(id, name, description) {
            const form = document.getElementById('editForm');
            form.action = `/admin/categories/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_description').value = description || '';
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Close modals with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeAddModal();
                closeEditModal();
            }
        });

        // Close modals when clicking outside
        window.onclick = function(event) {
            const addModal = document.getElementById('addModal');
            const editModal = document.getElementById('editModal');
            if (event.target == addModal) {
                closeAddModal();
            }
            if (event.target == editModal) {
                closeEditModal();
            }
        }
    </script>
</x-admin-layout>