<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bienvenido a AgroTech 4.0</title>
  <!-- Style -->
  <link rel="stylesheet" href="assets/css/login.css" />
  <link rel="stylesheet" href="assets/css/estilo.css" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Special+Gothic:wght@400..700&display=swap" rel="stylesheet">
  <!-- Bootstrap icons and Bootstrap 4 stylesheet (using local Bootstrap 4 JS below) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .botones {
      position: absolute;
      top: 20px;
      right: 20px;
      z-index: 20;
      /* Encima del carrusel */
      display: flex;
      gap: 10px;
    }

    .carousel,
    .carousel-inner,
    .carousel-item {
      height: 100vh;
    }

    .carousel-item img {
      height: 100vh;
      width: 100%;
      object-fit: cover;
      /* Ajusta sin deformar */
    }

    html,
    body {
      margin: 0 !important;
      padding: 0 !important;
      overflow-x: hidden;
    }

    .carousel-item::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.35);
      /* Nivel de oscuridad */
      z-index: 1;
    }

    /* Asegurar que el caption quede encima del overlay */
    .carousel-caption {
      position: absolute;
      z-index: 2;
    }

    @media (max-width: 768px) {
      .carousel-caption h5 {
        font-size: 22px;
      }

      .carousel-caption p {
        font-size: 14px;
        padding: 0 10px;
      }
    }
  </style>
</head>



<body>

  <div class="botones">
    <button type="button" class="btn-standar1" onclick="window.location.href = 'https://inta.gob.ni/'">INTA</button>
    <button type="button" class="btn-standar1" id="login" data-toggle="modal" data-target="#loginModal">Iniciar
      Sesión</button>
  </div>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/Imagenes/Inta1.jpg" class="d-block w-100" alt="">
        <div class="carousel-caption">
          <h5>AgroTech 4.0</h5>
          <p>Sistema web innovador diseñado para transformar la gestión de los CDTs de la Dirección de la Costa Caribe
            Sur del INTA, integrando principios y herramientas de la Cuarta Revolución Industrial en el ámbito
            agropecuario</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="assets/Imagenes/Inta2.jpg" class="d-block w-100" alt="">
        <div class="carousel-caption">
          <h5>AgroTech 4.0</h5>
          <p>Esta plataforma digital permite registrar, controlar y supervisar de manera centralizada y en tiempo real
            el flujo de productos que se generan o comercializan en los CDTs</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="assets/Imagenes/Inta3.jpg" class="d-block w-100" alt="">
        <div class="carousel-caption">
          <h5>AgroTech 4.0</h5>
          <p>...</p>
        </div>
      </div>
    </div>

    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>

    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>

  </div>


  <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- modal grande -->
      <div class="modal-content" id="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Iniciar Sesión</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row align-items-center">
            <!-- Columna del formulario -->
            <div class="col-md-6">
              <form id="f" method="post">
                <div class="mb-3">
                  <label for="user">Ingrese su número de empleado</label>
                  <input class="form-control input-standar" type="text" id="user" name="user"
                    placeholder="Introducir n° de empleado" autofocus>
                </div>
                <div class="mb-3">
                  <label for="password">Ingrese su contraseña</label>
                  <input class="form-control input-standar" type="password" id="password" name="password"
                    placeholder="Digite su contraseña">
                </div>
                <button type="submit" class="btn w-100" id="enviar">Iniciar sesión</button>
              </form>
            </div>

            <!-- Columna de la imagen -->
            <div class="col-md-6 text-center">
              <img src="assets/Imagenes/F-Login.png" alt="Login Image" class="img-fluid rounded">
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  <!-- jQuery -> Popper (v1) -> Bootstrap 4 (local) -> custom login JS -->
  <script src="Assets/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
  <script src="Assets/js/p_bootstrap.min.js"></script>
  <script src="Assets/js/login.js"></script>
</body>

</html>