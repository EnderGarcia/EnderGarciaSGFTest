<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentType;

class HomeController extends Controller
{
    public function index()
    {
      //Funcion inicial que muestra el view correspondiente al home (welcome)
      $document_types = DocumentType::all()->pluck('name','id')->toArray();
      return view('welcome')->with([
        'document_types' => $document_types,
      ]);
    }
}
