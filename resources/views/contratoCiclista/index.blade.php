<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contratos de {{ $ciclista->nombre }} {{ $ciclista->apellido }}</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  </head>
  <body class="pt-8">

    <div class="container mx-auto px-4">
      <h1 class="text-center text-4xl font-bold text-gray-900 dark:text-black mb-6">

      <div class="mb-4">
    <a href="{{ url('/ciclista') }}" 
       class="inline-block px-5 py-2.5 bg-yellow-400 hover:bg-yellow-500 text-white font-medium rounded-full text-sm focus:outline-none focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-900">
      ← Volver a Ciclistas
    </a>
  </div>
        Contratos de {{ $ciclista->nombre }} {{ $ciclista->apellido }}
      </h1>

      <div class="text-center mb-6">
        <button
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#mCrearContrato"
          class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6 mr-2"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          Crear contrato
        </button>
      </div>

      @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
      @endif

      <div class="flex justify-center">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full max-w-6xl bg-white mt-6">
          <table class="w-full text-sm text-left text-black">
            <thead class="text-xs uppercase bg-gray-200 text-gray-800 font-semibold">
              <tr>
                <th scope="col" class="px-6 py-3">ID Contrato</th>
                <th scope="col" class="px-6 py-3">Fecha Inicio</th>
                <th scope="col" class="px-6 py-3">Fecha Fin</th>
                <th scope="col" class="px-6 py-3">Equipo</th>
                <th scope="col" class="px-6 py-3 text-right">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($contratos as $contrato)
                <tr class="bg-white border-b border-gray-200">
                  <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
                    {{ $contrato->idContrato }}
                  </th>
                  <td class="px-6 py-4 text-black">{{ $contrato->fechaInicio }}</td>
                  <td class="px-6 py-4 text-black">{{ $contrato->fechaFin ?? '-' }}</td>
                  <td class="px-6 py-4 text-black">{{ $contrato->equipo->nombreEquipo ?? 'N/A' }}</td>
                  <td class="px-6 py-4 text-right">
                    <button
                      class="text-yellow-500 hover:underline me-2"
                      data-bs-toggle="modal"
                      data-bs-target="#mEditarContrato"
                      data-idContrato="{{ $contrato->idContrato }}"
                      data-fechaInicio="{{ $contrato->fechaInicio }}"
                      data-fechaFin="{{ $contrato->fechaFin }}"
                      data-codigoEquipo="{{ $contrato->codigoEquipo }}"
                    >
                      Editar
                    </button>
                    |
                    <button
                      class="text-red-600 hover:underline ms-2"
                      data-bs-toggle="modal"
                      data-bs-target="#mEliminarContrato"
                      data-idContrato="{{ $contrato->idContrato }}"
                      data-fechaInicio="{{ $contrato->fechaInicio }}"
                      data-codigoEquipo="{{ $contrato->codigoEquipo }}"
                      data-nombreEquipo="{{ $contrato->equipo->nombreEquipo ?? '' }}"
                    >
                      Eliminar
                    </button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                    No hay contratos para este ciclista.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal Crear Contrato -->
    <div class="modal" id="mCrearContrato" tabindex="-1" aria-labelledby="crearContratoLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="formCrearContrato" action="{{ route('contratoCiclistas.store') }}" method="POST">
            @csrf
            <input type="hidden" name="codigoCiclista" value="{{ $ciclista->codigoCiclista }}">
            <div class="modal-header">
              <h5 class="modal-title" id="crearContratoLabel">Crear Contrato</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="fechaInicio" class="form-label">Fecha Inicio</label>
                <input type="date" class="form-control" name="fechaInicio" required />
              </div>
              <div class="mb-3">
                <label for="fechaFin" class="form-label">Fecha Fin (opcional)</label>
                <input type="date" class="form-control" name="fechaFin" />
              </div>
              <div class="mb-3">
                <label for="codigoEquipo" class="form-label">Equipo</label>
                <select name="codigoEquipo" class="form-select" required>
                  <option value="" disabled selected>Seleccione equipo</option>
                  @foreach ($equipos as $equipo)
                    <option value="{{ $equipo->codigoEquipo }}">{{ $equipo->nombreEquipo }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Guardar</button>
              <button type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900" data-bs-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Editar Contrato -->
    <div class="modal" id="mEditarContrato" tabindex="-1" aria-labelledby="editarContratoLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="formEditarContrato" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="codigoCiclista" value="{{ $ciclista->codigoCiclista }}">
            <div class="modal-header">
              <h5 class="modal-title" id="editarContratoLabel">Editar Contrato</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="idContrato" id="editIdContrato" />
              <div class="mb-3">
                <label for="editFechaInicio" class="form-label">Fecha Inicio</label>
                <input type="date" class="form-control" name="fechaInicio" id="editFechaInicio" required />
              </div>
              <div class="mb-3">
                <label for="editFechaFin" class="form-label">Fecha Fin (opcional)</label>
                <input type="date" class="form-control" name="fechaFin" id="editFechaFin" />
              </div>
              <div class="mb-3">
                <label for="editCodigoEquipo" class="form-label">Equipo</label>
                <select name="codigoEquipo" id="editCodigoEquipo" class="form-select" required>
                  <option value="" disabled>Seleccione equipo</option>
                  @foreach ($equipos as $equipo)
                    <option value="{{ $equipo->codigoEquipo }}">{{ $equipo->nombreEquipo }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Guardar cambios</button>
              <button type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900" data-bs-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Eliminar Contrato -->
    <div class="modal" id="mEliminarContrato" tabindex="-1" aria-labelledby="eliminarContratoLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="formEliminarContrato" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-header">
              <h5 class="modal-title" id="eliminarContratoLabel">Eliminar Contrato</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <p>¿Está seguro que desea eliminar este contrato?</p>
              <p><strong>Contrato ID:</strong> <span id="deleteIdContrato"></span></p>
              <p><strong>Fecha Inicio:</strong> <span id="deleteFechaInicio"></span></p>
              <p><strong>Equipo:</strong> <span id="deleteEquipo"></span></p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">Eliminar</button>
              <button type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900" data-bs-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      // Editar contrato - llenar formulario al abrir modal
      const editarModal = document.getElementById('mEditarContrato');
      editarModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const idContrato = button.getAttribute('data-idContrato');
        const fechaInicio = button.getAttribute('data-fechaInicio');
        const fechaFin = button.getAttribute('data-fechaFin');
        const codigoEquipo = button.getAttribute('data-codigoEquipo');

        const form = editarModal.querySelector('form');
        form.action = `/contratoCiclistas/${idContrato}`;

        document.getElementById('editIdContrato').value = idContrato;
        document.getElementById('editFechaInicio').value = fechaInicio;
        document.getElementById('editFechaFin').value = fechaFin || '';
        document.getElementById('editCodigoEquipo').value = codigoEquipo;
      });

      // Eliminar contrato - llenar datos al abrir modal
      const eliminarModal = document.getElementById('mEliminarContrato');
      eliminarModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const idContrato = button.getAttribute('data-idContrato');
        const fechaInicio = button.getAttribute('data-fechaInicio');
        const codigoEquipo = button.getAttribute('data-codigoEquipo');
        const nombreEquipo = button.getAttribute('data-nombreEquipo');

        const form = eliminarModal.querySelector('form');
        form.action = `/contratoCiclistas/${idContrato}`;

        document.getElementById('deleteIdContrato').textContent = idContrato;
        document.getElementById('deleteFechaInicio').textContent = fechaInicio;
        document.getElementById('deleteEquipo').textContent = nombreEquipo || codigoEquipo;
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
