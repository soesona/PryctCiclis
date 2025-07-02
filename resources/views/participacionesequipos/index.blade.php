<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Participaciones del Equipo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="pt-8">
    <div class="container mx-auto px-4">
      <h1 class="text-3xl font-bold text-center mb-6">Participaciones de {{ $equipo->nombreEquipo }}</h1>

      <div class="text-center mb-6">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mCrearParticipacion">
          Agregar Participación
        </button>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered text-center">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Nombre Prueba</th>
              <th>Posición Final</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($listaParticipaciones as $participacion)
              <tr>
                <td>{{ $participacion->codigoParticipacionEquipo }}</td>
                <td>{{ $participacion->prueba->nombrePrueba->nombrePrueba ?? 'N/A' }} - {{ $participacion->prueba->anioEdicion ?? 'N/A' }}</td>
                <td>{{ $participacion->posicionFinal }}</td>
                <td>
                  <button class="btn btn-sm btn-warning editar-participacion"
                    data-bs-toggle="modal" data-bs-target="#mEditarParticipacion"
                    data-id="{{ $participacion->codigoParticipacionEquipo }}"
                    data-prueba="{{ $participacion->idPrueba }}"
                    data-posicion="{{ $participacion->posicionFinal }}">
                    Editar
                  </button>

                  <button class="btn btn-sm btn-danger eliminar-participacion"
                    data-bs-toggle="modal" data-bs-target="#mEliminarParticipacion"
                    data-id="{{ $participacion->codigoParticipacionEquipo }}"
                    data-prueba="{{ $participacion->prueba->nombrePrueba->nombrePrueba ?? 'N/A' }}"
                    data-posicion="{{ $participacion->posicionFinal }}">
                    Eliminar
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- Modal Crear --}}
    <div class="modal fade" id="mCrearParticipacion" tabindex="-1">
      <div class="modal-dialog">
        <form action="/participacionesequipos" method="POST" class="modal-content">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Agregar Participación</h5>
          </div>
          <div class="modal-body">
            <input type="hidden" name="codigoEquipo" value="{{ $equipo->codigoEquipo }}">

            <div class="mb-3">
              <label for="idPrueba" class="form-label">Prueba</label>
              <select name="codigoPrueba" id="codigoPrueba" class="form-select" required>
               <option value="" disabled selected>Seleccione una prueba</option>
              @foreach ($pruebasDisponibles as $prueba)
              <option value="{{ $prueba->id }}">{{ $prueba->nombrePrueba->nombrePrueba ?? 'N/A' }} - {{ $prueba->anioEdicion }}</option>
              @endforeach
              </select>

            </div>

            <div class="mb-3">
              <label for="posicionFinal" class="form-label">Posición Final</label>
              <input type="text" name="posicionFinal" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>

    {{-- Modal Editar --}}
    <div class="modal fade" id="mEditarParticipacion" tabindex="-1">
      <div class="modal-dialog">
        <form method="POST" id="formEditarParticipacion" class="modal-content">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title">Editar Participación</h5>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="idPruebaEditar" class="form-label">Prueba</label>
              <select name="codigoPrueba" id="idPruebaEditar" class="form-select" required>
               <option value="" disabled selected>Seleccione una prueba</option>
              @foreach ($pruebasDisponibles as $prueba)
              <option value="{{ $prueba->id }}">{{ $prueba->nombrePrueba->nombrePrueba ?? 'N/A' }} - {{ $prueba->anioEdicion }}</option>
              @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="posicionFinalEditar" class="form-label">Posición Final</label>
              <input type="text" name="posicionFinal" id="posicionFinalEditar" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Guardar cambios</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>

    {{-- Modal Eliminar --}}
    <div class="modal fade" id="mEliminarParticipacion" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" id="formEliminarParticipacion" class="modal-content">
      @csrf
      @method('DELETE')
      <div class="modal-header">
        <h5 class="modal-title">Eliminar Participación</h5>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="codigoPruebaEliminar" class="form-label">Prueba</label>
          <input type="text" id="codigoPruebaEliminar" class="form-control" readonly>
        </div>

        <div class="mb-3">
          <label for="posicionFinalEliminar" class="form-label">Posición Final</label>
          <input type="text" id="posicionFinalEliminar" class="form-control" readonly>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Eliminar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.editar-participacion').forEach(btn => {
          btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const prueba = this.dataset.prueba;
            const posicion = this.dataset.posicion;

            document.getElementById('idPruebaEditar').value = prueba;
            document.getElementById('posicionFinalEditar').value = posicion;
            document.getElementById('formEditarParticipacion').action = '/participacionesequipos/' + id;
          });
        });

        document.querySelectorAll('.eliminar-participacion').forEach(btn => {
  btn.addEventListener('click', function () {
    const id = this.dataset.id;
    const prueba = this.dataset.prueba; // Ya viene con formato "Nombre - Año"
    const posicion = this.dataset.posicion;

    document.getElementById('codigoPruebaEliminar').value = prueba;
    document.getElementById('posicionFinalEliminar').value = posicion;

    document.getElementById('formEliminarParticipacion').action = '/participacionesequipos/' + id;
  });
        });
      });
    </script>
  </body>
</html>
