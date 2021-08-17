<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create([
            'username' => 'luisgamez',
            'email'    => 'luis@kemok.io'
        ]);
        $admin->assignRole('admin');

        $publisher = User::factory()->create([
            'username' => 'joseaviles',
            'email'    => 'joseaviles230796@gmail.com'
        ]);
        $publisher->assignRole('publisher');

        $publishers = User::factory(98)->create();
        foreach ($publishers as $publisher) {
            $publisher->assignRole('publisher');
        }
    }
}
