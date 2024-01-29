@extends('backend.main')

@section('content')
    <div class="p-5">
        <div class="product_create">
            <div class="d-inline-block">
                <a href="{{url()->previous()}}" class="product_content d-flex align-items-center cursor text-dark">
                    <i class="ri-arrow-left-s-line" style="font-size: 20px"></i>
                    <span class="ms-2">
                        Create Product
                    </span>
                </a>
            </div>

            <form action="{{route('product.store')}}" id="category_store" method="POST" class="create_form px-4" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="mb-4">
                            <label for="name" class="mb-2">Name</label>
                            <input type="text" id="name" autocomplete="off" name="name">
                        </div>
        
                    </div>
                    <div class="col-6">
                        <div class="mb-4">
                            <label for="barcode" class="mb-2">Barcode</label>
                            <input type="text" id="barcode" autocomplete="off" name="barcode" placeholder="Optional">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="mb-4">
                            <label for="category" class="mb-2">Choose Category</label>
                            <select name="category_id" class="form-control mb-3 category_id" id='category'>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-4">
                            <label for="stock" class="mb-2">Stock</label>
                            <input type="number" id="stock" autocomplete="off" name="stock">
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="price" class="mb-2">Price</label>
                    <input type="number" id="price" autocomplete="off" name="price">
                </div>

                <button class="create-btn mt-4">
                    Create
                </button>
            </form>
        </div>
    </div>
@endsection

@section('script')
{!! JsValidator::formRequest('App\Http\Requests\StoreProductRequest', '#category_store') !!}
@endsection