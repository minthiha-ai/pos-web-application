<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Product;
use Carbon\Carbon;

class DashboardController extends Controller {
  /**
   * dashboard index
   *
   * @return void
   */
  public function index() {
    $query   = Invoice::query();
    $invoice = $query->whereDate('created_at', Carbon::today());

    $todaySale   = $invoice->count();
    $todayIncome = $invoice
      ->selectRaw('SUM(invoices.grand_total) as today_income')
      ->first()
      ->today_income;

    $currentMonth = date('m');
    $lastMonth    = date('m', strtotime('-1 month'));

    $monthlySale = Invoice::selectRaw('SUM(invoices.grand_total) as month_sale')
      ->whereRaw('MONTH(invoices.created_at) = ?', [$currentMonth])
      ->first()
      ->month_sale;

    $lastMonthSale = Invoice::selectRaw('SUM(invoices.grand_total) as last_month_income')
      ->whereRaw('MONTH(invoices.created_at) = ?', [$lastMonth])
      ->first()
      ->last_month_income;

    $totalProducts = Product::count();

    $totalCategorys = Category::count();

    return view('backend.dashboard.index', compact('totalProducts', 'todaySale', 'todayIncome', 'totalCategorys', 'monthlySale', 'lastMonthSale'));
  }
}
