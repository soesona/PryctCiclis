<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pruebas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  </head>
  <body class="pt-8">

    <div class="container mx-auto px-4">
      <h1 class="text-center text-4xl font-bold text-gray-900 dark:text-black mb-6">Lista Pruebas</h1>

      <div class="text-center mb-6">
        <button type="button" data-bs-toggle="modal" data-bs-target="#mCrearPrueba"
          class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          Crear Prueba
        </button>
      </div>

      <div class="flex justify-center">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full max-w-6xl bg-white mt-6">
          <table class="w-full text-sm text-left text-black">
            <thead class="text-xs uppercase bg-gray-200 text-gray-800 font-semibold">
              <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Nombre Prueba</th>
                <th class="px-6 py-3">Año Edición</th>
                <th class="px-6 py-3">Núm. Etapas</th>
                <th class="px-6 py-3">Km Totales</th>
                <th class="px-6 py-3">Ciclista</th>
                <th class="px-6 py-3 text-right">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($listaPruebas as $prueba)
              <tr class="bg-white border-b border-gray-200">
                <td class="px-6 py-4">{{ $prueba->id }}</td>
                <td class="px-6 py-4">{{ $prueba->nombrePrueba->nombrePrueba ?? 'N/A' }}</td>
                <td class="px-6 py-4">{{ $prueba->anioEdicion }}</td>
                <td class="px-6 py-4">{{ $prueba->numEtapas }}</td>
                <td class="px-6 py-4">{{ $prueba->kilometrosTotales }}</td>
                <td class="px-6 py-4">{{ $prueba->ciclista->nombre ?? 'N/A' }} {{ $prueba->ciclista->apellido ?? '' }}</td>
                <td class="px-6 py-4 text-right">
                  <button class="text-blue-600 hover:underline editar-prueba" data-bs-toggle="modal" data-bs-target="#mEditarPrueba"
                    data-id="{{ $prueba->id }}"
                    data-nombre="{{ $prueba->codigoNombrePrueba }}"
                    data-anio="{{ $prueba->anioEdicion }}"
                    data-etapas="{{ $prueba->numEtapas }}"
                    data-kms="{{ $prueba->kilometrosTotales }}"
                    data-ciclista="{{ $prueba->idCiclista }}">
                    Editar
                  </button>
                  |
                  <button class="text-red-600 hover:underline eliminar-prueba" data-bs-toggle="modal" data-bs-target="#mEliminarPrueba"
                    data-id="{{ $prueba->id }}"
                    data-nombre="{{ $prueba->nombrePrueba->nombrePrueba ?? 'N/A' }}"
                    data-anio="{{ $prueba->anioEdicion }}"
                    data-etapas="{{ $prueba->numEtapas }}"
                    data-kms="{{ $prueba->kilometrosTotales }}"
                    data-ciclista="{{ $prueba->ciclista->nombre ?? 'N/A' }} {{ $prueba->ciclista->apellido ?? '' }}">
                    Eliminar
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal Crear -->
    <div class="modal" id="mCrearPrueba">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="/prueba" method="POST" id="formCrearPrueba">
            @csrf
            <div class="modal-header">
              <h2 class="modal-title">Crear Prueba</h2>
            </div>
            <div class="modal-body">
              <div class="form-floating mb-3">
                <select id="codigoNombrePrueba" name="codigoNombrePrueba" class="form-select" required>
                  <option value="" disabled selected>Seleccione nombre de prueba</option>
                  @foreach ($nombresPruebas as $nombre)
                  <option value="{{ $nombre->codigoNombrePrueba }}">{{ $nombre->nombrePrueba }}</option>
                  @endforeach
                </select>
                <label for="codigoNombrePrueba">Nombre Prueba</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" id="anioEdicion" name="anioEdicion" class="form-control" required />
                <label for="anioEdicion">Año Edición</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" id="numEtapas" name="numEtapas" class="form-control" required />
                <label for="numEtapas">Núm. Etapas</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" step="0.01" id="kilometrosTotales" name="kilometrosTotales" class="form-control" required />
                <label for="kilometrosTotales">Km Totales</label>
              </div>
              <div class="form-floating mb-3">
                <select id="idCiclista" name="idCiclista" class="form-select" required>
                  <option value="" disabled selected>Seleccione ciclista</option>
                  @foreach ($ciclistas as $ciclista)
                  <option value="{{ $ciclista->codigoCiclista }}">{{ $ciclista->nombre }} {{ $ciclista->apellido }}</option>
                  @endforeach
                </select>
                <label for="idCiclista">Ciclista</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit"
                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Guardar
              </button>
              <button type="button" data-bs-dismiss="modal"
                class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
                Cancelar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal" id="mEditarPrueba">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="" id="formEditarPrueba" method="POST">
            @method('PUT')
            @csrf
            <div class="modal-header">
              <h2 class="modal-title">Editar Prueba</h2>
            </div>
            <div class="modal-body">
              <div class="form-floating mb-3">
                <select id="codigoNombrePruebaEditar" name="codigoNombrePrueba" class="form-select" required>
                  <option value="" disabled>Seleccione nombre de prueba</option>
                  @foreach ($nombresPruebas as $nombre)
                  <option value="{{ $nombre->codigoNombrePrueba }}">{{ $nombre->nombrePrueba }}</option>
                  @endforeach
                </select>
                <label for="codigoNombrePruebaEditar">Nombre Prueba</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" id="anioEdicionEditar" name="anioEdicion" class="form-control" required />
                <label for="anioEdicionEditar">Año Edición</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" id="numEtapasEditar" name="numEtapas" class="form-control" required />
                <label for="numEtapasEditar">Núm. Etapas</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" step="0.01" id="kilometrosTotalesEditar" name="kilometrosTotales" class="form-control" required />
                <label for="kilometrosTotalesEditar">Km Totales</label>
              </div>
              <div class="form-floating mb-3">
                <select id="idCiclistaEditar" name="idCiclista" class="form-select" required>
                  <option value="" disabled>Seleccione ciclista</option>
                  @foreach ($ciclistas as $ciclista)
                  <option value="{{ $ciclista->codigoCiclista }}">{{ $ciclista->nombre }} {{ $ciclista->apellido }}</option>
                  @endforeach
                </select>
                <label for="idCiclistaEditar">Ciclista</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit"
                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Guardar cambios
              </button>
              <button type="button" data-bs-dismiss="modal"
                class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
                Cancelar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal" id="mEliminarPrueba">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="" id="formEliminarPrueba" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-header">
              <h2 class="modal-title">Eliminar Prueba</h2>
            </div>
            <div class="modal-body">
              <div class="form-floating mb-3">
                <input type="text" id="idEliminar" class="form-control" readonly />
                <label for="idEliminar">ID</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" id="nombreEliminar" class="form-control" readonly />
                <label for="nombreEliminar">Nombre Prueba</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" id="anioEliminar" class="form-control" readonly />
                <label for="anioEliminar">Año Edición</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" id="etapasEliminar" class="form-control" readonly />
                <label for="etapasEliminar">Núm. Etapas</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" step="0.01" id="kmsEliminar" class="form-control" readonly />
                <label for="kmsEliminar">Km Totales</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" id="ciclistaEliminar" class="form-control" readonly />
                <label for="ciclistaEliminar">Ciclista</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit"
                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Eliminar
              </button>
              <button type="button" data-bs-dismiss="modal"
                class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
                Cancelar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function () {
        $('.editar-prueba').on('click', function () {
          let id = $(this).data('id');
          let nombre = $(this).data('nombre');
          let anio = $(this).data('anio');
          let etapas = $(this).data('etapas');
          let kms = $(this).data('kms');
          let ciclista = $(this).data('ciclista');

          $('#idEditar').val(id);
          $('#codigoNombrePruebaEditar').val(nombre);
          $('#anioEdicionEditar').val(anio);
          $('#numEtapasEditar').val(etapas);
          $('#kilometrosTotalesEditar').val(kms);
          $('#idCiclistaEditar').val(ciclista);
          $('#formEditarPrueba').attr('action', '/prueba/' + id);
        });

        $('.eliminar-prueba').on('click', function () {
          let id = $(this).data('id');
          let nombre = $(this).data('nombre');
          let anio = $(this).data('anio');
          let etapas = $(this).data('etapas');
          let kms = $(this).data('kms');
          let ciclista = $(this).data('ciclista');

          $('#idEliminar').val(id);
          $('#nombreEliminar').val(nombre);
          $('#anioEliminar').val(anio);
          $('#etapasEliminar').val(etapas);
          $('#kmsEliminar').val(kms);
          $('#ciclistaEliminar').val(ciclista);
          $('#formEliminarPrueba').attr('action', '/prueba/' + id);
        });
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
