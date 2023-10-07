
@extends('user.layouts.master')

@section('content')
        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                    <table id="dataTable" class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th></th>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                       
                                @foreach ($cartList as $cart)
                                <tr>
                                    <td> <img src="{{ asset('storage/'.$cart->product_image)}}" class="img-thumbnail shadow-sm" style="width: 100px;"></td>
                                    <td class="align-middle">{{$cart->product_name}}</td>
                                    <td class="align-middle" id="price" >{{$cart->product_price}} Ks</td>
                                    <input type="hidden" id="cartId" value="{{$cart->id}}">
                                    <input type="hidden" id="userId" value="{{$cart->user_id}}">
                                    <input type="hidden" id="productId" value="{{$cart->product_id}}">
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus" >
                                                <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center"  value="{{$cart->qty}}" id="qty"> 
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle" id="total">{{ $cart->product_price * $cart->qty}} Ks</td>
                                    <td class="align-middle"><button class="btn btn-sm btnRemove btn-danger"><i class="fa fa-times"></i></button></td>
                                </tr>
                                @endforeach
                     
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6 id="subTotal">{{$totalPrice}} Ks</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Delivery</h6>
                                <h6 class="font-weight-medium">3000 Ks</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5 id="finalPrice">{{$totalPrice + 3000}} Ks</h5>
                            </div>
                            <button id="proceedBtn" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                            <button id="clearBtn" class="btn btn-block btn-danger font-weight-bold my-3 py-3">Cancel Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->
@endsection

@section('jqeurySource')
    <script src="{{ asset('js/cart.js')}}"></script>

    <script>
        $('#proceedBtn').click(function(){
            
            $orderList = []
            $random = Math.floor(Math.random() * 10000001)
            $('#dataTable tbody tr').each(function(index,row){

                $orderList.push({
                    'user_id' : $(row).find('#userId').val(),
                    'product_id' : $(row).find('#productId').val(),
                    'qty' : $(row).find('#qty').val(),
                    'total' : $(row).find('#total').text().replace('Ks','')*1,
                    'order_code' : "POS"+$random
                })

                    

            })

            $.ajax({
                    type : 'get',
                    url : '/user/ajax/order',
                    data : Object.assign({}, $orderList),
                    dataType : 'json',
                    success : function(response){
                       console.log(response.status);
                        if(response.status == 'true'){
                            window.location.href = '/user/home';
                        }
                    }
                })
            
        })

        $('#clearBtn').click(function(){

            $('#dataTable tbody tr').remove();
            $('#subTotal').html('0 Ks')
            $('#finalPrice').html('3000 Ks')

            $.ajax({
                    type : 'get',
                    url : '/user/ajax/clear/cart',
                    dataType : 'json',
                
                })

        })

        $(".btnRemove").click(function(){
        $parentNode = $(this).parents('tr');
        $cartId = $parentNode.find('#cartId').val();
        $productId = $parentNode.find('#productId').val();
        $.ajax({
                    type : 'get',
                    url : '/user/ajax/clear/current/cart',
                    data : {'cartId' : $cartId , 'productId' : $productId},
                    dataType : 'json',
                
                })
        $parentNode.remove();

        $totalPrice = 0;
        $("#dataTable tr").each(function(index,row){
            $totalPrice +=Number($(row).find('#total').text().replace('Ks',''));
            
        })
        $('#subTotal').html(`${$totalPrice} Kyats`)
        $('#finalPrice').html(`${$totalPrice+3000} Kyats`)
    })
    </script>
@endsection


