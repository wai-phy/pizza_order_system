@extends('admin.layouts.master')
@section('title')

@section('title', 'Category Create')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 offset-8">
                            <a href="{{ route('product#pizzaPage') }}"><button
                                    class="btn bg-dark text-white my-3">List</button></a>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Create Pizza</h3>
                                </div>
                                <hr>
                                <form action="{{ route('product#create')}}" enctype="multipart/form-data" method="post" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <label for="pizzaName" class="control-label mb-1">Name</label>
                                        <input  name="pizzaName" type="text" value="{{ old('pizzaName')}}"
                                            class="form-control @error('pizzaName') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Pizza Name...">
                                        @error('pizzaName')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="pizzaCategory" class="control-label mb-1">Category</label>
                                        <select name="pizzaCategory"  class="form-control @error('pizzaCategory') is-invalid @enderror">
                                            <option value="">Choose Category</option>
                                            @foreach ($categories as $c )
                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                            @endforeach    
                                        </select>
                                        @error('pizzaCategory')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="pizzaDescription" class="control-label mb-1">Description</label>
                                        <textarea name="pizzaDescription" id="" cols="30" rows="3" class="form-control @error('pizzaDescription') is-invalid @enderror" placeholder="Pizza Description...">{{ old('pizzaDescription')}}</textarea>
                                        @error('pizzaDescription')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="pizzaImage" class="control-label mb-1">Image</label>
                                        <input  name="pizzaImage" type="file" value="{{ old('pizzaImage')}}"
                                            class="form-control @error('pizzaImage') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" >
                                        @error('pizzaImage')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="waitingTime" class="control-label mb-1">Waiting Time</label>
                                        <input  name="waitingTime" type="number" value="{{ old('waitingTime')}}"
                                            class="form-control @error('waitingTime') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time ...">
                                        @error('waitingTime')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="pizzaPrice" class="control-label mb-1">Price</label>
                                        <input  name="pizzaPrice" type="number" value="{{ old('pizzaPrice')}}"
                                            class="form-control @error('pizzaPrice') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Pizza Price...">
                                        @error('pizzaPrice')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount">Create</span>
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
