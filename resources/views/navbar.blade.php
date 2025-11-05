<!-- Sidebar Floating -->
<aside class="w-64 bg-white rounded-3xl shadow-xl fixed left-6 top-6 bottom-6 overflow-y-auto z-40 transition-all duration-300" id="sidebar" style="max-height: calc(100vh - 48px);">
    <div class="p-6 border-b border-gray-100">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-sm bg-gradient-to-br">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-sm">
                        <img src="{{ asset('images/logounib.png') }}">
                </div>
            </div>
            <div>
                <h1 class="text-base font-bold text-gray-900">SIPULAS</h1>
                <p class="text-xs text-gray-500">FT UNIB</p>
            </div>
        </div>
    </div>
    
    <nav class="p-4 space-y-1">
        <a href="{{ url('/dashboard') }}" class="nav-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200 text-sm" data-page="dashboard">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>
        
        <a href="{{ url('/form') }}" class="nav-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200 text-sm" data-page="form">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="font-medium">Manajemen Form</span>
        </a>
        
        <a href="{{ url('/kategori') }}" class="nav-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200 text-sm" data-page="kategori">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            <span class="font-medium">Manajemen Kategori</span>
        </a>
        
        <a href="#" class="nav-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200 text-sm" data-page="admin">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span class="font-medium">Manajemen Admin</span>
        </a>
        
        <div class="pt-4 mt-4 border-t border-gray-100">
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-red-600 hover:text-red-700 hover:bg-red-50 transition-all duration-200 text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span class="font-medium">Keluar</span>
            </a>
        </div>
    </nav>
</aside>

<script>
    // Detect current page and set active menu
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        const page = link.getAttribute('data-page');
        
        // Check if current path matches the link
        if (currentPath.includes(page)) {
            link.classList.add('bg-gradient-to-r', 'from-blue-500', 'to-indigo-600', 'text-white', 'shadow-md', 'shadow-blue-500/20', 'font-semibold');
            link.classList.remove('text-gray-700', 'hover:bg-gray-100', 'hover:text-gray-900');
        }
    });
</script>