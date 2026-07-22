@extends('layouts.app')
@section('content')

<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title d-flex align-items-center flex-wrap">
                <h2 class="mr-40">Generate Short URL</h2>
            </div>
        </div>
        <!-- end col -->
        <div class="col-md-6">
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('short-urls.index')}}">Short URL List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Short URL
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
                    <form method="POST" action="{{ route('short-urls.store') }}">

                        @csrf

                        <div class="row">

                            <div class="col-md-12 mb-3">

                                <label class="form-label">
                                    Original URL
                                </label>

                                <input type="url" name="original_url" class="form-control"
                                    value="{{ old('original_url') }}" placeholder="https://example.com" required>

                                @error('original_url')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>

                            <div class="col-md-12 mb-3">

                                <label class="form-label">
                                    Title
                                </label>

                                <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                    placeholder="Enter URL title">

                                @error('title')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>

                            <div class="col-md-12">

                                <button type="submit" class="btn btn-primary">
                                    Generate URL
                                </button>

                                <a href="{{ route('short-urls.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>

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