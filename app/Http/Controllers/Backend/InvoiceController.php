<?php
namespace App\Http\Controllers\Backend;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller {
  public function index(Request $request) {
    $query = Invoice::query();

    if (isset($request->keyword)) {
      $query = $query->where('invoice_number', 'like', "%{$request->keyword}%");
    }

    $results = $query
      ->orderBy('id', 'desc')
      ->paginate(15)
      ->withQueryString();

    return view('backend.invoices.index', compact('results'));
  }

  /**
   * show invoices
   *
   * @param [type] $id
   * @return void
   */
  public function show($id) {
    $invoice = Invoice::with('invoiceProducts', 'invoiceProducts.product')
      ->where('id', $id)
      ->firstOrFail();

    return view('backend.invoices.show', compact('invoice'));
  }
}
