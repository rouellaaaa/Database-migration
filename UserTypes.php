<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_types = [
            ['name' => 'Buyer', 'description' => 'Just a buyer.'],
            ['name' => 'Seller', 'description' => 'Just a seller.'],
            ['name' => 'Buyer and Seller', 'description' => 'Buyer and seller.'],
            ['name' => 'Company', 'description' => 'A company account.'],
            ['name' => 'Lurker', 'description' => 'Just looking around.'],
            ['name' => 'Admin', 'description' => 'An admin.']
        ];

        DB::table('user_types')->insert($user_types);
    }
}
