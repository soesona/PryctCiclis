<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ciclistas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
     <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  </head>
  <body class="pt-8">

<div class="container mx-auto px-4">
  <h1 class="text-center text-4xl font-bold text-gray-900 dark:text-black mb-6">Lista Ciclistas</h1>

<div class="text-center mb-6">
  <button type="button" data-bs-toggle="modal" data-bs-target="#mCrearCiclista"
    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center"
    type="button"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /> </svg> Crear ciclista</button>
</div>


  <div class="flex justify-center">
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full max-w-6xl bg-white mt-6">
    <table class="w-full text-sm text-left text-black">
      <thead class="text-xs uppercase bg-gray-200 text-gray-800 font-semibold">
        <tr>
          <th scope="col" class="px-6 py-3">Código</th>
          <th scope="col" class="px-6 py-3">Nombre</th>
          <th scope="col" class="px-6 py-3">Apellido</th>
          <th scope="col" class="px-6 py-3">Fecha de nacimiento</th>
          <th scope="col" class="px-6 py-3">Nacionalidad</th>
          <th scope="col" class="px-6 py-3">Imagen</th>
          <th scope="col" class="px-6 py-3 text-right">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($listaCiclistas as $ciclista)
          <tr class="bg-white border-b border-gray-200">
            <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
              {{ $ciclista->codigoCiclista }}
            </th>
            <td class="px-6 py-4 text-black">{{ $ciclista->nombre }}</td>
            <td class="px-6 py-4 text-black">{{ $ciclista->apellido }}</td>
            <td class="px-6 py-4 text-black">{{ $ciclista->fechaNacimiento }}</td>
            <td class="px-6 py-4 text-black">{{ $ciclista->nacionalidad->nombreNacionalidad ?? 'N/A' }}</td>
            <td class="px-6 py-4">
              @if ($ciclista->imagen)
                <img src="{{ asset('storage/' . $ciclista->imagen) }}" alt="Imagen ciclista" class="w-12 h-12 rounded-full object-cover">
              @else
                <span class="text-gray-500 text-sm">Sin imagen</span>
              @endif
            </td>
            <td class="px-6 py-4 text-right">
              <button class="text-blue-600 hover:underline ejecutar" data-bs-toggle="modal" data-bs-target="#mEditarCiclista"
                data-codigo="{{ $ciclista->codigoCiclista }}"
                data-nombre="{{ $ciclista->nombre }}"
                data-apellido="{{ $ciclista->apellido }}"
                data-fechanacimiento="{{ $ciclista->fechaNacimiento }}"
                data-codigonacionalidad="{{ $ciclista->codigoNacionalidad }}"
                data-imagen="{{ asset('storage/' . $ciclista->imagen) }}">
                Editar
              </button>
              |
              <button class="text-red-600 hover:underline eliminar" data-bs-toggle="modal" data-bs-target="#mEliminarCiclista"
                data-codigo="{{ $ciclista->codigoCiclista }}"
                data-nombre="{{ $ciclista->nombre }}"
                data-apellido="{{ $ciclista->apellido }}"
                data-fechanacimiento="{{ $ciclista->fechaNacimiento }}"
                data-nacionalidad="{{ $ciclista->nacionalidad->nombreNacionalidad ?? 'N/A' }}"
                data-imagen="{{ asset('storage/' . $ciclista->imagen) }}">
                Eliminar
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>



