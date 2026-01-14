<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Marriage Game for Hiba & Youssef</title>
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script:700|Montserrat:400,700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	@php
	$category = $category ?? request()->get('category', request()->post('category', 'sex-life'));
	$categoryThemes = [
		'sex-life' => [
			'bg' => 'linear-gradient(120deg, #7b1f1f 0%, #ff2e63 100%)',
			'nav' => 'linear-gradient(90deg, #7b1f1f 0%, #ff2e63 100%)',
			'card' => 'linear-gradient(135deg, #fff 60%, #ff2e63 100%)',
		],
		'house' => [
			'bg' => 'linear-gradient(120deg, #43cea2 0%, #ffe6e6 100%)',
			'nav' => 'linear-gradient(90deg, #43cea2 0%, #ffe6e6 100%)',
			'card' => 'linear-gradient(135deg, #fff 60%, #43cea2 100%)',
		],
		'outside' => [
			'bg' => 'linear-gradient(120deg, #185a9d 0%, #e6ffe6 100%)',
			'nav' => 'linear-gradient(90deg, #185a9d 0%, #e6ffe6 100%)',
			'card' => 'linear-gradient(135deg, #fff 60%, #185a9d 100%)',
		],
		'all-life' => [
			'bg' => 'linear-gradient(120deg, #c9a34f 0%, #fffbe6 100%)',
			'nav' => 'linear-gradient(90deg, #c9a34f 0%, #fffbe6 100%)',
			'card' => 'linear-gradient(135deg, #fff 60%, #c9a34f 100%)',
		],
	];
	$theme = $categoryThemes[$category] ?? $categoryThemes['sex-life'];
	@endphp
	<style>
		body {
			font-family: 'Montserrat', sans-serif;
			background: {{ $theme['bg'] }};
			min-height: 100vh;
			overflow-x: hidden;
			transition: background 0.5s;
		}
		.navbar {
			background: {{ $theme['nav'] }};
			box-shadow: 0 4px 24px rgba(200,30,60,0.15);
			animation: fadeInDown 1s;
		}
		.navbar-brand {
			font-family: 'Dancing Script', cursive;
			font-size: 2.5rem;
			color: #fff;
			letter-spacing: 2px;
			text-shadow: 2px 2px 12px #ff2e6344;
			animation: popIn 1.2s;
		}
		.card {
			border: none;
			background: {{ $theme['card'] }};
			box-shadow: 0 8px 48px 0 #ff2e6388, 0 2px 16px 0 #7b1f1f22;
			transition: transform 0.3s cubic-bezier(.4,2,.6,1), box-shadow 0.3s;
		}
		.card:hover {
			transform: scale(1.04) rotate(-2deg);
			box-shadow: 0 16px 64px 0 #ff2e63cc, 0 4px 24px 0 #7b1f1f44;
		}
		.btn-primary, .btn-outline-primary {
			background: {{ $theme['nav'] }};
			border: none;
			color: #fff;
			font-weight: bold;
			box-shadow: 0 2px 8px #7b1f1f22;
			transition: background 0.3s, box-shadow 0.3s;
		}
		.btn-primary:hover, .btn-outline-primary:hover {
			background: linear-gradient(90deg, #ff2e63 0%, #7b1f1f 100%);
			color: #fff;
			box-shadow: 0 4px 16px #ff2e6344;
		}
		@keyframes fadeInDown {
			from { opacity: 0; transform: translateY(-40px); }
			to { opacity: 1; transform: translateY(0); }
		}
		@keyframes fadeInUp {
			from { opacity: 0; transform: translateY(40px); }
			to { opacity: 1; transform: translateY(0); }
		}
		@keyframes popIn {
			0% { opacity: 0; transform: scale(0.7); }
			80% { opacity: 1; transform: scale(1.1); }
			100% { opacity: 1; transform: scale(1); }
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg">
		<div class="container">
			<a class="navbar-brand" href="{{ route('game.home') }}">💖 Hiba & Youssef 💖</a>
		</div>
	</nav>
	<main>
		@yield('content')
	</main>
	<!-- Footer removed for a cleaner, more immersive experience -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
