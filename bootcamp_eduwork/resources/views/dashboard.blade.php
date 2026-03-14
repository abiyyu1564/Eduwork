<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="border-radius: 16px; box-shadow: 0 4px 20px rgba(108, 92, 231, 0.08);">
                <div class="p-6 text-gray-900" style="font-family: 'Inter', sans-serif;">
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 1.1rem;">
                        <span style="font-size: 1.4rem;">👋</span>
                        {{ __("Selamat datang di EduShop, ") }} <strong>{{ Auth::user()->name }}</strong>!
                    </div>
                    <p style="margin-top: 0.5rem; color: #636E72; font-size: 0.95rem;">
                        Kelola akun dan lihat aktivitas kamu di sini.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
