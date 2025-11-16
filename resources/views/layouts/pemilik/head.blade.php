<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pemilik - RS Hewan UNAIR')</title>
    
    <!-- CSS Styling External -->
    <link rel="stylesheet" href="{{ asset('css/style_dashboard_pemilik.css') }}">
    
    <!-- Font Google (Inter) untuk typography modern -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome untuk icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Hover effect untuk tombol logout */
        .nav-menu form button {
            margin-top: 6.3px;
            transition: all 0.3s ease;
        }
        
        .nav-menu form button:hover {
            color: #ef4444 !important;
            transform: scale(1.05);
        }
        
        .nav-menu form button:hover i {
            color: #ef4444;
        }
    </style>
    
    @stack('styles')
</head>
<body>
