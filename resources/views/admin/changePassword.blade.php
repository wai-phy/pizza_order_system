@extends('admin.layouts.master')

@section('title', 'Password Change')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 offset-8">
                            <a href="{{ route('category#list') }}"><button
                                    class="btn bg-dark text-white my-3">List</button></a>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Password</h3>
                                </div>
                                <hr>
                                <form action="{{ route('category#create') }}" method="post" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <label for="categoryName" class="control-label mb-1">Old Password</label>
                                        <input id="cc-pament" name="categoryName" type="text" value="{{ old('categoryName')}}"
                                            class="form-control @error('categoryName') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter Old Password...">
                                        @error('categoryName')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="categoryName" class="control-label mb-1">New Password</label>
                                        <input id="cc-pament" name="categoryName" type="text" value="{{ old('categoryName')}}"
                                            class="form-control @error('categoryName') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter New Password...">
                                        @error('categoryName')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="categoryName" class="control-label mb-1">Confirm Password</label>
                                        <input id="cc-pament" name="categoryName" type="text" value="{{ old('categoryName')}}"
                                            class="form-control @error('categoryName') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password...">
                                        @error('categoryName')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount">Change Password</span>
                                            {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
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
