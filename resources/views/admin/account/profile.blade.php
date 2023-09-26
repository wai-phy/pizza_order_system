@extends('admin.layouts.master')

@section('title', 'Profile Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Account Info</h3>
                                </div>
                                <hr>
                                <div class="row my-5">
                                    <div class="col-4 offset-1">
                                        <div class="image">
                                            @if (Auth::user()->image == null)
                                                    @if(Auth::user()->gender == 'male')
                                                        <img class="img-thumbnail" src="{{ asset('image/user_profile.webp')}}" width="150px">
                                                    @else
                                                        <img class="img-thumbnail" src="{{ asset('image/female_user.jpg')}}" width="150px">
                                                    @endif
                                            @else
                                                <img src="{{ asset('storage/'. Auth::user()->image)}}" alt="John Doe" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-5 offset-1">
                                            <h3 class="my-2"><i class="fa-solid fa-user-pen"></i> : {{ Auth::user()->name }}</h3>
                                            <h4 class="my-2"><i class="fa-solid fa-envelope"></i> : <small>{{ Auth::user()->email }}</small></h4>
                                            <h4 class="my-2"><i class="fa-solid fa-phone"></i> : {{ Auth::user()->phone }}</h4>
                                            <h4 class="my-2"><i class="fa-solid fa-location-dot"></i> : {{ Auth::user()->address }}</h4>
                                            <h4 class="my-2"><i class="fa-solid fa-venus-mars"></i> : {{ Auth::user()->gender }}</h4>
                                            <h4 class="my-2"><i class="fa-solid fa-calendar-days"></i> : {{ Auth::user()->created_at->format('d.F.Y') }}</h4>
                                            <div class="row mt-5">
                                                <a class="" href="{{ route('admin#editPage')}}">
                                                    <button class="btn btn-dark" type="submit">Edit Profile</button>
                                                </a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
