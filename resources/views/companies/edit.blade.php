@extends('layouts.app')
@section('content')

<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title d-flex align-items-center flex-wrap">
                <h2 class="mr-40">Edit Company</h2>
            </div>
        </div>
        <!-- end col -->
        <div class="col-md-6">
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('companies.index')}}">Companies</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Edit Company
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
                <div class="">
                    <form method="POST" action="{{ route('companies.update', $company) }}">

                        @csrf

                        @method('PUT')


                        {{-- Company Name --}}
                        <div class="mb-3">

                            <label for="name" class="form-label fw-semibold">
                                Company Name
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" id="name" name="name" value="{{ old('name', $company->name) }}"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>


                        {{-- Email --}}
                        <div class="mb-3">

                            <label for="email" class="form-label fw-semibold">
                                Company Email
                            </label>

                            <input type="email" id="email" name="email" value="{{ old('email', $company->email) }}"
                                class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>


                        {{-- Status --}}
                        <div class="mb-4">

                            <label for="status" class="form-label fw-semibold">
                                Status
                            </label>

                            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">

                                <option value="1" {{ old('status', $company->status) == '1' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0" {{ old('status', $company->status) == '0' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                            @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>


                        {{-- Actions --}}
                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('companies.index') }}" class="btn btn-light">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i>
                                Update Company
                            </button>

                        </div>

                    </form>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- ENd Col -->
    </div>
    <!-- End Row -->
</div>
<!-- Invoice Wrapper End -->

@endsection