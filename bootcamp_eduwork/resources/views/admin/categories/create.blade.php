<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Kategori') }}
            </h2>
            <a href="{{ route('product-category.index') }}"
               style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 20px; background: #fff; color: #6C5CE7; border: 2px solid #6C5CE7; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: transform 0.15s, box-shadow 0.15s;"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 14px rgba(108,92,231,0.2)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div style="background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(108,92,231,0.08); overflow: hidden;">
                {{-- Header Card --}}
                <div style="padding: 24px 32px; background: linear-gradient(135deg, #6C5CE7, #A29BFE); color: #fff;">
                    <h3 style="margin: 0; font-size: 1.15rem; font-weight: 700;">📂 Form Tambah Kategori</h3>
                    <p style="margin: 6px 0 0 0; font-size: 0.85rem; opacity: 0.85;">Buat kategori produk baru</p>
                </div>

                {{-- Form --}}
                <form action="{{ route('product-category.store') }}" method="POST" style="padding: 32px;">
                    @csrf

                    {{-- Nama Kategori --}}
                    <div style="margin-bottom: 32px;">
                        <label for="name" style="display: block; font-weight: 600; font-size: 0.9rem; color: #2D3436; margin-bottom: 8px;">
                            Nama Kategori <span style="color: #E17055;">*</span>
                        </label>
                        <input type="text" name="name" id="name" placeholder="Masukkan nama kategori"
                               style="width: 100%; padding: 12px 16px; border: 2px solid #f1f1f1; border-radius: 10px; font-size: 0.95rem; font-family: 'Inter', sans-serif; transition: border-color 0.2s; outline: none; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#A29BFE'"
                               onblur="this.style.borderColor='#f1f1f1'">
                        @error('name')
                            <p style="margin-top: 6px; font-size: 0.8rem; color: #E17055;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Submit --}}
                    <div style="display: flex; gap: 12px; justify-content: flex-end;">
                        <a href="{{ route('product-category.index') }}"
                           style="display: inline-flex; align-items: center; padding: 12px 24px; background: #f1f1f1; color: #636E72; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: transform 0.15s;"
                           onmouseover="this.style.transform='translateY(-1px)'"
                           onmouseout="this.style.transform='translateY(0)'">
                            Batal
                        </a>
                        <button type="submit"
                                style="display: inline-flex; align-items: center; gap: 6px; padding: 12px 28px; background: linear-gradient(135deg, #6C5CE7, #A29BFE); color: #fff; border: none; border-radius: 10px; font-weight: 600; font-size: 0.9rem; cursor: pointer; box-shadow: 0 4px 14px rgba(108,92,231,0.3); transition: transform 0.15s, box-shadow 0.15s;"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(108,92,231,0.4)';"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 14px rgba(108,92,231,0.3)';">
                            💾 Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
