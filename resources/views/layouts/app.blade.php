<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website Resmi Humas Polres Bangkalan">
    <title>@yield('title', 'Beranda') - Humas Polres Bangkalan</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .hover-card {
            transition: transform 0.2s ease-in-out;
        }
        .hover-card:hover {
            transform: translateY(-5px);
        }
        .object-fit-cover {
            object-fit: cover;
        }
    </style>
    
    @stack('styles')
</head>
<body class="antialiased">
    
    <!-- Navbar -->
    @include('layouts.navbar')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main> 
    
    <!-- Footer -->
    @include('layouts.footer')
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    @stack('scripts')
</body>
</html>