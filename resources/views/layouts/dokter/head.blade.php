<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title', 'Dokter RSHP')</title>
	<link rel="stylesheet" href="{{ asset('css/style_dashboard.css') }}">
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

		/* Button Styles */
		.btn-view, .btn, .btn-primary, .btn-secondary, .btn-danger {
			display: inline-block;
			padding: 0.5rem 1rem;
			text-decoration: none;
			border-radius: 6px;
			font-size: 0.9rem;
			font-weight: 500;
			transition: all 0.3s ease;
			border: none;
			cursor: pointer;
			text-align: center;
		}

		.btn-view, .btn-primary {
			background: linear-gradient(135deg, #4eb1cf 0%, #265295 100%);
			color: white;
			box-shadow: 0 2px 8px rgba(78, 177, 207, 0.3);
		}

		.btn-view:hover, .btn-primary:hover {
			background: linear-gradient(135deg, #3a9eb8 0%, #1e3f72 100%);
			box-shadow: 0 4px 12px rgba(78, 177, 207, 0.4);
			transform: translateY(-1px);
		}

		.btn-secondary {
			background: #6b7280;
			color: white;
		}

		.btn-secondary:hover {
			background: #4b5563;
			transform: translateY(-1px);
		}

		.btn-danger {
			background: #ef4444;
			color: white;
		}

		.btn-danger:hover {
			background: #dc2626;
			transform: translateY(-1px);
		}
	</style>
	@stack('styles')
</head>
<body>
