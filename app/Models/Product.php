<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {
  use HasFactory, SoftDeletes;

  protected $table = 'products';

  protected $fillable = [
    'name',
    'category_id',
    'in_stock',
    'barcode',
    'price',
  ];

  public function category() {
    return $this->belongsTo(Category::class, 'category_id', 'id');
  }
}
