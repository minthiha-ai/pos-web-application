<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {
  use HasFactory;

  protected $table = 'invoices';

  protected $fillable = [
    'user_id',
    'invoice_number',
    'total',
    'grand_total',
  ];

  public function invoiceProducts() {
    return $this->hasMany(InvoiceProduct::class, 'invoice_id', 'id');
  }
}
