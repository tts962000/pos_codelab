@extends('admin.layouts.master')
@section('title','Category List Page')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
               @if (session('createSuccess'))
               <div class="col-4 offset-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('createSuccess')}} <i class="fa-solid fa-check"></i>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
               </div>
               @endif

               @if (session('deleteSuccess'))
               <div class="col-4 offset-8">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('deleteSuccess')}} <i class="fa-regular fa-circle-xmark"></i>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
               </div>
               @endif
              <div class="row">
                <div class="col-3">
                    <h4 class="text-secondary">Search Key: <span class="text-danger">{{request('key')}}</span></h4>
                </div>
                <div class="col-3 offset-6">
                 <form action="{{route('admin#orderList')}}" method="get">
                     @csrf
                     <div class="row">
                         <div class="d-flex">
                             <input type="text" name="key" class="form-control" placeholder="Search..." value="{{request('key')}}">
                             <button class="btn bg-dark text-white" type="submit">
                                 <i class="fa-solid fa-magnifying-glass"></i>
                             </button>
                         </div>
                     </div>
                 </form>
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-1 offset-10 bg-white shadow-sm p-1 my-1 text-center">
                    <h3> <i class="fa-solid fa-database me-2"></i>{{count($order)}}</h3>
                </div>
              </div>

              <form action="{{route('admin#changeStatus')}}" method="get">
                @csrf
                <div class="d-flex">
                    <label for="" class="" style="margin-right:15px;margin-top:5px;">Filter Orders</label>
                    <select name="orderStatus" class="form-control col-2">
                        <option value="">All</option>
                        <option value="0" @if (request('orderStatus')=='0') selected
                        @endif>Pending</option>
                        <option value="1" @if (request('orderStatus')=='1') selected
                        @endif>Success</option>
                        <option value="2" @if (request('orderStatus')=='2') selected
                        @endif>Reject</option>
                    </select>
                    <button type="submit" class="btn btn-sm me-3 bg-dark text-white"><i class="fa-solid fa-magnifying-glass me-3"></i>Search</button>
                    <div class="col-2 mt-1">
                        <h3> <i class="fa-solid fa-database"></i>{{count($order)}}</h3>
                    </div>
                </div>
              </form>
               @if (count($order)!=0)
               <div class="table-responsive table-responsive-data2 mt-3">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>User Name</th>
                            <th>Order Date</th>
                            <th>Order Code</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                            @foreach ($order as $o)
                            <tr class="tr-shadow">
                                <input type="hidden" name="" class="orderId" value="{{$o->id}}">
                                <td>{{$o->user_id}}</td>
                                <td>{{$o->user_name}}</td>
                                <td>{{$o->created_at->format('F-j-Y')}} </td>
                                <td>
                                    <a href="{{route('admin#listInfo',$o->order_code)}}" class="text-primary">{{$o->order_code}}</a>
                                </td>
                                <td>{{$o->total_price}} Kyats</td>
                                <td>
                                    <select name="status" class="form-control statusChange">
                                        <option value="0" @if ($o->status==0) selected @endif >Pending</option>
                                        <option value="1" @if ($o->status==1) selected @endif>Success</option>
                                        <option value="2" @if ($o->status==2) selected @endif>Reject</option>
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>


            </div>
            @else
            <h3>There is no Data!</h3>
               @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptSource')
<script>
    $(document).ready(function(){
        // $('#orderStatus').change(function(){
        //     $status=$('#orderStatus').val();
        //     // console.log($status);
        //     $.ajax({
        //         type: 'get' ,
        //         url: 'http://localhost:8000/order/ajax/status',
        //         data: {
        //             'status':$status
        //         },
        //         datatype: 'json',
        //         success: function(response){
        //             // console.log(response);
        //             //append
        //             $list="";
        //             for($i=0;$i<response.length;$i++){
        //                 $months=['January','February','March','April','May','June','July',
        //                          'August','September','October','November','December'];
        //                 // console.log(`${response[$i].name}`)
        //                 $dbDate=new Date(response[$i].created_at);
        //                 $finalDate=$months[$dbDate.getMonth()]+"-"+$dbDate.getDate() +"-"+$dbDate.getFullYear();
        //                 if(response[$i].status==0){
        //                     $statusMessage=`
        //                     <select name="status" class="form-control statusChange">
        //                                 <option value="0" selected>Pending</option>
        //                                 <option value="1">Success</option>
        //                                 <option value="2">Reject</option>
        //                             </select>
        //                     `;
        //                 }else if(response[$i].status==1){
        //                     $statusMessage=`
        //                     <select name="status" class="form-control statusChange">
        //                                 <option value="0">Pending</option>
        //                                 <option value="1" selected>Success</option>
        //                                 <option value="2">Reject</option>
        //                             </select>
        //                     `;
        //                 }else if(response[$i].status==2){
        //                     $statusMessage=`
        //                     <select name="status" class="form-control statusChange">
        //                                 <option value="0">Pending</option>
        //                                 <option value="1">Success</option>
        //                                 <option value="2" selected>Reject</option>
        //                             </select>
        //                     `;
        //                         }
        //                 $list+=`
        //                 <tr class="tr-shadow">
        //                     <input type="hidden" name="" class="orderId" value="${response[$i].id}">
        //                         <td>${response[$i].user_id}</td>
        //                         <td>${response[$i].user_name}</td>
        //                         <td>${$finalDate} </td>
        //                         <td>${response[$i].order_code}</td>
        //                         <td>${response[$i].total_price} Kyats</td>
        //                         <td>
        //                            ${$statusMessage}
        //                         </td>
        //                     </tr>
        //                 `;
        //             }
        //             $('#dataList').html($list);
        //         }
        //     })
        // })
        //changeStatus
        $('.statusChange').change(function(){
        $currentStatus=$(this).val();
        $parentNode=$(this).parents("tr");
        $orderId=$parentNode.find('.orderId').val();
        // console.log($parentNode.find('.amount').html());
        $data={
            'status':$currentStatus,
            'orderId':$orderId
        };
        // console.log($data);
        $.ajax({
                type: 'get' ,
                url: 'http://localhost:8000/order/ajax/change/status',
                data: $data,
                datatype: 'json',
                })
                // location.reload();
        })
    })
</script>
@endsection
