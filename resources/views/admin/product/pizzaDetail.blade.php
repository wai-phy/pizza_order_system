@extends('admin.layouts.master')

@section('title', 'Profile Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="col-lg-9 offset-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="">
                                    {{-- <a class="text-decoration-none text-success" href="{{ route('product#pizzaPage')}}"> --}}
                                        <h5><i class="fa-solid fa-circle-left" onclick="history.back()"> Back</i>  </h5>
                                    {{-- </a> --}}
                                </div>
                                <div class="card-title">
                                    <h2 class="text-center title-2"><b>Product Detail</b></h2>
                                </div>
                                <hr>
                                <div class="row my-5">
                                    <div class="col-4 offset-1">
                                        <div class="image">
                                            <img src="{{ asset('storage/'. $pizza->image)}}" alt="John Doe" />
                                        </div>
                                    </div>
                                    <div class="col-7">
                                            <h2 class="my-2 "><i class="fa-solid fa-pizza-slice me-2"></i><b><strong> {{ $pizza->name }}</strong></b></h2>
                                            <span class="my-2 btn btn-dark text-white"><i class="fa-solid fa-clock"></i> {{ $pizza->waiting_time }}</span>
                                            <span class="my-2 btn btn-dark text-white"><i class="fa-solid fa-comments"></i> {{ $pizza->category_name }}</span>
                                            <span class="my-2 btn btn-dark text-white"><i class="fa-solid fa-eye"></i> {{ $pizza->view_count }} </span>
                                            <span class="my-2 btn btn-dark text-white"><i class="fa-solid fa-sack-dollar"></i> {{ $pizza->price }}Ks</span>
                                            <span class="my-2 btn btn-dark text-white"><i class="fa-solid fa-calendar-days"></i> {{ $pizza->created_at->format('d.F.Y') }}</span>
                                            <h4 class="my-2 "><i class="fa-solid fa-file-lines"></i> detail</h4>
                                            <span class="my-2 ">{{ $pizza->description }}</span>
                                            <br><br><br>
                                            <div class="row mt-5">
                                                <a class="" href="{{ route('product#editPage',$pizza->id)}}">
                                                    <button class="btn btn-dark" type="submit">Edit Pizza</button>
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
