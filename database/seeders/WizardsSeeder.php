<?php

namespace Database\Seeders;

use App\Models\Wizard;
use Illuminate\Database\Seeder;

class WizardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wizard::create([
            'name' => 'Balthazar'
        ]);
        Wizard::create([
            'name' => 'Gandalf'
        ]);
    }
}
