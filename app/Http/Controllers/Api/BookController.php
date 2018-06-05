<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function getAll() {
      $books = Book::with('author')->get();
      return Response::create([ 'message' => 'success', 'books' => $books ]);
    }
}
