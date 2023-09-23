@extends('admin.layouts.master')

@section('title', 'Profile Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="col-lg-8 offset-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="">
                                    {{-- <a class="text-decoration-none text-success" href="{{ route('product#pizzaPage')}}"> --}}
                                        <h5><i class="fa-solid fa-circle-left" onclick="history.back()"> Back</i>  </h5>
                                    {{-- </a> --}}
                                </div>
                                <div class="card-title">
                                    <h2 class="text-center title-2"><b>Pizza Edit</b></h2>
                                </div>
                                <hr>
                                <form action="{{ route('product#update')}}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row my-5">
                                        <div class="col-4 offset-1">
                                            <div class="pizzaImage">
                                                 <img src="{{ asset('storage/' . $pizza->image) }}" alt="John Doe" />
                                                <div class="form-group mt-4">
                                                    <input name="pizzaImage" type="file"
                                                        class="form-control  @error('pizzaImage') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false">
                                                    @error('pizzaImage')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 offset-1">

                                            <div class="row">
                                                <div class="form-group">
                                                    <input type="hidden" value="{{$pizza->id}}" name="pizzaId">
                                                    <label for="pizzaName" class="control-label mb-1">Pizza Name</label>
                                                    <input id="cc-pament" name="pizzaName"
                                                        value="{{ old('pizzaName', $pizza->name) }}" type="text"
                                                        class="form-control  @error('pizzaName') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter Name...">
                                                    @error('pizzaName')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="pizzaPrice" class="control-label mb-1">Price</label>
                                                    <input id="cc-pament" name="pizzaPrice"
                                                        value="{{ old('pizzaPrice', $pizza->price) }}" type="pizzaPrice"
                                                        class="form-control  @error('pizzaPrice') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter Price...">
                                                    @error('pizzaPrice')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="waitingTime" class="control-label mb-1">Waiting Time</label>
                                                    <input id="cc-pament" name="waitingTime"
                                                        value="{{ old('waitingTime', $pizza->waiting_time) }}" type="number"
                                                        class="form-control  @error('waitingTime') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter Waiting Time...">
                                                    @error('waitingTime')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="pizzaDescription" class="control-label mb-1">Description </label>
                                                    <textarea name="pizzaDescription" id="" cols="10" rows="3"
                                                        class="form-control  @error('pizzaDescription') is-invalid @enderror" placeholder="Enter Description...">{{ old('pizzaDescription', $pizza->description) }}</textarea>
                                                    @error('pizzaDescription')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="pizzaCategory" class="control-label mb-1">Category</label>
                                                    <select name="pizzaCategory"
                                                        class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                        <option value="">Choose Category</option>
                                                        @foreach ($categories as $c)
                                                            <option value="{{ $c->id }}" @if ($pizza->category_id == $c->id) selected @endif>{{ $c->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('pizzaCategory')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="viewCount" class="control-label mb-1">View Count </label>
                                                    <input type="text" name="viewCount"
                                                        value="{{ old('viewCount', $pizza->view_count) }}" class="form-control "
                                                        disabled>
                                                </div>
                                                <a class="" href="">
                                                    <button class="btn px-5 btn-dark" type="submit"> Update</button>
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
