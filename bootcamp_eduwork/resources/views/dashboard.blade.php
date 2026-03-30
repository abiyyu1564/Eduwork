<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Welcome Card --}}
            <div style="
                background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
                border-radius: 20px;
                padding: 32px 36px;
                margin-bottom: 32px;
                box-shadow: 0 8px 32px rgba(108, 92, 231, 0.25);
                color: #fff;
            ">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                    <span style="font-size: 2rem;">👋</span>
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin: 0;">
                        Selamat datang, {{ Auth::user()->name }}!
                    </h3>
                </div>
                <p style="margin: 0; opacity: 0.85; font-size: 0.95rem;">
                    Berikut ringkasan informasi toko kamu saat ini.
                </p>
            </div>

            {{-- Summary Cards --}}
            <div style="
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                gap: 24px;
            ">
                {{-- Jumlah Produk --}}
                <div class="dashboard-card" style="
                    background: #fff;
                    border-radius: 18px;
                    padding: 28px 32px;
                    box-shadow: 0 4px 24px rgba(108, 92, 231, 0.08);
                    border: 1px solid rgba(108, 92, 231, 0.08);
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    cursor: default;
                    position: relative;
                    overflow: hidden;
                ">
                    <div style="
                        position: absolute;
                        top: -20px;
                        right: -20px;
                        width: 100px;
                        height: 100px;
                        background: linear-gradient(135deg, rgba(108, 92, 231, 0.08) 0%, rgba(108, 92, 231, 0.02) 100%);
                        border-radius: 50%;
                    "></div>
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="
                            width: 56px;
                            height: 56px;
                            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
                            border-radius: 16px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 1.5rem;
                            box-shadow: 0 4px 12px rgba(108, 92, 231, 0.3);
                        ">📦</div>
                        <div>
                            <p style="margin: 0; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: #8C8C8C;">
                                Jumlah Produk
                            </p>
                            <p style="margin: 4px 0 0; font-size: 2rem; font-weight: 800; color: var(--dark); line-height: 1;">
                                {{ number_format($productCount) }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Jumlah Kategori --}}
                <div class="dashboard-card" style="
                    background: #fff;
                    border-radius: 18px;
                    padding: 28px 32px;
                    box-shadow: 0 4px 24px rgba(253, 121, 168, 0.08);
                    border: 1px solid rgba(253, 121, 168, 0.08);
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    cursor: default;
                    position: relative;
                    overflow: hidden;
                ">
                    <div style="
                        position: absolute;
                        top: -20px;
                        right: -20px;
                        width: 100px;
                        height: 100px;
                        background: linear-gradient(135deg, rgba(253, 121, 168, 0.08) 0%, rgba(253, 121, 168, 0.02) 100%);
                        border-radius: 50%;
                    "></div>
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="
                            width: 56px;
                            height: 56px;
                            background: linear-gradient(135deg, var(--accent) 0%, #fab1c4 100%);
                            border-radius: 16px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 1.5rem;
                            box-shadow: 0 4px 12px rgba(253, 121, 168, 0.3);
                        ">🏷️</div>
                        <div>
                            <p style="margin: 0; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: #8C8C8C;">
                                Jumlah Kategori
                            </p>
                            <p style="margin: 4px 0 0; font-size: 2rem; font-weight: 800; color: var(--dark); line-height: 1;">
                                {{ number_format($categoryCount) }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Jumlah Klik --}}
                <div class="dashboard-card" style="
                    background: #fff;
                    border-radius: 18px;
                    padding: 28px 32px;
                    box-shadow: 0 4px 24px rgba(0, 206, 201, 0.08);
                    border: 1px solid rgba(0, 206, 201, 0.08);
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    cursor: default;
                    position: relative;
                    overflow: hidden;
                ">
                    <div style="
                        position: absolute;
                        top: -20px;
                        right: -20px;
                        width: 100px;
                        height: 100px;
                        background: linear-gradient(135deg, rgba(0, 206, 201, 0.08) 0%, rgba(0, 206, 201, 0.02) 100%);
                        border-radius: 50%;
                    "></div>
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="
                            width: 56px;
                            height: 56px;
                            background: linear-gradient(135deg, #00CEC9 0%, #55EFC4 100%);
                            border-radius: 16px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 1.5rem;
                            box-shadow: 0 4px 12px rgba(0, 206, 201, 0.3);
                        ">👆</div>
                        <div>
                            <p style="margin: 0; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: #8C8C8C;">
                                Jumlah Klik Produk
                            </p>
                            <p style="margin: 4px 0 0; font-size: 2rem; font-weight: 800; color: var(--dark); line-height: 1;">
                                {{ number_format($totalClicks) }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 32px rgba(108, 92, 231, 0.15) !important;
        }
    </style>
</x-app-layout>
