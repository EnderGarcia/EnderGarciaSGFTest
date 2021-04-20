<div class="bg-dark" id="loadingUsersTable" style="height:100%;width:95%;position:absolute;z-index:20;opacity:0.9;">
  <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
      <div class="">
        <div class="d-flex flex-row justify-content-center text-light">
          <h1><i class="fas fa-spinner fa-spin"></i></h1>
        </div>
      </div>
    </div>
</div>
@if (!empty($data) && $data->count())
{!! $data->links("pagination::bootstrap-4") !!}
@endif
<div class="table-responsive px-3 table-dark">
  <table class="table table-sm table-dark text-center table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
        <th scope="col">Tipo de Documento</th>
        <th scope="col">Fecha de Creación</th>
        <th scope="col">Fecha de Actualización</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @if (!empty($data) && $data->count())
        @foreach ($data as $key => $user)
          @php
            $id = ($key + 1)+($data->currentPage() * 10)-10;
          @endphp
          <tr>
            <td>{{$id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->document->name}}</td>
            <td>{{date('d/m/y h:i A',strtotime($user->created_at))}}</td>
            <td>{{date('d/m/y h:i A',strtotime($user->updated_at))}}</td>
            <td>
              <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                <button data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" type="button" class="btn btn-outline-warning" onClick="editUser('{{$user}}')"><i class="far fa-edit"></i></button>
                <button data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar" type="button" class="btn btn-sm btn-outline-danger" onClick="deleteUser('{{$user}}')"><i class="fas fa-times"></i></button>
              </div>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="6">No data found.</td>
        </tr>
      @endif
    </tbody>
  </table>
</div>
@if (!empty($data) && $data->count())
{!! $data->links("pagination::bootstrap-4") !!}
@endif
