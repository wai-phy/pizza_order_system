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
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
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
                            <form class="form-header" action="" method="get">
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
                            <h5>Total - {{ $admin->total()}} </h5>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr class="tr-shadow">
                                        <th>Image</th>
                                        <th>Admin Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admin as $a)
                                        <tr class="tr-shadow">
                                            <td>
                                                @if ($a->image == null)
                                                    @if($a->gender == 'male')
                                                        <img class="img-thumbnail" src="{{ asset('image/user_profile.webp')}}" width="150px">
                                                    @else
                                                        <img class="img-thumbnail" src="{{ asset('image/female_user.jpg')}}" width="150px">
                                                    @endif
                                                @else
                                                    <img class="img-thumbnail" src="{{ asset('storage/'. $a->image)}}" width=" 150px" />
                                                @endif
                                            </td>
                                            <td>{{ $a->name }}</td>
                                            <td>{{ $a->email }}</td>
                                            <td>{{ $a->gender }}</td>
                                            <td>{{ $a->phone }}</td>
                                            <td>{{ $a->address }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    @if (Auth::user()->id != $a->id)

                                                        <a class="mx-2" href="{{ route('admin#roleChange',$a->id)}}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                                title="Change Role">
                                                                <i class="fa-solid fa-right-left"></i>
                                                            </button>
                                                        </a>
                                                        <a class="mx-2" href="{{route('admin#delete',$a->id)}}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                                title="Delete">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </a>
                                                        
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="spacer"></tr>

                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $admin->appends(request()->query())->links()}}
                            </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
