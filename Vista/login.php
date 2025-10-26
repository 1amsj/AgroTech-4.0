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
    <linkn href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet"/>  
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </head>



  <body>
      <div class="container-fluid">
        <div class ="row justify-content-end align-items-start">
          <div class = "col-auto">
            <button type="button" class="btn-standar" onclick= "window.location.href = 'https://inta.gob.ni/'" >INTA</button>
            <button type="button" class="btn-standar">Iniciar Sesión</button>
          </div>
        </div>
        <div class ="row justify-content-start align-items-center">
          <div class ="col-12 col-md-8 col-lg-6 order-2 order-md-2 order-lg-1">
            <div class="news-card">
              <div class = "image-section">
                <img src="assets/Imagenes/logo1.png" alt="AgroTech 4.0 Logo" style = "width: 70vh; height: 70vh;"/>
                <div class = "description">
                  <p>AgroTech 4.0 es un sistema web innovador diseñado para transformar la gestión de los CDTs de la Dirección de la Costa Caribe Sur del INTA, integrando principios y herramientas de la Cuarta Revolución Industrial en el ámbito agropecuario.</p>
                </div>
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
      

  <!-- 
     
      <div class="card">
        <div class="container-label">Bienvenido a AgroTech 4.0<span></span></div>

        <div class="container-icon">
          <div class="circle">
            <i class="bi bi-chevron-right"></i>
          </div>
        </div>

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

            <div class="change-password">
              Para alterar Contraseña <a href="javascript:void(0)">Clique aqui</a>
            </div>
            
            <div class="boton" id="enviar" >Ingresar</div>
            
            </form>
        </div>
      </div>
    -->

     
    <script src="assets/js/login.js"></script>
    <script src="assets/js/p_bootstrap.min.js"></script>
  </body>
</html>