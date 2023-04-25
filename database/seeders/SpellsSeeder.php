<?php

namespace Database\Seeders;

use App\Models\Spell;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SpellType;

class SpellsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Spell::create([
            'name' => 'Fireball',
            'damage' => 1,
            'spell_type_id' => SpellType::where('type', 'Fire')->first()->id
        ]);
        Spell::create([
            'name' => 'Splash',
            'damage' => 1,
            'spell_type_id' => SpellType::where('type', 'Water')->first()->id
        ]);
        Spell::create([
            'name' => 'Sandblast',
            'damage' => 1,
            'spell_type_id' => SpellType::where('type', 'Earth')->first()->id
        ]);
        Spell::create([
            'name' => 'Gust of wind',
            'damage' => 1,
            'spell_type_id' => SpellType::where('type', 'Air')->first()->id
        ]);
    }
}
