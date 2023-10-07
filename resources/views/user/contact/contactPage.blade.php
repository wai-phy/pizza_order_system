
@extends('user.layouts.master')

@section('content')
        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="offset-3 col-lg-6 table-responsive mb-5">
                    <div class="container mt-5">
                        <h1 class="text-center">Contact Us</h1>
                        <form action="{{ route('user#createContact')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input value="{{ old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Your Name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input value="{{ old('email')}}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Your Email">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="4" placeholder="Your Message">{{ old('name')}}</textarea>
                                @error('message')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- Cart End -->
@endsection




