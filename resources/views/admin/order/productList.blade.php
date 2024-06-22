@extends('admin.layouts.master')
@section('title','Category List Page')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-12 col-md-12">
               <div class="table-responsive table-responsive-data2 mt-3">
                <a href="{{route('admin#orderList')}}" class="text-dark">
                    <i class="fa-solid fa-circle-arrow-left"></i>Back
                </a>
                <div class="row col-5">
                    <div class="card mt-4">
                        <div class="card-body">
                            <h3> <i class="fa-regular fa-clipboard me-3"></i>Order Info</h3>
                            <small class="text-warning"><i class="fa-solid fa-triangle-exclamation me-2"></i>Include Delivery Charges</small>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-user me-3"></i>Customer</div>
                                <div class="col">{{strtoupper($orderList[0]->user_name)}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-barcode me-3"></i>Order Code</div>
                                <div class="col">{{$orderList[0]->order_code}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-regular fa-clock me-3"></i>Order Date</div>
                                <div class="col">{{$orderList[0]->created_at}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-money-bill me-3"></i>Total Price</div>
                                <div class="col">{{$order->total_price}} Kyats</div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Order Id</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Order Date</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                        @foreach ($orderList as $o)
                        <tr class="tr-shadow">
                            <td></td>
                            <td>{{$o->id}}</td>
                            <td><img src="{{url('image/'.$o->product_image)}}" class="w-50 img-thumbnail"></td>
                            <td>{{$o->product_name}}</td>
                            <td>{{$o->created_at->format('F-j-Y')}}</td>
                            <td>{{$o->qty}}</td>
                            <td>{{$o->total}}</td>
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
@endsection

