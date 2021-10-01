<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Address extends Model
{
    use Searchable;

   public function searchableAs()
   {
       return 'address-autofill';
   }

   public function toSearchableArray()
   {
       $array = $this->toArray();

       // Customize the data array...

       return $array;
   }
}
