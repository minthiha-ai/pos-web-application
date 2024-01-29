@extends('backend.main')

@section('content')
    <div class="p-md-4 p-0">
        <div class="d-sm-block d-md-flex justify-content-between align-items-center">
            <form action="{{route('invoice')}}">
                <input type="text" name="keyword" id="search" placeholder="search" class="searchbox" onkeyup="checkValue()" value="{{request()->keyword}}" autocomplete="off">
            </form>
        </div>

        @if(count($results) > 0) 
            <div class="dataTable mt-2">
                <table class="border-0">
                    <tbody>
                        <tr class="text-muted">
                            <th>Invoice Number</th>
                            <th>Grand Total</th>
                            <th>Created At</th>
                        </tr>
                        @foreach ($results as $key => $result)
                            <tr class="cursor">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3" onclick="updateHandler({{$result->id}})">
                                            {{$result->invoice_number}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{$result->grand_total}}
                                </td>
                                <td>
                                    {{Carbon\Carbon::parse($result->created_at)->format('d-m-Y H:i:s')}}
                                </td>
                                <td onclick="dropFunction({{$key}})" class="dropbtn_index">
                                    <span onclick="dropFunction({{$key}})" class="dropbtn_index">...</span>
                                    <div id="myDropdown{{$key}}" class="dropdown-content">
                                        <a href="{{route('invoice.show', $result->id)}}">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <i class="ri-eye-line"></i>
                                                <span class="ms-5">
                                                    Detail
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
                <p class="ms-2">Not found invoices</p>
            </div>
        @endif
    </div>
@endsection

@section('script')
<script>
    function checkValue() {
        const search = document.querySelector('#search');
        if(search.value.length == 0) {
            window.location.href = "{{URL::to('invoices')}}"
        }
    }

    function updateHandler($id) {
        window.location.href = `{{URL::to('invoices/${$id}')}}`;
    }
</script>
@endsection