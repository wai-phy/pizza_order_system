@extends('admin.layouts.master')
@section('title')

@section('title', 'Order_List Information')

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
                                <h2 class="title-1"><b>Order_List Information</b></h2>

                            </div>
                        </div>

                    </div>
                    <div class="card col-5">
                        <div class="card-header">
                            <h4>Order Info</h4>
                            <small class="text-warning"><i class="fa-solid fa-triangle-exclamation me-2"></i> Include Delivery Fee</small>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col"><i class="fa-solid fa-user me-3"></i>Name :</div>
                                <div class="col">{{$orderList[0]->user_name}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><i class="fa-regular fa-clipboard me-3"></i>Order Code :</div>
                                <div class="col">{{$orderList[0]->order_code}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><i class="fa-solid fa-sack-dollar me-3"></i> Total Price :</div>
                                <div class="col">{{$order->total_price}} Kyats</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><i class="fa-regular fa-clock me-3"></i> Order Date :</div>
                                <div class="col">{{$orderList[0]->created_at->format('d-F-Y')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <div class="mb-3">
                            <h5><a href="{{route('admin#orderList')}}" class="text-decoration-none"><i class="fa-solid fa-angles-left"></i> Back</a></h5>
                        </div>
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderList as $o)
                                    <tr>
                                        <td>{{ $o->id }}</td>
                                        <td>
                                            <img src="{{ asset('storage/'.$o->product_image) }}" class="img-thumbnail shadow-sm" style="height:80px;">
                                        </td>
                                        <td>{{$o->product_name}} </td>
                                        <td>{{$o->qty}}</td>
                                        <td>{{ $o->total }} Kyats</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

