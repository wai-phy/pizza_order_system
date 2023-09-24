@extends('user.layouts.master')

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
                                    <h3 class="text-center title-2">Change Password</h3>
                                </div>
                                <hr>
                                @if (session('changeSuccess'))
                                    <div class="alert alert-success alert-dismissible fade show col-10 offset-1 " role="alert">
                                        <i class="fa-solid fa-check"></i> {{ session('changeSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <form action="{{ route('user#passwordChange') }}" method="post" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group mb-5">
                                        <label for="oldPassword" class="control-label mb-1">Old Password</label>
                                        <input id="cc-pament" name="oldPassword" type="password" @if(session('failMessage')) @endif
                                            class="form-control @error('oldPassword') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter Old Password...">
                                        @error('oldPassword')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        @if (session('failMessage'))
                                            <span class="text-danger">{{ session('failMessage')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-5">
                                        <label for="newPassword" class="control-label mb-1">New Password</label>
                                        <input id="cc-pament" name="newPassword" type="password" 
                                            class="form-control @error('newPassword') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter New Password...">
                                        @error('newPassword')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-5">
                                        <label for="confirmPassword" class="control-label mb-1">Confirm Password</label>
                                        <input id="cc-pament" name="confirmPassword" type="password" 
                                            class="form-control @error('confirmPassword') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password...">
                                        @error('confirmPassword')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                            <span id="payment-button-amount">Change Password</span>
                                            <i class="fa-solid fa-circle-right"></i>
                                        </button>
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