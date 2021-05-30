@extends('layouts.master')

@section('content')

  @include('products.sidebar')

  <div class="amado_product_area section-padding-100">
    <div class="container-fluid">

      <div class="row">
        <div class="col-12">
          <div class="product-topbar d-xl-flex align-items-end justify-content-between">
            <!-- Total Products -->
            <div class="total-products">
            <p>Showing {{ (($products->currentPage() * 6) - 5).'-'.($products->currentPage() * 6) }} 0f {{ $products->total() }}</p>
              <div class="view d-flex">
                <a href="#"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
              </div>
            </div>
            <!-- Sorting -->
            {{-- <div class="product-sorting d-flex">
              <div class="sort-by-date d-flex align-items-center mr-15">
                <p>Sort by</p>
                <form action="#" method="get">
                  <select name="select" id="sortBydate">
                    <option value="value">Date</option>
                    <option value="value">Newest</option>
                    <option value="value">Popular</option>
                  </select>
                </form>
              </div>
              <div class="view-product d-flex align-items-center">
                <p>View</p>
                <form action="#" method="get">
                  <select name="select" id="viewProduct">
                    <option value="value">12</option>
                    <option value="value">24</option>
                    <option value="value">48</option>
                    <option value="value">96</option>
                  </select>
                </form>
              </div>
            </div> --}}
          </div>
        </div>
      </div>

      <div class="row">
        @foreach ($products as $key => $product)
          <!-- Single Product Area -->
          <div class="col-12 col-sm-6 col-md-12 col-xl-6">
            <div class="single-product-wrapper">
              <!-- Product Image -->
              <div class="product-img">
                <a href="{{ route('product.show', $product->slug) }}">
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
              </a>
                <!-- Hover Thumb -->
                @if ($product->images)
                  <a href="{{ route('product.show', $product->slug) }}">
                  <img class="hover-img" src="{{ asset('storage/'.json_decode($product->images, true)[0]) }}" alt="{{ $product->name }}">
                </a>
                @endif
              </div>
              <!-- Product Description -->
              <div class="product-description d-flex align-items-center justify-content-between">
                <!-- Product Meta Data -->
                <div class="product-meta-data">
                  <div class="line"></div>
                  <p class="product-price">{{ $product->getPrice() }}</p>
                  <a href="{{ route('product.show', $product->slug) }}">
                    <h6>{{ $product->title }}</h6>
                  </a>
                </div>
                <!-- Ratings & Cart -->
                <div class="ratings-cart text-right">
                  <div class="ratings">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
                <div class="cart">
                  <form class="cart clearfix" action="{{ route('cart.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="qty" value="1">
                    <button type="submit" name="addtocart" value="1" class="btn amado-btn"><img src="{{ asset('storage/img/core-img/cart.png') }}" alt="Add to cart"></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="row">
      <div class="col-12">
        <!-- Pagination -->
        {{ $products->appends(request()->input())->links() }}
  </div>
</div>
</div>
</div>
@endsection
