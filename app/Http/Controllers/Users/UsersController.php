<?php

namespace App\Http\Controllers\Users;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    // Mensajes customizables para el validador
    private $customValidationMessages = [
      'name.required' => 'El nombre es requerido.',
      'name.between' => 'El nombre debe ser mayor a :min y menor a :max caracteres.',
      'email.required' => 'El email es requerido.',
      'email.between' => 'El email debe ser mayor a :min y menor a :max caracteres.',
      'email.email' => 'El email debe ser válido.',
      'email.unique' => 'El email debe ser único.',
      'document_type_id.required' => 'El tipo de documento es requerido.',
      'document_type_id.integer' => 'El tipo de documento tiene un formato incorrecto.',
      'document_type_id.min' => 'El tipo de documento es requerido.',
      'document_type_id.exists' => 'El tipo de documento debe existir en las opciones permitidas.',
    ];
    // Paginación default
    private $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $users = User::orderByDesc('created_at')->paginate($this->pagination);
       return response()->json($users);
    }

    public function list(Request $request)
    {
      //FUNCION: Devuelve la lista de usuarios (para el refrescamiento luego de agregar/editar/eliminar)
       if($request->ajax())
       {
        $data = User::orderByDesc('created_at')->paginate($this->pagination);
        return view('users.usersTable', compact('data'))->render();
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
        // Para validar emails reales |email:rfc,dns|
        $validator = Validator::make($request->toArray(), [
          'name' => 'required|between:5,100',
          'email' => 'required|email|unique:users|between:1,100',
          'document_type_id' => 'required|integer|min:1|exists:document_types,id',
        ],$this->customValidationMessages);

        // Si la validación falla, devuelve la lista de errores con el código 422.
        if ($validator->fails()) {
          return response()->json($validator->errors(),422);
        }

        $newUser = new User;
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->document_type_id = $request->document_type_id;
        $newUser->save();

        return true;
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
        // FUNCION: Permite actualizar/editar un usuario.
        $validator = Validator::make($request->toArray(), [
          'name' => 'required|between:5,100',
          'email' => 'required|email|between:1,100',
          'document_type_id' => 'required|integer|min:1|exists:document_types,id',
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
            'id' => 'required|integer|min:1|exists:users,id',
          ]
        ,$this->customValidationMessages);

        // Si la validación falla, devuelve la lista de errores con el código 422.
        if ($validator->fails()) {
          return response()->json($validator->errors(),422);
        }

        $email = $request->email;

        $foundEmail = User::where('email',$email)->first();

        // Valida que si, al cambiar un email, el mismo no se encuentre en otro usuario.
        if ($foundEmail) {
          if ($foundEmail->id <> $id) {
          return response()->json([
            'email' => 'El email indicado ya existe en otro usuario, debe ser único.'
          ],422);
          }
        }

        $editUser = User::find($id);
        $editUser->name = $request->name;
        $editUser->email = $request->email;
        $editUser->document_type_id = $request->document_type_id;
        $editUser->save();

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
          'id' => 'required|integer|min:1|exists:users,id',
        ]
      ,$this->customValidationMessages);

      // Si la validación falla, devuelve la lista de errores con el código 422.
      if ($validator->fails()) {
        return response()->json($validator->errors(),422);
      }

      $destroyUser = User::find($id)->delete();

      return response()->json(true,200);
    }
}
