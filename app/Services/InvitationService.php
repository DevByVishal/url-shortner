<?php

namespace App\Services;

use App\Models\Invitation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvitationService
{
    public function create(
        array $data
    ): Invitation {

        return DB::transaction(function () use ($data) {

            return Invitation::create([

                'uuid' => (string) Str::uuid(),

                'company_id' => $data['company_id'],

                'invited_by' => $data['invited_by'] ?? null,

                'name' => $data['name'],

                'email' => $data['email'],

                'role_id' => $data['role_id'],

                'token' => $this->generateToken(),

                'expires_at' => now()->addDays(2),

            ]);

        });
    }

    private function generateToken(): string
    {
        do {

            $token = Str::random(64);

        } while (
            Invitation::where(
                'token',
                $token
            )->exists()
        );

        return $token;
    }
}