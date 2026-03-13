<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — EduShop</title>
    
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary: #6C5CE7;
            --primary-dark: #5A4BD1;
            --primary-light: #A29BFE;
            --secondary: #00CEC9;
            --accent: #FD79A8;
            --dark: #2D3436;
            --darker: #1E272E;
            --light: #F8F9FD;
            --gray: #636E72;
            --card-shadow: 0 4px 20px rgba(108, 92, 231, 0.08);
            --card-hover-shadow: 0 12px 40px rgba(108, 92, 231, 0.18);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--light);
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ─── Navbar ─── */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(108, 92, 231, 0.08);
            padding: 0.8rem 0;
            transition: all 0.3s ease;
        }

        .navbar-custom .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .navbar-custom .nav-link {
            font-weight: 500;
            color: var(--dark) !important;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.25s ease;
            font-size: 0.95rem;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: var(--primary) !important;
            background: rgba(108, 92, 231, 0.08);
        }

        .navbar-custom .nav-link.active {
            font-weight: 600;
        }

        /* ─── Main Content ─── */
        main {
            flex: 1;
        }

        /* ─── Page Header ─── */
        .page-header {
            padding: 2.5rem 0 1.5rem;
        }

        .page-header h1 {
            font-weight: 800;
            font-size: 2.2rem;
            color: var(--dark);
            letter-spacing: -1px;
        }

        .page-header p {
            color: var(--gray);
            font-size: 1.05rem;
            margin-top: 0.3rem;
        }

        /* ─── Product Card ─── */
        .product-card {
            background: #fff;
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--card-hover-shadow);
        }

        .product-card .card-img-wrapper {
            position: relative;
            overflow: hidden;
            height: 200px;
            background: linear-gradient(135deg, #e8e4f8, #d4e8f7);
        }

        .product-card .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .product-card:hover .card-img-wrapper img {
            transform: scale(1.08);
        }

        .product-card .category-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            color: var(--primary);
            font-size: 0.72rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .product-card .card-body {
            padding: 1.3rem 1.4rem 1.4rem;
            display: flex;
            flex-direction: column;
        }

        .product-card .card-title {
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--dark);
            margin-bottom: 0.4rem;
            letter-spacing: -0.3px;
        }

        .product-card .card-desc {
            font-size: 0.85rem;
            color: var(--gray);
            line-height: 1.5;
            margin-bottom: 0.8rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-card .card-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            padding-top: 0.8rem;
            border-top: 1px solid rgba(0,0,0,0.06);
        }

        .product-card .stock-info {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 0.82rem;
            color: var(--secondary);
            font-weight: 600;
        }

        .product-card .stock-info.low {
            color: var(--accent);
        }

        .product-card .btn-detail {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            color: #fff;
            font-size: 0.82rem;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 10px;
            transition: all 0.25s ease;
            text-decoration: none;
        }

        .product-card .btn-detail:hover {
            background: linear-gradient(135deg, var(--primary-dark), #4834d4);
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(108, 92, 231, 0.35);
            color: #fff;
        }

        /* ─── Pagination ─── */
        .pagination-wrapper {
            padding: 2rem 0 1rem;
        }

        .pagination {
            gap: 6px;
        }

        .pagination .page-item .page-link {
            border: none;
            border-radius: 10px;
            padding: 8px 16px;
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--gray);
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: all 0.25s ease;
        }

        .pagination .page-item .page-link:hover {
            color: var(--primary);
            background: rgba(108,92,231,0.08);
            transform: translateY(-1px);
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            box-shadow: 0 4px 14px rgba(108,92,231,0.3);
        }

        .pagination .page-item.disabled .page-link {
            color: #ccc;
            background: #f5f5f5;
        }

        .pagination-info {
            text-align: center;
            font-size: 0.85rem;
            color: var(--gray);
            margin-top: 0.8rem;
        }

        /* ─── Footer ─── */
        .footer-custom {
            background: var(--darker);
            color: rgba(255,255,255,0.7);
            padding: 3rem 0 1.5rem;
            margin-top: auto;
        }

        .footer-custom h5 {
            color: #fff;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 0.8rem;
        }

        .footer-custom p {
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .footer-custom .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            margin-right: 8px;
            transition: all 0.25s ease;
            font-size: 1rem;
        }

        .footer-custom .social-links a:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-2px);
        }

        .footer-custom hr {
            border-color: rgba(255,255,255,0.1);
            margin: 1.5rem 0;
        }

        .footer-custom .copyright {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.4);
        }

        /* ─── Placeholder Image ─── */
        .placeholder-img {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
            font-size: 2.5rem;
            color: rgba(108,92,231,0.3);
        }

        /* ─── Animations ─── */
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-grid .col-12:nth-child(1) .fade-in-up { animation-delay: 0.05s; }
        .product-grid .col-12:nth-child(2) .fade-in-up { animation-delay: 0.1s; }
        .product-grid .col-12:nth-child(3) .fade-in-up { animation-delay: 0.15s; }
        .product-grid .col-12:nth-child(4) .fade-in-up { animation-delay: 0.2s; }
        .product-grid .col-12:nth-child(5) .fade-in-up { animation-delay: 0.25s; }
        .product-grid .col-12:nth-child(6) .fade-in-up { animation-delay: 0.3s; }
    </style>

    @stack('css')
</head>
<body>
    @include('components.navbar')

    <main class="container my-4">
        @yield('content')
    </main>

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    @stack('js')
</body>
</html>