@extends('admin.layouts.master')
@section('title','Category List Page')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12 col-sm-12">
                <!-- DATA TABLE -->
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
                    <h3> <i class="fa-solid fa-database me-2"></i>{{$users->total()}}</h3>
                </div>
              </div>
               <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr class="tr-shadow">
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody id="dataList col-12">
                        @foreach ($users as $user)
                        <tr class="tr-shadow">
                            <td class="col-1">
                                @if ($user->image==null)
                                    @if ($user->gender=='male')
                                        <img src="{{ asset('image/usermale.jpg') }}" class="">
                                    @else
                                        <img src="{{ asset('image/userfemale.jpg') }}" class="">
                                    @endif
                                @else
                                <img src="{{ asset('storage/'.$user->image) }}" class="">
                                @endif</td>
                                <input type="hidden" id="userId" value="{{$user->id}}">
                            <td class="col-1">{{$user->name}}</td>
                            <td class="col-1">{{$user->email}}</td>
                            <td class="col-1">{{$user->gender}}</td>
                            <td class="col-1">{{$user->phone}}</td>
                            <td class="col-1">{{$user->address}}</td>
                            <td class="col-1">
                                <select name="" id="" class="form-control statusChange">
                                    <option value="user" @if ($user->role=='user') selected
                                    @endif>User</option>
                                    <option value="admin" @if ($user->role=='admin') selected
                                        @endif>Admin</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-5">
                    {{$users->links()}}
                </div>

            </div>

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptSource')
<script>
    $(document).ready(function(){
        $('.statusChange').change(function(){
        $currentStatus=$(this).val();
        $parentNode=$(this).parents("tr");
        $userId=$parentNode.find('#userId').val();
        // console.log($parentNode.find('.amount').html());
        $data={'userId':$userId,'role':$currentStatus};
        // console.log($data);
        $.ajax({
                type: 'get' ,
                url: 'http://localhost:8000/user/change/role',
                data: $data,
                datatype: 'json',
                })
                location.reload();
        })
    })
</script>
@endsection


