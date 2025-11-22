<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title', 'Admin RSHP')</title>
	<link rel="stylesheet" href="{{ asset('css/style_dashboard.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style_data_pemilik_new.css') }}">
	<style>
		/* Alert Styles */
		.alert {
			padding: 1rem 1.5rem;
			margin: 1rem 0;
			border-radius: 8px;
			font-size: 0.95rem;
			box-shadow: 0 2px 8px rgba(0,0,0,0.1);
			animation: slideDown 0.3s ease-out;
			position: relative;
			display: flex;
			align-items: center;
			gap: 0.75rem;
		}

		.alert::before {
			content: '';
			width: 20px;
			height: 20px;
			flex-shrink: 0;
		}

		.alert-success {
			background: #d1fae5;
			color: #065f46;
			border-left: 4px solid #10b981;
		}

		.alert-success::before {
			content: '✓';
			display: flex;
			align-items: center;
			justify-content: center;
			background: #10b981;
			color: white;
			border-radius: 50%;
			font-weight: bold;
		}

		.alert-error {
			background: #fee2e2;
			color: #991b1b;
			border-left: 4px solid #ef4444;
		}

		.alert-error::before {
			content: '✕';
			display: flex;
			align-items: center;
			justify-content: center;
			background: #ef4444;
			color: white;
			border-radius: 50%;
			font-weight: bold;
		}

		.alert ul {
			margin: 0;
			padding-left: 1.25rem;
		}

		.alert li {
			margin: 0.25rem 0;
		}

		@keyframes slideDown {
			from {
				opacity: 0;
				transform: translateY(-20px);
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
				transform: translateY(-20px);
			}
		}

		.alert.fade-out {
			animation: slideUp 0.3s ease-out forwards;
		}
	</style>
	@stack('styles')
</head>
<body>
