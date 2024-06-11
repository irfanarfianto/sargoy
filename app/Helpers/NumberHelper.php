<?php

namespace App\Helpers;

use NumberFormatter;

class NumberHelper
{
   /**
    * Get a configured currency formatter.
    *
    * @return NumberFormatter
    */
   public static function getCurrencyFormatter()
   {
      $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
      $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
      return $formatter;
   }
}
