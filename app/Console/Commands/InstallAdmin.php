<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class InstallAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install System Admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = new User([
            'name' => 'System Admin',
            'email' => 'admin@gmail.com',
            'phone_no' => '1234567890',
            'password' => bcrypt('admin123'),
            'user_type' => 1,
        ]);
        if (User::where('email', 'admin@gmail.com')->exists()) {
            $this->error('System Admin already exists.');
        } elseif ($user->save()) {
            $this->info('System Admin created successfully.');
        } else {
            $this->error('Failed to create System Admin.');
        }
    }
}
