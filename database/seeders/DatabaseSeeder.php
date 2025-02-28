<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        Contact::create([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'birthdate' => '1990-05-15',
            'workphone' => '123-456-7890',
            'homephone' => '321-654-0987',
            'email' => 'johndoe@example.com',
        ]);
    }
}
