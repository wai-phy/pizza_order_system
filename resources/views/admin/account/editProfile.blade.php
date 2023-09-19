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
                                <form action="{{route('admin#update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row my-5">
                                        <div class="col-4 offset-1">
                                            <div class="image">
                                                @if (Auth::user()->image == null)
                                                    <img src="{{ asset('admin/image/user_profile.webp')}}" alt="">
                                                @else
                                                    <img src="{{ asset('admin/images/icon/avatar-01.jpg')}}" alt="John Doe" />
                                                @endif
                                                <div class="form-group mt-4">
                                                    <input name="image" type="file" 
                                                        class="form-control  @error('image') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false">
                                                    @error('image')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 offset-1">
                                                
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label mb-1">User Name</label>
                                                        <input id="cc-pament" name="name" value="{{old('name',Auth::user()->name)}}" type="text" class="form-control  @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                                        @error('name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email" class="control-label mb-1">Email</label>
                                                        <input id="cc-pament" name="email" value="{{old('email',Auth::user()->email)}}" type="email" class="form-control  @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Email...">
                                                        @error('email')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone" class="control-label mb-1">Phone</label>
                                                        <input id="cc-pament" name="phone" value="{{old('phone',Auth::user()->phone)}}" type="number" class="form-control  @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter phone...">
                                                        @error('phone')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address" class="control-label mb-1">Address </label>
                                                        <textarea name="address" id="" cols="10" rows="2" class="form-control  @error('address') is-invalid @enderror" placeholder="Enter Address...">{{old('role',Auth::user()->address)}}</textarea>
                                                        @error('address')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gender" class="control-label mb-1">Gender </label>
                                                        <select name="gender" class="form-control  @error('gender') is-invalid @enderror">
                                                            <option value="">Choose Gender</option>
                                                            <option value="male" @if(Auth::user()->gender == 'male' ) selected @endif>Male</option>
                                                            <option value="female" @if(Auth::user()->gender == 'female' ) selected @endif >Female</option>
                                                        </select>
                                                        @error('gender')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="role" class="control-label mb-1">Role </label>
                                                        <input type="text" name="role" value="{{old('role',Auth::user()->role)}}" class="form-control " disabled>
                                                    </div>
                                                    <a class="" href="">
                                                        <button class="btn btn-dark" type="submit">Edit Profile</button>
                                                    </a>
                                                </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
