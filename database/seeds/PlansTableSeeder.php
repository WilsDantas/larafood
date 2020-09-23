<?php

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'Businers',
            'url' => 'businers',
            'price' => 499.9,
            'description' => 'Plano Empresarial'
        ]);
    }
}
