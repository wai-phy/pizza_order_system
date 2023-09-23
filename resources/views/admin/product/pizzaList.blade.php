@extends('admin.layouts.master')
@section('title')

@section('title', 'Product List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#CreatePage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    @if (session('deleteSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show col-3 offset-6" role="alert">
                            <i class="fa-solid fa-xmark me-2"></i> {{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-3">
                            <h5><span class="text-muted">Search Key</span>: <span
                                    class="text-danger">{{ request('key') }}</span></h5>
                        </div>
                        <div class="mb-4 col-3 offset-6">
                            <form class="form-header" action="{{ route('product#pizzaPage') }}" method="get">
                                <input class="form-control" type="text" name="key" value="{{ request('key') }}"
                                    placeholder="Search for pizza..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-3">
                            <h5>Total - {{$pizza->total()}} </h5>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">

                        @if (count($pizza)!= 0)
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>View Count</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pizza as $p)
                                <tr class="tr-shadow">
                                    <td class="col-2"><img src="{{asset('storage/'.$p->image)}}" width="100px" class="img-thumbnail"></td>
                                    <td class="col-2">{{$p->name}}</td>
                                    <td class="col-2">{{$p->price}}</td>
                                    <td class="col-2">{{$p->category_name}}</td>
                                    <td class="col-2"><i class="fa-solid fa-eye"></i> {{$p->view_count}}</td>
                                    <td class="col-2">
                                        <div class="table-data-feature">
                                            <a class="mx-2" href="{{route('product#detail',$p->id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="View">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </a>
                                            <a class="mx-2" href="{{route('product#editPage',$p->id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </a>
                                            <a class="mx-2" href="{{route('product#delete',$p->id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr> 
                                <tr class="spacer"></tr>

                                </tr> 
                                @endforeach
                                
                                
                                
                            </tbody>
                        </table>
                        @else
                            <h2 class="text-danger text-center">There Is No Pizza Available .....</h2>
                        @endif
                        <div class="mt-4">
                            {{ $pizza->links()}}
                            {{-- {{ $pizza->appends(request()->query())->links()}} --}}
                        </div>

                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
