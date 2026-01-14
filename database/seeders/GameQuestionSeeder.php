<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameQuestionSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'sex-life', 'house', 'outside', 'all-life'
        ];
        $questions = [
            'sex-life' => [
                'What is your dream romantic night together?',
                'What is one thing you want to try in your sex life?',
                'Share a secret fantasy with your partner.',
                'What makes you feel most loved physically?',
                'What is your favorite way to be kissed?',
                'How do you like to be surprised in bed?',
                'What is your biggest turn-on?',
                'What is your favorite memory of us being intimate?',
                'What is something you want to learn about intimacy?',
                'How do you feel most connected during sex?',
                'What is your favorite compliment to receive?',
                'What is your favorite time for romance?',
                'What is your favorite place for intimacy?',
                'What is your favorite love song?',
                'What is your favorite scent on your partner?',
                'What is your favorite outfit for romance?',
                'What is your favorite way to cuddle?',
                'What is your favorite romantic movie?',
                'What is your favorite way to say "I love you"?',
                'What is your favorite way to relax together?',
                'What is your wildest sexual fantasy you want to try with your partner?',
                'Describe the most adventurous place you would like to make love.',
                'What is your favorite position and why?',
                'What is something you want your partner to do more often in bed?',
                'What is the naughtiest thought you’ve had about your partner?',
                'What is your favorite way to tease your partner?',
                'What is a secret desire you’ve never shared before?',
                'What is your favorite body part to kiss?',
                'What is the most memorable orgasm you’ve had together?',
                'What is your favorite way to initiate intimacy?',
            ],
            'house' => [
                'What does your dream home look like?',
                'Who is the better cook? Plan a dinner together.',
                'How will you decorate your bedroom?',
                'What household chore would you love to never do again?',
                'What is your favorite spot in the house?',
                'What is your favorite home activity?',
                'What is your favorite thing to do on weekends at home?',
                'What is your favorite home-cooked meal?',
                'What is your favorite way to relax at home?',
                'What is your favorite home tradition?',
                'What is your favorite color for walls?',
                'What is your favorite type of furniture?',
                'What is your favorite way to organize things?',
                'What is your favorite scent for the house?',
                'What is your favorite way to spend a rainy day?',
                'What is your favorite way to celebrate at home?',
                'What is your favorite home improvement idea?',
                'What is your favorite way to keep the house clean?',
                'What is your favorite way to make guests feel welcome?',
                'What is your favorite thing about our home?'
            ],
            'outside' => [
                'Where would you love to travel together?',
                'What is your favorite outdoor activity as a couple?',
                'Plan your perfect date outside the house.',
                'What adventure do you want to try together?',
                'What is your favorite place to visit?',
                'What is your favorite way to spend time outdoors?',
                'What is your favorite season for outdoor fun?',
                'What is your favorite outdoor sport?',
                'What is your favorite picnic spot?',
                'What is your favorite way to explore nature?',
                'What is your favorite outdoor event?',
                'What is your favorite way to relax outside?',
                'What is your favorite outdoor memory?',
                'What is your favorite way to celebrate outdoors?',
                'What is your favorite outdoor food?',
                'What is your favorite way to stay active?',
                'What is your favorite outdoor game?',
                'What is your favorite way to enjoy the sun?',
                'What is your favorite way to enjoy the stars?',
                'What is your favorite outdoor dream?'
            ],
            'all-life' => [
                'What is your biggest dream for your life together?',
                'How do you want to support each other’s growth?',
                'What values are most important in your marriage?',
                'Describe your perfect day as a couple.',
                'What is your favorite shared goal?',
                'What is your favorite way to solve problems together?',
                'What is your favorite way to celebrate milestones?',
                'What is your favorite way to show appreciation?',
                'What is your favorite way to communicate?',
                'What is your favorite way to spend holidays?',
                'What is your favorite way to handle stress?',
                'What is your favorite way to make decisions?',
                'What is your favorite way to support each other?',
                'What is your favorite way to grow together?',
                'What is your favorite way to dream together?',
                'What is your favorite way to plan for the future?',
                'What is your favorite way to keep romance alive?',
                'What is your favorite way to stay healthy together?',
                'What is your favorite way to inspire each other?',
                'What is your favorite thing about our relationship?'
            ]
        ];
        foreach ($categories as $cat) {
            foreach ($questions[$cat] as $i => $q) {
                $emojiMap = [
                    'sex-life' => ['💋','🔥','🌹','💞','💃','🛏️','😏','😍','📚','🤗','💬','🌙','🏩','🎶','🌸','👗','🤗','🎬','💌','🧘','🍷','🍫','😈','👄','🧲','💦','🫦','🫶','🫂','🫣','🫠'],
                    'house' => ['🏡','🍽️','🛏️','🧹','🛋️','🎮','🛀','🍲','🧘','🎉','🎨','🪑','🗂️','🌺','🌧️','🎊','🔨','🧼','🤝','🏠','💖'],
                    'outside' => ['✈️','🚴‍♂️','🌳','🏕️','🏖️','🌄','🍂','⚽','🧺','🌲','🎤','🧘','📸','🎉','🍔','🏃‍♂️','🎲','☀️','🌟','🌈'],
                    'all-life' => ['💑','🌱','💍','🌞','🎯','🧩','🎉','🙏','💬','🎄','😌','🧠','🤝','🌱','💭','📅','💘','🏃‍♀️','💡','💖','🫶'],
                ];
                $emoji = $emojiMap[$cat][$i % count($emojiMap[$cat])];
                DB::table('game_questions')->insert([
                    'category' => $cat,
                    'question' => $q,
                    'emoji' => $emoji,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
