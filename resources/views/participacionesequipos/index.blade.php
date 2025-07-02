<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Participaciones del Equipo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body class="bg-light pt-5">
    <div class="container">
      <h1 class="text-center mb-4">Participaciones de {{ $equipo->nombreEquipo }}</h1>

      <div class="text-center mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mCrearParticipacion">Agregar Participación</button>
      </div>

      <table class="table table-bordered text-center bg-white">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Prueba</th>
            <th>Posición Final</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($listaParticipaciones as $participacion)
          <tr>
            <td>{{ $participacion->codigoParticipacionEquipo }}</td>
            <td>{{ $participacion->prueba->nombrePrueba->nombrePrueba ?? 'N/A' }}</td>
            <td>{{ $participacion->posicionFinal }}</td>
            <td>
              <button class="btn btn-sm btn-warning editar-btn"
                data-id="{{ $participacion->codigoParticipacionEquipo }}"
                data-prueba="{{ $participacion->idPrueba }}"
                data-posicion="{{ $participacion->posicionFinal }}"
                data-bs-toggle="modal" data-bs-target="#mEditarParticipacion">Editar</button>

              <button class="btn btn-sm btn-danger eliminar-btn"
                data-id="{{ $participacion->codigoParticipacionEquipo }}"
                data-bs-toggle="modal" data-bs-target="#mEliminarParticipacion">Eliminar</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Modal Crear --}}
    <div class="modal fade" id="mCrearParticipacion" tabindex="-1">
      <div class="modal-dialog">
        <form action="/participacionesequipos" method="POST" class="modal-content">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Nueva Participación</h5>
          </div>
          <div class="modal-body">
            <input type="hidden" name="codigoEquipo" value="{{ $equipo->codigoEquipo }}">

            <div class="mb-3">
              <label for="idPrueba" class="form-label">Prueba</label>
              <select name="idPrueba" id="idPrueba" class="form-select" required>
                <option disabled selected>Seleccione prueba</option>
                @foreach ($pruebasDisponibles as $prueba)
                  <option value="{{ $prueba->id }}">{{ $prueba->nombrePrueba->nombrePrueba }}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="posicionFinal" class="form-label">Posición Final</label>
              <input type="text" name="posicionFinal" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" type="submit">Guardar</button>
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>

    {{-- Modal Editar --}}
    <div class="modal fade" id="mEditarParticipacion" tabindex="-1">
      <div class="modal-dialog">
        <form method="POST" class="modal-content" id="formEditarParticipacion">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title">Editar Participación</h5>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="idPruebaEditar" class="form-label">Prueba</label>
              <select name="idPrueba" id="idPruebaEditar" class="form-select" required>
                @foreach ($pruebasDisponibles as $prueba)
                  <option value="{{ $prueba->id }}">{{ $prueba->nombrePrueba->nombrePrueba }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="posicionFinalEditar" class="form-label">Posición Final</label>
              <input type="text" name="posicionFinal" id="posicionFinalEditar" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" type="submit">Guardar Cambios</button>
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>

    {{-- Modal Eliminar --}}
    <div class="modal fade" id="mEliminarParticipacion" tabindex="-1">
      <div class="modal-dialog">
        <form method="POST" class="modal-content" id="formEliminarParticipacion">
          @csrf
          @method('DELETE')
          <div class="modal-header">
            <h5 class="modal-title">Eliminar Participación</h5>
          </div>
          <div class="modal-body">
            <p>¿Está seguro de eliminar esta participación?</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="submit">Eliminar</button>
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.editar-btn').forEach(btn => {
          btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const prueba = this.dataset.prueba;
            const posicion = this.dataset.posicion;
            document.getElementById('idPruebaEditar').value = prueba;
            document.getElementById('posicionFinalEditar').value = posicion;
            document.getElementById('formEditarParticipacion').action = '/participacionesequipos/' + id;
          });
        });

        document.querySelectorAll('.eliminar-btn').forEach(btn => {
          btn.addEventListener('click', function () {
            const id = this.dataset.id;
            document.getElementById('formEliminarParticipacion').action = '/participacionesequipos/' + id;
          });
        });
      });
    </script>
  </body>
</html>
