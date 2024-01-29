<?php
namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\InvoiceProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\InvoiceNumberGenerator;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller {
  use InvoiceNumberGenerator;

  public $insertInvoiceProducts = [];

  public $totalAmount = 0;

  /**
   * invoice create
   *
   * @param  Request $request
   * @return void
   */
  public function store() {
    DB::beginTransaction();
    try {
      $invoice                 = new Invoice();
      $invoice->user_id        = Auth::id();
      $invoice->invoice_number = $this->generateNumber(null, 'Invoice', 'invoice_number');
      $invoice->save();

      $carts = Cart::with('product')->where('user_id', Auth::id())->get();

      foreach ($carts->toArray() as $cart) {
        if ($cart['quantity'] > $cart['product']['in_stock']) {
          $errorMessage = $cart['product']['name'] . ' is greater than in stock';
          return response()->json([
            'success' => false,
            'error'   => $errorMessage,
          ]);
        }

        $product           = Product::findOrFail($cart['product']['id']);
        $product->in_stock = $product->in_stock - $cart['quantity'];
        $product->update();

        $this->insertInvoiceProducts[] = [
          'invoice_id'  => $invoice->id,
          'product_id'  => $cart['product_id'],
          'quantity'    => $cart['quantity'],
          'price'       => $cart['product']['price'],
          'total_price' => $cart['product']['price'] * $cart['quantity'],
        ];

        $this->totalAmount += $cart['product']['price'] * $cart['quantity'];
      }

      InvoiceProduct::insert($this->insertInvoiceProducts);

      $invoice->total       = $this->totalAmount;
      $invoice->grand_total = $this->totalAmount;
      $invoice->update();

      Auth::user()->carts()->delete();

      DB::commit();
      $url = ('/pos/print/' . $invoice->id);

      return response()->json([
        'success'      => true,
        'redirect_url' => $url,
      ]);
    } catch(Exception $e) {
      DB::rollback();
      throw $e;
    }
  }
}
