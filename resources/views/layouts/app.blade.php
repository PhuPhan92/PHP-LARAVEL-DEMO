<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            color: #333;
            padding: 12px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .nav-link:hover {
            background-color: #81abd4;
            color: #0d6efd;
        }

        .nav-link.active {
            background-color: #0d6efd;
            color: white !important;
            font-weight: 500;
        }

        .nav-link i {
            font-size: 1.1rem;
            margin-right: 10px;
            width: 32px;
            text-align: center;
        }
        .sidebar {
            background-color: #2c3e50;

        }
        .nav-link {
            color: #ecf0f1 !important;
        }
        .row-with-fixed-height {
            display: flex;
            min-height: 860px; /* Chiều cao tối thiểu */
        }
         .main-content {
            height: 100%;
            overflow-y: auto;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="bg-white py-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <img src="{{ asset('images/banner.jpg') }}" alt="Banner" class="img-fluid" style="height: 120px; ">
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row row-with-fixed-height">
            <!-- Sidebar -->
            <nav class="col-md-2  sidebar p-0">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('') ? 'active' : '' }}" href="/">
                                <i class="bi bi-house me-2"></i> Trang chủ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('productivities*') ? 'active' : '' }}" href="/productivities">
                                <i class="bi bi-box-seam me-2"></i> Năng suất
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('report*') ? 'active' : '' }}" href="/report">
                                <i class="bi bi-file-earmark-bar-graph me-2"></i> Báo cáo
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto p-4" style="background-color: #e7e5e5">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class=" text-white py-3 mt-auto">
        <div class="container-fluid " style="background-color: #2194d2">
            <div class="row ">
                <div class="col-4 text-left mt-2">
                    <h3 class="mb-1">CÔNG TY CỔ PHẦN DỆT MAY HUẾ</h3>
                    <h6 class="mb-0  mt-1">Địa chỉ: 122 Dương Thiệu Tước - P. Thủy Dương - TX Hương Thủy - TP. Huế </h6>
                    <h6 class="mb-0  mt-1">ĐT: 0234.3.864.337</h6>
                    <p></p>
                    <p></p>
                </div>

                 <div class="col-8 text-center">

                    <h4 class="mb-0  mt-1">THỊNH VƯỢNG KHÁCH HÀNG - PHỒN VINH CÔNG TY - HÀI HÒA LỢI ÍCH</h5>
                    <p></p>
                    <p></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    @stack('scripts')
</body>
</html>