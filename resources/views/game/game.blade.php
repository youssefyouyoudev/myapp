@extends('layouts.game')

@section('content')
@php
use Illuminate\Support\Facades\DB;
$category = request()->get('category', 'sex-life');
$player = request()->get('player', '');
$questions = DB::table('game_questions')->where('category', $category)->limit(20)->get();
$categoryThemes = [
    'sex-life' => [
        'bg' => 'linear-gradient(120deg, #7b1f1f 0%, #ff2e63 100%)',
        'card' => 'background: linear-gradient(135deg, #fff 60%, #ff2e63 100%); color: #7b1f1f;',
    ],
    'house' => [
        'bg' => 'linear-gradient(120deg, #43cea2 0%, #ffe6e6 100%)',
        'card' => 'background: linear-gradient(135deg, #fff 60%, #43cea2 100%); color: #232526;',
    ],
    'outside' => [
        'bg' => 'linear-gradient(120deg, #185a9d 0%, #e6ffe6 100%)',
        'card' => 'background: linear-gradient(135deg, #fff 60%, #185a9d 100%); color: #185a9d;',
    ],
    'all-life' => [
        'bg' => 'linear-gradient(120deg, #c9a34f 0%, #fffbe6 100%)',
        'card' => 'background: linear-gradient(135deg, #fff 60%, #c9a34f 100%); color: #c9a34f;',
    ],
];
$theme = $categoryThemes[$category] ?? $categoryThemes['sex-life'];
@endphp

<div class="container py-5" style="min-height: 100vh; background: {{ $theme['bg'] }}; transition: background 0.5s;">
    <h2 class="text-center mb-4" style="font-family: 'Dancing Script', cursive; color: #c94f7c; font-size: 2.5rem;">
        @switch($category)
            @case('sex-life') Sex Life 💋 @break
            @case('house') House 🏡 @break
            @case('outside') Outside 🌳 @break
            @case('all-life') All Life Things 💑 @break
            @default Sex Life 💋
        @endswitch
    </h2>
    <form method="POST" action="{{ route('game.result') }}" class="row justify-content-center">
        @csrf
        <input type="hidden" name="category" value="{{ $category }}">
        <div class="col-md-8 mb-4">
            <div class="card shadow-lg" style="border-radius: 20px; background: #fffbe6;">
                <div class="card-body text-center">
                    <label for="player" style="font-size: 1.3rem; color: #c94f7c;">Who are you?</label>
                    <input type="text" name="player" id="player" class="form-control form-control-lg mt-2" placeholder="Enter your name (e.g. Hiba, Youssef)" value="{{ $player }}" required style="max-width: 320px; margin: 0 auto;">
                </div>
            </div>
        </div>
        @foreach($questions as $idx => $item)
        <div class="col-md-8 mb-4">
            <div class="card shadow-lg" style="border-radius: 20px; {{ $theme['card'] }}">
                <div class="card-body text-center">
                    <span style="font-size: 2.5rem;">{{ $item->emoji }}</span>
                    <p class="mt-3" style="font-size: 1.3rem;">{{ $item->question }}</p>
                    <textarea name="answers[{{ $idx }}]" class="form-control form-control-lg mt-3" rows="2" placeholder="Your answer..." required></textarea>
                </div>
            </div>
        </div>
        @endforeach
        <div class="text-center mb-5">
            <button type="submit" class="btn btn-lg btn-primary" style="border-radius: 30px; min-width: 200px;">Show Results</button>
        </div>
    </form>
    <div class="text-center mt-5">
        <a href="{{ route('game.categories') }}" class="btn btn-lg btn-outline-primary" style="border-radius: 30px;">Back to Categories</a>
    </div>
</div>
@endsection
