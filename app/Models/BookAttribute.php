<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookAttribute extends Model
{
    public function book() {
      return $this->belongsTo( Book::class );
    }

    public function attribute() {
      return $this->belongsTo( Attribute::class );
    }
}
