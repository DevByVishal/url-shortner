<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    public function __construct(
        private CompanyService $companyService
    ) {
    }

    public function index(Request $request)
    {
        $companies = Company::query()
            ->withCount('users')
            ->when(
                $request->search,
                function ($query, $search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
                }
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'companies.index',
            compact('companies')
        );
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:companies,name',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ]);

        $this->companyService->create($validated);

        return redirect()
            ->route('companies.index')
            ->with(
                'success',
                'Company created successfully.'
            );
    }

    public function edit(Company $company)
    {
        return view(
            'companies.edit',
            compact('company')
        );
    }

    public function update(
        Request $request,
        Company $company
    ) {

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:companies,name,' . $company->id,
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ]);

        $this->companyService->update(
            $company,
            $validated
        );

        return redirect()
            ->route('companies.index')
            ->with(
                'success',
                'Company updated successfully.'
            );
    }

    public function destroy(Company $company)
    {
        $this->companyService->delete($company);

        return redirect()
            ->route('companies.index')
            ->with(
                'success',
                'Company deleted successfully.'
            );
    }
}