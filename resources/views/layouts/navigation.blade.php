<header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
    <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 py-4">
        <!-- Left Side - Page Title or Breadcrumb -->
        <div class="flex items-center">
            <!-- Mobile Menu Button -->
            <button 
                type="button" 
                id="mobileMenuButton"
                class="lg:hidden mr-4 text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none"
                onclick="toggleMobileMenu()">
                <svg id="menuOpenIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="menuCloseIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Logo & Page Title -->
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h1 class="text-xl sm:text-2xl font-semibold text-gray-800 dark:text-white">
                    InvenTrack
                </h1>
            </div>
        </div>

        <!-- Right Side - Navigation & User Menu -->
        <div class="flex items-center space-x-2 sm:space-x-4">
            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('dashboard') }}" 
                   class="px-3 py-2 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                </a>
                <a href="{{ route('pinjam.history') }}" 
                   class="px-3 py-2 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('pinjam.history') ? 'bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>History</span>
                    </div>
                </a>
            </nav>

            <!-- Dark Mode Toggle -->
            <button 
                type="button" 
                id="darkModeToggle"
                class="text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                onclick="toggleDarkMode()">
                <!-- Sun Icon (shown in dark mode) -->
                <svg id="sunIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <!-- Moon Icon (shown in light mode) -->
                <svg id="moonIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
            </button>

            <!-- Notifications Dropdown -->
            <div class="relative" x-data="notificationDropdown()" x-init="init()">
                <button 
                    @click="toggleDropdown()"
                    class="relative text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <!-- Notification Badge -->
                    <span 
                        x-show="unreadCount > 0" 
                        x-text="unreadCount > 9 ? '9+' : unreadCount"
                        class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full min-w-[18px]"
                        style="display: none;">
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
                    class="absolute right-0 z-50 mt-2 w-80 sm:w-96 origin-top-right rounded-lg bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
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
                        <!-- Loading State -->
                        <template x-if="loading">
                            <div class="p-8 text-center">
                                <svg class="animate-spin h-8 w-8 mx-auto text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Loading...</p>
                            </div>
                        </template>

                        <!-- No notifications -->
                        <template x-if="!loading && notifications.length === 0">
                            <div class="p-8 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No notifications yet</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">You're all caught up!</p>
                            </div>
                        </template>
                        
                        <!-- Notifications -->
                        <template x-if="!loading && notifications.length > 0">
                            <div>
                                <template x-for="notification in notifications" :key="notification.id">
                                    <div class="border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                                        <a 
                                            :href="notification.borrowing_id ? '/pinjam/' + notification.borrowing_id + '/show' : '#'" 
                                            class="block p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                                            :class="{ 'bg-blue-50 dark:bg-blue-900/20': !notification.is_read }"
                                            @click="markAsRead(notification.id)">
                                            <div class="flex items-start space-x-3">
                                                <!-- Icon based on notification type -->
                                                <div class="flex-shrink-0 mt-1">
                                                    <!-- Borrowing Request -->
                                                    <template x-if="notification.type === 'borrowing_request'">
                                                        <div class="w-8 h-8 rounded-full bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                                                            </svg>
                                                        </div>
                                                    </template>
                                                    
                                                    <!-- Approved -->
                                                    <template x-if="notification.type === 'borrowing_approved'">
                                                        <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                            </svg>
                                                        </div>
                                                    </template>
                                                    
                                                    <!-- Rejected -->
                                                    <template x-if="notification.type === 'borrowing_rejected'">
                                                        <div class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                            </svg>
                                                        </div>
                                                    </template>
                                                    
                                                    <!-- Return Request -->
                                                    <template x-if="notification.type === 'return_request'">
                                                        <div class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                                                            </svg>
                                                        </div>
                                                    </template>
                                                    
                                                    <!-- Waiting Pickup -->
                                                    <template x-if="notification.type === 'waiting_pickup'">
                                                        <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                                                            </svg>
                                                        </div>
                                                    </template>
                                                    
                                                    <!-- Default Icon -->
                                                    <template x-if="!['borrowing_request', 'borrowing_approved', 'borrowing_rejected', 'return_request', 'waiting_pickup'].includes(notification.type)">
                                                        <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                                                            </svg>
                                                        </div>
                                                    </template>
                                                </div>

                                                <!-- Content -->
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-start justify-between">
                                                        <p class="text-sm font-medium text-gray-900 dark:text-white" x-text="notification.title"></p>
                                                        <template x-if="!notification.is_read">
                                                            <span class="ml-2 h-2 w-2 rounded-full bg-blue-600 flex-shrink-0"></span>
                                                        </template>
                                                    </div>
                                                    <p class="mt-1 text-xs text-gray-600 dark:text-gray-400 line-clamp-2" x-text="notification.message"></p>
                                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-500" x-text="formatDate(notification.created_at)"></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="relative">
                <button 
                    id="userMenuButton"
                    onclick="toggleUserMenu()"
                    class="flex items-center space-x-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <!-- User Avatar -->
                    <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center text-white font-semibold text-sm">
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
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                    </div>

                    <!-- Menu Items -->
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profile
                        </div>
                    </a>

                    <a href="{{ route('notifications.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
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
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
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

    <!-- Mobile Navigation Menu -->
    <div id="mobileMenu" class="hidden lg:hidden border-t border-gray-200 dark:border-gray-700">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('dashboard') ? 'bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </div>
            </a>
            <a href="{{ route('pinjam.history') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('pinjam.history') ? 'bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Borrowing History</span>
                </div>
            </a>
        </div>
    </div>
