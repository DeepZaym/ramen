<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $adminEmail = 'founder@gmail.com';

        // Check if the admin already exists
        $admin = Admin::where('email', $adminEmail)->first();

        if ($admin) {
            // Update the existing admin
            $admin->name = 'Admin Name';
            $admin->password = Hash::make('founder'); // Hash the password
            $admin->save();
        } else {
            // Create a new admin
            Admin::create([
                'name' => 'Admin Name',
                'email' => $adminEmail,
                'password' => Hash::make('founder'), // Hash the password
            ]);
        }
    }
}
