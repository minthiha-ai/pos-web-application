{{-- <!DOCTYPE html>
<html>
<head>
  <style>
    .text {
      font-size: 12px;
      font-family: sans-serif;
      color: black !important;
    }

    @page {
        size: auto;   /* auto is the initial value */
        margin: 0mm;
    }

    img {
        margin: 0 auto;
    }

    .barcode-container {
      display: block; /* Change from inline-block to block */
      margin-bottom: 27px;
      text-align: center;
    }

    .product-info {
      margin-top: 10px; /* Adjust the value as per your preference */
    }

  </style>
</head>

<body onload="window.print();">
  <div>
    @for ($i = 0; $i < $quantity; $i++)
      <div class="barcode-container">
        {!! $barcode !!}
        <br>
        <span class="text">{{ $product['barcode'] }}</span>
        <div class="product-info">
          <span class="text">{{ $product['name'] }}</span><br>
          <span class="text">Price: {{ $product['price'] }} Ks</span>
        </div>
      </div>
    @endfor
  </div>
</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Receipt</title>
</head>

<style type="text/css">
  @page {
    margin: 0;
  }

  .barcode-container {
      display: inline-block; 
      margin-bottom: 27px;
      text-align: center
    }

  body {
    margin: 20px 0px 0px 0px;
    font-size: 12px;
  }

</style>

<body style="font-family:Verdana, Geneva, Tahoma, sans-serif;" onload="window.print();">
    <div class="barcode-container">
        {!! $barcode !!}
        <br>
        <span class="text">{{ $product['barcode'] }}</span>
        <br>
        <div class="product-info">
          <span class="text">Price: {{ number_format($product['price']) }} Ks</span>
        </div>
    </div>
</body>

</html>
