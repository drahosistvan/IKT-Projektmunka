<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Administrator::factory()->create([
            'name' => 'Drahos István',
            'email' => 'drahos.istvan@gmail.com',
            'password' => bcrypt('MkC*2airqhC39T-i'),
        ]);

        Administrator::factory()->create([
            'name' => 'Developer Admin',
            'email' => 'developer@admin.com',
        ]);

        Customer::factory()->create([
            'name' => 'Developer Customer',
            'email' => 'developer@customer.com'
        ]);

        Customer::factory()->count(20)->create();
    }
}
