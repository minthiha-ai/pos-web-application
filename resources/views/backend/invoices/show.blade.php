@extends('backend.main')

@section('content')
    <div class="p-4">
        <div class="mt-4 px-5 me-5 d-flex justify-content-between align-items-center ms-5">
            <div>
                <a href="{{url()->previous()}}" class="product_content d-flex align-items-center cursor text-dark">
                    <span class="ms-2 d-flex align-items-center">
                        <i class="ri-arrow-drop-left-line" style="font-size: 30px;"></i>
                        Detail Invoice
                    </span>
                </a>
            </div>

            <div>
                <a href="{{url('/pos/print/' . $invoice->id)}}" class="print-btn">
                    Print Pos
                </a>
            </div>
        </div>

        <div class="mt-5">
            <div class="row">
                <div class="col-10 offset-1">
                    <div class="card px-3 pt-1 shadow-lg" style="width: 100%">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="fw-bold">        
                                        {{$invoice->invoice_number}}
                                    </h5>
                                </div>
                                <div>
                                    <h6 class="fw-bold ms-2">invoice Date - Time</h6>
                                    {{$invoice->created_at->format('d M Y - H:i:s')}}
                                </div>
                            </div>
                            <hr>
                            <div class="row ps-4" style="margin-top: 30px">
                                <div class="col-5">
                                    <h6 class="fw-bold" style="margin-left: 57px">Product</h6>
                                </div>
                                <div class="col-3">
                                    <h6 class="fw-bold" style="margin-left: 33px">QTY</h6>
                                </div>
                                <div class="col-4 text-center">
                                    <h6 class="fw-bold">Total Price</h6>
                                </div>
                            </div>
                            <div class="invoice_products ps-4">
                                @foreach ($invoice->invoiceProducts as $item)
                                    <div class="row my-4">
                                        <div class="col-5">
                                            <div class="d-flex align-items-center">
                                                <label class="ms-2 pb-2" for="item{{$item->id}}">
                                                    {{$item->product->name}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-3 mt-2">
                                            <span class="me-3">
                                                {{$item->quantity}}
                                            </span> X 
                                            <span class="ms-3">
                                                Ks {{number_format($item->price)}}
                                            </span>
                                        </div>
                                        <div class="col-4 text-center mt-1 fw-bold">
                                            <span>
                                                Ks {{number_format($item->total_price)}}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="row mt-4">
                                <div class="col-10">
                                    <div class="fw-bold">Grand Total</div>
                                </div>
                                <div class="col-2 text-end">
                                    <p class="fw-bold">Ks {{number_format($invoice->grand_total)}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection