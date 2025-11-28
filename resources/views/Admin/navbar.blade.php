<!-- Sidebar -->
<aside class="w-64 bg-white border-r border-gray-200 fixed left-0 top-0 bottom-0 overflow-y-auto z-40 transition-all duration-300" id="sidebar">
    <!-- Logo Section -->
    <div class="h-16 flex items-center px-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-amber-50">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-lg flex items-center justify-center">
                <img src="{{ asset('images/logounib.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div>
                <h1 class="text-base font-bold text-gray-800">SIPULAS</h1>
                <p class="text-xs text-gray-500">FT UNIB</p>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="p-4 space-y-1">
        <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</p>
        
        <a href="{{ url('/dashboard') }}" class="nav-link flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200 text-sm" data-page="dashboard">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>
        
        <a href="{{ url('/form') }}" class="nav-link flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200 text-sm" data-page="form">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="font-medium">Manajemen Form</span>
        </a>
        
        <a href="{{ url('/kategori') }}" class="nav-link flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200 text-sm" data-page="kategori">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            <span class="font-medium">Manajemen Kategori</span>
        </a>
        
        <a href="{{ url('/admin') }}" class="nav-link flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200 text-sm" data-page="admin">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span class="font-medium">Manajemen Admin</span>
        </a>
        
        <div class="pt-6 mt-6 border-t border-gray-100">
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Akun</p>
            
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <a href="javascript:void(0)" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-red-500 hover:text-red-600 hover:bg-red-50 transition-all duration-200 text-sm" onclick="confirmLogout();">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-medium">Keluar</span>
                </a>
            </form>
        </div>
    </nav>
    
    <!-- Footer -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-100 bg-gradient-to-r from-blue-50/50 to-amber-50/50">
        <div class="text-center">
            <p class="text-xs text-gray-400">© 2025 SIPULAS</p>
            <p class="text-xs text-gray-400">Fakultas Teknik UNIB</p>
        </div>
    </div>
</aside>

<script>
    // Detect current page and set active menu
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        const page = link.getAttribute('data-page');
        
        // Check if current path matches the link
        if (currentPath.includes(page)) {
            link.classList.add('bg-gradient-to-r', 'from-blue-500', 'to-blue-600', 'text-white', 'shadow-sm');
            link.classList.remove('text-gray-600', 'hover:bg-blue-50', 'hover:text-blue-600');
            
            // Update icon color for active state
            const icon = link.querySelector('svg');
            if (icon) {
                icon.classList.remove('text-gray-400');
                icon.classList.add('text-white');
            }
        }
    });

    function confirmLogout() {
        showConfirmation(
            "Konfirmasi Keluar",
            "Apakah Anda yakin ingin keluar dari sistem?",
            function() {
                document.getElementById('logout-form').submit();
            }
        );
    }
</script>

@include('partials.confirmation-modal')
</file>