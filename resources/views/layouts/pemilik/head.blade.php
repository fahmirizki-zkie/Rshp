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
    @stack('styles')
</head>
<body>
