<?php
namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\BarcodeGenerator;
use App\Http\Controllers\Controller;
use Picqer\Barcode\BarcodeGeneratorPNG;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller {
  use BarcodeGenerator;

  /**
   * product listing
   *
   * @return void
   */
  public function index(Request $request) {
    $query = Product::with('category');

    if (isset($request->keyword)) {
      $query = $query->where('name', 'like', "%{$request->keyword}%")
        ->orWhereHas('category', function($c) use ($request) {
          return $c->where('name', 'like', "%{$request->keyword}%");
        });
    }

    $results = $query->with('category')
      ->orderBy('id', 'desc')
      ->paginate(15)
      ->withQueryString();

    return view('backend.products.index', compact('results'));
  }

  /**
   * create product form
   *
   * @return void
   */
  public function create() {
    $categories = Category::all();
    return view('backend.products.create', compact('categories'));
  }

  /**
   *store product
   *
   * @return void
   */
  public function store(StoreProductRequest $request) {
    $product              = new Product();
    $product->name        = $request->name;
    $product->barcode     = $request->barcode ?? $this->generateBarcode();
    $product->category_id = $request->category_id ?? null;
    $product->price       = $request->price;
    $product->in_stock    = $request->stock;
    $product->price       = $request->price;
    $product->save();

    return redirect()->route('product')->with('success', 'success');
  }

  /**
   * product edit page
   *
   * @param [type] $id
   * @return void
   */
  public function edit($id) {
    $product    = Product::findOrFail($id);
    $categories = Category::all();
    return view('backend.products.edit', compact('product', 'categories'));
  }

  /**
   * product update
   *
   * @param [type] $id
   * @param  StoreProductRequest $request
   * @return void
   */
  public function update($id, StoreProductRequest $request) {
    $product              = Product::findOrFail($id);
    $product->name        = $request->name;
    $product->barcode     = $request->barcode ?? $this->generateBarcode();
    $product->category_id = $request->category_id ?? null;
    $product->price       = $request->price;
    $product->in_stock    = $request->stock;
    $product->price       = $request->price;
    $product->save();

    return redirect()->route('product')->with('success', 'success');
  }

  /**
   * Delete product
   *
   * @param [type] $id
   * @return void
   */
  public function delete($id) {
    $product = Product::findOrFail($id);
    $product->delete();

    return 'success';
  }

  public function barcode($id) {
    $product   = Product::findOrFail($id);
    $generator = new BarcodeGeneratorPNG();
    $barcode   = $generator->getBarcode($product->barcode,
      $generator::TYPE_CODE_128,
      1
    );
    $barcode = '<img src="data:image/png;base64,' . base64_encode($barcode) . '" />';

    return view('backend.barcode', compact('product', 'barcode'));
  }
}
