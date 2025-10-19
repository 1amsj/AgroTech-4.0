<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <!-- Style -->
    <link rel="stylesheet" href="assets/css/login.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <linkn href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet"/>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"/>
  </head>



  <body>
    <div class="container">
      <div class="card">
        <div class="container-label">Bienvenido <span></span></div>

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
    </div>

    <?php require_once('comunes/footer.php') ?> 
    <script src="assets/js/login.js"></script>> 
  </body>
</html>