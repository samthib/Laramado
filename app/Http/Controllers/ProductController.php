<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (request()->categorie) {
        $products = Product::with('categories')->whereHas('categories', function ($query) {
          $query->where('slug', request()->categorie);
        })->latest()->paginate(6);
      } else {
        $products = Product::with('categories')->latest()->paginate(6);
      }

      return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      $product = Product::with('categories')->where('slug', $slug)->firstOrFail();
      $stock = $product->stock === 0 ? 'Out of stock' : 'In stock';

      return view('products.show', [
        'product' => $product,
        'stock' => $stock,
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search()
    {
      request()->validate([
        'q' => 'required|min:3'
      ]);

      $q = request()->input('q');

      $products = Product::where('title', 'like', "%$q%")
        ->orWhere('description', 'like', "%$q%")
        ->paginate(6);

        return view('products.index')->with('products', $products);
    }
}
