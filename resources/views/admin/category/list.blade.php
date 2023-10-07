@extends('admin.layouts.master')
@section('title')

@section('title', 'Category List')

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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>
                        </div>
                    </div>

                    @if (session('deleteSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show col-3 offset-6" role="alert">
                            <i class="fa-solid fa-xmark"></i>{{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-3">
                            <h5><span class="text-muted">Search Key</span>: <span class="text-danger">{{request('key')}}</span></h5>
                        </div>
                        <div class="mb-4 col-3 offset-6">
                            <form class="form-header" action="{{ route('category#list')}}" method="get">
                                <input class="form-control" type="text" name="key" value="{{ request('key')}}"
                                    placeholder="Search for category..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-3">
                            <h5>Total - {{ $categories->total()}} </h5>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        @if (count($categories))
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Created At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('d-F-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a class="mx-2" href="{{ route('category#edit',$category->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>
                                                    <a class="mx-2" href="{{ route('category#delete', $category->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="spacer"></tr>

                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{-- {{ $categories->links() }} --}}
                                {{ $categories->appends(request()->query())->links()}}
                            </div>
                        @else
                            <h3 class="text-danger text-center mt-5">There is No Category Here!!</h3>
                        @endif
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