<div class="modal" id="mCrearCiclista">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Crear ciclista</h2>
      </div>
      <div class="modal-body">
        <form action="/ciclista" id="miFormCiclista" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-floating mb-3">
            <input type="text" id="codigoCiclista" name="codigoCiclista" class="form-control" maxlength="10" placeholder="Código Ciclista" required>
            <label for="codigoCiclista">Código</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" id="nombre" name="nombre" class="form-control" maxlength="40" placeholder="Nombre" required>
            <label for="nombre">Nombre</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" id="apellido" name="apellido" class="form-control" maxlength="40" placeholder="Apellido" required>
            <label for="apellido">Apellido</label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" placeholder="Fecha de nacimiento" required>
            <label for="fechaNacimiento">Fecha de nacimiento</label>
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
          <div class="mb-3">
            <label for="imagen" class="form-label">Imagen del ciclista</label>
            <input class="form-control" type="file" id="imagen" name="imagen" accept="image/*">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="miFormCiclista" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
          Guardar
        </button>
        <button type="button" data-bs-dismiss="modal" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
          Cancelar
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="mEditarCiclista">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Editar Ciclista</h2>
      </div>
      <div class="modal-body">
        <form action="" id="miFormEditarCiclista" method="POST" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="mb-3">
            <label class="form-label">Código</label>
            <input type="text" id="codigoCiclistau" name="codigoCiclista" class="form-control" readonly>
          </div>
          <div class="form-floating mb-3">
            <input type="text" id="nombreu" name="nombre" class="form-control" required>
            <label for="nombreu">Nombre</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" id="apellidou" name="apellido" class="form-control" required>
            <label for="apellidou">Apellido</label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" id="fechaNacimientou" name="fechaNacimiento" class="form-control" required>
            <label for="fechaNacimientou">Fecha de nacimiento</label>
          </div>
          <div class="form-floating mb-3">
            <select id="codigoNacionalidadu" name="codigoNacionalidad" class="form-select" required>
              <option value="" disabled>Seleccione nacionalidad</option>
              @foreach ($nacionalidades as $nacionalidad)
                <option value="{{ $nacionalidad->codigoNacionalidad }}">{{ $nacionalidad->nombreNacionalidad }}</option>
              @endforeach
            </select>
            <label for="codigoNacionalidadu">Nacionalidad</label>
          </div>
          <div class="mb-3">
            <label for="imagenu" class="form-label">Cambiar imagen</label>
            <input class="form-control" type="file" id="imagenu" name="imagen" accept="image/*">
            <div class="mt-2" id="vistaPreviaImagen">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="miFormEditarCiclista"
          class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
          Guardar cambios
        </button>
        <button type="button" data-bs-dismiss="modal"
          class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
          Cancelar
        </button>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="mEliminarCiclista">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Eliminar Ciclista</h2>
      </div>
      <div class="modal-body">
        <form action="" id="miFormEliminarCiclista" method="POST">
          @csrf
          @method('DELETE')
          <div class="text-center mb-3">
            <img id="imagenEliminar" src="" alt="Imagen Ciclista" class="img-fluid rounded" style="max-height: 150px;">
          </div>
          <div class="form-floating mb-3">
            <input type="text" id="codigoCiclistap" class="form-control" readonly>
            <label for="codigoCiclistap">Código</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" id="nombrep" class="form-control" readonly>
            <label for="nombrep">Nombre</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" id="apellidop" class="form-control" readonly>
            <label for="apellidop">Apellido</label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" id="fechaNacimientoP" class="form-control" readonly>
            <label for="fechaNacimientoP">Fecha de nacimiento</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" id="nacionalidadP" class="form-control" readonly>
            <label for="nacionalidadP">Nacionalidad</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="miFormEliminarCiclista" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Eliminar</button>
        <button type="button" data-bs-dismiss="modal" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.ejecutar').on('click', function() {
      let codigo = $(this).data('codigo');
      let nombre = $(this).data('nombre');
      let apellido = $(this).data('apellido');
      let fechaNacimiento = $(this).data('fechanacimiento');
      let codigoNacionalidad = $(this).data('codigonacionalidad');
      let imagen = $(this).data('imagen');  

      $('#codigoCiclistau').val(codigo);
      $('#nombreu').val(nombre);
      $('#apellidou').val(apellido);
      $('#fechaNacimientou').val(fechaNacimiento);
      $('#codigoNacionalidadu').val(codigoNacionalidad);

      if (imagen) {
        $('#vistaPreviaImagen').html('<img src="' + imagen + '" alt="Imagen actual" style="max-width: 100%; height: auto; border-radius: 5px;">');
      } else {
        $('#vistaPreviaImagen').html('');
      }

      document.getElementById('miFormEditarCiclista').action = '/ciclista/' + codigo;
    });

    $('#imagenu').on('change', function() {
      const [file] = this.files;
      if (file) {
        $('#vistaPreviaImagen').html('<img src="' + URL.createObjectURL(file) + '" alt="Nueva imagen" style="max-width: 100%; height: auto; border-radius: 5px;">');
      }
    });
  });
  </script>

<script>
  $(document).ready(function() {
    $('.eliminar').on('click', function() {
      let codigo = $(this).data('codigo');
      let nombre = $(this).data('nombre');
      let apellido = $(this).data('apellido');
      let fechaNacimiento = $(this).data('fechanacimiento');
      let nacionalidad = $(this).data('nacionalidad');
      let imagen = $(this).data('imagen'); 

      $('#codigoCiclistap').val(codigo);
      $('#nombrep').val(nombre);
      $('#apellidop').val(apellido);
      $('#fechaNacimientoP').val(fechaNacimiento);
      $('#nacionalidadP').val(nacionalidad);

      $('#imagenEliminar').attr('src', imagen);

      document.getElementById('miFormEliminarCiclista').action = '/ciclista/' + codigo;
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>