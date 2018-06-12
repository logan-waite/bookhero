<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function author() {
      return $this->belongsTo( Author::class, 'author_id' );
    }

    public function lists() {
      return $this->hasMany( BookList::class, 'book_id' );
    }

    public function attributes() {
      return $this->hasMany( BookAttribute::class );
    }
}
