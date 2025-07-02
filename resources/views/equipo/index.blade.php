<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Equipos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
     <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  </head>
  <body class="pt-8">

<div class="container mx-auto px-4">
  <h1 class="text-center text-4xl font-bold text-gray-900 dark:text-black mb-6">Lista Equipos</h1>

<div class="text-center mb-6">
  <button type="button" data-bs-toggle="modal" data-bs-target="#mCrearEquipo"
    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center"
    type="button"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /> </svg> Crear equipo</button>
</div>


  <div class="flex justify-center">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full max-w-6xl bg-white mt-6">
      <table class="w-full text-sm text-left text-black">
        <thead class="text-xs uppercase bg-gray-200 text-gray-800 font-semibold">
          <tr>
            <th scope="col" class="px-6 py-3">Código</th>
            <th scope="col" class="px-6 py-3">Nombre Equipo</th>
            <th scope="col" class="px-6 py-3">Fecha de creación</th>
            <th scope="col" class="px-6 py-3">Nacionalidad</th>
            <th scope="col" class="px-6 py-3 text-right">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($listaEquipos as $equipo)
          <tr class="bg-white border-b border-gray-200">
            <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
              {{ $equipo->codigoEquipo }}
            </th>
            <td class="px-6 py-4 text-black">{{ $equipo->nombreEquipo }}</td>
            <td class="px-6 py-4 text-black">{{ $equipo->fechaCreacion }}</td>
            <td class="px-6 py-4 text-black">{{ $equipo->nacionalidad->nombreNacionalidad ?? 'N/A' }}</td>
            <td class="px-6 py-4 text-right">
              <button class="text-blue-600 hover:underline ejecutar" data-bs-toggle="modal" data-bs-target="#mEditarEquipo"
                data-codigo="{{ $equipo->codigoEquipo }}"
                data-nombre="{{ $equipo->nombreEquipo }}"
                data-fechacreacion="{{ $equipo->fechaCreacion }}"
                data-codigonacionalidad="{{ $equipo->codigoNacionalidad }}">
                Editar
              </button>
              |
              <button class="text-red-600 hover:underline eliminar" data-bs-toggle="modal" data-bs-target="#mEliminarEquipo"
                data-codigo="{{ $equipo->codigoEquipo }}"
                data-nombre="{{ $equipo->nombreEquipo }}"
                data-fechacreacion="{{ $equipo->fechaCreacion }}"
                 data-nacionalidad="{{ $equipo->nacionalidad->nombreNacionalidad ?? 'N/A' }}">
                Eliminar
              </button>
              |
              <a href="/participacionesequipos/{{$equipo->codigoEquipo}}">
                <button class="text-green-600 hover:underline">
                  Ver participaciones
                </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


<div class="modal" id="mCrearEquipo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Crear equipo</h2>
      </div>
      <div class="modal-body">
        <form action="/equipo" id="miFormEquipoCrear" method="POST">
          @csrf
          <div class="form-floating mb-3">
            <input type="text" id="nombreEquipo" name="nombreEquipo" class="form-control" maxlength="40" placeholder="Nombre Equipo" required>
            <label for="nombreEquipo">Nombre Equipo</label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" id="fechaCreacion" name="fechaCreacion" class="form-control" required>
            <label for="fechaCreacion">Fecha de creación</label>
          </div>
          <div class="form-floating mb-3">
            <select id="codigoNacionalidad" name="codigoNacionalidad" class="form-select" required>
              <option value="" selected disabled>Seleccione nacionalidad</option>
              @foreach ($nacionalidades as $nacionalidad)
              <option value="{{ $nacionalidad->codigoNacionalidad }}">{{ $nacionalidad->nombreNacionalidad }}</option>
              @endforeach
            </select>
            <label for="codigoNacionalidad">Nacionalidad</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="miFormEquipoCrear" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
          Guardar
        </button>
        <button type="button" data-bs-dismiss="modal" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
          Cancelar
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="mEditarEquipo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Editar equipo</h2>
      </div>
      <div class="modal-body">
        <form action="" id="miFormEquipoEditar" method="POST">
          @method('PUT')
          @csrf
          <div class="mb-3">
            <label class="form-label">Código</label>
            <input type="text" id="codigoEquipoU" class="form-control" readonly>
          </div>
          <div class="form-floating mb-3">
            <input type="text" id="nombreEquipoU" name="nombreEquipoU" class="form-control" required>
            <label for="nombreEquipoU">Nombre Equipo</label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" id="fechaCreacionU" name="fechaCreacionU" class="form-control" required>
            <label for="fechaCreacionU">Fecha de creación</label>
          </div>
          <div class="form-floating mb-3">
            <select id="codigoNacionalidadU" name="codigoNacionalidadU" class="form-select" required>
              <option value="" disabled>Seleccione nacionalidad</option>
              @foreach ($nacionalidades as $nacionalidad)
                <option value="{{ $nacionalidad->codigoNacionalidad }}">{{ $nacionalidad->nombreNacionalidad }}</option>
              @endforeach
            </select>
            <label for="codigoNacionalidadU">Nacionalidad</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="miFormEquipoEditar" class="btn btn-success">
          Guardar cambios
        </button>
        <button type="button" data-bs-dismiss="modal" class="btn btn-warning">
          Cancelar
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="mEliminarEquipo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Eliminar Equipo</h2>
      </div>
      <div class="modal-body">
        <form action="" id="miFormEliminarEquipo" method="POST">
          @csrf
          @method('DELETE')
          <div class="form-floating mb-3">
            <input type="text" id="codigoEquipop" class="form-control" readonly>
            <label for="codigoEquipop">Código</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" id="nombreEquipop" class="form-control" readonly>
            <label for="nombreEquipop">Nombre</label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" id="fechaCreacionp" class="form-control" readonly>
            <label for="fechaCreacionp">Fecha de creación</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" id="nacionalidadp" class="form-control" readonly>
            <label for="nacionalidadp">Nacionalidad</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="miFormEliminarEquipo" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
          Eliminar
        </button>
        <button type="button" data-bs-dismiss="modal" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
          Cancelar
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.ejecutar').on('click', function() {
      let codigo = $(this).data('codigo');
      let nombre = $(this).data('nombre');
      let fechaCreacion = $(this).data('fechacreacion');
      let codigoNacionalidad = $(this).data('codigonacionalidad');

      $('#codigoEquipoU').val(codigo);
      $('#nombreEquipoU').val(nombre);
      $('#fechaCreacionU').val(fechaCreacion);
      $('#codigoNacionalidadU').val(codigoNacionalidad);

      document.getElementById('miFormEquipoEditar').action = '/equipo/' + codigo;
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('.eliminar').on('click', function() {
      let codigo = $(this).data('codigo');
      let nombre = $(this).data('nombre');
      let fechaCreacion = $(this).data('fechacreacion');
      let nacionalidad = $(this).data('nacionalidad');

      $('#codigoEquipop').val(codigo);
      $('#nombreEquipop').val(nombre);
      $('#fechaCreacionp').val(fechaCreacion);
      $('#nacionalidadp').val(nacionalidad);

      document.getElementById('miFormEliminarEquipo').action = '/equipo/' + codigo;
    });
  });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>