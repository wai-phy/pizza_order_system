@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="offset-3 col-lg-6 table-responsive mb-5">
                {{-- <h1 class="text-center">Contact Us</h1> --}}
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-6 offset-md-3 text-center">
                            <h1 class="display-4">Thank You!</h1>
                            <p class="lead">We have received your message and will get back to you as soon as possible.</p>
                            <p class="mb-5">In the meantime, feel free to explore more of our website.</p>
                            <a href="{{route('user#home')}}" class="btn btn-primary">Go to Homepage</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection
