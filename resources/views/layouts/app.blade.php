<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MPASI Si Kecil')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --brand-purple: #6A1B9A;
            --brand-purple-hover: #4A148C;
            --brand-purple-light: #F3E5F5;
            --brand-yellow: #FBC02D;
            --brand-yellow-hover: #F57F17;
            --brand-yellow-light: #FFFDE7;
            --dark-navy: #1A237E;
            --bg-gray: #F8F9FA;
            --border-color: #E0E0E0;
            --radius-lg: 16px;
            --radius-md: 10px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-gray);
            color: #212121;
        }

        .bg-brand-purple { background-color: var(--brand-purple) !important; color: #fff; }
        .text-brand-purple { color: var(--brand-purple) !important; }
        .bg-brand-yellow { background-color: var(--brand-yellow) !important; color: #000; }
        .text-brand-yellow { color: var(--brand-yellow) !important; }
        .btn-brand-purple { background-color: var(--brand-purple); color: #fff; border: none; }
        .btn-brand-purple:hover { background-color: var(--brand-purple-hover); color: #fff; }
        .btn-brand-yellow { background-color: var(--brand-yellow); color: #000; border: none; font-weight: 600; }
        .btn-brand-yellow:hover { background-color: var(--brand-yellow-hover); color: #000; }
        .border-purple-200 { border-color: #E1BEE7 !important; }
        .bg-purple-light { background-color: var(--brand-purple-light) !important; }

        .navbar-custom {
            background-color: #ffffff;
            border-bottom: 2px solid var(--border-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        }
        .nav-link.active {
            color: var(--brand-purple) !important;
            font-weight: 700;
        }

        .card-custom {
            background: #ffffff;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            transition: all 0.2s ease-in-out;
        }
        .card-custom:hover {
            box-shadow: 0 8px 25px rgba(106, 27, 154, 0.08);
        }

        .hero-banner {
            background: linear-gradient(135deg, var(--brand-purple) 0%, #4A148C 100%);
            color: #ffffff;
            border-radius: var(--radius-lg);
            padding: 30px;
        }

        .role-sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--brand-purple);
            color: #ffffff;
            flex-shrink: 0;
        }
        .role-sidebar .nav-link {
            color: #E1BEE7;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.88rem;
        }
        .role-sidebar .nav-link.active, .role-sidebar .nav-link:hover {
            background: var(--brand-yellow);
            color: #000000;
            font-weight: 700;
        }

        #loading-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(255,255,255,0.92);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .cursor-pointer { cursor: pointer; }
        .fs-7 { font-size: 0.85rem; }
        .fs-8 { font-size: 0.75rem; }
        .max-w-1600 { max-width: 1600px; }
        .max-w-1000 { max-width: 1000px; }
        .max-w-600 { max-width: 600px; }
        .max-w-500 { max-width: 500px; }

        /* Mobile Bottom Navbar (Tools Bawah HP) */
        .mobile-bottom-nav {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-top: 1px solid rgba(106, 27, 154, 0.12) !important;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08) !important;
            height: 64px;
        }

        .mobile-nav-item {
            color: #757575;
            transition: all 0.2s ease-in-out;
            flex: 1;
            max-width: 72px;
        }

        .mobile-nav-item .nav-icon {
            font-size: 1.2rem;
            transition: transform 0.2s ease;
        }

        .mobile-nav-item .nav-label {
            font-size: 0.68rem;
            font-weight: 500;
            line-height: 1;
        }

        .mobile-nav-item.active {
            color: var(--brand-purple) !important;
        }

        .mobile-nav-item.active .nav-icon {
            transform: translateY(-2px) scale(1.12);
            color: var(--brand-purple);
        }

        .mobile-nav-item.active .nav-label {
            font-weight: 700;
            color: var(--brand-purple);
        }

        .fs-9 {
            font-size: 0.62rem;
            padding: 0.2em 0.4em;
        }

        @media (max-width: 767.98px) {
            .role-portal-page {
                padding-bottom: 75px !important;
            }
        }
    </style>
</head>
<body>
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
