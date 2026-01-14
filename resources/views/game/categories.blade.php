@extends('layouts.game')

@section('content')
<div class="container py-5" style="min-height: 100vh;">
	<h1 class="text-center mb-4" style="font-family: 'Dancing Script', cursive; color: #c94f7c; font-size: 3rem;">Marriage Game for Couples</h1>
	<p class="text-center mb-5" style="font-size: 1.2rem; color: #555;">Welcome! Choose a category to start your journey together. Each theme is designed to spark love, laughter, and deep connection. Impress your partner and make memories!</p>
	<div class="row justify-content-center">
		<div class="col-md-3 mb-4">
			<a href="{{ route('game.category', ['category' => 'sex-life']) }}" class="card shadow-lg text-decoration-none category-sex-life" style="border-radius: 20px;">
				<div class="card-body text-center">
					<span style="font-size: 3rem;">💋</span>
					<h3 class="mt-3">Sex Life</h3>
					<p>Intimacy, passion, and playful questions to bring you closer.</p>
				</div>
			</a>
		</div>
		<div class="col-md-3 mb-4">
			<a href="{{ route('game.category', ['category' => 'house']) }}" class="card shadow-lg text-decoration-none category-house" style="border-radius: 20px;">
				<div class="card-body text-center">
					<span style="font-size: 3rem;">🏡</span>
					<h3 class="mt-3">House</h3>
					<p>Home life, dreams, and cozy challenges for your future together.</p>
				</div>
			</a>
		</div>
		<div class="col-md-3 mb-4">
			<a href="{{ route('game.category', ['category' => 'outside']) }}" class="card shadow-lg text-decoration-none category-outside" style="border-radius: 20px;">
				<div class="card-body text-center">
					<span style="font-size: 3rem;">🌳</span>
					<h3 class="mt-3">Outside</h3>
					<p>Adventures, travel, and fun activities beyond your home.</p>
				</div>
			</a>
		</div>
		<div class="col-md-3 mb-4">
			<a href="{{ route('game.category', ['category' => 'all-life']) }}" class="card shadow-lg text-decoration-none category-all-life" style="border-radius: 20px;">
				<div class="card-body text-center">
					<span style="font-size: 3rem;">💑</span>
					<h3 class="mt-3">All Life Things</h3>
					<p>Everything else: dreams, values, and life’s big questions.</p>
				</div>
			</a>
		</div>
		<style>
		.category-sex-life {
			background: linear-gradient(135deg, #7b1f1f 0%, #ff2e63 100%);
			color: #fff;
			box-shadow: 0 8px 32px #ff2e6388;
		}
		.category-sex-life h3, .category-sex-life p { color: #fff3f3; }
		.category-house {
			background: linear-gradient(135deg, #43cea2 0%, #ffe6e6 100%);
			color: #232526;
			box-shadow: 0 8px 32px #43cea288;
		}
		.category-house h3, .category-house p { color: #232526; }
		.category-outside {
			background: linear-gradient(135deg, #185a9d 0%, #e6ffe6 100%);
			color: #fff;
			box-shadow: 0 8px 32px #185a9d88;
		}
		.category-outside h3, .category-outside p { color: #185a9d; }
		.category-all-life {
			background: linear-gradient(135deg, #c9a34f 0%, #fffbe6 100%);
			color: #232526;
			box-shadow: 0 8px 32px #c9a34f88;
		}
		.category-all-life h3, .category-all-life p { color: #c9a34f; }
		.card.category-sex-life:hover {
			box-shadow: 0 0 48px 0 #ff2e63cc;
			transform: scale(1.08) rotate(-2deg);
		}
		.card.category-house:hover {
			box-shadow: 0 0 48px 0 #43cea2cc;
			transform: scale(1.08) rotate(2deg);
		}
		.card.category-outside:hover {
			box-shadow: 0 0 48px 0 #185a9dcc;
			transform: scale(1.08) rotate(-2deg);
		}
		.card.category-all-life:hover {
			box-shadow: 0 0 48px 0 #c9a34fcc;
			transform: scale(1.08) rotate(2deg);
		}
		</style>
	</div>
</div>
@endsection
