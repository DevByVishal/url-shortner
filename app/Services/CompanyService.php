<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Str;

class CompanyService
{
    public function create(array $data): Company
    {
        return Company::create([
            'uuid' => (string) Str::uuid(),
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'email' => $data['email'] ?? null,
            'status' => $data['status'],
        ]);
    }

    public function update(
        Company $company,
        array $data
    ): Company {

        $company->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'email' => $data['email'] ?? null,
            'status' => $data['status'],
        ]);

        return $company->refresh();
    }

    public function delete(Company $company): void
    {
        $company->delete();
    }
}