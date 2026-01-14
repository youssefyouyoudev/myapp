@extends('layouts.game')

@section('content')
@php
use Illuminate\Support\Facades\DB;
$category = request()->get('category', request()->post('category', 'sex-life'));
$player = request()->get('player', request()->post('player', ''));
$answers = request()->post('answers', []);
$questions = DB::table('game_questions')->where('category', $category)->limit(20)->get();
if(request()->isMethod('post') && $player && count($answers)) {
    foreach($questions as $idx => $q) {
        $answerText = $answers[$idx] ?? null;
        if($answerText) {
            DB::table('game_answers')->insert([
                'question_id' => $q->id,
                'player_name' => $player,
                'answer' => $answerText,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
@endphp
<div class="container py-5" style="min-height: 80vh;">
    <h2 class="text-center mb-4" style="font-family: 'Dancing Script', cursive; color: #c94f7c; font-size: 2.5rem;">Game Results</h2>
    <div class="card shadow-lg mx-auto mb-4" style="max-width: 700px; border-radius: 24px;">
        <div class="card-body">
            <h4 class="text-center mb-3" style="color: #c94f7c; font-family: 'Dancing Script', cursive; font-size: 2rem;">Player: <span style="color:#185a9d">{{ $player }}</span></h4>
            <ul class="list-group list-group-flush">
                @foreach($questions as $idx => $item)
                <li class="list-group-item" style="background:rgba(255,255,255,0.95); border-radius:16px; margin-bottom:1rem; box-shadow:0 2px 8px #23252622;">
                    <div class="d-flex align-items-center mb-2">
                        <span style="font-size:2rem; margin-right:1rem;">@php echo $item->id % 4 == 0 ? '💋' : ($item->id % 4 == 1 ? '🔥' : ($item->id % 4 == 2 ? '🌹' : '💞')); @endphp</span>
                        <strong style="font-size:1.1rem; color:#c94f7c;">{{ $item->question }}</strong>
                    </div>
                    <div style="font-size:1.2rem; color:#232526; margin-left:2.5rem;">
                        <span style="font-weight:500;">Answer:</span> {{ $answers[$idx] ?? 'No answer' }}
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('game.home') }}" class="btn btn-lg btn-outline-primary" style="border-radius: 30px;">Back to Home</a>
    </div>
</div>
@endsection
