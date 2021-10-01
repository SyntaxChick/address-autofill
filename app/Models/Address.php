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
   
}
