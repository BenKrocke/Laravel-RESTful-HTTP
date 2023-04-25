<?php

namespace Database\Seeders;

use App\Models\SpellType;
use Illuminate\Database\Seeder;

class SpellTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SpellType::create([
            'type' => 'Water'
        ]);
        SpellType::create([
            'type' => 'Fire'
        ]);
        SpellType::create([
            'type' => 'Earth'
        ]);
        SpellType::create([
            'type' => 'Air'
        ]);
    }
}
