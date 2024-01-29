<?php
namespace App\Traits;

/**
 * @property string $type
 */
trait InvoiceNumberGenerator {
  public $column;

  /**
   * this function is to generate next invoice number
   * 
   * @param type platform or pos or invoiceCash
   */
  private $prefix;

  public function generateNumber($prefix = null, $modelName, $column) {
    $this->modelName = 'App\\Models\\' . $modelName;

    $this->column = $column;

    $this->prefix = $prefix;

    $model = $this->modelName::orderBy('id', 'desc')->first();

    if ($model) {
      $monthYear = substr(explode('#', $model->$column)[1], 0, 6);

      if ($monthYear == date('ymd') ) {
        $lastInvoiceNumber = substr($model->$column, -6);
      } else {
        $lastInvoiceNumber = 0;
      }
    } else {
      $lastInvoiceNumber = 0;
    }
    while ( $this->_invoiceNumber($lastInvoiceNumber) == false) {
      $lastInvoiceNumber++;
    }

    return $this->_invoiceNumber($lastInvoiceNumber);
  }

  /**
   * this function helper of invoice number generator
   */
  private function _invoiceNumber($lastInvoiceNumber) {
    $newNumber = sprintf( '%06d', ( $lastInvoiceNumber * 1 + 1) );
    $newNumber = $this->prefix . date('ymd') . $newNumber;

    $invoice = $this->modelName::where($this->column, $newNumber)->first();

    if ($invoice) {
      return false;
    }

    return '#' . $newNumber;
  }
}