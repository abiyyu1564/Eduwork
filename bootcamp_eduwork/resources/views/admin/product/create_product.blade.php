<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Produk') }}
            </h2>
            <a href="{{ route('product.index') }}"
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
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div style="background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(108,92,231,0.08); overflow: hidden;">
                {{-- Header Card --}}
                <div style="padding: 24px 32px; background: linear-gradient(135deg, #6C5CE7, #A29BFE); color: #fff;">
                    <h3 style="margin: 0; font-size: 1.15rem; font-weight: 700;">📦 Form Tambah Produk</h3>
                    <p style="margin: 6px 0 0 0; font-size: 0.85rem; opacity: 0.85;">Isi data produk baru di bawah ini</p>
                </div>

                {{-- Form --}}
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" style="padding: 32px;">
                    @csrf

                    {{-- Nama Produk --}}
                    <div style="margin-bottom: 24px;">
                        <label for="name" style="display: block; font-weight: 600; font-size: 0.9rem; color: #2D3436; margin-bottom: 8px;">
                            Nama Produk <span style="color: #E17055;">*</span>
                        </label>
                        <input type="text" name="name" id="name" placeholder="Masukkan nama produk"
                               style="width: 100%; padding: 12px 16px; border: 2px solid #f1f1f1; border-radius: 10px; font-size: 0.95rem; font-family: 'Inter', sans-serif; transition: border-color 0.2s; outline: none; box-sizing: border-box;"
                               onfocus="this.style.borderColor='#A29BFE'"
                               onblur="this.style.borderColor='#f1f1f1'">
                        @error('name')
                            <p style="margin-top: 6px; font-size: 0.8rem; color: #E17055;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div style="margin-bottom: 24px;">
                        <label for="description" style="display: block; font-weight: 600; font-size: 0.9rem; color: #2D3436; margin-bottom: 8px;">
                            Deskripsi
                        </label>
                        <textarea name="description" id="description" rows="4" placeholder="Masukkan deskripsi produk"
                                  style="width: 100%; padding: 12px 16px; border: 2px solid #f1f1f1; border-radius: 10px; font-size: 0.95rem; font-family: 'Inter', sans-serif; transition: border-color 0.2s; outline: none; resize: vertical; box-sizing: border-box;"
                                  onfocus="this.style.borderColor='#A29BFE'"
                                  onblur="this.style.borderColor='#f1f1f1'"></textarea>
                        @error('description')
                            <p style="margin-top: 6px; font-size: 0.8rem; color: #E17055;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Stok & Harga (2 kolom) --}}
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px;">
                        <div>
                            <label for="stock" style="display: block; font-weight: 600; font-size: 0.9rem; color: #2D3436; margin-bottom: 8px;">
                                Stok <span style="color: #E17055;">*</span>
                            </label>
                            <input type="number" name="stock" id="stock" placeholder="0" min="0"
                                   style="width: 100%; padding: 12px 16px; border: 2px solid #f1f1f1; border-radius: 10px; font-size: 0.95rem; font-family: 'Inter', sans-serif; transition: border-color 0.2s; outline: none; box-sizing: border-box;"
                                   onfocus="this.style.borderColor='#A29BFE'"
                                   onblur="this.style.borderColor='#f1f1f1'">
                            @error('stock')
                                <p style="margin-top: 6px; font-size: 0.8rem; color: #E17055;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="price" style="display: block; font-weight: 600; font-size: 0.9rem; color: #2D3436; margin-bottom: 8px;">
                                Harga (Rp) <span style="color: #E17055;">*</span>
                            </label>
                            <input type="number" name="price" id="price" placeholder="0" min="0"
                                   style="width: 100%; padding: 12px 16px; border: 2px solid #f1f1f1; border-radius: 10px; font-size: 0.95rem; font-family: 'Inter', sans-serif; transition: border-color 0.2s; outline: none; box-sizing: border-box;"
                                   onfocus="this.style.borderColor='#A29BFE'"
                                   onblur="this.style.borderColor='#f1f1f1'">
                            @error('price')
                                <p style="margin-top: 6px; font-size: 0.8rem; color: #E17055;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Kategori --}}
                    <div style="margin-bottom: 24px;">
                        <label for="category_id" style="display: block; font-weight: 600; font-size: 0.9rem; color: #2D3436; margin-bottom: 8px;">
                            Kategori <span style="color: #E17055;">*</span>
                        </label>
                        <select name="category_id" id="category_id"
                                style="width: 100%; padding: 12px 16px; border: 2px solid #f1f1f1; border-radius: 10px; font-size: 0.95rem; font-family: 'Inter', sans-serif; transition: border-color 0.2s; outline: none; background: #fff; box-sizing: border-box; cursor: pointer;"
                                onfocus="this.style.borderColor='#A29BFE'"
                                onblur="this.style.borderColor='#f1f1f1'">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p style="margin-top: 6px; font-size: 0.8rem; color: #E17055;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Upload Gambar --}}
                    <div style="margin-bottom: 32px;">
                        <label for="image" style="display: block; font-weight: 600; font-size: 0.9rem; color: #2D3436; margin-bottom: 8px;">
                            Gambar Produk
                        </label>
                        <div style="border: 2px dashed #d1d1d1; border-radius: 10px; padding: 24px; text-align: center; transition: border-color 0.2s; cursor: pointer;"
                             onmouseover="this.style.borderColor='#A29BFE'"
                             onmouseout="this.style.borderColor='#d1d1d1'"
                             onclick="document.getElementById('image').click()">
                            <div style="font-size: 2rem; margin-bottom: 8px;">📷</div>
                            <p style="margin: 0; font-size: 0.9rem; color: #636E72;">Klik untuk upload gambar</p>
                            <p style="margin: 4px 0 0 0; font-size: 0.8rem; color: #B2BEC3;">JPG, JPEG, PNG, WEBP (Maks. 2MB)</p>
                        </div>
                        <input type="file" name="image" id="image" accept="image/*" style="display: none;">
                        @error('image')
                            <p style="margin-top: 6px; font-size: 0.8rem; color: #E17055;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Submit --}}
                    <div style="display: flex; gap: 12px; justify-content: flex-end;">
                        <a href="{{ route('product.index') }}"
                           style="display: inline-flex; align-items: center; padding: 12px 24px; background: #f1f1f1; color: #636E72; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: transform 0.15s;"
                           onmouseover="this.style.transform='translateY(-1px)'"
                           onmouseout="this.style.transform='translateY(0)'">
                            Batal
                        </a>
                        <button type="submit"
                                style="display: inline-flex; align-items: center; gap: 6px; padding: 12px 28px; background: linear-gradient(135deg, #6C5CE7, #A29BFE); color: #fff; border: none; border-radius: 10px; font-weight: 600; font-size: 0.9rem; cursor: pointer; box-shadow: 0 4px 14px rgba(108,92,231,0.3); transition: transform 0.15s, box-shadow 0.15s;"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(108,92,231,0.4)';"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 14px rgba(108,92,231,0.3)';">
                            💾 Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
