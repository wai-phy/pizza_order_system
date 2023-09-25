
@extends('user.layouts.master')

@section('content')
        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
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
                                    <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;"> {{$cart->product_name}}</td>
                                    <td class="align-middle" >{{$cart->product_price}} ks</td>
                                    <input type="hidden" id="price" value="{{$cart->product_price}}">
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
                                <h5>{{$totalPrice + 3000}} Ks</h5>
                            </div>
                            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->
@endsection

@section('jqeurySource')
    <script>
        $(document).ready(function(){
            $(".btn-plus").click(function(){
                $parentNode = $(this).parents('tr')
                $price =$parentNode.find('#price').val();
                $qty = Number($parentNode.find('#qty').val()) ;

                $total = $price * $qty;

                $parentNode.find('#total').html($total + " Kyats");

            })
            $(".btn-minus").click(function(){
                $parentNode = $(this).parents('tr')
                $price =$parentNode.find('#price').val();
                $qty = Number($parentNode.find('#qty').val());

                $total = $price * $qty;

                $parentNode.find('#total').html($total + " Kyats");
            })

            $(".btnRemove").click(function(){
                $parentNode = $(this).parents('tr')
                $parentNode.remove();
            })
        })

    </script>
@endsection


