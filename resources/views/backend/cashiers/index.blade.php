@extends('backend.main')

@section('content')
    <div class="p-md-4 p-0">
        <form action="{{route('cart.store')}}" method="POST">
            @csrf
            <div class="barcode">
                <input type="text" class="p-1" name="barcode" id="barcode" autocomplete="off" placeholder="Barcode Scan">
            </div>
        </form>
    </div>

    @if(count($carts) > 0) 
    <form action="{{route('checkout')}}" method="POST" id="formcart">
        @csrf
        <div class="dataTable mt-2">
            <table class="border-0">
                <tbody>
                    <tr class="text-muted">
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total Price</th>
                    </tr>
                    @foreach ($carts as $key => $result)
                        <tr class="cursor">
                            <td>
                                {{$result->product->name}}
                            </td>
                            <td>{{$result->product->price}}</td>
                            <td wdth>
                                <input type="number" min=1 class="cart-number{{$key}}" 
                                onkeyup="calculatePrice({{$key}}, {{$result->product->price}}, {{$result->id}})"
                                value="{{$result->quantity}}"
                                style="width: 50px !important"
                                />
                            </td>
                            <td class="cart-price{{$key}}">
                                {{$result->product->price * $result->quantity}} Ks
                            </td>
                            <td>
                                <a href="" class="delete_btn" data-id={{$result->id}}>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="ri-delete-bin-6-line" style="font-size: 20px; color: red"></i>
                                    </div>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    
            <div class="d-flex justify-content-end align-items-center mt-5 gap-5 me-5">
                <div class="fw-bold">
                    Total Price:
                </div>
                <div id="total">
                    {{$totalPrice}} Ks
                </div>
            </div>
    
            <div class="d-flex justify-content-end mt-5 me-4">
                <button type="submit" class="btn btn-primary px-5 py-3" id="checkout">Checkout</button>
            </div>
        </div>
    </form>
    @else 
        <div class="d-flex justify-content-center text-muted" style="margin-top: 30vh; font-size: 1rem;">
            <p class="ms-2">Not found carts</p>
        </div>
    @endif
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    async function calculatePrice(key, productPrice, cart) {
        let number = document.querySelector(`.cart-number${key}`).value;
        let url = `/change-quantity/${cart}`;
        try {
            if(number >= 1) {
                let data = await axios.put(url, {
                    'quantity' : number,
                })

                let cartPrice = document.querySelector(`.cart-price${key}`);
                let price = productPrice;
                cartPrice.innerHTML = price * number;
            }

            let totalUrl = '/cart-total-prices'
            let dataTotal = await axios.get(totalUrl);
            if(dataTotal.data.success) {
                document.querySelector('#total').innerHTML = dataTotal.data.data + ' Ks';
            }
        } catch (err) {
            throw err;
        }
    }

    window.onload = function() {
        document.getElementById("barcode").focus();
    };

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
            url : `/carts/${id}`,
            method : 'DELETE',
            }).done(function(res) {
                window.location.href = "{{URL::to('cashiers')}}"
            })
        }
        });
    })

    $(document).on('click', '#checkout', function(e) {
        e.preventDefault();
        swal({
            text: "Are you sure?",
            icon: "info",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if(willDelete) {
                $.ajax({
                    url: '/checkout', // Replace with the actual URL for the checkout endpoint
                    method: 'POST',
                    success: function(response) {
                        if (response.success) {
                            window.popupWindow(response.redirect_url, 900, 720);
                            location.reload();
                        } else {
                            // Error handling
                            swal({
                                text: response.error,
                                icon: "error",
                                button: "OK",
                            });
                        }
                    }
                });
            }
        });
    })
</script>
@endsection