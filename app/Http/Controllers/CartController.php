<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Product;

use App\Coupon;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('cart.index');
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
      $duplicata = Cart::search(function ($cartItem, $rowId) use ($request) {
        return $cartItem->id == $request->product_id;
      });

      if ($duplicata->isNotEmpty()) {
        return redirect()->route('product.index')->with('success', 'Product already in cart');
      }

      $product = Product::find($request->product_id);

      Cart::add($product->id, $product->title, $request->qty, $product->price)->associate('App\Product');

      return redirect()->route('product.index')->with('success', 'Product added to cart');
    }

    public function storeCoupon(Request $request)
    {
      $code = $request->get('code');

      $coupon = Coupon::where('code', $code)->first();

      if (!$coupon) {
        return redirect()->back()->with('danger', 'Discount coupon is invalid.');
      }

      $request->session()->put('coupon', [
        'code' => $coupon->code,
        'remise' => $coupon->discount(Cart::subtotal())
      ]);

      return redirect()->back()->with('success', 'Discount coupon added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     public function update(Request $request, $rowId)
     {
       $data = $request->json()->all();

       $validator = Validator::make($request->all(), [
         'qty' => 'required|numeric|between:1,6',
       ]);

       if ($validator->fails()) {
         Session::flash('danger', 'Cart quantity should not exceed 6');
         return response()->json(['error' => 'Cart quantity has not been updated']);
       }

       if ($data['qty'] > $data['stock']) {
         Session::flash('danger', 'Product quantity not avaiable');
         return response()->json(['error' => 'Product quantity not avaiable']);
       }

       Cart::update($rowId, $data['qty']);

       Session::flash('success', 'Cart quantity has been updated to '.$data['qty'].'.');

       return response()->json(['success' => 'Cart quantity has been updated']);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($rowId)
     {
       Cart::remove($rowId);

       return back()->with('success', 'Product deleted.');
     }

     public function destroyCoupon()
     {
       request()->session()->forget('coupon');

       return redirect()->back()->with('success', 'Discount coupon deleted');
     }
}
