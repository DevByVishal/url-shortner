<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>Sign In</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{url('assets/css/lineicons.css')}}" />
    <link rel="stylesheet" href="{{url('assets/css/materialdesignicons.min.css')}}" />
    <link rel="stylesheet" href="{{url('assets/css/fullcalendar.css')}}" />
    <link rel="stylesheet" href="{{url('assets/css/main.css')}}" />
  </head>
  <body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
      <div class="spinner"></div>
    </div>
    <main class="container">
        @include('components.error')
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title d-flex align-items-center flex-wrap">
                        <h2 class="mr-40">Accept Invitation</h2>
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
                                    Accept Invitation
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
                            <p>
                                You have been invited to join: <b>{{ $invitation->company->name }}</b>
                            </p>

                            <p>
                                Role:
                                <strong>
                                    {{ $invitation->role->name }}
                                </strong>
                            </p>

                            <hr>

                            <form method="POST" action="{{ route('invitations.accept.store', $invitation->token) }}">

                                @csrf

                                <div class="row">

                                    <div class="col-md-12 mb-3">

                                        <label class="form-label">
                                            Name
                                        </label>

                                        <input
                                            type="text"
                                            name="name"
                                            class="form-control"
                                            value="{{ $invitation->name }}"
                                            readonly
                                        >

                                    </div>

                                    <div class="col-md-12 mb-3">

                                        <label class="form-label">
                                            Email
                                        </label>

                                        <input
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            value="{{ $invitation->email }}"
                                            readonly
                                        >

                                    </div>

                                    <div class="col-md-12 mb-3">

                                        <label class="form-label">
                                            Password
                                        </label>

                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control"
                                            required
                                        >

                                        @error('password')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    <div class="col-md-12 mb-3">

                                        <label class="form-label">
                                            Confirm Password
                                        </label>

                                        <input
                                            type="password"
                                            name="password_confirmation"
                                            class="form-control"
                                            required
                                        >

                                    </div>

                                    <div class="col-md-12">

                                        <button type="submit" class="btn btn-primary">
                                            Accept Invitation
                                        </button>

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
    
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="{{ url('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ url('assets/js/Chart.min.js')}}"></script>
    <script src="{{ url('assets/js/dynamic-pie-chart.js')}}"></script>
    <script src="{{ url('assets/js/moment.min.js')}}"></script>
    <script src="{{ url('assets/js/fullcalendar.js')}}"></script>
    <script src="{{ url('assets/js/jvectormap.min.js')}}"></script>
    <script src="{{ url('assets/js/world-merc.js')}}"></script>
    <script src="{{ url('assets/js/polyfill.js')}}"></script>
    <script src="{{ url('assets/js/main.js')}}"></script>
  </body>
</html>
