@extends('admin.layouts.master')
@section('title','Category List Page')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('category#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="fa-solid fa-plus"></i>Add Category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
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
                 <form action="{{route('admin#list')}}" method="get">
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
                    <h3> <i class="fa-solid fa-database"></i> {{$admin->total()}} </h3>
                </div>
              </div>

                {{-- @if (count($categories)!=0) --}}
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($admin as $a)
                           <tr class="tr-shadow">
                            <td class="col-2">
                                @if ($a->image==null)
                                    @if ($a->gender=='male')
                                        <img src="{{ asset('image/usermale.jpg') }}" class="">
                                    @else
                                        <img src="{{ asset('image/userfemale.jpg') }}" class="">
                                    @endif
                                @else
                                <img src="{{ asset('storage/'.$a->image) }}" class="">
                                @endif</td>
                            <td>{{$a->name}}</td>
                            <td>{{$a->email}}</td>
                            <td>{{$a->gender}}</td>
                            <td>{{$a->phone}}</td>
                            <td>{{$a->address}}</td>
                            <input type="hidden" id="adminId" value="{{$a->id}}">
                            <td>
                                <div class="table-data-feature">
                                    @if (Auth::user()->id == $a->id)
                                    @else
                                    <a href="{{route('admin#changeRole',$a->id)}}" class="roleChange"
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Change Admin Role">
                                            <i class="fa-solid fa-arrows-rotate me-1"></i>
                                        </button>
                                    </a>
                                        <a href="{{route('admin#delete',$a->id)}}"
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                    @endif
                                   {{-- <a href="@if (Auth::user()->id == $a->id)
                                    #
                                   @else
                                     {{route('admin#delete')}}
                                   @endif">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                   </a> --}}
                                </div>
                            </td>
                           </tr>
                           @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$admin->links()}}
                        {{-- {{$categories->appends(request()->query())->links()}} --}}
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
        $('.roleChange').click(function(){
       $currentStatus=$(this).val();
       $parentNode=$(this).parents("tr");
       $adminId=$parentNode.find('#adminId').val();
       $data={
           'adminId':$adminId,
           'role':$currentStatus
       };
       $.ajax({
           type:'get',
           url:'/admin/change/roles',
           data:$data,
           dataType:'json',
       })
       location.reload();
    })
})
    </script>
@endsection
