@extends('backend.main')

@section('css')
<style>
    .dashboard {
        height: 100vh;
        background: #f4f4f4;
        overflow: scroll;
    }

    .dashboard::-webkit-scrollbar
    {
        display: none;
    }

    .today_sale {
        min-width: 20%;
        height: 105px;
        border: 1.5px solid #dddddd;
        border-radius: 4px;
        padding: 20px;
    }

    .currency {
        font-size: 14px;
    }

    .top_product a{
        color: cornflowerblue;
        cursor: pointer;
        text-decoration: underline !important;
    }
</style>
@endsection

@section('content')
<div class="dashboard p-5">
    <h3 class="mb-5">Dashboard</h3>
    <div class="d-flex gap-5 flex-wrap">
        <div class="today_sale">
            <div class="d-flex justify-content-between">
                <div>
                    <p>Today Sale</p>
                    <h3>{{$todaySale}}</h3>
                </div>
                <div class="order-icon">
                    <i class="ri-money-dollar-circle-line" style="font-size: 15px"></i>
                </div>
            </div>
        </div>

        <div class="today_sale">
            <div class="d-flex justify-content-between">
                <div>
                    <p>Today Income</p>
                    <h3>{{$todayIncome ?? 0}} <span class="currency">Ks</span></h3>
                </div>
                <div class="order-icon">
                    <i class="ri-money-dollar-circle-line" style="font-size: 15px"></i>
                </div>
            </div>
        </div>

        <div class="today_sale">
            <div class="d-flex justify-content-between">
                <div>
                    <p>Total Products</p>
                    <h3>{{$totalProducts}}</h3>
                </div>
                <div class="order-icon">
                    <i class="ri-t-shirt-fill" style="font-size: 15px"></i>
                </div>
            </div>
        </div>

        <div class="today_sale">
            <div class="d-flex justify-content-between">
                <div>
                    <p>Total Categories</p>
                    <h3>{{$totalCategorys}}</h3>
                </div>
                <div class="order-icon">
                    <i class="ri-t-shirt-fill" style="font-size: 15px"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex gap-5 flex-wrap justify-content-center">
        <div class="today_sale mt-4">
            <div class="d-flex justify-content-between">
                <div>
                    <p>This MonthSale</p>
                    <h3>{{$monthlySale}}</h3>
                </div>
                <div class="order-icon">
                    <i class="ri-t-shirt-fill" style="font-size: 15px"></i>
                </div>
            </div>
        </div>
        <div class="today_sale mt-4">
            <div class="d-flex justify-content-between">
                <div>
                    <p>Last MonthSale</p>
                    <h3>{{$lastMonthSale}}</h3>
                </div>
                <div class="order-icon">
                    <i class="ri-t-shirt-fill" style="font-size: 15px"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection