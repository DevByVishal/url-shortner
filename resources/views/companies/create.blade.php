@extends('layouts.app')
@section('content')

<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title d-flex align-items-center flex-wrap">
                <h2 class="mr-40">Add Company</h2>
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
                            Add Company
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
                    <form method="POST" action="{{ route('companies.store') }}">

                        @csrf

                        <div class="row g-3">

                            {{-- Company Name --}}
                            <div class="col-md-6">

                                <label for="name" class="form-label fw-semibold">
                                    Company Name
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter company name" autofocus>

                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            {{-- Company Email --}}
                            <div class="col-md-6">

                                <label for="email" class="form-label fw-semibold">
                                    Company Email
                                </label>

                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="company@example.com">

                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            {{-- Status --}}
                            <div class="col-md-6">

                                <label for="status" class="form-label fw-semibold">
                                    Status
                                    <span class="text-danger">*</span>
                                </label>

                                <select id="status" name="status"
                                    class="form-select @error('status') is-invalid @enderror">

                                    <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
                                        Inactive
                                    </option>

                                </select>

                                @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            {{-- Form Actions --}}
                            <div class="col-12">

                                <hr class="my-2">

                                <div class="d-flex justify-content-end gap-2">

                                    <a href="{{ route('companies.index') }}" class="btn btn-light">
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-plus-lg me-1"></i>
                                        Create Company
                                    </button>

                                </div>

                            </div>

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