<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public function books() {
      return $this->hasMany(BookAttribute::class);
    }

    public function contribution_attributes() {
      return $this->hasMany( ContributionAttribute::class );
    }
}
