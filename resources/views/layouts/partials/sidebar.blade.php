<div id="sidebar" class="bg-gray-800 text-white flex flex-col transition-all duration-300 ease-in-out h-screen sidebar-expanded">
    <div class="h-20 flex items-center justify-center text-xl font-bold border-b border-gray-700">
        <span class="sidebar-text flex items-center">
            <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
        </span>
        <span class="sidebar-text">
            InvenTrack
        </span>
        <span class="sidebar-icon hidden">
            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
        </span>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2">
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900' : '' }}"
           title="Dashboard">
            <svg class="h-6 w-6 sidebar-icon-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="sidebar-text ml-3">Dashboard</span>
        </a>
        
        <a href="{{ route('admin.barang.index') }}"
           class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('admin.barang.*') ? 'bg-gray-900' : '' }}"
           title="Item Management">
            <svg class="h-6 w-6 sidebar-icon-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
            </svg>
            <span class="sidebar-text ml-3">Item Management</span>
        </a>
        
        <a href="{{ route('admin.users.index') }}"
           class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('admin.users.*') ? 'bg-gray-900' : '' }}"
           title="User Management">
            <svg class="h-6 w-6 sidebar-icon-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span class="sidebar-text ml-3">User Management</span>
        </a>

        <a href="{{ route('admin.movements.index') }}"
           class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('admin.movements.*') ? 'bg-gray-900' : '' }}"
           title="Item Movement">
            <svg class="h-6 w-6 sidebar-icon-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
            </svg>
            <span class="sidebar-text ml-3">Item Movement</span>
        </a>

        <a href="{{ route('admin.qr-scanner') }}" 
           class="flex items-center px-4 py-2 mt-2 rounded-md text-gray-100 hover:bg-gray-700 {{ request()->routeIs('admin.qr-scanner') ? 'bg-gray-700' : '' }}"
           title="QR Scanner">
            <svg class="h-6 w-6 sidebar-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
            </svg>
            <span class="sidebar-text ml-3">QR Scanner</span>
        </a>
    </nav>
    
    <!-- Sidebar Toggle Button -->
    <div class="border-t border-gray-700">
        <!-- Toggle Button -->
        <div class="flex items-center justify-center py-3 border-b border-gray-700">
            <button id="sidebarToggle" class="bg-gray-700 text-white rounded-lg px-3 py-2 hover:bg-gray-600 transition-colors duration-200 flex items-center">
                <svg id="toggleIcon" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="sidebar-text ml-2 text-sm font-medium">Collapse</span>
            </button>
        </div>
    </div>
</div>

<style>
    .sidebar-expanded {
        width: 16rem; /* 256px / w-64 */
    }
    
    .sidebar-collapsed {
        width: 5rem; /* 80px */
    }
    
    .sidebar-collapsed .sidebar-text {
        display: none;
    }
    
    .sidebar-collapsed .sidebar-icon {
        display: block !important;
    }
    
    .sidebar-collapsed .sidebar-icon-svg {
        margin: 0 auto;
    }
    
    .sidebar-collapsed nav a {
        justify-content: center;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }
    
    .sidebar-collapsed #sidebarToggle {
        padding: 0.5rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const toggleIcon = document.getElementById('toggleIcon');
        
        // Load saved state from localStorage
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        if (isCollapsed) {
            sidebar.classList.remove('sidebar-expanded');
            sidebar.classList.add('sidebar-collapsed');
            updateToggleIcon(true);
        }
        
        toggleBtn.addEventListener('click', function() {
            const isCurrentlyCollapsed = sidebar.classList.contains('sidebar-collapsed');
            
            if (isCurrentlyCollapsed) {
                sidebar.classList.remove('sidebar-collapsed');
                sidebar.classList.add('sidebar-expanded');
                localStorage.setItem('sidebarCollapsed', 'false');
                updateToggleIcon(false);
            } else {
                sidebar.classList.remove('sidebar-expanded');
                sidebar.classList.add('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', 'true');
                updateToggleIcon(true);
            }
        });
        
        function updateToggleIcon(isCollapsed) {
            if (isCollapsed) {
                // Arrow pointing right (expand)
                toggleIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />';
            } else {
                // Arrow pointing left (collapse)
                toggleIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />';
            }
        }
    });
</script>