<?php
namespace App\Traits;

use App\Models\Product;

trait BarcodeGenerator {
  public function generateBarcode() {
    $uniqueNumber = rand(000000000000000, 999999999999999);

    // Check if the generated number already exists in the database
    while (Product::where('barcode', $uniqueNumber)->exists()) {
      $uniqueNumber = rand(000000000000000, 999999999999999);
    }

    return $uniqueNumber;
  }
}