@extends('layouts.app')
@section('content')
@php
    $user = auth()->user();
@endphp
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
                            <a href="{{route('invitations.index')}}">Invitations</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Add Invitations
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
                    <form method="POST" action="{{ route('invitations.store') }}">

                        @csrf

                        <div class="row g-3">

                            {{-- Company --}}
                            @if($user->hasRole('SuperAdmin'))

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company</label>

                                        <select name="company_id" class="form-control" required>
                                            <option value="">Select Company</option>

                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}">
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('company_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            @elseif($user->hasRole('Admin'))

                                {{-- Admin cannot choose another company --}}
                                <input type="hidden"
                                    name="company_id"
                                    value="{{ $user->company_id }}">

                            @endif


                            {{-- Role --}}

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Role
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="role" class="form-select @error('role') is-invalid @enderror">

                                    <option value="">
                                        Select Role
                                    </option>

                                    @foreach($roles as $role)
                                        <option value="{{ $role }}"
                                            {{ old('role') == $role ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('role')
                                <div class="error">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            {{-- Name --}}

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Name
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter user name">

                                @error('name')
                                <div class="error">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            {{-- Email --}}

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Email
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter email address">

                                @error('email')
                                <div class="error">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            {{-- Actions --}}

                            <div class="col-12">

                                <hr class="my-2">

                                <div class="d-flex justify-content-end gap-2">

                                    <a href="{{ route('invitations.index') }}" class="btn btn-light">
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-send me-1"></i>
                                        Send Invitation
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