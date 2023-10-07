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
                                    placeholder="Search for admin..." />
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
                                        {{-- <th>Role</th> --}}
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
                                            <input type="hidden" id="userId" value="{{$a->id}}">
                                            <td>{{ $a->name }}</td>
                                            <td>{{ $a->email }}</td>
                                            <td>{{ $a->gender }}</td>
                                            <td>{{ $a->phone }}</td>
                                            <td>{{ $a->address }}</td>
                                            
                                            <td class="col-2">
                                                <div class="table-data-feature">
                                                    @if (Auth::user()->id != $a->id)

                                                        <span class="me-2">
                                                            <select class="form-control statusChange" name="role">
                                                                <option value="user" @if($a->role == 'user') selected @endif>User</option>
                                                                <option value="admin" @if($a->role == 'admin') selected @endif>Admin</option>
                                                            </select>
                                                        </span>
                                                        
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

@section('jQuery')
    <script>
        $(document).ready(function() {
           
            $('.statusChange').change(function() {
                $currentStatus = $('.statusChange').val();
                $parentNode = $('.statusChange').parents('tr');
                $userId = $parentNode.find('#userId').val();

                $data = {'userId': $userId, 'role' : $currentStatus };
                $.ajax({
                    type: 'get',
                    url: '/account/role/change',
                    data: $data,
                    dataType: 'json',
                })

                location.reload();
            })
        });
    </script>
@endsection