</header>

<!-- Alpine.js (pastikan sudah di-include di layout utama) -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
    // Alpine.js Notification Component
    function notificationDropdown() {
        return {
            open: false,
            loading: false,
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
                    const response = await fetch('/notifications/unread-count', {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });
                    const data = await response.json();
                    this.unreadCount = data.count;
                } catch (error) {
                    console.error('Error fetching unread count:', error);
                }
            },
            
            async toggleDropdown() {
                this.open = !this.open;
                if (this.open && this.notifications.length === 0) {
                    await this.fetchNotifications();
                }
            },
            
            async fetchNotifications() {
                this.loading = true;
                try {
                    const response = await fetch('/notifications/recent', {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });
                    const data = await response.json();
                    this.notifications = data;
                } catch (error) {
                    console.error('Error fetching notifications:', error);
                } finally {
                    this.loading = false;
                }
            },
            
            async markAsRead(notificationId) {
                try {
                    const response = await fetch(`/notifications/${notificationId}/read`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    
                    if (response.ok) {
                        // Update notification as read
                        const notification = this.notifications.find(n => n.id === notificationId);
                        if (notification) {
                            notification.is_read = true;
                        }
                        this.fetchUnreadCount();
                    }
                } catch (error) {
                    console.error('Error marking notification as read:', error);
                }
            },
            
            async markAllAsRead() {
                try {
                    const response = await fetch('/notifications/mark-all-read', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    
                    if (response.ok) {
                        // Update all notifications as read
                        this.notifications.forEach(n => n.is_read = true);
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
                if (diff < 3600) return Math.floor(diff / 60) + ' min ago';
                if (diff < 86400) return Math.floor(diff / 3600) + ' hours ago';
                if (diff < 604800) return Math.floor(diff / 86400) + ' days ago';
                
                return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
            }
        }
    }

    // Dark Mode Toggle
    function toggleDarkMode() {
        const html = document.documentElement;
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');
        
        html.classList.toggle('dark');
        
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

    // Load dark mode preference
    function loadDarkModePreference() {
        const darkMode = localStorage.getItem('darkMode');
        const html = document.documentElement;
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');
        
        if (darkMode === 'true') {
            html.classList.add('dark');
            if (sunIcon) sunIcon.classList.remove('hidden');
            if (moonIcon) moonIcon.classList.add('hidden');
        } else {
            html.classList.remove('dark');
            if (sunIcon) sunIcon.classList.add('hidden');
            if (moonIcon) moonIcon.classList.remove('hidden');
        }
    }

    // User Dropdown Toggle
    function toggleUserMenu() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('hidden');
    }

    // Mobile Menu Toggle
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        const openIcon = document.getElementById('menuOpenIcon');
        const closeIcon = document.getElementById('menuCloseIcon');
        
        menu.classList.toggle('hidden');
        openIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const userMenuButton = document.getElementById('userMenuButton');
        const userDropdown = document.getElementById('userDropdown');
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        
        // Close user dropdown
        if (userMenuButton && userDropdown && 
            !userMenuButton.contains(event.target) && 
            !userDropdown.contains(event.target)) {
            userDropdown.classList.add('hidden');
        }
        
        // Close mobile menu
        if (mobileMenuButton && mobileMenu && 
            !mobileMenuButton.contains(event.target) && 
            !mobileMenu.contains(event.target)) {
            mobileMenu.classList.add('hidden');
            document.getElementById('menuOpenIcon')?.classList.remove('hidden');
            document.getElementById('menuCloseIcon')?.classList.add('hidden');
        }
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadDarkModePreference();
    });
</script>
