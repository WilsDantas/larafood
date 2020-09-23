<?php

use Illuminate\Database\Seeder;
use App\Models\{
    User,
    Tenant
};


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tenant = Tenant::first();

        $tenant->users()->create([
            'name' => 'William Santos',
            'email' => 'wilsdantas@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
