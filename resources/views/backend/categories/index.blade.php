@extends('backend.main')

@section('content')
    <div class="p-md-4 p-0">
        <div class="d-sm-block d-md-flex justify-content-between align-items-center">
            <form action="{{route('category')}}">
                <input type="text" name="keyword" id="search" placeholder="search" class="searchbox" onkeyup="checkValue()" value="{{request()->keyword}}" autocomplete="off">
            </form>
            <div>
                <a href="{{route('category.create')}}" >
                    <div class="d-flex align-items-center btn-create">
                        <i class="ri-add-circle-fill" style="font-size: 20px"></i>
                        <span class="ms-1">
                            Create New Category
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
                            <th>Category Name</th>
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
                                <td onclick="dropFunction({{$key}})" class="dropbtn_index">
                                    <span onclick="dropFunction({{$key}})" class="dropbtn_index">...</span>
                                    <div id="myDropdown{{$key}}" class="dropdown-content">
                                        <a href="{{route('category.edit', $result->id)}}">
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
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{$results->links()}}
            </div>
        @else 
            <div class="d-flex justify-content-center text-muted" style="margin-top: 30vh; font-size: 1rem;">
                <p class="ms-2">Not found categories</p>
            </div>
        @endif
    </div>
@endsection

@section('script')
<script>
    function checkValue() {
        const search = document.querySelector('#search');
        if(search.value.length == 0) {
            window.location.href = "{{URL::to('categories')}}"
        }
    }

    function updateHandler($id) {
        window.location.href = `{{URL::to('categories/${$id}/edit')}}`;
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
                url : `/categories/${id}`,
                method : 'DELETE',
                }).done(function(res) {
                    window.location.href = "{{URL::to('categories')}}"
                })
            }
            });
        })
</script>
@endsection