<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $langs = [
            [
                'language_code' => 'hy',
                'icon' => 'quiz-assets/images/flags/armenia.svg'
            ],
            [
                'language_code' => 'ru',
                'icon' => 'quiz-assets/images/flags/russia.svg'
            ],
            [
                'language_code' => 'en',
                'icon' => 'quiz-assets/images/flags/usa.svg'
            ],
        ];
        foreach ($langs as $l) {
            Language::create($l);
        }
        return;
    }
}
