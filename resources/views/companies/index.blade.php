@extends('layouts.app')
@section('content')

<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title d-flex align-items-center flex-wrap">
                <h2 class="mr-40">Companies</h2>
                <a href="{{ route('companies.create') }}" class="main-btn primary-btn btn-hover btn-sm">
                    <i class="lni lni-plus mr-5"></i> New</a>
            </div>
        </div>
        <!-- end col -->
        <div class="col-md-6">
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Companies
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
<!-- ========== title-wrapper end ========== -->

<!-- Invoice Wrapper Start -->
<div class="invoice-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="invoice-card card-style mb-30">
                <div class="invoice-address">

                    <form method="GET" action="{{ route('companies.index') }}">

                        <div class="row g-2">

                            <div class="col-md-6">

                                <div class="input-group">

                                    <span class="input-group-text bg-white">
                                        <i class="bi bi-search"></i>
                                    </span>

                                    <input type="text" name="search" class="form-control"
                                        placeholder="Search company name or email..." value="{{ request('search') }}">

                                </div>

                            </div>

                            <div class="col-auto">

                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>

                            </div>

                            @if(request('search'))

                            <div class="col-auto">

                                <a href="{{ route('companies.index') }}" class="btn btn-outline-secondary">
                                    Clear
                                </a>

                            </div>

                            @endif

                        </div>

                    </form>

                </div>


                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="px-4">
                                    #
                                </th>

                                <th>
                                    Company
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Users
                                </th>

                                <th>
                                    Status
                                </th>

                                <th class="text-end px-4">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($companies as $company)

                            <tr>

                                <td class="px-4">
                                    {{ $companies->firstItem() + $loop->index }}
                                </td>

                                <td>

                                    <div class="d-flex align-items-center">

                                        <div class="company-avatar me-3">
                                            {{ strtoupper(substr($company->name, 0, 1)) }}
                                        </div>

                                        <div>

                                            <div class="fw-semibold">
                                                {{ $company->name }}
                                            </div>

                                            <small class="text-muted">
                                                {{ $company->slug }}
                                            </small>

                                        </div>

                                    </div>

                                </td>

                                <td>
                                    {{ $company->email ?? '-' }}
                                </td>

                                <td>

                                    <span class="badge bg-light text-dark">

                                        <i class="bi bi-people me-1"></i>

                                        {{ $company->users_count }}

                                    </span>

                                </td>

                                <td>

                                    @if($company->status)

                                    <span class="badge bg-success-subtle text-success">
                                        Active
                                    </span>

                                    @else

                                    <span class="badge bg-danger-subtle text-danger">
                                        Inactive
                                    </span>

                                    @endif

                                </td>

                                <td class="text-end px-4">

                                    <div class="dropdown">

                                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">

                                            <i class="lni lni-radio-button"></i>

                                        </button>

                                        <ul class="dropdown-menu dropdown-menu-end">

                                            <li>

                                                <a href="{{ route('companies.edit', $company) }}" class="dropdown-item">

                                                    <i class="bi bi-pencil me-2"></i>

                                                    Edit

                                                </a>

                                            </li>

                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>

                                            <li>

                                                <form method="POST" action="{{ route('companies.destroy', $company) }}"
                                                    onsubmit="return confirm('Are you sure you want to delete this company?')">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button type="submit" class="dropdown-item text-danger">

                                                        <i class="bi bi-trash me-2"></i>

                                                        Delete

                                                    </button>

                                                </form>

                                            </li>

                                        </ul>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="6" class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-buildings fs-1 d-block mb-3"></i>

                                        <h5>
                                            No companies found
                                        </h5>

                                        <p class="mb-3">
                                            Start by creating your first company.
                                        </p>

                                        <a href="{{ route('companies.create') }}" class="btn btn-primary">
                                            <i class="bi bi-plus-lg me-1"></i>
                                            Add Company
                                        </a>

                                    </div>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>


                {{-- Pagination --}}
                @if($companies->hasPages())
                <div class="card-footer bg-white border-0">
                    {{ $companies->links() }}
                </div>
                @endif
            </div>
            <!-- End Card -->
        </div>
        <!-- ENd Col -->
    </div>
    <!-- End Row -->
</div>
<!-- Invoice Wrapper End -->

@endsection