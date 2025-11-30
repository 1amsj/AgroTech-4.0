<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

<?php

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $consulta = $co->prepare("SELECT * FROM inventario WHERE id = :id LIMIT 1");
    $consulta->bindParam(":id", $id, PDO::PARAM_INT);
    $consulta->execute();
    $producto = $consulta->fetch(PDO::FETCH_ASSOC);

} else {
    echo "Producto no encontrado";
    exit;
}
 
?>

 <!-- Modal del detalle del producto -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center">
      <div class="modal-content" id="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detalle del producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class ="row justify-content-center align-items-center text-center">
            <button class ="btn-eliminar" data-toggle = "modal" data-target="#loginModal3" >Eliminar producto</button>
            <button class ="btn-modificar" data-toggle="modal" data-target="#loginModal2">Modificar producto</button>
          </div>
          <div class="row justify-content-center align-items-center text-center">
            <!-- Columna del formulario -->
            <div class="col-md-8">
              <form id="f" method="post">
                <p><strong>Fecha:</strong> <?php echo $producto['Fecha']; ?></p>
                <p><strong>Descripción:</strong> <?php echo $producto['Descripcion']; ?></p>
                <p><strong>Categoría:</strong> <?php echo $producto['Categoria']; ?></p>
                <p><strong>Cantidad:</strong> <?php echo $producto['Cantidad']; ?></p>
                <button type="submit" class="btn w-100" id="enviar">Cerrar</button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal de Agregar -->
  <div class="modal fade" id="loginModal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center">
      <div class="modal-content" id="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Agregar producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row justify-content-center align-items-center text-center">
            <!-- Columna del formulario -->
            <div class="col-md-8">
              <form id="f" method="post">
                <div class="mb-3">
                  <label for="user">Nombre del producto</label>
                  <input class="form-control input-standar" type="text" id="nombre" name="nombre"
                    placeholder="Escriba el nombre del producto" autofocus>
                </div>
                <div class="mb-3">
                  <label for="password">Categoría</label>
                  <input class="form-control input-standar" type="text" id="categoria" name="categoria"
                      placeholder="Escriba la categoría del producto" autofocus>
                  </div>
                <div class="mb-3">
                  <label for="password">Fecha</label>
                  <input class="form-control input-standar" type="text" id="fecha" name="fecha"
                      placeholder="Escriba la categoría del producto" autofocus>
                  </div>
                <div class="mb-3">
                  <label for="user">Stock Actual</label>
                  <input class="form-control input-standar" type="text" id="stocka" name="stocka"
                    placeholder="Escriba el stock actual" autofocus>
                </div>
                <button type="submit" class="btn w-100" id="enviar">Enviar</button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal de modificar -->
  <div class="modal fade" id="loginModal2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center">
      <div class="modal-content" id="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modificar producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row justify-content-center align-items-center text-center">
            <!-- Columna del formulario -->
            <div class="col-md-8">
              <form id="f" method="post">
                <div class="mb-3">
                  <label for="user">Nombre del producto</label>
                  <input class="form-control input-standar" type="text" id="nombrem" name="nombrem"
                    placeholder="Escriba el nombre del producto" autofocus>
                </div>
                <div class="mb-3">
                  <label for="password">Categoría</label>
                  <input class="form-control input-standar" type="text" id="categoriam" name="categoriam"
                      placeholder="Escriba la categoría del producto" autofocus>
                  </div>
                  <div class="mb-3">
                  <label for="password">Fecha</label>
                  <input class="form-control input-standar" type="text" id="fecham" name="fecham"
                      placeholder="Escriba la categoría del producto" autofocus>
                  </div>
                <div class="mb-3">
                  <label for="user">Stock Actual</label>
                  <input class="form-control input-standar" type="text" id="stockam" name="stockam"
                    placeholder="Escriba el stock actual" autofocus>
                </div>
                <button type="submit" class="btn w-100" id="enviar">Enviar</button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal de eliminar -->

  <div class="modal fade" id="loginModal3" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center">
      <div class="modal-content" id="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Eliminar producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row justify-content-center align-items-center text-center">
            <!-- Columna del formulario -->
            <div class="col-md-8">
              <form id="f" method="post">
                <div class="mb-3">
                  <label for="user">Nombre del producto</label>
                  <input class="form-control input-standar" type="text" id="nombre" name="nombre"
                    placeholder="Escriba el nombre del producto" autofocus>
                </div>
                <div class="mb-3">
                  <label for="password">Categoría</label>
                  <input class="form-control input-standar" type="text" id="nombre" name="nombre"
                      placeholder="Escriba la categoría del producto" autofocus>
                  </div>
                <div class="mb-3">
                  <label for="user">Stock Actual</label>
                  <input class="form-control input-standar" type="text" id="nombre" name="nombre"
                    placeholder="Escriba el stock actual" autofocus>
                </div>
                <button type="submit" class="btn w-100" id="enviar">Enviar</button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>