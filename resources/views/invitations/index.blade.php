@extends('layouts.app')
@section('content')

<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title d-flex align-items-center flex-wrap">
                <h2 class="mr-40">Invitations</h2>
                <a href="{{ route('invitations.create') }}" class="main-btn primary-btn btn-hover btn-sm">
                    <i class="lni lni-plus mr-5"></i> Invite</a>
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
                            Invitations
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
                {{-- Table --}}
                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="px-4">
                                    #
                                </th>

                                <th>
                                    User
                                </th>

                                <th>
                                    Company
                                </th>

                                <th>
                                    Role
                                </th>

                                <th>
                                    Invited By
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Expires
                                </th>

                                <th class="text-end px-4">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($invitations as $invitation)

                            <tr>

                                {{-- Number --}}
                                <td class="px-4">

                                    {{ $invitations->firstItem() + $loop->index }}

                                </td>


                                {{-- User --}}
                                <td>

                                    <div class="fw-semibold">
                                        {{ $invitation->name }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $invitation->email }}
                                    </small>

                                </td>


                                {{-- Company --}}
                                <td>

                                    {{ $invitation->company?->name ?? '-' }}

                                </td>


                                {{-- Role --}}
                                <td>

                                    <span class="badge bg-light text-dark">

                                        {{ $invitation->role?->name ?? '-' }}

                                    </span>

                                </td>


                                {{-- Invited By --}}
                                <td>

                                    {{ $invitation->inviter?->name ?? 'System' }}

                                </td>


                                {{-- Status --}}
                                <td>

                                    @if($invitation->accepted_at)

                                    <span class="badge bg-success">
                                        Accepted
                                    </span>

                                    @elseif($invitation->expires_at->isPast())

                                    <span class="badge bg-danger">
                                        Expired
                                    </span>

                                    @else

                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>

                                    @endif

                                </td>


                                {{-- Expiry --}}
                                <td>

                                    @if($invitation->accepted_at)

                                    <span class="text-muted">
                                        -
                                    </span>

                                    @elseif($invitation->expires_at->isPast())

                                    <span class="text-danger">
                                        Expired
                                    </span>

                                    @else

                                    {{ $invitation->expires_at->format('d M Y') }}

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="text-end px-4">
                                    <button type="button" class="btn-sm btn-info btn text-white"
                                        onclick="copyInvitationLink( '{{ route('invitations.accept', $invitation->token) }}' )">

                                        <i class="bi bi-link-45deg me-2"></i>

                                        Copy Invitation Link

                                    </button>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="8" class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-envelope fs-1 d-block mb-3"></i>

                                        <h5>
                                            No invitations found
                                        </h5>

                                        <p class="mb-3">
                                            There are no invitations yet.
                                        </p>

                                        <a href="{{ route('invitations.create') }}" class="btn btn-primary">
                                            <i class="bi bi-person-plus me-1"></i>
                                            Invite User
                                        </a>

                                    </div>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>


                    {{-- Pagination --}}
                    @if($invitations->hasPages())

                    <div class="card-footer bg-white border-0">

                        {{ $invitations->links() }}

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
@push('scripts')

    <script>
    function copyInvitationLink(url) {
        navigator.clipboard.writeText(url)
            .then(function() {

                alert('Invitation link copied successfully.');

            })
            .catch(function() {

                alert('Unable to copy invitation link.');

            });
    }
    </script>

    @endpush