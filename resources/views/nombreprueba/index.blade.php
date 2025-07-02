<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nombres de Pruebas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
     <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  </head>
  <body class="pt-8">

<div class="container mx-auto px-4">
  <h1 class="text-center text-4xl font-bold text-gray-900 dark:text-black mb-6">Lista de Nombres de Pruebas</h1>

<div class="text-center mb-6">
  <button type="button" data-bs-toggle="modal" data-bs-target="#mCrearNombrePrueba"
    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center"
    type="button"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /> </svg> Crear nombre de Pruebas</button>
</div>


  <div class="flex justify-center">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full max-w-4xl bg-white mt-6">
      <table class="w-full text-sm text-left text-black">
        <thead class="text-xs uppercase bg-gray-200 text-gray-800 font-semibold">
          <tr>
            <th scope="col" class="px-6 py-3">Código</th>
            <th scope="col" class="px-6 py-3">Nombre</th>
            <th scope="col" class="px-6 py-3 text-right">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($listaNombresPruebas as $nombresPruebas)
          <tr class="bg-white border-b border-gray-200">
            <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
              {{ $nombresPruebas->codigoNombrePrueba }}
            </th>
            <td class="px-6 py-4 text-black">
              {{ $nombresPruebas->nombrePrueba}}
            </td>
            <td class="px-6 py-4 text-right">
              <button class="text-blue-600 hover:underline ejecutar" data-bs-toggle="modal" data-bs-target="#mEditarNombrePrueba"
                data-codigo="{{ $nombresPruebas->codigoNombrePrueba }}" data-nombre="{{ $nombresPruebas->nombrePrueba}}">
                Editar
              </button>
              |
              <button class="text-red-600 hover:underline eliminar" data-bs-toggle="modal" data-bs-target="#mEliminarNombrePrueba"
                data-codigo="{{ $nombresPruebas->codigoNombrePrueba }}" data-nombre="{{ $nombresPruebas->nombrePrueba}}">
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


<div class="modal" id="mCrearNombrePrueba">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Crear Nombre de Prueba</h2>
      </div>
      <div class="modal-body">
        <form action="/nombrepruebas" id="miCrearNombrePrueba" method="POST">
          @csrf
          <div class="form-floating mb-3">
            <input type="text" id="nombrePrueba" name="nombrePrueba" class="form-control" maxlength="100" placeholder="Nombre de la prueba" required>
            <label for="nombrePrueba">Nombre de la Prueba</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="miCrearNombrePrueba" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5">Guardar</button>
        <button type="button" data-bs-dismiss="modal" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="mEditarNombrePrueba">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Editar Nombre de Prueba</h2>
      </div>
      <div class="modal-body">
        <form action="" id="formEditarNombrePrueba" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label class="form-label">Código</label>
            <input type="text" id="codigoNombrePruebaU" class="form-control" readonly>
          </div>
          <div class="form-floating mb-3">
            <input type="text" id="nombrePruebaU" name="nombrePrueba" class="form-control" required>
            <label for="nombrePruebaU">Nombre</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="formEditarNombrePrueba" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5">Guardar cambios</button>
        <button type="button" data-bs-dismiss="modal" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="mEliminarNombrePrueba">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Eliminar Nombre de Prueba</h2>
      </div>
      <div class="modal-body">
        <form action="" id="formEliminarNombrePrueba" method="POST">
          @csrf
          @method('DELETE')
          <div class="form-floating mb-3">
            <input type="text" id="codigoNombrePruebaP" class="form-control" readonly>
            <label for="codigoNombrePruebaP">Código</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" id="nombrePruebaP" class="form-control" readonly>
            <label for="nombrePruebaP">Nombre</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="formEliminarNombrePrueba" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5">Eliminar</button>
        <button type="button" data-bs-dismiss="modal" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5">Cancelar</button>
      </div>
    </div>
  </div>
</div>


<script>
   $(document).ready(function () {
      $('.ejecutar').on('click', function () {
      let codigo = $(this).data('codigo');
      let nombre = $(this).data('nombre');

      $('#codigoNombrePruebaU').val(codigo);
      $('#nombrePruebaU').val(nombre);
      document.getElementById('formEditarNombrePrueba').action = '/nombrepruebas/' + codigo;
   
    });

  });
  </script>

<script>
  $(document).ready(function () {
     $('.eliminar').on('click', function () {
      let codigo = $(this).data('codigo');
      let nombre = $(this).data('nombre');

      $('#codigoNombrePruebaP').val(codigo);
      $('#nombrePruebaP').val(nombre);
      document.getElementById('formEliminarNombrePrueba').action = '/nombrepruebas/' + codigo;
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>