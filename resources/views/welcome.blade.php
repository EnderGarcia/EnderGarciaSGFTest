@extends('layouts.app')
@section('content')
    <div class="d-flex flex-column justify-content-top" style="height: 86vh;">
      <div class="p-3">
        <div class="row shadow py-5 px-3 rounded">
          <div class="col-12 col-md-4 pb-1">
            <div class="row">
              <div class="col-12 text-center">
                <h3>¡Bienvenid@!</h3>
              </div>
              <div class="col-12 text-center">
                <hr>
              </div>
              <div class="col-12 text-center">
                En la sección <b>[Inicio]</b> encontrará los comentarios, tips y mayor información sobre el proyecto y requerimientos
              </div>
              <div class="col-12 text-center">
                <hr>
              </div>
              <div class="col-12 text-center">
                En las secciones <b>[Usuarios]</b> y <b>[Tipo de documento]</b> encontrará los CRUDs requeridos.
              </div>
            </div>
          </div>
          <div class="col-12 col-md-8 border rounded p-3">
            <div class="row">
              <div class="col-12 text-center py-1">
                <h5>Herramientas de validación de código</h5>
              </div>
              <div class="col text-center">
                <label> Validación de jQuery (Front):</label>
                <button data-bs-toggle="tooltip" data-bs-placement="top" title="Activar/Desactivar validaciones jQuery"  type="button" class="btn btn-sm btn-success" name="jqueryValidation" onClick="jqueryVal()"><i class="fas fa-code"></i> <span name="jqueryValidationIndicator">Activa</span> </button>
              </div>
              <div class="col text-center py-1">
                <div class="row">
                  <div class="col-12 text-center alert alert-dark my-2">
                    <b>[2.c] Crear un middleware donde se verifique que exista y tenga valor un header “api-key-laika”</b>
                  </div>

                </div>
              </div>
              <div class="col text-center">
                <div class="col-12">
                  Para probarlo, elimine el contendio del campo.
                </div>
                <div class="col-12">
                  <label><b>api-key-laika:</b> </label>
                </div>
                <div class="col-12">
                  <input type="text" name="api-key-laika" id="api-key-laika" value="123456789">
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 p-3">
            <hr>
          </div>
          <div class="col-12 col-lg-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active" id="v-pills-inicio-tab" data-toggle="pill" href="#v-pills-inicio" role="tab" aria-controls="v-pills-inicio" aria-selected="false">Inicio</a>
              <a class="nav-link" id="v-pills-CRUD1-tab" data-toggle="pill" href="#v-pills-CRUD1" role="tab" aria-controls="v-pills-CRUD1" aria-selected="false">Usuarios</a>
              <a class="nav-link" id="v-pills-CRUD2-tab" data-toggle="pill" href="#v-pills-CRUD2" role="tab" aria-controls="v-pills-CRUD2" aria-selected="false">Tipo de Documento</a>
            </div>
          </div>
          <div class=" col-12 col-lg-10">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade  show active" id="v-pills-inicio" role="tabpanel" aria-labelledby="v-pills-inicio-tab">
                <div class="row">
                  <div class="col-12 text-center">
                    A continuación, se muestran los comentarios de los requerimientos expuestos en el documento <b>[Prueba Técnica Backend]</b> compartido al correo.
                  </div>
                  <div class="col-12">
                    <br>
                  </div>
                  <div class="col-12 text-center">
                    <b>[1]</b> La construcción de la base de datos, se realiza desde la migración con el comando:
                  </div>
                  <div class="col-auto m-auto text-center alert alert-dark p-1">
                    <b><i>php artisan migrate --seed</i></b>
                  </div>
                  <div class="col-12 text-center">
                    Es importante agregar el comando <b>--seed</b> ya que los documentos y usuarios ejemplo son agregados desde el mismo.
                  </div>
                  <div class="col-12">
                    <br>
                  </div>
                  <div class="col-12 text-center">
                    <b>[2.b]</b> Los stored procedures solicitados se crean durante la migración, en el documento llamado <b>2021_04_20_121258_create_stored_procedures.php</b>
                  </div>
                  <div class="col-12">
                    <br>
                  </div>
                  <div class="col-12 text-center">
                    <b>[3]</b> Por otra parte, para ejecutar las pruebas unitarias de <b>DocumentTest.php</b> y <b>UserTest.php</b>, debe ejecutarse el comando desde la consola:
                  </div>
                  <div class="col-auto m-auto text-center alert alert-dark my-2 p-1">
                    <b><i>php artisan test</i></b>
                  </div>
                  <div class="col-12">
                    <br>
                  </div>
                  <div class="col-12 text-center">
                    <b>[4.a]</b> Los tiempos de respuesta pueden ser verificados al inspeccionar la página web, en la pestaña Network. En la prueba local a la hora de entregar este proyecto, ninguno pasa del límite indicado.
                    <br>
                    <b>[4.b]</b> Alterando los valores predispuestos de las pruebas unitarias (como nombre o email) se pueden comprobar las validaciones requeridas.
                  </div>
                  <div class="col-12">
                    <br>
                  </div>
                  <div class="col-12 text-center">
                    <b>[5]</b> Todos los consumos (excepto el de home) se realizan desde un ajax, facilitando así el análisis en la implementación de código laravel con un front de otro tipo.
                  </div>
                  <div class="col-12">
                    <br>
                  </div>
                  <div class="col-12 text-center">
                    Finalmente, agradezco mucho su tiempo y consideración para formar parte de su equipo. Cualquier duda, comentario o sugerencia, lo puede dirigir conmigo.
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="v-pills-CRUD1" role="tabpanel" aria-labelledby="v-pills-CRUD1-tab">
                <div class="row">
                  <div class="col-12">
                    En esta sección, se encuentran todas aquellas funciones relacionadas con la solicitud del punto <b>[2.a]</b>:
                  </div>
                  <div class="col-12">
                    <br>
                  </div>
                  <div class="col-12 text-center alert alert-dark my-2">
                    <b>CRUD 1: Crear todos los caminos para el mantenimiento de la tabla paramétrica usando Laravel.</b>
                  </div>
                  <div class="col-12">
                    <div class="row bg-dark rounded">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-12 col-md p-3 text-white text-center">
                            <h3>Lista de Usuarios</h3>
                          </div>
                          <div class="col-12 col-md-auto ml-auto p-3 text-center">
                            <div class="row">
                              <div class="col-12 pt-3">
                                <button data-bs-toggle="tooltip" data-bs-placement="top" title="Refrescar lista" type="button" onClick="userIndex()" class="btn btn-sm btn-outline-primary" name="button"><i class="fas fa-sync-alt"></i></button>
                                <button data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar" type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#addUser" name="button"><i class="fas fa-plus"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12" id="userTableContainer">
                        @include('users.usersTable')
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="v-pills-CRUD2" role="tabpanel" aria-labelledby="v-pills-CRUD2-tab">
                <div class="row">
                  <div class="col-12">
                    En esta sección, se encuentran todas aquellas funciones relacionadas con la solicitud del punto <b>[2.b]</b>:
                  </div>
                  <div class="col-12">
                    <br>
                  </div>
                  <div class="col-12 text-center alert alert-dark my-2">
                    <b>CRUD 2: Crear todos los caminos para el mantenimiento de la tabla relacional no paramétrica usando consumo directo de la base de datos sin ORM a través de Stored Procedures.</b>
                  </div>
                  <div class="col-12">
                    <div class="row bg-dark rounded">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-12 col-md p-3 text-white text-center">
                            <h3>Lista de Documentos</h3>
                          </div>
                          <div class="col-12 col-md-auto ml-auto p-3 text-center">
                            <div class="row">
                              <div class="col-12 pt-3">
                                <button data-bs-toggle="tooltip" data-bs-placement="top" title="Refrescar lista" type="button" onClick="documentIndex()" class="btn btn-sm btn-outline-primary" name="button"><i class="fas fa-sync-alt"></i></button>
                                <button data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar" type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#addDocument" name="button"><i class="fas fa-plus"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12" id="documentTableContainer">
                        @include('documents.documentsTable')
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="v-pills-SAMPLE" role="tabpanel" aria-labelledby="v-pills-SAMPLE-tab">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-dark text-white">
            <h5 class="modal-title" id="addUserLabel">Crear Usuario</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="bg-white" id="loadingAddUser" style="height:80%;width:100%;position:absolute;z-index:20;opacity:0.9;margin-top:63.09px;display:none;">
            <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
                <div class="">
                  <div class="d-flex flex-row justify-content-center text-light">
                    <h1><i class="fas fa-spinner fa-spin text-dark"></i></h1>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-body">
            <div class="row text-center">
              <div class="col-12 alert alert-info">
                Validación jQuery: <br> <span class="badge badge-success" name="jqueryValidationIndicator" onClick="jqueryVal()">Activa</span>
              </div>
            </div>
            <div class="form-group">
              <form class="" id="addUserForm">
                <div class="row">
                  <div class="col-12 pb-3">
                    <label for="user_name"><b>Nombre</b></label>
                    <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Ej: Elon Musk">
                  </div>
                  <div class="col-12 pb-3">
                    <label for="user_email"><b>Email</b></label>
                    <input type="text" class="form-control" name="user_email" id="user_email" email placeholder="Ej: gaben@valvesoftware.com">
                  </div>
                  <div class="col-12 pb-3">
                    <label for="user_email"><b>Tipo de Documento</b></label>
                    <select class="form-control" name="user_document_type_id" id="user_document_type_id">
                      <option value="0" selected>*</option>
                      @foreach ($document_types as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="clearModal('addUserForm')">Cerrar</button>
            <button type="button" class="btn btn-success" onClick="addUser()">Crear</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-dark text-white">
            <h5 class="modal-title" id="editUserLabel">Editar Usuario</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="bg-white" id="loadingEditUser" style="height:80%;width:100%;position:absolute;z-index:20;opacity:0.9;margin-top:63.09px;display:none;">
            <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
                <div class="">
                  <div class="d-flex flex-row justify-content-center text-light">
                    <h1><i class="fas fa-spinner fa-spin text-dark"></i></h1>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-body">
            <div class="row text-center">
              <div class="col-12 alert alert-info">
                Validación jQuery: <br> <span class="badge badge-success" name="jqueryValidationIndicator" onClick="jqueryVal()">Activa</span>
              </div>
            </div>
            <div class="form-group">
              <form class="" id="editUserForm">
                <div class="row">
                  <div class="col-12 pb-3">
                    <label for="edit_name"><b>Nombre</b></label>
                    <input type="text" class="form-control" name="edit_name" id="edit_name" placeholder="Ej: Elon Musk">
                  </div>
                  <div class="col-12 pb-3">
                    <label for="edit_email"><b>Email</b></label>
                    <input type="text" class="form-control" name="edit_email" id="edit_email" email placeholder="Ej: gaben@valvesoftware.com">
                  </div>
                  <div class="col-12 pb-3">
                    <label for="edit_email"><b>Tipo de Documento</b></label>
                    <select class="form-control" name="edit_document_type_id" id="edit_document_type_id">
                      <option value="0" selected>*</option>
                      @foreach ($document_types as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" onClick="updateUser(this)" data-id="" id="updateUserButton">Actualizar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="deleteUserLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-dark text-white">
            <h5 class="modal-title" id="deleUserLabel">Eliminar Usuario</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="bg-white" id="loadingDeleteUser" style="height:80%;width:100%;position:absolute;z-index:20;opacity:0.9;margin-top:63.09px;display:none;">
            <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
                <div class="">
                  <div class="d-flex flex-row justify-content-center text-light">
                    <h1><i class="fas fa-spinner fa-spin text-dark"></i></h1>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger text-center">
              ¿Está seguro que desea eliminar este usuario?
              <br>
              <b>Esta acción no se puede deshacer</b>
              <br>
              <hr>
              <b>Información de Usuario</b>
              <br>
              <b>Nombre:</b> <label id="delete_user_name"></label>
              <br>
              <b>Email:</b> <label id="delete_user_email"></label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" onClick="destroyUser(this)" data-id="" id="deleteUserButton">Eliminar</button>
          </div>
        </div>
      </div>
    </div>

    {{--  --}}
    <div class="modal fade" id="addDocument" tabindex="-1" role="dialog" aria-labelledby="addDocumentLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-dark text-white">
            <h5 class="modal-title" id="addDocumentLabel">Crear Documento</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="bg-white" id="loadingAddDocument" style="height:80%;width:100%;position:absolute;z-index:20;opacity:0.9;margin-top:63.09px;display:none;">
            <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
                <div class="">
                  <div class="d-flex flex-row justify-content-center text-light">
                    <h1><i class="fas fa-spinner fa-spin text-dark"></i></h1>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-body">
            <div class="row text-center">
              <div class="col-12 alert alert-info">
                Validación jQuery: <br> <span class="badge badge-success" name="jqueryValidationIndicator" onClick="jqueryVal()">Activa</span>
              </div>
            </div>
            <div class="form-group">
              <form class="" id="addDocumentForm">
                <div class="row">
                  <div class="col-12 pb-3">
                    <label for="document_name"><b>Nombre</b></label>
                    <input type="text" class="form-control" name="document_name" id="document_name" placeholder="Ej: Elon Musk">
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="clearModal('addDocumentForm')">Cerrar</button>
            <button type="button" class="btn btn-success" onClick="addDocument()">Crear</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editDocument" tabindex="-1" role="dialog" aria-labelledby="editDocumentLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-dark text-white">
            <h5 class="modal-title" id="editDocumentLabel">Editar Documento</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="bg-white" id="loadingEditDocument" style="height:80%;width:100%;position:absolute;z-index:20;opacity:0.9;margin-top:63.09px;display:none;">
            <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
                <div class="">
                  <div class="d-flex flex-row justify-content-center text-light">
                    <h1><i class="fas fa-spinner fa-spin text-dark"></i></h1>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-body">
            <div class="row text-center">
              <div class="col-12 alert alert-info">
                Validación jQuery: <br> <span class="badge badge-success" name="jqueryValidationIndicator" onClick="jqueryVal()">Activa</span>
              </div>
            </div>
            <div class="form-group">
              <form class="" id="editDocumentForm">
                <div class="row">
                  <div class="col-12 pb-3">
                    <label for="edit_document_name"><b>Nombre</b></label>
                    <input type="text" class="form-control" name="edit_document_name" id="edit_document_name" placeholder="Ej: Elon Musk">
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" onClick="updateDocument(this)" data-id="" id="updateDocumentButton">Actualizar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="deleteDocument" tabindex="-1" role="dialog" aria-labelledby="deleteDocumentLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-dark text-white">
            <h5 class="modal-title" id="deleDocumentLabel">Eliminar Documento</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="bg-white" id="loadingDeleteDocument" style="height:80%;width:100%;position:absolute;z-index:20;opacity:0.9;margin-top:63.09px;display:none;">
            <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
                <div class="">
                  <div class="d-flex flex-row justify-content-center text-light">
                    <h1><i class="fas fa-spinner fa-spin text-dark"></i></h1>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger text-center">
              ¿Está seguro que desea eliminar este documento?
              <br>
              <b>Esta acción no se puede deshacer</b>
              <br>
              <hr>
              <b>Información de Documento</b>
              <br>
              <b>Nombre:</b> <label id="delete_document_name"></label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" onClick="destroyDocument(this)" data-id="" id="deleteDocumentButton">Eliminar</button>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('scripts')
  <script type="text/javascript">

    // Variables globales
    var jqueryValidation = true;
    var apiKeyLaika = $("#api-key-laika").val();

    $("#api-key-laika").data('oldVal', $("#api-key-laika").val());

    // hacer bind para conectar cualquier propiedad de edición sobre el api-key-laika, para que la variable global cambie al mismo tiempo.
    $("#api-key-laika").bind("propertychange change click keyup input paste", function(event){
       if ($("#api-key-laika").data('oldVal') != $("#api-key-laika").val()) {
        $("#api-key-laika").data('oldVal', $("#api-key-laika").val());
        apiKeyLaika = $("#api-key-laika").val()
      }
    });
    //
    // Modificadores de variables globales.
    function jqueryVal()
    {
      if (jqueryValidation) {
        $("[name=jqueryValidation]").addClass("btn-danger").removeClass("btn-success");
        $("[name=jqueryValidationIndicator]").addClass('badge-danger').removeClass('badge-success').text('Inactiva');
        jqueryValidation = false;
      }
      else {
        $("[name=jqueryValidation]").addClass("btn-success").removeClass("btn-danger");
        $("[name=jqueryValidationIndicator]").addClass('badge-success').removeClass('badge-danger').text('Activa');
        jqueryValidation = true;
      }
    }
    //

    // detectar tab activa inicialmente.
    $(document).ready(function()
    {
      var initialTabID = $("#v-pills-tab").find("a.nav-link.active")[0];
      if (initialTabID) {
        ActiveTab(initialTabID.id);
      }
    });

    /// detector para refrescar las tablas cuando se haga focus en la tab correcta.
    $(document).on("click", "a.nav-link", function (e) {
      ActiveTab(e.target.id);
    });

    // funciones anidadas para cada tab activa.
    function ActiveTab(id)
    {
      switch (id) {
        case "v-pills-CRUD1-tab":
          userIndex();
          break;
        case "v-pills-CRUD2-tab":
          documentIndex();
          break;
        default:
      }
    }

    // Limpiar modales de edición y agregado.
    function clearModal(id)
    {
      $(':input','#'+id)
      .not(':button, :submit, :reset, :hidden')
      .val('')
      .prop('checked', false)
      .prop('selected', false);
    }

    // Activar Tooltips.
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
  </script>
  @include('scripts.userCrud')
  @include('scripts.documentCrud')
@endsection
