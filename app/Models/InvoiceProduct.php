<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model {
  use HasFactory;

  protected $table = 'invoice_products';

  protected $fillable = [
    'invoice_id',
    'product_id',
    'quantity',
    'price',
    'total_price',
  ];

  public function product() {
    return $this->belongsTo(Product::class, 'product_id', 'id')->withTrashed();
  }
}
