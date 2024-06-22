@extends('user.layouts.master')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Contact Page</h3>
                        </div>
                        <hr>
                       <form action="{{route('user#ContactCreate')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="contactName" type="text" value="" class="form-control @error('contactName')
                                    is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Name...">
                                    @error('contactName')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Email</label>
                                    <input id="cc-pament" name="contactEmail" type="text" value="" class="form-control @error('contactEmail') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Email">
                                    @error('contactEmail')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                                {{-- <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Phone</label>
                                    <input id="cc-pament" name="contactPhone" type="number" value="" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Your Phone">
                                </div> --}}
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Message</label>
                                    <textarea name="contactMessage" class="form-control  @error('contactMessage')
                                    is-invalid @enderror" cols="30" rows="10" placeholder="Enter Your Feedback"></textarea>
                                    @error('contactMessage')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block btn-warning">
                                        <span id="payment-button-amount">Submit</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-4">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.963801434193!2d96.15257971481813!3d16.828151788416072!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c19356570c3721%3A0xdee582037d200c1c!2sThe%20Pizza%20Company!5e0!3m2!1sen!2smm!4v1673376824035!5m2!1sen!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                <div class=""><i class="fa-solid fa-phone me-2 text-warning"></i> Our Phone Number : 09763755256</div>
                                <div class=""><i class="fa-solid fa-location-arrow me-2 text-warning"></i> Our Location : Myanmar Plaza</div>
                                <div class=""><i class="fa-solid fa-globe text-warning me-2"></i> Our Officical Page :
                                    <span class="">
                                       <a class="text-dark" href="http://thepizzacompany-myanmar.com/">http://thepizzacompany-myanmar.com/</a>
                                    </span></div>
                                </div>
                         </div>
                        </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
