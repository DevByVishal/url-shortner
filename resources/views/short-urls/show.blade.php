@extends('layouts.app')
@section('content')

<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title d-flex align-items-center flex-wrap">
                <h2 class="mr-40">Short-urls</h2>
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
                            Short-urls
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
                <div class="card-body">

                    <h4 class="mb-4">Short URL Details</h4>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <strong>Title</strong>
                            <p>{{ $shortUrl->title ?? '-' }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Short Code</strong>
                            <p>{{ $shortUrl->short_code }}</p>
                        </div>

                        <div class="col-md-12 mb-3">
                            <strong>Original URL</strong>
                            <p>
                                {{ $shortUrl->original_url }}
                            </p>
                        </div>

                        <div class="col-md-12 mb-3">
                            <strong>Public Short URL</strong>
                            <p>
                                {{ url('/s/' . $shortUrl->short_code) }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Created By</strong>
                            <p>
                                {{ $shortUrl->user->name ?? '-' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Company</strong>
                            <p>
                                {{ $shortUrl->company->name ?? '-' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Hits</strong>
                            <p>{{ $shortUrl->hits }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Status</strong>
                            <p>
                                @if($shortUrl->status)
                                <span class="badge bg-success">
                                    Active
                                </span>
                                @else
                                <span class="badge bg-danger">
                                    Inactive
                                </span>
                                @endif
                            </p>
                        </div>

                    </div>

                    <a href="{{ route('short-urls.index') }}" class="btn btn-secondary">
                        Back
                    </a>

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