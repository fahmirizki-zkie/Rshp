<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Resepsionis - RSHP UNAIR')</title>
    <link rel="stylesheet" href="{{ asset('css/style_dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            position: relative;
            animation: slideDown 0.3s ease-out;
        }

        .alert-success {
            background-color: #d1fae5;
            border-left: 4px solid #10b981;
            color: #065f46;
        }

        .alert-success::before {
            content: "✓";
            display: inline-block;
            margin-right: 0.5rem;
            font-weight: bold;
        }

        .alert-error {
            background-color: #fee2e2;
            border-left: 4px solid #ef4444;
            color: #991b1b;
        }

        .alert-error::before {
            content: "✕";
            display: inline-block;
            margin-right: 0.5rem;
            font-weight: bold;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-10px);
            }
        }
    </style>
    @stack('styles')
</head>
<body>
