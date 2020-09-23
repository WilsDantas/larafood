<?php

use Illuminate\Database\Seeder;
use App\Models\{
    Tenant,
    Plan
};

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' => '27010044000159',
            'name' => 'William Santos',
            'url' => 'william-santos',
            'email' => 'wilsdantas@gmail.com'
        ]);
    }
}
