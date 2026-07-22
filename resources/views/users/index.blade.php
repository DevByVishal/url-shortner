@extends('layouts.app')
@section('content')

<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title d-flex align-items-center flex-wrap">
                <h2 class="mr-40">Users List</h2>
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
                            Users List
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

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Company</th>
                                <th>Created At</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($users as $user)

                            <tr>
                                <td>
                                    {{ $user->name }}
                                </td>

                                <td>
                                    {{ $user->email }}
                                </td>

                                <td>
                                    {{ $user->getRoleNames()->first() ?? '-' }}
                                </td>

                                <td>
                                    {{ $user->company->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                            </tr>

                            @empty

                            <tr>
                                <td colspan="5" class="text-center">
                                    No team members found.
                                </td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table>

                </div>

                <div class="mt-3">
                    {{ $users->links() }}
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