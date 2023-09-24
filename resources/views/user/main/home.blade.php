

@extends('user.layouts.master')

@section('content')

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex bg-dark px-4 py-2 text-white align-items-center justify-content-between mb-3">
                            <label class="" for="price-all">Categories</label>
                            <span class="badge bg-dark text-white border font-weight-normal">{{count($category)}}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="{{route('user#home')}}" class="text-dark shadow-sm col-12"><label class="" for="price-1">All</label></a>
                        </div>
                        @foreach ($category as $c)
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="{{route('filter#pizza',$c->id)}}" class="text-dark shadow-sm col-12"><label class="" for="price-1">{{$c->name}}</label></a>
                        </div>
                        @endforeach

                    </form>
                </div>
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->

             <!-- Shop Product Start -->
                <div class="col-lg-9 col-md-8">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                    <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                                </div>
                                <div class="ml-2">
                                    <div class="btn-group">
                                        <select name="sortin" id="sortingOption">
                                            <option value="">Choose Option ...</option>
                                            <option value="asc">Ascending</option>
                                            <option value="desc">Descending</option>
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                           <span class="row" id="dataList">
                            @if (count($pizza) != 0)
                            @foreach ($pizza as $p)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/'.$p->image)}}" style="height: 250px">
                                    <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="{{ route('pizza#DetailPage',$p->id)}}"><i class="fa-solid fa-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{$p->price}} kyats</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                                <h3 class="text-center mt-5">There is No Pizza !!<i class="fa-solid fa-pizza-slice ms-3"></i></h3>
                            @endif
                           </span>
                    </div>
                </div>
                <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
    
@endsection

@section('jqeury')
    

@endsection