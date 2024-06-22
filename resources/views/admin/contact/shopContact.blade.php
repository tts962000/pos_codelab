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
                    <h3> <i class="fa-solid fa-database me-2"></i>{{count($contacts)}}</h3>
                </div>
              </div>
              @if (count($contacts)!=0)
              <div class="table-responsive table-responsive-data2 mt-3">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                           @foreach ($contacts as $contact)
                           <tr class="tr-shadow">
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->message}}</td>
                            <td>
                                <div class="table-data-feature">
                                   <a href="{{route('admin#deleteContact',$contact->id)}}">
                                    <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                   </a>
                                </div>
                            </td>
                        </tr>
                           @endforeach
                    </tbody>
                </table>
            </div>
              @else
                  <h3>There is No User Contact</h3>
              @endif



                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

