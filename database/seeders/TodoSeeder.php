<?php

namespace Database\Seeders;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
    
        Todo::factory()->count(5)->create([
            'user_id' => $user->id,
        ]);
    }
}
