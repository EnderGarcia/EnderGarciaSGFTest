<?php

namespace App\Http\Controllers\DocumentTypes;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentType;
use DB;

class DocumentTypesController extends Controller
{

  // Mensajes customizables para el validador
  private $customValidationMessages = [
    'name.required' => 'El nombre es requerido.',
    'name.between' => 'El nombre debe ser mayor a :min y menor a :max caracteres.',
    'name.unique' => 'El nombre que intenta asignar ya se está utilizando.',
  ];
  // Paginación default
  private $pagination = 5;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
     $documents = DocumentType::orderByDesc('id')->paginate($this->pagination);
     return response()->json($documents);
  }

  public function list(Request $request)
  {
    //FUNCION: Devuelve la lista de tipos de documentos (para el refrescamiento luego de agregar/editar/eliminar)
     if($request->ajax())
     {
      $data = DocumentType::orderByDesc('id')->paginate($this->pagination);
      return view('documents.documentsTable', compact('data'))->render();
     }
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      //FUNCION: Permite crear nuevos documentos.

      // Validación de Request
      $validator = Validator::make($request->toArray(), [
        'name' => 'required|unique:document_types|between:5,100',
      ],$this->customValidationMessages);

      // Si la validación falla, devuelve la lista de errores con el código 422.
      if ($validator->fails()) {
        return response()->json($validator->errors(),422);
      }

      // Llama al Stored Procedure insertDocumentType, enviando la variable requerida para su funcionamiento.
      $createDocument = DB::select('call insertDocumentType(?)',[$request->name]);

      return response()->json(true,200);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      // FUNCION: Permite actualizar/editar un documento.
      $validator = Validator::make($request->toArray(), [
        'name' => 'required|between:5,100',
      ],$this->customValidationMessages);

      // Si la validación falla, devuelve la lista de errores con el código 422.
      if ($validator->fails()) {
        return response()->json($validator->errors(),422);
      }

      // Debido a que la variable $id llega fuera del request, se hace una nueva validación para verificar que exista.(Se pudiese agregar al request, pero prefiero hacer estos pasos a parte)
      $validator = Validator::make(
        [
          'id' => $id
        ],
        [
          'id' => 'required|integer|min:1|exists:document_types,id',
        ]
      ,$this->customValidationMessages);

      // Si la validación falla, devuelve la lista de errores con el código 422.
      if ($validator->fails()) {
        return response()->json($validator->errors(),422);
      }

      // Valida que si, al cambiar un nombre, el mismo no se encuentre en otro documento.
      $foundDocument = DocumentType::where('name',$request->name)->first();
      if ($foundDocument) {
        if ($foundDocument->id <> $id) {
        return response()->json([
          'email' => 'El nombre indicado ya existe en otro documento, debe ser único.'
        ],422);
        }
      }
      // Llama al Stored Procedure updateDocumentType, enviando las variables requeridas para su funcionamiento.
      $updateDocument = DB::select('call updateDocumentType(?,?)',[$request->id,$request->name]);

      return response()->json(true,200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    // FUNCION: Permite eliminar un documento
    $validator = Validator::make([
        'id' => $id
      ],
      [
        'id' => 'required|integer|min:1|exists:document_types,id',
      ]
    ,$this->customValidationMessages);

    // Si la validación falla, devuelve la lista de errores con el código 422.
    if ($validator->fails()) {
      return response()->json($validator->errors(),422);
    }

    // Llama al Stored Procedure destroyDocumentType, enviando la variable requerida para su funcionamiento.
    $destroyDocument = DB::select('call destroyDocumentType(?)',[$id]);

    return response()->json(true,200);
  }
}
