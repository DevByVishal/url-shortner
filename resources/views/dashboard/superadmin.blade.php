@extends('layouts.app')
@section('content')

    <div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
        <div class="title d-flex align-items-center flex-wrap">
            <h2 class="mr-40">DashBoard</h2>
        </div>
        </div>
        <!-- end col -->
        <div class="col-md-6">
        <div class="breadcrumb-wrapper">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                <a href="#0">Dashboard</a>
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
            <div class="invoice-header">
                <div class="invoice-for">
                    <h2 class="mb-10 d-none">Dashboard</h2>
                    <p class="text-sm">
                    {{auth()->user()->getRoleNames()->first()}} Dashboard Design & Development
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center pt-4">
                    <h1 class="m-4 p-4">Welcome</h1>
                </div>
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