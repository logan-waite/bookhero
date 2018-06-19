<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAttribute extends Model
{
    public function user() {
      return $this->belongsTo( User::class );
    }

    public function attribute() {
      return $this->belongsTo( Attribute::class );
    }
}
