<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Página Principal</title>

    <link rel="stylesheet" href="assets/css/estilo.css" />
    <link rel="stylesheet" href="assets/css/menu.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet"/>  
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic:wght@400..700&display=swap" rel="stylesheet">
    <!-- Bootstrap icons and Bootstrap 4 stylesheet (using local Bootstrap 4 JS below) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class = "container-fluid">
        <div class="row align-items-center">
            <div class="col-12 col-md-8 col-lg-6 order-2 order-md-2 order-lg-1">
                <?php include 'menu.php'; ?>

            </div>
            <div class="col-12 col-md-8 col-lg-6 order-1 order-md-1 order-lg-2" style = "justify-content: start; align-items: center; display: flex; flex-direction: column;">
                <h1 class = "header-standar">Bienvenido, ...</h1>
                <p>Esta es la página principal de AgroTech 4.0</p>
            </div>
        </div>
    </div>
   
    
</body>

  <script src="Assets/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
  <script src="Assets/js/p_bootstrap.min.js"></script>
</html>