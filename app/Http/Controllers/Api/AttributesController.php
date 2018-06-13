<?php

namespace App\Http\Controllers\Api;

use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class AttributesController extends Controller
{
    public function getAll() {
      $attributes = Attribute::all();

      return Response::create([ 'message' => 'success', 'attributes' => $attributes ]);
    }
}
