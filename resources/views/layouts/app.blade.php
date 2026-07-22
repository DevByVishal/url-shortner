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
    @stack('styles')
  </head>
  <body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
      <div class="spinner"></div>
    </div>

    <!-- ======== sidebar-nav start =========== -->
    @include('components.sidebar')
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        @include('components.error')
      <!-- ========== header start ========== -->
      @include('components.navbar')
      <!-- ========== header end ========== -->

      <!-- ========== section start ========== -->
      <section>
        <div class="container-fluid">
        <!-- ========== content start ========== -->
            @yield('content')
        <!-- end content -->
        </div>
      </section>
      <!-- ========== section end ========== -->

      <!-- ========== footer start =========== -->
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 order-last order-md-first">
              <div class="copyright text-center text-md-start">
                <p class="text-sm">
                  
                </p>
              </div>
            </div>
            <!-- end col-->
            <div class="col-md-6">
              <div class="terms d-flex justify-content-center justify-content-md-end">
                2026
              </div>
            </div>
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </footer>
      <!-- ========== footer end =========== -->
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
    @stack('scripts')
  </body>
</html>
