<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use App\Models\BookList;
use App\Models\UserAttribute;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function getAll() {
      $user_id = auth()->user()->id;

      $books = Book::with(['author', 'attributes'])
                      ->select('books.*',
                                'book_lists.book_id',
                                'book_lists.user_id',
                                'book_lists.currently_reading',
                                'book_lists.finished')
                      ->leftJoin('book_lists', 'books.id', '=', 'book_lists.book_id')
                      ->where('user_id', $user_id)
                      ->orWhere('user_id', null)
                      ->get();

      return Response::create([ 'message' => 'success', 'books' => $books ]);
    }

    // public function addBookToList() {
    //   $input = Input::only('book_id');
    //
    //   $user_id = auth()->user()->id;
    //   $book_id = $input['book_id'];
    //
    //   $existing_list_record = BookList::where('user_id', $user_id)
    //                             ->where('book_id', $book_id)
    //                             ->first();
    //
    //   if ($existing_list_record) {
    //     return Response::create([ 'message' => 'Book already in list!' ], 409 );
    //   }
    //
    //   $list_record = new BookList;
    //   $list_record->user_id = auth()->user()->id;
    //   $list_record->book_id = $book_id;
    //
    //   try {
    //     $list_record->save();
    //   }
    //   catch(\Throwable $e) {
    //     return Response::create([ 'message' => $e->getMessage() ], 500);
    //   }
    //
    //   return Response::create([ 'message' => 'success' ]);
    // }

    public function getBookList() {
      $user_id = auth()->user()->id;
      $book_list = Book::with('author')
                    ->join('book_lists', 'books.id', '=', 'book_lists.book_id')
                    ->where('book_lists.user_id', $user_id)
                    ->get();

      return Response::create([ 'message' => 'success', 'booklist' => $book_list ]);
    }

    public function updateBookList() {
      $input = Input::only('type', 'action', 'book_id');
      $user_id = auth()->user()->id;
      $book_id = $input["book_id"];

      $existing_list_record = BookList::where('user_id', $user_id)
                                ->where('book_id', $book_id)
                                ->first();

      switch( $input['type'] ) {
        case 'add':
          if ($existing_list_record) {
            return Response::create([ 'message' => 'Book already in list!' ], 409 );
          }

          $list_record = new BookList;
          $list_record->user_id = auth()->user()->id;
          $list_record->book_id = $book_id;
          // $list_record->save();

          try {
            $list_record->save();
          }
          catch(\Throwable $e) {
            return Response::create([ 'message' => $e->getMessage() ], 500);
          }

          break;
        case 'remove':
        try {
          $existing_list_record->delete();
        }
        catch(\Throwable $e) {
          return Response::create([ 'message' => $e->getMessage() ], 500);
        }          break;
        case 'currently_reading':
          if (! $existing_list_record ) {
            $list_record = new BookList;
            $list_record->user_id = auth()->user()->id;
            $list_record->book_id = $book_id;
            $list_record->currently_reading = $input['action'];

            try {
              $list_record->save();
            }
            catch(\Throwable $e) {
              return Response::create([ 'message' => $e->getMessage() ], 500);
            }
          } else {
            if ( $input['action'] == true ) {
              $currently_reading = BookList::where('user_id', $user_id)
                                        ->where('currently_reading', true)
                                        ->first();

              if( $currently_reading ) {
                $currently_reading->currently_reading = false;
              }

              $existing_list_record->currently_reading = true;

            } else if ( $input['action'] == false ) {
              $existing_list_record->currently_reading = $input['action'];
            }
            $existing_list_record->save();
          }
          break;
        case 'finished':
          if ( $input['action'] == true ) {
            $existing_list_record->finished = 1;
            $existing_list_record->currently_reading = 0;
            // Apply the books attributes to the user.
            // get the book's attributes
            $book = Book::with('attributes')
                          ->where('id', $book_id)
                          ->first();
            $attributes = $book->attributes;
            // check if the user has those attributes already
            $user_attributes = [];
            foreach ( $attributes as $attr ) {
              $user_attr = UserAttribute::where('attribute_id', $attr->id)->first();
              if ( $user_attr ) {
                // if they do, add xp to existing attribute and check if level up is needed
                $user_attr->experience += $attr->value;
                if ($user_attr->experience > (( $user_attr->level / 0.6 ) ** 2) ) {
                  $user_attr->level += 1;
                }

                try {
                  $user_attr->save();
                }
                catch(\Throwable $e) {
                  return Response::create([ 'message' => $e->getMessage() ], 500);
                }
              } else {
                // if not, add attribute at level 1 and add experience.
                $user_attr = new UserAttribute();
                $user_attr->user_id = $user_id;
                $user_attr->attribute_id = $attr->id;
                $user_attr->level = 1;
                $user_attr->experience = $attr->value;

                try {
                  $user_attr->save();
                }
                catch(\Throwable $e) {
                  return Response::create([ 'message' => $e->getMessage() ], 500);
                }
              }
            }

          } else if ( $input['action'] == false ) {
            $existing_list_record->finished = 0;
          }

          try {
            $existing_list_record->save();
          }
          catch(\Throwable $e) {
            return Response::create([ 'message' => $e->getMessage() ], 500);
          }
          break;
      }

      return Response::create([ 'message' => 'success' ]);
    }
}
