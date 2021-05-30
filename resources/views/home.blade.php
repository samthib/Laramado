@extends('layouts.master')

@section('content')
  <div class="cart-table-area section-padding-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-lg-8">
          <div class="cart-title mt-50">
            <h2>{{ __('Dashboard') }}</h2>
          </div>

          {{-- <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif --}}

      <div class="cart-table clearfix">
        <table class="table table-responsive">
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Price</th>
              <th>Quantity</th>
            </tr>
          </thead>
          <tbody>
            @foreach (Auth()->user()->orders as $order)
              @foreach (unserialize($order->products) as $product)
                <tr>
                  <td class="cart_product_img">
                    <a href="{{ route('product.show', App\Product::where('title', $product[0])->first()->slug) }}"><img src="{{ asset('storage/'.App\Product::where('title', $product[0])->first()->image)}}" alt="Product"></a>
                  </td>
                  <td class="cart_product_desc">
                    <h5>{{ $product[0] }}</h5>
                    <i>{{ Carbon\Carbon::parse($order->payment_created_at)->format('m/d/y H:i a') }}</i>
                  </td>
                  <td class="price">
                    <span>{{ getPrice($product[1]) }}</span>
                  </td>
                  <td class="qty">
                    <div class="qty-btn d-flex">
                      <div class="quantity">
                        {{ $product[2] }}
                      </div>
                    </td>
                  </div>
                </tr>
              @endforeach
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
