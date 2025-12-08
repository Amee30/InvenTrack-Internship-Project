<header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
    <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 py-4">
        <!-- Left Side - Page Title or Breadcrumb -->
        <div class="flex items-center">
            <!-- Mobile Menu Button -->
            <button 
                type="button" 
                class="lg:hidden mr-4 text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none"
                onclick="toggleSidebar()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Page Title -->
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-800 dark:text-white">
                {{ $title ?? 'Dashboard' }}
            </h1>
        </div>

        <!-- Right Side - User Menu & Actions -->
        <div class="flex items-center space-x-4">
            <!-- Notifications -->
            <div class="relative" x-data="notificationDropdown()" x-init="init()">
                <button 
                    @click="toggleDropdown()" 
                    class="relative p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span 
                        x-show="unreadCount > 0" 
                        x-text="unreadCount"
                        class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                    </span>
                </button>

                <!-- Notification Dropdown -->
                <div 
                    x-show="open" 
                    @click.away="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 z-50 mt-2 w-80 origin-top-right rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                    style="display: none;">
                    
                    <!-- Header -->
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between items-center">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Notifications</h3>
                            <div class="flex items-center space-x-2">
                                <!-- Mark All as Read Button -->
                                <button 
                                    @click="markAllAsRead()" 
                                    x-show="unreadCount > 0"
                                    class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Mark all read
                                </button>
                                <a href="{{ route('notifications.index') }}" class="text-xs text-blue-600 dark:text-blue-400 hover:underline">
                                    View all
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Notifications List -->
                    <div class="max-h-96 overflow-y-auto">
                        <!-- No notifications -->
                        <template x-if="notifications.length === 0">
                            <div class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                No new notifications
                            </div>
                        </template>
                        
                        <!-- Notifications -->
                        <template x-for="notification in notifications" :key="notification.id">
                            <div class="block border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                                <a 
                                    :href="notification.borrowing_id ? '/pinjam/' + notification.borrowing_id + '/show' : '#'" 
                                    class="block p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                                    :class="{ 'bg-blue-50 dark:bg-blue-900/20': !notification.is_read }">
                                    <div class="flex items-start">
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white" x-text="notification.title"></p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 line-clamp-2" x-text="notification.message"></p>
                                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1" x-text="formatDate(notification.created_at)"></p>
                                        </div>
                                        <template x-if="!notification.is_read">
                                            <span class="ml-2 h-2 w-2 rounded-full bg-blue-600 flex-shrink-0"></span>
                                        </template>
                                    </div>
                                </a>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Dark Mode Toggle -->
            <button 
                type="button" 
                id="darkModeToggle"
                class="text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none"
                onclick="toggleDarkMode()">
                <!-- Sun Icon (shown in dark mode) -->
                <svg id="sunIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <!-- Moon Icon (shown in light mode) -->
                <svg id="moonIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
            </button>

            <!-- User Dropdown -->
            <div class="relative">
                <button 
                    id="userMenuButton"
                    onclick="toggleUserMenu()"
                    class="flex items-center space-x-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none">
                    <!-- User Avatar -->
                    <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center text-white font-semibold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="hidden sm:block text-sm font-medium">{{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div 
                    id="userDropdown"
                    class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 border border-gray-200 dark:border-gray-700">
                    
                    <!-- User Info -->
                    <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                    </div>

                    <!-- Menu Items -->
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profile
                        </div>
                    </a>

                    <a href="{{ route('notifications.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            Notifications
                        </div>
                    </a>

                    <hr class="my-1 border-gray-200 dark:border-gray-700">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Logout
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    // Alpine.js Notification Component
    function notificationDropdown() {
        return {
            open: false,
            unreadCount: 0,
            notifications: [],
            
            init() {
                this.fetchUnreadCount();
                // Auto refresh every 30 seconds
                setInterval(() => {
                    this.fetchUnreadCount();
                }, 30000);
            },
            
            async fetchUnreadCount() {
                try {
                    const response = await fetch('/notifications/unread-count');
                    const data = await response.json();
                    this.unreadCount = data.count;
                } catch (error) {
                    console.error('Error fetching unread count:', error);
                }
            },
            
            async toggleDropdown() {
                this.open = !this.open;
                if (this.open) {
                    await this.fetchNotifications();
                }
            },
            
            async fetchNotifications() {
                try {
                    const response = await fetch('/notifications/recent');
                    const data = await response.json();
                    this.notifications = data;
                } catch (error) {
                    console.error('Error fetching notifications:', error);
                }
            },

            async markAllAsRead() {
                try {
                    const response = await fetch('/notifications/mark-all-read', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    });
                    if (response.ok) {
                        // Update local state
                        this.notifications = this.notifications.map(n => ({ ...n, is_read: true }));
                        this.unreadCount = 0;
                    }
                } catch (error) {
                    console.error('Error marking all as read:', error);
                }
            },
            
            formatDate(dateString) {
                const date = new Date(dateString);
                const now = new Date();
                const diff = Math.floor((now - date) / 1000); // difference in seconds
                
                if (diff < 60) return 'Just now';
                if (diff < 3600) return Math.floor(diff / 60) + ' minutes ago';
                if (diff < 86400) return Math.floor(diff / 3600) + ' hours ago';
                if (diff < 604800) return Math.floor(diff / 86400) + ' days ago';
                
                return date.toLocaleDateString();
            }
        }
    }

    // Dark Mode Toggle
    function toggleDarkMode() {
        const html = document.documentElement;
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');
        
        html.classList.toggle('dark');
        
        // Toggle icons
        if (html.classList.contains('dark')) {
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
            localStorage.setItem('darkMode', 'true');
        } else {
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
            localStorage.setItem('darkMode', 'false');
        }
    }

    // Load dark mode preference on page load
    function loadDarkModePreference() {
        const darkMode = localStorage.getItem('darkMode');
        const html = document.documentElement;
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');
        
        if (darkMode === 'true') {
            html.classList.add('dark');
            if (sunIcon && moonIcon) {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            }
        } else {
            html.classList.remove('dark');
            if (sunIcon && moonIcon) {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }
        }
    }

    // User Dropdown Toggle
    function toggleUserMenu() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('hidden');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const userMenuButton = document.getElementById('userMenuButton');
        const userDropdown = document.getElementById('userDropdown');
        
        if (userMenuButton && userDropdown && 
            !userMenuButton.contains(event.target) && 
            !userDropdown.contains(event.target)) {
            userDropdown.classList.add('hidden');
        }
    });

    // Sidebar Toggle for Mobile
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        if (sidebar) {
            sidebar.classList.toggle('-translate-x-full');
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadDarkModePreference();
    });
</script>