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
                        
                        <div class="mb-4 col-3 offset-1">
                            <form action="{{ route('admin#orderStatus') }}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <label class="me-3 form-label" for="">Status </label>
                                    <select class="form-control" name="orderStatus" id="orderStatus">
                                        <option value="">All</option>
                                        <option value="0" @if(request('orderStatus')== '0') selected @endif >Pending</option>
                                        <option value="1" @if(request('orderStatus')== '1') selected @endif>Accept</option>
                                        <option value="2" @if(request('orderStatus')== '2') selected @endif>Reject</option>
                                    </select>
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-3">
                            <h5>Total - {{ count($order) }} </h5>
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
                            <tbody id="dataList">
                                @foreach ($order as $o)
                                    <tr>
                                        <input type="hidden" id="orderId" value="{{ $o->id }}">
                                        <td>{{ $o->user_id }}</td>
                                        <td>{{ $o->user_name }}</td>
                                        <td>{{ $o->created_at->format('j-F-Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin#listInfo',$o->order_code)}}" class="text-decoration-none text-primary">{{ $o->order_code }}</a>
                                        </td>
                                        <td>{{ $o->total_price }} Kyats</td>
                                        <td>
                                            <select class="form-control statusChange" name="role">
                                                <option value="" @if($o->status == '') selected @endif>All</option>
                                                <option value="0" @if($o->status == '0') selected @endif>Pending</option>
                                                <option value="1" @if($o->status == '1') selected @endif>Accept</option>
                                                <option value="2" @if($o->status == '2') selected @endif>Reject</option>
                                            </select>
                                        </td>
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

@section('jQuery')
    <script>
        $(document).ready(function() {
            // $("#orderStatus").change(function(){
            //     $status = $('#orderStatus').val();

            //     $.ajax({
            //     type : 'get',
            //     url : '/order/change/status',
            //     data : {
            //         'status' : $status
            //     },
            //     dataType : 'json',
            //     success : function(response){
            //         $list = "";

            //         for($i = 0; $i < response.length; $i ++){

            //             $months = ['January','Febraury','March','April','May','June','July','August','September','October','November','December'];

            //             $dbDate = new Date(response[$i].created_at);

            //             $finalDate = $months[$dbDate.getMonth()]+"-"+$dbDate.getDate()+"-"+$dbDate.getFullYear();

            //             if(response[$i].status == 0){
            //                 $statusMessage = `

        //                         <select name="status" class="form-control statusChange">
        //                             <option value="0" selected >Pending</option>
        //                             <option value="1" >Accept</option>
        //                             <option value="2" >Reject</option>
        //                         </select>
        //             `;
            //             }else if(response[$i].status == 1){
            //                 $statusMessage = `

        //                         <select name="status" class="form-control statusChange">
        //                             <option value="0"  >Pending</option>
        //                             <option value="1" selected>Accept</option>
        //                             <option value="2" >Reject</option>
        //                         </select>
        //             `;
            //             }else if(response[$i].status == 2){
            //                 $statusMessage = `

        //                         <select name="status" class="form-control statusChange">
        //                             <option value="0" >Pending</option>
        //                             <option value="1" >Accept</option>
        //                             <option value="2" selected >Reject</option>
        //                         </select>
        //             `;
            //             }

            //             $list +=   `

        //             <tr>
        //                     <td>${response[$i].user_id}</td>
        //                     <td>${response[$i].user_name}</td>
        //                     <td>${$finalDate}</td>
        //                     <td>${response[$i].order_code}</td>
        //                     <td>${response[$i].total_price} Kyats</td>
        //                     <td>${$statusMessage}</td>
        //             </tr>

        //             `;
            //         }
            //         $('#dataList').html($list);

            //     }

            // })
            // });

            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $oderId = $parentNode.find('#orderId').val();

                $data = {
                    'status': $currentStatus,
                    'oderId': $oderId
                };
                $.ajax({
                    type: 'get',
                    url: '/order/ajax/change/status',
                    data: $data,
                    dataType: 'json',
                })
            })
        });
    </script>
@endsection
