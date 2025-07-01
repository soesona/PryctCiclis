<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nacionalidades</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
     <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  </head>
  <body class="pt-8">

<div class="container mx-auto px-4">
  <h1 class="text-center text-4xl font-bold text-gray-900 dark:text-black mb-6">Lista Nacionalidades</h1>

<div class="text-center mb-6">
  <button type="button" data-bs-toggle="modal" data-bs-target="#mCrearNacionalidad"
    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center"
    type="button"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /> </svg> Crear nacionalidad</button>
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
          @foreach ($listaNacionalidades as $nacionalidad)
          <tr class="bg-white border-b border-gray-200">
            <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
              {{ $nacionalidad->codigoNacionalidad }}
            </th>
            <td class="px-6 py-4 text-black">
              {{ $nacionalidad->nombreNacionalidad }}
            </td>
            <td class="px-6 py-4 text-right">
              <button class="text-blue-600 hover:underline ejecutar" data-bs-toggle="modal" data-bs-target="#mEditarNacionalidad"
                data-codigo="{{ $nacionalidad->codigoNacionalidad }}" data-nombre="{{ $nacionalidad->nombreNacionalidad }}">
                Editar
              </button>
              |
              <button class="text-red-600 hover:underline eliminar" data-bs-toggle="modal" data-bs-target="#mEliminarNacionalidad"
                data-codigo="{{ $nacionalidad->codigoNacionalidad }}" data-nombre="{{ $nacionalidad->nombreNacionalidad }}">
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


<div class="modal" id="mCrearNacionalidad">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Crear nacionalidad</h2>
      </div>
      <div class="modal-body">
        <form action="/nacionalidad" id="miFormNacionalidad" method="POST">
          @csrf
          <div class="form-floating mb-3">
            <input type="text" id="nombreNacionalidad" name="nombreNacionalidad" class="form-control" maxlength="40" placeholder="Nombre Nacionalidad" required>
            <label for="nombreNacionalidad">Nombre</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="miFormNacionalidad"class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
        >Guardar</button>
        <button type="button" data-bs-dismiss="modal" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900"
        >Cancelar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="mEditarNacionalidad">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Editar Nacionalidad</h2>
      </div>
      <div class="modal-body">
        <form action="" id="miFormEditarNacionalidad" method="POST">
          @method('PUT')
          @csrf
          <div class="mb-3">
            <label class="form-label">Código</label>
            <input type="text" id="codigoNacionalidadu" class="form-control" readonly>
          </div>
          <div class="form-floating mb-3">
            <input type="text" id="nombreNacionalidadu" name="nombreNacionalidadu" class="form-control" required>
            <label for="nombreNacionalidadu">Nombre</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="miFormEditarNacionalidad" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" >Guardar cambios</button>
        <button type="button" data-bs-dismiss="modal" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900" >Cancelar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="mEliminarNacionalidad">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Eliminar nacionalidad</h2>
      </div>
      <div class="modal-body">
        <form action=""  id="miFormEliminarNacionalidad" method="POST">
          @csrf
          @method('DELETE')
          <div class="form-floating mb-3">
            <input type="text" id="codigoNacionalidadp" class="form-control" readonly>
            <label for="codigoNacionalidadp">Código</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" id="nombreNacionalidadp" class="form-control" readonly>
            <label for="nombreNacionalidadp">Nombre</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="miFormEliminarNacionalidad" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Eliminar</button>
        <button type="button" data-bs-dismiss="modal" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.ejecutar').on('click',function() {
    let codigo=$(this).data('codigo');
    let nombre=$(this).data('nombre');
   
    $('#codigoNacionalidadu').val(codigo);
    $('#nombreNacionalidadu').val(nombre);

       document.getElementById('miFormEditarNacionalidad').action = '/nacionalidad/' + codigo;

    });
  });
  </script>

<script>
  $(document).ready(function () {
    $('.eliminar').on('click', function () {
      let codigo = $(this).data('codigo');
      let nombre = $(this).data('nombre');

      $('#codigoNacionalidadp').val(codigo);
      $('#nombreNacionalidadp').val(nombre);

      document.getElementById('miFormEliminarNacionalidad').action = '/nacionalidad/' + codigo;
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>