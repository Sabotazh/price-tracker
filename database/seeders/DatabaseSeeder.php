<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            "id" => 1,
            "name" => "John Doe",
            "email" => "admin@example.com",
            "password" => '$2y$10$/NbDDRLvGpUT9SsXloW8pOFtnHqP0qSZWgFd2pThxpZMwPtXL/jJO',
        ]);
    }
}
