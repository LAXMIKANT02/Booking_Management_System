<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class InstallAdmin extends Command
{
    protected $signature = 'install:admin';
    protected $description = 'Install System Admin';

    public function handle()
    {
        $user = User::where('email', 'sys@example.com')->first();

        if (!$user) {
            $user = User::create([
                'name' => 'System Admin',
                'email' => 'sys@example.com',
                'password' => Hash::make('password'), // hashed password
                'user_type' => 1,
            ]);

            if ($user) {
                $this->info('System Admin created successfully.');
            } else {
                $this->error('Failed to create System Admin.');
            }
        } else {
            $this->info('System Admin already exists.');
        }
    }
}
