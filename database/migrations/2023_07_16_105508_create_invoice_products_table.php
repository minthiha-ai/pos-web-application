<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('invoice_products', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('invoice_id')->nullable();
      $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
      $table->unsignedBigInteger('product_id')->nullable();
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
      $table->integer('quantity');
      $table->integer('price');
      $table->integer('total_price');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('invoice_products');
  }
};
