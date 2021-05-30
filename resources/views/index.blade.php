@extends('layouts.master')

@section('content')
  <!-- Product Catagories Area Start -->
  <div class="products-catagories-area clearfix">
    <div class="amado-pro-catagory clearfix">

      @foreach ($categories as $key => $category)
        <!-- Single Category -->
        <div class="single-products-catagory clearfix">
          <a href="{{ route('product.index', ['categorie' => $category->slug]) }}">
            <img src="{{ asset('storage/'.$category->image) }}" alt="">

            <!-- Hover Content -->
            <div class="hover-content">
              <div class="line"></div>
              <p>From {{ getPrice($category->products->min('price')) }}</p>
              <h4>{{ $category->name }}</h4>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
  <!-- Product Catagories Area End -->
@endsection
