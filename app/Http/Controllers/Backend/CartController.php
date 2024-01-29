<?php
namespace App\Http\Controllers\Backend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller {
  /**
   * barcode scan result store in carts
   *
   * @param  Request $request
   * @return void
   */
  public function store(Request $request) {
    $product = Product::where('barcode', $request->barcode)
      ->first();

    if (!$product) {
      Session::put('fail', 'Not Found');
      return redirect()->back();
    }

    $cart = Cart::where('product_id', $product->id)->first();

    if ($cart) {
      $cart->quantity += 1;
      $cart->update();
    } else {
      $newCart             = new Cart();
      $newCart->user_id    = Auth::id();
      $newCart->product_id = $product->id;
      $newCart->quantity   = 1;
      $newCart->save();
    }

    return redirect()->back();
  }

  /**
   * change quantity
   *
   * @param [type] $id
   * @param  Request $request
   * @return void
   */
  public function changeQuantity($id, Request $request) {
    $request->validate([
      'quantity' => 'required|numeric',
    ]);

    $cart           = Cart::findOrFail($id);
    $cart->quantity = $request->quantity ?? $cart->quantity;
    $cart->update();

    return response()->json([
      'success' => true,
    ]);
  }

  /**
   * cart total price
   *
   * @return void
   */
  public function cartTotalPrices() {
    $carts = Cart::with('product')->get();

    $totalPrice = $carts->reduce(function ($total, $cart) {
      $quantity = $cart->quantity;
      $price    = $cart->product->price;

      return $total + ($quantity * $price);
    }, 0);

    return response()->json([
      'success' => true,
      'data'    => $totalPrice,
    ]);
  }

  public function delete($id) {
    $cart = Cart::findOrFail($id);
    $cart->delete();

    return response()->json([
      'success' => true,
    ]);
  }
}
