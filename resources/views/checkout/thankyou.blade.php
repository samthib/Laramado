@extends('layouts.master')

@section('content')
    <div class="col-md-8 mt-100">
        <div class="jumbotron text-center">
            <h1 class="display-3">Thank you!</h1>
            <p class="lead"><strong>Your order has been processed successfully</strong></p>
            <hr>
            <p>
                You have a problem? <a href="#">Contact us</a>
            </p>
            <p class="lead">
                <a href="{{ route('product.index') }}" role="button">
                <div class="cart-btn mt-50">
                  <button class="btn amado-btn w-100" id="submit">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i> Continue to the store
                  </button>
                </div>
                </a>
            </p>
        </div>
    </div>
@endsection
