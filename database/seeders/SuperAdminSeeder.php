<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::insert("
            INSERT INTO users
            (
                company_id,
                name,
                email,
                password,
                status,
                created_at,
                updated_at
            )
            VALUES
            (
                NULL,
                ?,
                ?,
                ?,
                1,
                NOW(),
                NOW()
            )
        ", [
            'Super Admin',
            'super@admin.com',
            Hash::make('Admin@123#')
        ]);

        $user = \App\Models\User::where('email', 'super@admin.com')->first();

        $user->assignRole('SuperAdmin');
    }
}