<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use App\Models\BookList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function getAll() {
      $books = Book::with('author')->get();
      $counter = 0;
      foreach ( $books as $book ) {
        $book->active = ( $counter % 2 == 0 ) ? true : false;
        $counter++;
      }
      return Response::create([ 'message' => 'success', 'books' => $books ]);
    }

    public function addBookToList() {
      $input = Input::only('book_id');
      $user_id = auth()->user()->id;
      $book_id = $input['book_id'];

      $existing_list_record = BookList::where('user_id', $user_id)
                                ->where('book_id', $book_id)
                                ->first();

      if ($existing_list_record) {
        return Response::create([ 'message' => 'Book already in list!' ], 409 );
      }

      $list_record = new BookList;
      $list_record->user_id = auth()->user()->id;
      $list_record->book_id = $book_id;

      try {
        $list_record->save();
      }
      catch(\Throwable $e) {
        return Response::create([ 'message' => $e->getMessage() ], 500);
      }

      return Response::create([ 'message' => 'success' ]);
    }
}
