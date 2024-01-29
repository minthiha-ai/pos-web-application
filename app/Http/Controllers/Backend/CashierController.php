<?php
namespace App\Http\Controllers\Backend;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CashierController extends Controller {
  public function index(Request $request) {
    $carts = Cart::with('product')->get();

    $totalPrice = $carts->reduce(function ($total, $cart) {
      $quantity = $cart->quantity;
      $price    = $cart->product->price;

      return $total + ($quantity * $price);
    }, 0);

    return view('backend.cashiers.index', compact('carts', 'totalPrice'));
  }
}
