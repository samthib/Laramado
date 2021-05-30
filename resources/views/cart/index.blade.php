@extends('layouts.master')

@section('content')
  <div class="cart-table-area section-padding-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-lg-8">
          <div class="cart-title mt-50">
            <h2>Shopping Cart</h2>
          </div>

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
                @foreach (Cart::content() as $key => $product)
                  <tr>
                    <td class="cart_product_img">
                      <a href="{{ route('product.show', $product->model->slug) }}"><img src="{{ asset('storage/'.$product->model->image) }}" alt="Product"></a>
                    </td>
                    <td class="cart_product_desc">
                      <h5>{{ $product->model->title }}</h5>
                    </td>
                    <td class="price">
                      <span>{{ $product->model->getPrice() }}</span>
                    </td>
                    <td class="qty">
                      <div class="qty-btn d-flex">
                        {{-- <p>Qty</p> --}}
                        {{-- <div class="quantity"> --}}
                          {{-- <span class="qty-minus" onclick="var effect = document.getElementById('qty-{{ $product->id }}'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                          <input type="number" class="qty-text" id="qty-{{ $product->id }}" step="1" min="1" max="300" name="qty" value="{{ $product->qty }}" data-id="{{ $product->rowId }}" data-stock="{{ $product->model->stock }}">
                          <span class="qty-plus" onclick="var effect = document.getElementById('qty-{{ $product->id }}'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span> --}}


                          <select id="qty" class="custom-select" data-id="{{ $product->rowId }}" data-stock="{{ $product->model->stock }}" name="qty">
                            @for ($i=1; $i <= 6; $i++)
                              <option value="{{ $i }}" {{ $i==$product->qty ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                          </select>

                  {{-- </div> --}}
                  <div class="cart-btn ml-2">
                    <form class="" action="{{ route('cart.destroy', $product->rowId) }}" method="post">
                      @csrf
                      @method('DELETE')
                        <button type="submit" class="btn amado-btn" style="min-width: 40px; height: 40px;"><i class="fa fa-trash" style="vertical-align: super;"></i></button>
                    </form>
                  </div>

                </td>
              </div>
            </tr>
          @endforeach
        </tbody>
      </table>
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
      <div class="cart-btn mt-100">
        <a href="{{ route('checkout.index') }}" class="btn amado-btn w-100">Checkout</a>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection

@section('extra-js')
  <script type="text/javascript">
  var selects = document.querySelectorAll('#qty');
  Array.from(selects).forEach((element) => {
    element.addEventListener('change', function () {
      var rowId = this.getAttribute('data-id');
      var stock = element.getAttribute('data-stock')
      var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      fetch(
        `/panier/${rowId}`,
        {
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
          },
          method: 'patch',
          body: JSON.stringify({
            qty: this.value,
            stock: stock
          })
        }
      ).then((data) => {
        location.reload();
      }).catch((error) => {
        console.log(error);
      })
    });
  });
  </script>
@endsection
