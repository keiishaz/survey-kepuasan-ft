<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Edit Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: {
            'pastel-blue':'#E8F4FD','light-blue':'#B8E0FF','cream':'#FEF9E7','dark-blue':'#1E3A8A','medium-blue':'#3B82F6'
        }}}}
    </script>
    <style>
        body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen,Ubuntu,Cantarell,sans-serif}
        #sidebar{transition:transform .3s cubic-bezier(.4,0,.2,1)}
        @media(max-width:1023px){#sidebar{transform:translateX(-100%);left:1rem;width:calc(100% - 2rem);max-width:280px}#sidebar.translate-x-0{transform:translateX(0)}}
        button:focus-visible,input:focus-visible{outline:2px solid #3B82F6;outline-offset:2px}
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
<div class="flex min-h-screen">
    @include('navbar')

    <!-- Toggle -->
    <button class="fixed top-6 right-6 z-50 lg:hidden bg-white p-3 rounded-xl shadow-lg border border-gray-200" id="sidebar-toggle">
        <svg class="w-5 h-5 text-dark-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <main class="flex-1 lg:ml-72 p-6 lg:p-8 lg:pr-6">
        <div class="mb-6 lg:mt-0 mt-16">
            <h1 class="text-xl font-bold text-gray-900 mb-1">Edit Kategori</h1>
            <p class="text-xs text-gray-600">Perbarui nama kategori</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-4 mb-6 border border-gray-100">
            <form method="POST" action="{{ route('kategori.update', $kategori->id_kategori) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Kategori</label>
                    <input type="text" name="nama" required
                           value="{{ old('nama', $kategori->nama) }}"
                           placeholder="Masukkan nama kategori"
                           class="w-full px-3 py-2 border border-gray-200 rounded-xl focus:border-medium-blue focus:ring-2 focus:ring-medium-blue/20 transition-all duration-200 outline-none text-sm">
                    @error('nama')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2 flex items-center gap-3">
                    <button type="submit"
                            class="bg-gradient-to-r from-medium-blue to-blue-600 text-white px-4 py-2 rounded-xl font-medium text-sm hover:from-dark-blue hover:to-blue-700 transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Perbarui
                    </button>
                    <a href="{{ route('kategori') }}" class="px-4 py-2 rounded-xl border border-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-50 transition-all duration-200">Batal</a>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
const sidebarToggle=document.getElementById('sidebar-toggle');const sidebar=document.getElementById('sidebar');
if(sidebarToggle&&sidebar){sidebarToggle.addEventListener('click',function(){sidebar.classList.toggle('-translate-x-full');sidebar.classList.toggle('translate-x-0');const i=this.querySelector('svg');i.innerHTML=sidebar.classList.contains('-translate-x-full')?'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>':'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';});document.addEventListener('click',function(e){const inSide=sidebar.contains(e.target);const onTog=sidebarToggle.contains(e.target);if(!inSide&&!onTog&&window.innerWidth<1024){sidebar.classList.add('-translate-x-full');const i=sidebarToggle.querySelector('svg');i.innerHTML='<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';}});}
window.addEventListener('resize',function(){if(window.innerWidth>=1024){sidebar.classList.remove('-translate-x-full');}else{sidebar.classList.add('-translate-x-full');}});
if(window.innerWidth<1024){sidebar.classList.add('-translate-x-full');}
</script>
</body>
</html>
