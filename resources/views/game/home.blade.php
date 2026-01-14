@extends('layouts.game')

@section('content')


<div class="container py-5 position-relative" style="min-height: 100vh; overflow:hidden; display:flex; align-items:center; justify-content:center;">
	<!-- Animated Falling Hearts Background -->
	<div id="falling-hearts-bg" style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:0;pointer-events:none;"></div>
	<script>
	document.addEventListener('DOMContentLoaded', function() {
		const colors = ['#232526', '#b0b0b0', '#185a9d', '#ffffff', '#ff69b4'];
		const heartCount = 36;
		const container = document.getElementById('falling-hearts-bg');
		for (let i = 0; i < heartCount; i++) {
			const heart = document.createElement('div');
			const color = colors[Math.floor(Math.random()*colors.length)];
			heart.innerHTML = Math.random() > 0.7 ? '💋' : '❤';
			heart.style.position = 'absolute';
			heart.style.left = Math.random()*100 + 'vw';
			heart.style.top = (Math.random()*-20) + 'vh';
			heart.style.fontSize = (Math.random()*2.5+2) + 'rem';
			heart.style.color = color;
			heart.style.opacity = Math.random()*0.5+0.5;
			heart.style.filter = 'drop-shadow(0 2px 12px #0003)';
			heart.style.animation = `fallingHeart ${Math.random()*4+7}s linear infinite`;
			heart.style.animationDelay = (Math.random()*8) + 's';
			container.appendChild(heart);
		}
	});
	</script>
	<style>
	@keyframes fallingHeart {
		0% { transform: translateY(0) rotate(-10deg) scale(1); }
		80% { transform: translateY(80vh) rotate(10deg) scale(1.1); }
		100% { transform: translateY(100vh) rotate(-10deg) scale(1.2); opacity:0.1; }
	}
	.love-3d-row {
		display: flex;
		flex-wrap: wrap;
		gap: 2.5rem;
		justify-content: center;
		align-items: stretch;
		z-index: 1;
		width: 100%;
		max-width: 1200px;
	}
	.love-3d-card {
		flex: 1 1 320px;
		min-width: 320px;
		max-width: 370px;
		background: linear-gradient(135deg, #fff 60%, #ff69b4 100%);
		border-radius: 32px;
		box-shadow: 0 8px 48px 0 #ff69b488, 0 2px 16px 0 #23252622, 0 8px 32px #185a9d22;
		padding: 2.2rem 1.7rem 2rem 1.7rem;
		margin: 1rem 0;
		position: relative;
		text-align: center;
		transform-style: preserve-3d;
		transition: transform 0.5s cubic-bezier(.4,2,.6,1), box-shadow 0.5s;
		animation: popIn 1.2s;
	}
	.love-3d-card:hover {
		transform: rotateY(8deg) scale(1.04) translateY(-8px);
		box-shadow: 0 16px 64px 0 #ff69b4cc, 0 4px 24px 0 #23252644;
	}
	.love-3d-card .icon {
		font-size: 2.8rem;
		margin-bottom: 1.1rem;
		animation: popIn 1.5s;
		filter: drop-shadow(0 2px 8px #ff69b488);
	}
	.love-3d-card h2 {
		font-family: 'Dancing Script', cursive;
		color: #ff69b4;
		font-size: 2.3rem;
		margin-bottom: 0.7rem;
		text-shadow: 0 2px 8px #ff69b488, 0 2px 8px #23252622;
		letter-spacing: 1px;
		animation: fadeInDown 1.2s;
	}
	.love-3d-card p {
		font-size: 1.2rem;
		color: #232526;
		margin-bottom: 1.2rem;
		line-height: 1.6;
		font-weight: 500;
		animation: fadeInUp 1.2s;
	}
	.love-3d-card .img-hot {
		max-width: 220px;
		border-radius: 18px;
		box-shadow: 0 4px 32px #ff69b488, 0 2px 8px #23252622;
		margin: 1.2rem auto 1.2rem auto;
		display: block;
		animation: popIn 1.5s;
	}
	.love-3d-card .btn {
		border-radius: 30px;
		font-size: 1.1rem;
		background: linear-gradient(90deg, #232526 0%, #ff69b4 100%);
		border: none;
		color: #fff;
		font-weight: bold;
		box-shadow: 0 2px 8px #23252622;
		transition: background 0.3s, box-shadow 0.3s;
		padding: 0.7rem 2rem;
		animation: fadeInUp 1.5s;
	}
	.love-3d-card .btn:hover {
		background: linear-gradient(90deg, #ff69b4 0%, #232526 100%);
		color: #fff;
		box-shadow: 0 4px 16px #ff69b488;
	}
	@media (max-width: 900px) {
		.love-3d-row { flex-direction: column; align-items: center; }
	}
	</style>
	<div class="love-3d-row">
		<div class="love-3d-card">
			<div class="icon">💖</div>
			<h2>My Heart Beats for You</h2>
			<p>Every moment with you is a new adventure. You are the reason my heart races and my soul smiles. I love you more than words can say.</p>
		</div>
		<div class="love-3d-card">
			<div class="icon">🔥</div>
			<h2>Passion & Desire</h2>
			<p>Your touch sets my soul on fire. You are my passion, my desire, my everything. Together, we are unstoppable and hot!</p>
		</div>
		<div class="love-3d-card">
			<div class="icon">💋</div>
			<h2>Kisses & Sweetness</h2>
			<p>Your kisses are my favorite addiction. Each one is sweeter than the last. I crave your lips and your love every day.</p>
		</div>
		<div class="love-3d-card">
			<div class="icon">👩‍❤️‍👨</div>
			<h2>Forever Together</h2>
			<p>With you, forever is not long enough. I promise to stand by your side, to love, cherish, and adore you for all our days.</p>
			<img src="/images/2da69b56-553c-4527-80c4-a577603afa65.jpg" alt="Couple" class="img-hot">
			<a href="{{ route('game.categories') }}" class="btn btn-lg mt-2">Start the Game</a>
		</div>
	</div>
</div>
@endsection
