@extends('admin.layouts.master')
@section('title')

@section('title', 'User List')

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
                                <h2 class="title-1">User List</h2>

                            </div>
                        </div>

                    </div>

                    <div class="row my-2">
                        <div class="col-3">
                            <h5>Total - {{ $userList->total() }} </h5>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">

                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($userList as $user)
                                <tr>
                                    <td>
                                        @if ($user->image == null)
                                        @if($user->gender == 'male')
                                            <img class="img-thumbnail" src="{{ asset('image/user_profile.webp')}}" width="120px">
                                        @else
                                            <img class="img-thumbnail" src="{{ asset('image/female_user.jpg')}}" width="120px">
                                        @endif
                                        @else
                                            <img class="img-thumbnail" src="{{ asset('storage/'. $user->image)}}" width=" 120px" />
                                        @endif
                                    </td>
                                    <input type="hidden" id="userId" value="{{ $user->id}}">
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->gender}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->address}}</td>
                                    <td>
                                        <select class="form-control statusChange" name="role">
                                            <option value="user" @if($user->role == 'user') selected @endif>User</option>
                                            <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin#deleteUser',$user->id)}}">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{$userList->links()}}
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
                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();

                $data = {'userId': $userId, 'role' : $currentStatus };
                $.ajax({
                    type: 'get',
                    url: '/user/change/role',
                    data: $data,
                    dataType: 'json',
                })

                location.reload();
            })
        });
    </script>
@endsection



