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
                                <h2 class="title-1">Contact List</h2>

                            </div>
                        </div>

                    </div>

                    <div class="row my-2">
                        <div class="col-3">
                            {{-- <h5>Total - {{ $userList->total() }} </h5> --}}
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">

                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Contact Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Contact Time</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($getContact as $cont)
                                <tr>
                                    <td>{{ $cont->name}}</td>
                                    <td>{{ $cont->email}}</td>
                                    <td>{{ $cont->message}}</td>
                                    <td>{{ $cont->created_at->format('d-F-Y')}}</td>
                                    <td>
                                        <a href="{{ route('admin#deleteContact',$cont->id)}}">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{$getContact->links()}}
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection





