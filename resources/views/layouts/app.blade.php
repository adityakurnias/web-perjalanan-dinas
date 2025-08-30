<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perjalanan Dinas - @yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @vite('resources/css/app.css')

    @yield('styles')
</head>

<body>
    <div>
        @auth
            <div class="fixed top-0 left-0 h-full w-72 bg-[#F6EDFF] z-50 shadow-lg flex flex-col justify-between px-6 py-4 rounded-r-2xl transform -translate-x-full transition-transform duration-300 ease-in-out"
                id="sidebar">
                <div>
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-xl font-semibold text-purple-800">Catatan Dinas</h2>
                        <button class="text-purple-600 hover:text-purple-800 lg:hidden" onclick="closeSidebar()">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <nav>
                        <div class="space-y-4">
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center px-4 py-3 bg-[#EADDFF] text-[#4F378A] rounded-xl hover:shadow-md hover:-translate-y-0.5 transition {{ request()->routeIs('dashboard') ? 'font-semibold shadow-md' : '' }}">
                                <span class="material-icons mr-3">home</span>
                                Beranda
                            </a>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('pegawai.index') }}"
                                    class="flex items-center px-4 py-3 bg-[#EADDFF] text-[#4F378A] rounded-xl hover:shadow-md hover:-translate-y-0.5 transition {{ request()->routeIs('pegawai.*') ? 'font-semibold shadow-md' : '' }}">
                                    <span class="material-icons mr-3">groups</span>
                                    Kelola Pegawai
                                </a>
                                <a href="{{ route('sppd.index') }}"
                                    class="flex items-center px-4 py-3 bg-[#EADDFF] text-[#4F378A] rounded-xl hover:shadow-md hover:-translate-y-0.5 transition {{ request()->routeIs('sppd.*') ? 'font-semibold shadow-md' : '' }}">
                                    <span class="material-icons mr-3">assignment</span>
                                    Kelola SPPD
                                </a>
                                <a href="{{ route('biaya.index') }}"
                                    class="flex items-center px-4 py-3 bg-[#EADDFF] text-[#4F378A] rounded-xl hover:shadow-md hover:-translate-y-0.5 transition {{ request()->routeIs('biaya.*') ? 'font-semibold shadow-md' : '' }}">
                                    <span class="material-icons mr-3">attach_money</span>
                                    Kelola Biaya
                                </a>
                                <a href="{{ route('anggaran.index') }}"
                                    class="flex items-center px-4 py-3 bg-[#EADDFF] text-[#4F378A] rounded-xl hover:shadow-md hover:-translate-y-0.5 transition {{ request()->routeIs('anggaran.*') ? 'font-semibold shadow-md' : '' }}">
                                    <span class="material-icons mr-3">business</span>
                                    Kelola Anggaran
                                </a>
                            @else
                                <a href="{{ route('sppd.create') }}"
                                    class="flex items-center px-4 py-3 bg-[#EADDFF] text-[#4F378A] rounded-xl hover:shadow-md hover:-translate-y-0.5 transition {{ request()->routeIs('sppd.create') ? 'font-semibold shadow-md' : '' }}">
                                    <span class="material-icons mr-3">add_circle</span>
                                    Buat SPPD
                                </a>
                                <a href="{{ route('sppd.index') }}"
                                    class="flex items-center px-4 py-3 bg-[#EADDFF] text-[#4F378A] rounded-xl hover:shadow-md hover:-translate-y-0.5 transition {{ request()->routeIs('sppd.index') ? 'font-semibold shadow-md' : '' }}">
                                    <span class="material-icons mr-3">flag</span>
                                    Status SPPD
                                </a>
                                <a href="{{ route('laporan.index') }}"
                                    class="flex items-center px-4 py-3 bg-[#EADDFF] text-[#4F378A] rounded-xl hover:shadow-md hover:-translate-y-0.5 transition {{ request()->routeIs('laporan.*') ? 'font-semibold shadow-md' : '' }}">
                                    <span class="material-icons mr-3">description</span>
                                    Laporan
                                </a>
                            @endif
                        </div>
                    </nav>
                </div>
                <div class="mb-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-4 py-3 bg-red-700 cursor-pointer text-white rounded-full shadow hover:bg-red-600 transition">
                            <span class="material-icons mr-3">logout</span>
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <header
                class="sticky top-0 px-4 py-2 flex items-center justify-between w-full z-10 rounded-b-2xl shadow-lg bg-[#EADDFF] ">
                <button class="cursor-pointer text-[#4F378A] flex items-center justify-center" onclick="openSidebar()">
                    <span class="material-icons">menu</span>
                </button>

                <h1 class="text-[#4F378A] font-bold text-lg ml-2 flex-1">Beranda</h1>

                <a href="{{ route('profile') }}"
                    class="flex items-center px-4 py-3 bg-[#EADDFF] text-[#4F378A] rounded-xl hover:shadow-md hover:-translate-y-0.5 transition {{ request()->routeIs('profile') ? 'font-semibold shadow-md' : '' }}">
                    <span class="material-icons mr-3">person</span>
                    Profil
                </a>
            </header>

            <div class="fixed inset-0 bg-black/10 bg-opacity-50 z-40 hidden" id="sidebar-overlay" onclick="closeSidebar()">
            </div>
        @endauth

        <main class="w-full bg-violet-50 p-5">
            <div class="page-content space-y-3">
                @if(session('success'))
                    <div class="flex items-center gap-3 rounded-xl bg-green-50 border border-green-200 p-4 shadow-sm">
                        <span class="material-icons text-green-600">check_circle</span>
                        <p class="text-green-900 font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="flex items-center gap-3 rounded-xl bg-red-50 border border-red-200 p-4 shadow-sm">
                        <span class="material-icons text-red-600">error</span>
                        <p class="text-red-900 font-medium">{{ session('error') }}</p>
                    </div>
                @endif

                @if(session('info'))
                    <div class="flex items-center gap-3 rounded-xl bg-blue-50 border border-blue-200 p-4 shadow-sm">
                        <span class="material-icons text-blue-600">info</span>
                        <p class="text-blue-900 font-medium">{{ session('info') }}</p>
                    </div>
                @endif

                @yield('content')
            </div>

        </main>
    </div>

    <script>
        // document.addEventListener('DOMContentLoaded', function () {
        //     document.getElementById('add-biaya')?.addEventListener('click', function () {
        //         const biayaContainer = document.getElementById('biaya-container');
        //         const index = biayaContainer.children.length;
        //         const template = `
        //         <div class="biaya-row">
        //             <span class="remove-biaya" onclick="this.parentElement.remove()">×</span>
        //             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        //                 <input class="mdl-textfield__input" type="text" name="jenis_biaya[]" required>
        //                 <label class="mdl-textfield__label">Jenis Biaya</label>
        //             </div>
        //             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        //                 <input class="mdl-textfield__input" type="number" name="jumlah_biaya[]" step="0.01" required>
        //                 <label class="mdl-textfield__label">Jumlah Biaya</label>
        //             </div>
        //             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        //                 <textarea class="mdl-textfield__input" name="keterangan_biaya[]" rows="2"></textarea>
        //                 <label class="mdl-textfield__label">Keterangan</label>
        //             </div>
        //         </div>
        //     `;

        //         const div = document.createElement('div');
        //         div.innerHTML = template;
        //         biayaContainer.appendChild(div.firstElementChild);

        //         componentHandler.upgradeAllRegistered();
        //     });
        // });

        // The JS functions are correct and do not need changes.
        // They correctly add/remove the classes we have now set up in the HTML.
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.remove('hidden');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.add('hidden');
        }
    </script>

    @yield('scripts')
</body>

</html>