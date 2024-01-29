<?php
namespace App\Http\Controllers\Backend;

use App\Models\Invoice;
use App\Http\Controllers\Controller;

class GeneralController extends Controller {
  public function posPrint($id) {
    $result   = Invoice::with('invoiceProducts', 'invoiceProducts.product')->findOrFail($id);
    $template = 'backend.invoice-pos';
    $html     = view($template, ['invoice' => $result, 'showPrint' => true])->render();
    return $html;
  }
}
