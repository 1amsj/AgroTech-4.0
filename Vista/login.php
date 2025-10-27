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
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet"/>  
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Bootstrap icons and Bootstrap 4 stylesheet (using local Bootstrap 4 JS below) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>



  <body>
      <div class="container-fluid">
        <div class ="row justify-content-end align-items-start">
          <div class = "col-auto">
            <button type="button" class="btn-standar" onclick= "window.location.href = 'https://inta.gob.ni/'" >INTA</button>
            <button type="button" class="btn-standar" id="login" data-toggle="modal" data-target="#loginModal">Iniciar Sesión</button>
          </div>
        </div>
        <div class ="row justify-content-start align-items-center">
          <div class ="col-12 col-md-8 col-lg-6 order-2 order-md-2 order-lg-1">
            <div class="news-card">
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="assets/Imagenes/Inta1.jpg" alt="First slide" style="height:66.4vh; width: 133.33vh;">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>AgroTech 4.0</h5>
                      <p>Sistema web innovador diseñado para transformar la gestión de los CDTs de la Dirección de la Costa Caribe Sur del INTA, integrando principios y herramientas de la Cuarta Revolución Industrial en el ámbito agropecuario.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="assets/Imagenes/Inta2.jpg" alt="Second slide" style = "height:66.4vh; width: 133.33vh;">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>AgroTech 4.0</h5>
                      <p>Esta plataforma digital permite registrar, controlar y supervisar de manera centralizada y en tiempo real el flujo de productos que se generan o comercializan en los CDTs</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="assets/Imagenes/Inta3.jpg" alt="Third slide" style = "height:66.4vh; width: 133.33vh;">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>AgroTech 4.0</h5>
                      <p>...</p>
                    </div>
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
          <div class ="col-12 col-md-8 col-lg-6 order-1 order-md-1 order-lg-2">
            <div class = "welcome-section">
              <div class ="welcome">
                <h2>Bienvenido</h2>
              </div>
              <div class ="image-section">
                <img src="assets/Imagenes/F-Login.png" alt="Login Image" style="width:80vh; height:80vh;"/>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    <!-- Modal -->
     <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Iniciar Sesión</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-form">
              <form  method="post" id="f">
              <label for="usuario">Nombre / Usuario</label>
              <span id="suser"></span>
              <input type="text"id="user" name="user" placeholder="Introducir Nombre / Contraseña" autofocus/>

              <div class="container-input">
                <label for="password">Contraseña</label>

                <span id="spassword"></span>
                <input type="password"id="password" name="password" id="password" placeholder="Digite su Contrasena"/>
                <i id="reveal-password" class="bi bi-eye-slash"></i>
              </div>

            </form>
        </div>
          </div>
          <div class="modal-footer">
            <button type="button" id = "enviar">Guardar cambios</button>
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