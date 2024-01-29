@extends('backend.main')

@section('content')
    <div class="p-md-4 p-0">
        <div class="d-sm-block d-md-flex justify-content-between align-items-center">
            <form action="{{route('product')}}">
                <input type="text" name="keyword" id="search" placeholder="search" class="searchbox" value="{{request()->keyword}}" autocomplete="off">
            </form>
            <div class="d-inline-block mt-3">
                <a href="{{route('product.create')}}">
                    <div class="d-flex align-items-center btn-create">
                        <i class="ri-add-circle-fill" style="font-size: 20px"></i>
                        <span class="ms-1">
                            Create New Product
                        </span>
                    </div>
                </a>
            </div>
        </div>

        @if(count($results) > 0) 
            <div class="dataTable mt-2">
                <table class="border-0">
                    <tbody>
                        <tr class="text-muted">
                            <th>Product Name</th>
                            <th>Barcode</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Category</th>
                        </tr>
                        @foreach ($results as $key => $result)
                            <tr class="cursor">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3" onclick="updateHandler({{$result->id}})">
                                            {{$result->name}}
                                        </div>
                                    </div>
                                </td>
                                <td>{{$result->barcode}}</td>
                                <td>{{$result->in_stock}}</td>
                                <td>{{$result->price}}</td>
                                <td>{{$result->category ? $result->category->name : '-'}}</td>
                                <td onclick="dropFunction({{$key}})" class="dropbtn_index">
                                    <span onclick="dropFunction({{$key}})" class="dropbtn_index">...</span>
                                    <div id="myDropdown{{$key}}" class="dropdown-content">
                                        <a href="{{route('product.edit', $result->id)}}">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <i class="ri-edit-box-line"></i>
                                                <span class="ms-5">
                                                    Edit
                                                </span>
                                            </div>
                                        </a>
                                        <hr class="m-0 p-0">
                                        <a href="" class="delete_btn" data-id={{$result->id}}>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <i class="ri-delete-bin-6-line"></i>
                                                <span class="table-delete-btn">
                                                    Delete
                                                </span>
                                            </div>
                                        </a>
                                        <hr class="m-0 p-0">
                                        <a href="{{route('product.barcode', $result->id)}}">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <i class="ri-barcode-line"></i>
                                                <span class="ms-3">
                                                    Barcode
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Barcode</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="{{route('product.barcode', 'REPLACE_WITH_ID')}}" method="POST">
                                @csrf
                                <input type="number" name="quantity" placeholder="quantity" id="barcode_quantity">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>

                {{$results->links()}}
            </div>
        @else 
            <div class="d-flex justify-content-center text-muted" style="margin-top: 30vh; font-size: 1rem;">
                <p class="ms-2">Not found products</p>
            </div>
        @endif
    </div>
@endsection

@section('script')
<script>
    // function checkValue() {
    //     const search = document.querySelector('#search');
    //     if(search.value.length == 0) {
    //         window.location.href = "{{URL::to('products')}}"
    //     }
    // }

    function updateHandler($id) {
        window.location.href = `{{URL::to('products/${$id}/edit')}}`;
    }

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            swal({
                text: "Are you sure?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                let id = $(this).data('id');
                console.log(id);
                $.ajax({
                url : `/products/${id}`,
                method : 'DELETE',
                }).done(function(res) {
                    window.location.href = "{{URL::to('products')}}"
                })
            }
            });
        })
</script>
@endsection