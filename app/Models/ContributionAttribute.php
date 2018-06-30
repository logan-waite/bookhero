<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContributionAttribute extends Model
{
    public function contribution() {
      return $this->belongsTo( Contribution::class );
    }

    public function attribute() {
      return $this->belongsTo( Attribute::class );
    }
}
