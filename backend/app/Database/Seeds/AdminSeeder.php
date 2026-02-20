<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();

        $email = "alonsogg@hotmail.es";

        $existing = $userModel->where("email", $email)->first();

        if ($existing) {
            echo "Admin user already exists: $email\n";
            return;
        }

        $userModel ->insert([
            'name' => 'Admin',
            'email' => $email,
            'password' => password_hash('admin123', PASSWORD_BCRYPT),
            'role' => 'admin'
        ]);
    }
}
