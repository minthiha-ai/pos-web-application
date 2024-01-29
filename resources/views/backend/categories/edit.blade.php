@extends('backend.main')

@section('content')
    <div class="p-5">
        <div class="product_create">
            <div class="d-inline-block">
                <a href="{{url()->previous()}}" class="product_content d-flex align-items-center cursor text-dark">
                    <i class="ri-arrow-left-s-line" style="font-size: 20px"></i>
                    <span class="ms-2">
                        Edit Category
                    </span>
                </a>
            </div>

            <form action="{{route('category.update', $category->id)}}" id="category_store" method="POST" class="create_form px-4" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="mb-2">Name</label>
                    <input type="text" id="name" autocomplete="off" name="name" value="{{$category->name}}">
                </div>

                <button class="create-btn mt-4">
                    Save Changes
                </button>
            </form>
        </div>
    </div>
@endsection

@section('script')
{!! JsValidator::formRequest('App\Http\Requests\StoreCategoryRequest', '#category_store') !!}
</script>
@endsection