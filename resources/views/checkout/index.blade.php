@extends('layouts.master')

@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('extra-script')
  <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
  <div class="cart-table-area section-padding-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-lg-8">
          <div class="checkout_details_area mt-50 clearfix">

            <div class="cart-title">
              <h2>Checkout</h2>
            </div>

            <form action="#" method="post">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <input type="text" class="form-control" id="first_name" value="" placeholder="First Name" required>
                </div>
                <div class="col-md-6 mb-3">
                  <input type="text" class="form-control" id="last_name" value="" placeholder="Last Name" required>
                </div>
                <div class="col-12 mb-3">
                  <input type="text" class="form-control" id="company" placeholder="Company Name" value="">
                </div>
                <div class="col-12 mb-3">
                  <input type="email" class="form-control" id="email" placeholder="Email" value="">
                </div>
                <div class="col-12 mb-3">
                  <select class="w-100" id="country">
                    <option value="usa">United States</option>
                    <option value="uk">United Kingdom</option>
                    <option value="ger">Germany</option>
                    <option value="fra">France</option>
                    <option value="ind">India</option>
                    <option value="aus">Australia</option>
                    <option value="bra">Brazil</option>
                    <option value="cana">Canada</option>
                  </select>
                </div>
                <div class="col-12 mb-3">
                  <input type="text" class="form-control mb-3" id="street_address" placeholder="Address" value="">
                </div>
                <div class="col-12 mb-3">
                  <input type="text" class="form-control" id="city" placeholder="Town" value="">
                </div>
                <div class="col-md-6 mb-3">
                  <input type="text" class="form-control" id="zipCode" placeholder="Zip Code" value="">
                </div>
                <div class="col-md-6 mb-3">
                  <input type="number" class="form-control" id="phone_number" min="0" placeholder="Phone No" value="">
                </div>
                <div class="col-12 mb-3">
                  <textarea name="comment" class="form-control w-100" id="comment" cols="30" rows="10" placeholder="Leave a comment about your order"></textarea>
                </div>

                {{-- <div class="col-12">
                <div class="custom-control custom-checkbox d-block mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck2">
                <label class="custom-control-label" for="customCheck2">Create an accout</label>
              </div>
              <div class="custom-control custom-checkbox d-block">
              <input type="checkbox" class="custom-control-input" id="customCheck3">
              <label class="custom-control-label" for="customCheck3">Ship to a different address</label>
            </div>
          </div> --}}
        </div>
      </form>
    </div>
  </div>
  <div class="col-12 col-lg-4">
    <div class="cart-summary">
      <h5>Cart Total</h5>
      <ul class="summary-table">
        <li><span>subtotal:</span> <span>{{ getPrice(Cart::subtotal()) }}</span></li>
        {{-- <li><span>delivery:</span> <span>Free</span></li> --}}
        <li><span>tax:</span> <span>{{ getPrice(Cart::tax()) }}</span></li>
        <li><span>total:</span> <span>{{ getPrice(Cart::total()) }}</span></li>
      </ul>

      {{-- <div class="payment-method">
      <!-- Cash on delivery -->
      <div class="custom-control custom-checkbox mr-sm-2">
      <input type="checkbox" class="custom-control-input" id="cod" checked>
      <label class="custom-control-label" for="cod">Cash on Delivery</label>
    </div>
    <!-- Paypal -->
    <div class="custom-control custom-checkbox mr-sm-2">
    <input type="checkbox" class="custom-control-input" id="paypal">
    <label class="custom-control-label" for="paypal">Paypal <img class="ml-15" src="img/core-img/paypal.png" alt=""></label>
  </div>
</div> --}}

{{-- <div class="cart-btn mt-100">
<a href="#" class="btn amado-btn w-100">Checkout</a>
</div> --}}

<a href="{{ route('cart.index') }}">
  <button type="button" name="button"  class="btn btn-sm btn-secondary my-3">Back to cart</button>
</a>

<form action="{{ route('checkout.store') }}" method="POST" class="my-4" id="payment-form">
  @csrf
  <div id="card-element">
    <!-- Elements will create input elements here -->
  </div>
  <!-- We'll put the error messages in this element -->
  <div id="card-errors" role="alert"></div>
  <div class="cart-btn mt-50">
    <button class="btn amado-btn w-100" id="submit">
      <i class="fa fa-credit-card" aria-hidden="true"></i> Pay now ({{ getPrice($total) }})
    </button>
  </div>
</form>

<hr>
<div class="mt-3">
  <h5>Fake Test Card</h5>
  <p>Card Number: 4242 4242 4242 4242</p>
  <p>Expiration Date: min. Today</p>
  <p>CVC: 123</p>
  <p>Zip: 75000</p>
</div>


</div>
</div>
</div>
</div>
</div>
@endsection

@section('extra-js')
  <script>
  //Suppression de la barre de navigation
  // document.getElementsByClassName('blog-header')[0].classList.add("d-none");
  // document.getElementsByClassName('nav-scroller')[0].classList.add("d-none");

  // Paiement Stripe
  var stripe = Stripe('pk_test_rQ4KldW0nyPW206Uz7fTotqT');
  var elements = stripe.elements();
  // var style = {
  //   base: {
  //     color: "#32325d",
  //     fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
  //     fontSmoothing: "antialiased",
  //     fontSize: "16px",
  //     "::placeholder": {
  //       color: "#aab7c4"
  //     }
  //   },
  //   invalid: {
  //     color: "#fa755a",
  //     iconColor: "#fa755a"
  //   }
  // };
  var card = elements.create("card" /*, { style: style }*/);
  card.mount("#card-element");
  card.addEventListener('change', ({error}) => {
    const displayError = document.getElementById('card-errors');
    if (error) {
      displayError.classList.add('alert', 'alert-warning', 'mt-3');
      displayError.textContent = error.message;
    } else {
      displayError.classList.remove('alert', 'alert-warning', 'mt-3');
      displayError.textContent = '';
    }
  });

  var submitButton = document.getElementById('submit');

  submitButton.addEventListener('click', function(ev) {
    ev.preventDefault();
    submitButton.disabled = true;
    stripe.confirmCardPayment("{{ $clientSecret }}", {
      payment_method: {
        card: card
      }
    }).then(function(result) {
      if (result.error) {
        // Show error to your customer (e.g., insufficient funds)
        submitButton.disabled = false;
        console.log(result.error.message);
      } else {
        // The payment has been processed!
        if (result.paymentIntent.status === 'succeeded') {
          var paymentIntent = result.paymentIntent;
          var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          var form = document.getElementById('payment-form');
          var url = form.action;

          fetch(
            url,
            {
              headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
              },
              method: 'post',
              body: JSON.stringify({
                paymentIntent: paymentIntent
              })
            }).then((data) => {
              if (data.status == 400) {
                var redirect = '/boutique';
              } else {
                var redirect = '/merci';
              }
              console.log(data);
              // form.reset();
              window.location.href = redirect;
            }).catch((error) => {
              console.log(error)
            })
          }
        }
      });
    });
    </script>
  @endsection
