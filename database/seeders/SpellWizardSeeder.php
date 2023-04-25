<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Wizard;
use App\Models\Spell;

class SpellWizardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('spell_wizard')->insert([
            'wizard_id' => Wizard::where('name', 'Balthazar')->first()->id,
            'spell_id' => Spell::where('name', 'Fireball')->first()->id
        ]);
        DB::table('spell_wizard')->insert([
            'wizard_id' => Wizard::where('name', 'Balthazar')->first()->id,
            'spell_id' => Spell::where('name', 'Splash')->first()->id
        ]);
        DB::table('spell_wizard')->insert([
            'wizard_id' => Wizard::where('name', 'Gandalf')->first()->id,
            'spell_id' => Spell::where('name', 'Sandblast')->first()->id
        ]);
        DB::table('spell_wizard')->insert([
            'wizard_id' => Wizard::where('name', 'Gandalf')->first()->id,
            'spell_id' => Spell::where('name', 'Gust of wind')->first()->id
        ]);
        DB::table('spell_wizard')->insert([
            'wizard_id' => Wizard::where('name', 'Gandalf')->first()->id,
            'spell_id' => Spell::where('name', 'Splash')->first()->id
        ]);
    }
}
