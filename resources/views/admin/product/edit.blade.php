@extends('admin.layouts.master')
@section('title','Category List Page')
@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-3 offset-7 mb-2">
            @if (session('updateSuccess'))
            <div class="">
             <div class="alert alert-success alert-dismissible fade show" role="alert">
                 {{session('updateSuccess')}} <i class="fa-solid fa-check"></i>
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
            </div>
            @endif
        </div>
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-5">
                            {{-- <a href="{{route('product#list')}}" class="text-decoration-none text-dark"> --}}
                                <i class="fa-solid fa-backward text-dark" onclick="history.back()"></i>
                            {{-- </a> --}}
                        </div>
                        <div class="card-title">
                            {{-- <h3 class="text-center title-2">Account Info</h3> --}}
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-2">

                                <img src="{{asset('storage/'.$pizza->image)}}" class="img-thumbnail" />

                            </div>
                            <div class="col-7">
                                <h3 class="my-3 btn bg-danger fs-5 text-white b d-block w-50"><i class="fa-solid fa-pizza-slice me-2"></i>{{$pizza->name}}</h3>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-sack-dollar me-2"></i>{{$pizza->price}} Kyats </span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-clock me-2"></i>{{$pizza->waiting_time}} mins </span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-eye me-2"></i>{{$pizza->view_count}}</span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid fa-link me-2"></i>{{$pizza->category_name}}</span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-calendar-days me-2"></i>{{$pizza->created_at->format('j-F-Y')}}</span>
                                <div class="my-3"><i class="fa-solid fs-5 fa-file-lines me-2"></i> Details </div>
                                <div class="">{{$pizza->description}}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
