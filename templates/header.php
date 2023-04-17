<?php
@session_start();

$url_base="http://localhost/proySanFranciscoPHP/";
$varsession=$_SESSION['correo'];
if($varsession==null || $varsession==''){

    header("Location: login.php");
    die();}



 //seguridad de sesiones


?>

<?php $url_base="http://localhost/proySanFranciscoPHP/";?>

<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

<link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
<script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>

<script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">


</head>
<body>
  
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container">
    <!-- Navbar brand -->
    <a href="<?php echo $url_base?>">
      <img
        src="<?php echo $url_base?>images/logo.jpg"
        width="70" height="65"
      />
    </a>

    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarButtonsExample"
      aria-controls="navbarButtonsExample"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarButtonsExample">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url_base?>">Consultorio San Francisco</a>
        </li>
      </ul>
      <!-- Left links -->

      <div class="d-flex align-items-center">

      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <a class="btn btn-light" href="<?php echo $url_base?>/index.php" role="button">Inicio</a>
        <a class="btn btn-light" href="<?php echo $url_base?>" role="button">Ajustes</a>
        <label class="btn btn-light">
            <input type="radio" name="options" id="option3" autocomplete="off"> Página Inicial
        </label>
        </div>
        
        <div>
        <a class="btn btn-danger" href="<?php echo $url_base?>cerrar.php" role="button">Cerrar Sesión</a>
        </div>
        
      </div>
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
  </header>
  
  <main class="container">

  <?php if(isset($_GET['mensaje'])){ ?>
<script>
    Swal.fire({icon:"success",
    title:"<?php echo $_GET['mensaje']; ?>"});
</script>
<?php } ?>
