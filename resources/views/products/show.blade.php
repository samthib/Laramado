@extends('layouts.master')

@section('content')
  <!-- Product Details Area Start -->
  <div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">

      <div class="row">
        <div class="col-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-50">
              <li class="breadcrumb-item"><a href="{{route('shop.index') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('product.index', ['categorie' => $product->categories->first()->slug]) }}">{{ $product->categories->first()->name }}</a></li>
              {{-- <li class="breadcrumb-item"><a href="#">{{ 'Sub-Category' }}</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
            </ol>
          </nav>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-lg-7">
          <div class="single_product_thumb">
            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url({{ asset('storage/'.str_replace('\\', '/', $product->image)) }});">
                </li>
                @foreach (json_decode($product->images, true) as $key => $image)
                  <li data-target="#product_details_slider" data-slide-to="{{ $key+1 }}" style="background-image: url({{ asset('storage/'.str_replace('\\', '/', $image)) }});">
                  </li>
                @endforeach
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <a class="gallery_img" href="{{ asset('storage/'.str_replace('\\', '/', $product->image)) }}">
                    <img class="d-block w-100" src="{{ asset('storage/'.str_replace('\\', '/', $product->image)) }}" alt="{{ '0-nth slide' }}">
                  </a>
                </div>
                @foreach (json_decode($product->images, true) as $key => $image)
                  <div class="carousel-item">
                    <a class="gallery_img" href="{{ asset('storage/'.str_replace('\\', '/', $image)) }}">
                      <img class="d-block w-100" src="{{ asset('storage/'.str_replace('\\', '/', $image)) }}" alt="{{ ($key+1).'-nth slide' }}">
                    </a>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-5">
          <div class="single_product_desc">
            <!-- Product Meta Data -->
            <div class="product-meta-data">
              <div class="line"></div>
              <p class="product-price">{{ $product->getPrice() }}</p>
              <a href="product-details.php">
                <h6>{{ $product->title }}</h6>
              </a>
              {{-- <!-- Ratings & Review -->
              <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
              <div class="ratings">
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
              <i class="fa fa-star" aria-hidden="true"></i>
            </div>
            <div class="review">
            <a href="#">Write A Review</a>
          </div>
        </div> --}}
        <!-- Avalaible -->
        <p class="avaibility"><i class="fa fa-circle" style="color:{{ ($stock == 'In stock') ? 'green': 'red'}}"></i> {{ $stock }}</p>
      </div>

      <div class="short_overview my-5">
        <p>{!! $product->description !!}</p>
      </div>

      <!-- Add to Cart Form -->
      <form class="cart clearfix" action="{{ route('cart.store') }}" method="post">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="cart-btn d-flex mb-50">
          <p>Quantity</p>
          <div class="quantity">
            <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
            <input type="number" class="qty-text" id="qty" step="1" min="1" max="6" name="qty" value="1">
            <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
          </div>
        </div>
        <button type="submit" name="addtocart" value="1" class="btn amado-btn">Add to cart</button>
      </form>

    </div>
  </div>
</div>
</div>
</div>
<!-- Product Details Area End -->
@endsection
