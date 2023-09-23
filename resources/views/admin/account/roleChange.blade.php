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
                                <div class="">
                                    <a class="text-decoration-none text-success" href="{{ route('admin#list')}}">
                                        <h5><i class="fa-solid fa-circle-left"> Back</i>  </h5>
                                    </a>
                                </div>
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Role</h3>
                                </div>
                                <hr>
                                <form action="{{route('admin#change',$account->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row my-5">
                                        <div class="col-4 offset-1">
                                            <div class="image">
                                                @if ($account->image == null)
                                                        @if($account->gender == 'male')
                                                            <img class="img-thumbnail" src="{{ asset('image/user_profile.webp')}}" width="150px">
                                                        @else
                                                            <img class="img-thumbnail" src="{{ asset('image/female_user.jpg')}}" width="150px">
                                                        @endif
                                                @else
                                                    <img src="{{ asset('storage/'. $account->image)}}" alt="John Doe" />
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-5 offset-1">
                                                
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label mb-1">User Name</label>
                                                        <input disabled id="cc-pament" name="name" value="{{old('name',$account->name)}}" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="role" class="control-label mb-1">Role </label>
                                                        <select name="role" class="form-control bg-danger">
                                                            <option value="admin" @if($account->role == 'admin' ) selected @endif>Admin</option>
                                                            <option value="user" @if($account->role == 'user' ) selected @endif >User</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email" class="control-label mb-1">Email</label>
                                                        <input disabled id="cc-pament" name="email" value="{{old('email',$account->email)}}" type="email" class="form-control  " aria-required="true" aria-invalid="false" placeholder="Enter Email...">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone" class="control-label mb-1">Phone</label>
                                                        <input disabled id="cc-pament" name="phone" value="{{old('phone',$account->phone)}}" type="number" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter phone...">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address" class="control-label mb-1">Address </label>
                                                        <textarea disabled name="address" id="" cols="10" rows="2" class="form-control" placeholder="Enter Address...">{{old('role',$account->address)}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gender" class="control-label mb-1">Gender </label>
                                                        <select disabled name="gender" class="form-control">
                                                            <option value="">Choose Gender</option>
                                                            <option value="male" @if($account->gender == 'male' ) selected @endif>Male</option>
                                                            <option value="female" @if($account->gender == 'female' ) selected @endif >Female</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <a class="" href="">
                                                        <button class="btn btn-dark" type="submit">Change Role</button>
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
