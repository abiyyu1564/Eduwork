<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('List Kategori') }}
            </h2>
            <a href="{{ route('product-category.create') }}"
               style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 20px; background: linear-gradient(135deg, #6C5CE7, #A29BFE); color: #fff; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 0.9rem; box-shadow: 0 4px 14px rgba(108,92,231,0.3); transition: transform 0.15s, box-shadow 0.15s;"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(108,92,231,0.4)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 14px rgba(108,92,231,0.3)';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                </svg>
                Tambah Kategori
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Flash Message --}}
            @if(session('success'))
                <div style="margin-bottom: 16px; padding: 14px 20px; background: linear-gradient(135deg, #00b894, #55efc4); color: #fff; border-radius: 12px; font-weight: 500; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(0,184,148,0.2);">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div style="background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(108,92,231,0.08); overflow: hidden;">
                <table style="width: 100%; border-collapse: collapse; font-family: 'Inter', sans-serif;">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #6C5CE7, #A29BFE); color: #fff;">
                            <th style="padding: 14px 20px; text-align: left; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">ID</th>
                            <th style="padding: 14px 20px; text-align: left; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Nama Kategori</th>
                            <th style="padding: 14px 20px; text-align: center; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Jumlah Produk</th>
                            <th style="padding: 14px 20px; text-align: center; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr style="border-bottom: 1px solid #f1f1f1; transition: background 0.15s;"
                                onmouseover="this.style.background='#F8F9FD'"
                                onmouseout="this.style.background='#fff'">
                                <td style="padding: 14px 20px; font-size: 0.9rem; color: #636E72;">{{ $category->id }}</td>
                                <td style="padding: 14px 20px; font-size: 0.95rem; font-weight: 500; color: #2D3436;">{{ $category->name }}</td>
                                <td style="padding: 14px 20px; text-align: center;">
                                    <span style="display: inline-block; background: linear-gradient(135deg, #6C5CE7, #A29BFE); color: #fff; padding: 4px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                                        {{ $category->products_count }}
                                    </span>
                                </td>
                                <td style="padding: 14px 20px; text-align: center;">
                                    <div style="display: flex; justify-content: center; gap: 8px;">
                                        <a href="{{ route('product-category.edit', $category) }}"
                                           style="display: inline-flex; align-items: center; gap: 4px; padding: 8px 16px; background: #FFEAA7; color: #FDCB6E; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.8rem; transition: transform 0.15s;"
                                           onmouseover="this.style.transform='translateY(-1px)'"
                                           onmouseout="this.style.transform='translateY(0)'">
                                            ✏️ Edit
                                        </a>
                                        <form action="{{ route('product-category.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    style="display: inline-flex; align-items: center; gap: 4px; padding: 8px 16px; background: #FFE0E0; color: #E17055; border: none; border-radius: 8px; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: transform 0.15s;"
                                                    onmouseover="this.style.transform='translateY(-1px)'"
                                                    onmouseout="this.style.transform='translateY(0)'">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 40px 20px; text-align: center; color: #B2BEC3; font-size: 1rem;">
                                    <div style="font-size: 2rem; margin-bottom: 8px;">📂</div>
                                    Belum ada kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
