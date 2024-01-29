<?php
namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller {
  /**
   * Category Listing
   *
   * @return void
   */
  public function index(Request $request) {
    $query = Category::query();

    if (isset($request->keyword)) {
      $query = $query->where('name', 'like', "%{$request->keyword}%");
    }

    $results = $query->orderBy('id', 'desc')
      ->paginate(15)
      ->withQueryString();

    return view('backend.categories.index', compact('results'));
  }

  /**
   * Create View Category
   *
   * @return void
   */
  public function create() {
    return view('backend.categories.create');
  }

  /**
   * store category
   *
   * @param  StoreCategoryRequest $request
   * @return void
   */
  public function store(StoreCategoryRequest $request) {
    $category       = new Category();
    $category->name = $request->name;
    $category->save();

    return redirect()->route('category')->with('success', 'success');
  }

  /**
   * edit category
   *
   * @param [type] $id
   * @return void
   */
  public function edit($id) {
    $category = Category::findOrFail($id);
    return view('backend.categories.edit', compact('category'));
  }

  /**
   * update category
   *
   * @param StoreCategoryRequest $request
   * @param [type] $id
   * @return void
   */
  public function update(StoreCategoryRequest $request, $id) {
    $category       = Category::findOrFail($id);
    $category->name = $request->name;
    if ($request->hasFile('image')) {
      $oldImage = $category->getRawOriginal('image') ?? '';
      Storage::delete($oldImage);
      $category->image = $request->file('image')->store('categories');
    }
    $category->update();

    return redirect()->route('category')->with('success', 'success');
  }

  /**
   * delete Category
   *
   * @param [type] $id
   * @return void
   */
  public function delete($id) {
    $category = Category::findOrFail($id);
    $oldImage = $category->getRawOriginal('image') ?? '';
    Storage::delete($oldImage);
    $category->delete();

    Session::put('deleted', 'success');
    return 'success';
  }
}
