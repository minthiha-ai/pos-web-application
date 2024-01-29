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

  body {
    width: 68mm;
    height: 100%;
    font-size: 12px;
  }

</style>

<body style="font-family:Verdana, Geneva, Tahoma, sans-serif;"
  @if ($showPrint) onload="window.print()" @endif>
  <table style="width: 100%" border="0">
    <tr>
      <td style="text-align: center">RECEIPT</td>
    </tr>

    <tr>
      <td style="text-align: center">Pink Lady</td>
    </tr>
  </table>
  <div style="border-top: 1px dashed; margin-top: 5px"></div>

  <table style="width: 100%" border="0">
    <tr>
      <td><b>Name</b></td>
      <td style="text-align:center"><b>QTY</b></td>
      <td style="text-align:right"><b>Ks</b></td>
    </tr>

    @foreach ($invoice->invoiceProducts as $product)
      <tr>
        <td>
            {{ $product->product->name }}
        </td>
        <td style="text-align:center">
          {{ $product->quantity }}
        </td>
        <td style="text-align:right">
          {{ number_format($product->total_price) }}
        </td>
      </tr>
    @endforeach

  </table>

  <div style="border-top: 1px dashed; margin-top: 5px"></div>

  <table style="width: 100%" border="0">
    <tr>
      <td>Total</td>
      <td style="text-align:right">
        {{ number_format($invoice->grand_total, 0) }} 
      </td>
    </tr>
  </table>

  <div style="border-top: 1px dashed; margin-top: 5px; margin-bottom: 6px"></div>
  <table style="width: 100%;" border="0">
    <tr>
      <td style="text-align: center">Thank You</td>
    </tr>
    <tr>
      <td style="text-align: center">၀ယ်ပြီးပစ္စည်းပြန်မလဲပါ</td>
    </tr>
  </table>
</body>

</html>
