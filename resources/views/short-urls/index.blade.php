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
                @if($shortUrls->count())

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Original URL</th>
                                <th>Short Code</th>
                                <th>Created By</th>
                                <th>Company</th>
                                <th>Hits</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($shortUrls as $shortUrl)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $shortUrl->title ?? '-' }}
                                </td>

                                <td>
                                    {{ $shortUrl->original_url }}
                                </td>

                                <td>
                                    {{ $shortUrl->short_code }}
                                </td>

                                <td>
                                    {{ $shortUrl->user->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $shortUrl->company->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $shortUrl->hits }}
                                </td>

                                <td>

                                    @if($shortUrl->status)

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                    @else

                                    <span class="badge bg-danger">
                                        Inactive
                                    </span>

                                    @endif

                                </td>
                                <td>
                                    <a href="{{ route('short-urls.show', $shortUrl->id) }}"
                                    class="btn btn-sm btn-primary">
                                        View
                                    </a>
                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                @else

                <div class="text-center py-5">

                    <h5>No Short URLs Found</h5>

                    <p class="text-muted">
                        There are no short URLs available.
                    </p>

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