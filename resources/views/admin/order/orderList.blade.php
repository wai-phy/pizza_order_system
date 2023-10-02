@extends('admin.layouts.master')
@section('title')

@section('title', 'Order List')

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
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <h5><span class="text-muted">Search Key</span>: <span
                                    class="text-danger">{{ request('key') }}</span></h5>
                        </div>
                        <div class="mb-4 col-3 offset-6">
                            <div class="d-flex">
                                <label class="me-3 form-label" for="">Status </label>
                                <select class="form-control mb-4" name="" id="">
                                    <option value="">All</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Accept</option>
                                    <option value="2">Reject</option>
                                </select>
                            </div>
                            <div class="">
                                <form class="form-header" action="{{ route('admin#orderList') }}" method="get">
                                    <input class="form-control" type="text" name="key" value="{{ request('key') }}"
                                        placeholder="Search for Order..." />
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-3">
                            <h5>Total - {{$order->total()}} </h5>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">

                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Date</th>
                                    <th>Order Code</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $o)
                                <tr>
                                    <td>{{$o->user_id}}</td>
                                    <td>{{$o->user_name}}</td>
                                    <td>{{$o->created_at->format('j-F-Y')}}</td>
                                    <td>{{$o->order_code}}</td>
                                    <td>{{$o->total_price}} Kyats</td>
                                    <td>
                                        <select name="status" class="form-control">
                                            <option value="0" @if($o->status == 0) selected @endif  >Pending</option>
                                            <option value="1" @if($o->status == 1) selected @endif  >Accept</option>
                                            <option value="2" @if($o->status == 2) selected @endif  >Reject</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="mt-4">
                            {{-- {{ $order->links()}} --}}
                            {{ $order->appends(request()->query())->links()}}
                        </div>

                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
