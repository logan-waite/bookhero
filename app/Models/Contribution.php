<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    public function user() {
      return $this->belongsTo( User::class );
    }

    public function book() {
      return $this->belongsTo( Book::class );
    }

    public function attributes() {
      return $this->hasMany( ContributionAttribute::class );
    }
}
