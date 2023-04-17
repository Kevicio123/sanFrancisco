<?php 
include ("./db.php");

if($_POST){
    // Recolectamos los datos
    $asunto=(isset($_POST["asunto"])?$_POST["asunto"]:"");
    $detalle=(isset($_POST["detalle"])?$_POST["detalle"]:"");

    // Insertamos los datos a la BD
    $sentencia=$conexion->prepare("INSERT INTO sugerencias(idSug,asunto,detalle)
            VALUES(null,:asunto,:detalle)");
    
    // Asignando los valores del formulario
    $sentencia->bindParam(":asunto",$asunto);
    $sentencia->bindParam(":detalle",$detalle);
    $sentencia->execute();
    $mensaje="Sugerencia Enviada con Éxito";
    header("Location:index.php?mensaje=".$mensaje);
}

if(isset($_GET['mensaje'])){ ?>
  <script>
      Swal.fire({icon:"success",
      title:"<?php echo $_GET['mensaje']; ?>"});
  </script>
  <?php } 
?>




<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Inicio del Paciente</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/flexslider.css">
<link rel="stylesheet" href="css/jquery.fancybox.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/font-icon.css">
<link rel="stylesheet" href="css/animate.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> 
</head>

<body>
<!-- header section -->
<section class="banner" role="banner">
  <header id="header">
  
    <div class="header-content clearfix"><a class="logo" href="index.html"><i><img src="images/logo.jpg"  width="70" height="65"> </i> Consultorio San Francisco</a>
      <nav class="navigation" role="navigation">
        <ul class="primary-nav">
		 <li><a href="#banner">Inicio</a></li>
          <li><a href="#services">Tratamientos</a></li>
          <li><a href="#gallery">Galería</a></li>
          <li><a href="#teams">Nuestro Equipo</a></li>
          <li><a href="#contact">Contacto</a></li>
          <li><a href="login.php">Intranet</a></li>
        </ul>
      </nav>
      <a href="#" class="nav-toggle">Menu<span></span></a> </div>
  </header>
  <!-- banner text --> 
    <div class="banner" id="banner"> 
	<div class="slider-banner">
            <div data-lazy-background="images/slides/3.jpg"> 
                <h3 data-pos="['75%', '-40%', '60%', '12%']" data-duration="700" data-effect="move">
                Bienvenido!
                </h3> <br>
                <p data-pos="['75%', '-40%', '75%', '12%']" data-duration="700" data-effect="move">
                A Nuestro Portal Odontológico.
                </p>
            </div>
             
        </div>
      <!-- banner text --> 
    </div> 
</section>
<!-- header section --> 
<!-- intro section -->
<!-- intro section --> 
<!-- services section -->
<section id="services" class="services service-section">
  <div class="container">
  <div class="section-header">
                <h2 class="wow fadeInDown animated">Tratamientos</h2>
                <p class="wow fadeInDown animated">Tratamos tratamientos médicos especializados en: <br> </p>
            </div>
    <div class="row">
      <div class="col-md-4 col-sm-6 services text-center"> <span class="icon icon-happy"></span>
        <div class="services-content">
          <h5>Odontología Estética</h5>
          <p>Se enfoca en la mejora de la apariencia de los dientes mediante técnicas de blanqueamiento dental, las carillas y la ortodoncia estética.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 services text-center"> <span class="icon icon-layers"></span>
        <div class="services-content">
          <h5>Ortodoncia</h5>
          <p>Se enfoca en la corrección de la alineación y la posición de los dientes para mejorar la función y la estética de la boca.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 services text-center"> <span class="icon icon-happy"></span>
        <div class="services-content">
          <h5>Odontología General</h5>
          <p>Se encarga de la prevención, diagnóstico y tratamiento de los problemas dentales comunes en pacientes de todas las edades. </p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 services text-center"> <span class="icon icon-wine"></span>
        <div class="services-content">
          <h5>Endodoncia</h5>
          <p>Se enfoca en el tratamiento de los problemas de la pulpa dental, como las caries profundas y la infección.</p>
        </div>
      </div>
      
      <div class="col-md-4 col-sm-6 services text-center"> <span class="icon icon-heart"></span>
        <div class="services-content">
          <h5>Implantología</h5>
          <p>Se enfoca en la colocación de implantes dentales para reemplazar dientes perdidos o faltantes.</p>
        </div>
      </div>

      <div class="col-md-4 col-sm-6 services text-center"> <span class="icon icon-hotairballoon"></span>
        <div class="services-content">
          <h5>Odontopediatría</h5>
          <p>Se enfoca en el tratamiento dental de los niños, desde la infancia hasta la adolescencia.</p>
        </div>
      </div>
      <div class="col-md-12 col-sm-6 services text-center"> <span class="icon icon-layers"></span>
        <div class="services-content">
          <h5>Cirugía Oral y Maxilofacial</h5>
          <p>Se enfoca en el  diagnóstico y tratamiento de una amplia variedad de afecciones, lesiones y defectos en el cuello, la cara, la mandíbula y los tejidos blandos y duros de la boca.</p>
        </div>
      </div>
      
    </div>
  </div>
  </div>
</section>
<!-- services section --> 
<!--About-->

<!-- package section --> 

<!-- gallery section -->
<section id="gallery" class="gallery section">
  <div class="container-fluid">
    <div class="section-header">
                <h2 class="wow fadeInDown animated">Nuestra Galeria</h2>
                <p class="wow fadeInDown animated">Imágenes de nuestro trabajo continuo.</p>
            </div>
    <div class="row no-gutter">
      <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/discapacitado.jpg" class="work-box"> <img src="images/portfolio/discapacitado.jpg" alt="">
        <div class="overlay">
          <div class="overlay-caption">
             <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>
        <!-- overlay --> 
        </a> </div>
      <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/02.jpg" class="work-box"> <img src="images/portfolio/02.jpg" alt="">
        <div class="overlay">
          <div class="overlay-caption">
            <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>
        <!-- overlay --> 
        </a> </div>
      <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/222.jpg" class="work-box"> <img src="images/portfolio/222.jpg" alt="">
        <div class="overlay">
          <div class="overlay-caption">
            <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>

        <!-- overlay --> 
        </a> </div>
        <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/08.jpg" class="work-box"> <img src="images/portfolio/08.jpg" alt="">
        <div class="overlay">
          <div class="overlay-caption">
             <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>
        
        <!-- overlay --> 
        </a> </div>
      <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/411.jpg" class="work-box"> <img src="images/portfolio/411.jpg" alt="" height="100%";>
        <div class="overlay">
          <div class="overlay-caption"> 
            <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>
        <!-- overlay --> 
        </a> </div>
      <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/4556.jpg" class="work-box"> <img src="images/portfolio/4556.jpg" alt="">
        <div class="overlay">
          <div class="overlay-caption">
            <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>
        
        <!-- overlay --> 
        </a> </div>
      <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/56.jpg" class="work-box"> <img src="images/portfolio/56.jpg" alt="">
        <div class="overlay">
          <div class="overlay-caption">
            <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>
        
        <!-- overlay --> 
        </a> </div>
      <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/portfolio/511.jpg" class="work-box"> <img src="images/portfolio/511.jpg" alt="">
        <div class="overlay">
          <div class="overlay-caption">
            <p><span class="icon icon-magnifying-glass"></span></p>
          </div>
        </div>
        <!-- overlay --> 
        </a> </div>
      
    </div>
  </div>
</section>
<!-- gallery section --> 
<!-- our team section -->
<section id="teams" class="section teams">
  <div class="container">
      <div class="section-header">
                <h2 class="wow fadeInDown animated">Nuestro Equipo</h2>
                <p class="wow fadeInDown animated">Contamos con un equipo especializado en varias áreas de odontología.</p>
            </div>
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="person"><img src="images/Eddy.jpg" alt="" class="img-responsive">
          <div class="person-content">
            <h4>Eddy Guerra</h4>
            <h5 class="role">Doctor</h5>
            <p>Especialista en Ortodoncia.</p>
          </div>
          <ul class="social-icons clearfix">
            <li><a href="#"><span class="fa fa-facebook"></span></a></li>
            <li><a href="#"><span class="fa fa-twitter"></span></a></li> 
            <li><a href="#"><span class="fa fa-google-plus"></span></a></li> 
          </ul>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="person"> <img src="images/carmen.jpg" alt="" class="img-responsive">
          <div class="person-content">
            <h4>Carmen Navarro</h4>
            <h5 class="role">Doctora</h5>
            <p>Especialista en Endodoncia.</p>
          </div>
          <ul class="social-icons clearfix">
            <li><a href="#" class=""><span class="fa fa-facebook"></span></a></li>
            <li><a href="#" class=""><span class="fa fa-twitter"></span></a></li> 
            <li><a href="#" class=""><span class="fa fa-google-plus"></span></a></li> 
          </ul>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="person"> <img src="images/Jose.jpg" alt="" class="img-responsive">
          <div class="person-content">
            <h4>José Rivera</h4>
            <h5 class="role">Doctor</h5>
            <p>Especialista en Implantología.</p>
          </div>
          <ul class="social-icons clearfix">
            <li><a href="#" class=""><span class="fa fa-facebook"></span></a></li>
            <li><a href="#" class=""><span class="fa fa-twitter"></span></a></li> 
            <li><a href="#" class=""><span class="fa fa-google-plus"></span></a></li> 
          </ul>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="person"> <img src="images/bianca.jpg" alt="" class="img-responsive">
          <div class="person-content">
            <h4>Bianca Salazar</h4>
            <h5 class="role">Doctora</h5>
            <p>Especialista en Odontopediatría.</p>
          </div>
          <ul class="social-icons clearfix">
            <li><a href="#" class=""><span class="fa fa-facebook"></span></a></li>
            <li><a href="#" class=""><span class="fa fa-twitter"></span></a></li> 
            <li><a href="#" class=""><span class="fa fa-google-plus"></span></a></li> 
          </ul>
        </div>
        <br><br>
      </div>

      <div class="col-md-4 col-sm-6">
        <div class="person"> <img src="images/fernanda.jpg" alt="" class="img-responsive">
          <div class="person-content">
            <h4>Fernanda Boluarte</h4>
            <h5 class="role">Doctora</h5>
            <p>Especialista en Odontología General.</p>
          </div>
          <ul class="social-icons clearfix">
            <li><a href="#" class=""><span class="fa fa-facebook"></span></a></li>
            <li><a href="#" class=""><span class="fa fa-twitter"></span></a></li> 
            <li><a href="#" class=""><span class="fa fa-google-plus"></span></a></li> 
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="person"> <img src="images/milusca.jpg" alt="" class="img-responsive">
          <div class="person-content">
            <h4>Miluska Mallaupoma</h4>
            <h5 class="role">Doctora</h5>
            <p>Especialista en Odontología Estética.</p>
          </div>
          <ul class="social-icons clearfix">
            <li><a href="#" class=""><span class="fa fa-facebook"></span></a></li>
            <li><a href="#" class=""><span class="fa fa-twitter"></span></a></li> 
            <li><a href="#" class=""><span class="fa fa-google-plus"></span></a></li> 
          </ul>
        </div>
      </div>
    

    

    <div class="col-md-4 col-sm-6">
        <div class="person"> <img src="images/william.jpg" alt="" class="img-responsive">
          <div class="person-content">
            <h4>William Chirri</h4>
            <h5 class="role">Doctor</h5>
            <p>Especialista en Cirugía Oral y Maxilofacial.</p>
          </div>
          <ul class="social-icons clearfix">
            <li><a href="#" class=""><span class="fa fa-facebook"></span></a></li>
            <li><a href="#" class=""><span class="fa fa-twitter"></span></a></li> 
            <li><a href="#" class=""><span class="fa fa-google-plus"></span></a></li> 
          </ul>
        </div>
      </div>
    </div>
  

  


  
</section>
<!-- our team section --> 

<!-- Testimonials section -->
<section id="testimonials" class="section testimonials no-padding">
  <div class="container-fluid">
    <div class="row no-gutter">
      <div class="flexslider">
        <ul class="slides">
          <li>
            <div class="col-md-12">
              <blockquote>
                <h1>"La prevención es la clave para una buena salud dental" </h1>
                
              </blockquote>
            </div>
          </li>
          <li>
            <div class="col-md-12">
              <blockquote>
                <h1>"Una sonrisa es la mejor carta de presentación" </h1>
                
              </blockquote>
            </div>
          </li>
          <li>
            <div class="col-md-12">
              <blockquote>
                <h1>"La salud bucal es parte integral de la salud general" </h1>
                
              </blockquote>
            </div>
          </li>
          <li>
            <div class="col-md-12">
              <blockquote>
                <h1>"Un tratamiento dental temprano evita complicaciones mayores en el futuro" </h1>
                
              </blockquote>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- Testimonials section --> 

<!-- contact section -->
<section id="contact" class="section">
  <div class="container">
      <div class="section-header">
                <h2 class="wow fadeInDown animated">Contáctanos</h2>
                <p class="wow fadeInDown animated">
                  Déjanos tus consultas o contáctanos rellenando el presente formulario.</p>
            </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2 conForm">       
        <form method="post" action="" >
          <input name="asunto" id="asunto" type="number" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" placeholder="Celular..." >
          <textarea name="detalle" id="detalle" cols="" rows="" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" placeholder="Detalle..."></textarea>
          <button type="submit" class="btn btn-primary">Enviar</button>
          <div id="simple-msg"></div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- contact section --> 
<!-- Footer section -->
<footer class="footer">
<div class="container-fluid">
<div id="map-row" class="row">
    <div class="col-xs-12">    
    	<iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.540849589881!2d-76.99553368462023!3d-12.075080491448443!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c73ec8ddf08b%3A0x8fb654ef558700c8!2sSan%20Francisco%20Consultorio%20Dental!5e0!3m2!1sen!2spe!4v1677777285454!5m2!1sen!2spe"></iframe> 

          <div id="map-overlay" class="col-xs-5 col-xs-offset-6" style="">
    		<h2 style="margin-top:0;color:#fff;">Información</h2>
    		<address style="color:#fff;">
    			<strong>Consultorio San Francisco</strong><br>
    			Av. del Aire 1583<br>
    			San Luis<br>
    			Lima<br>
    			<abbr title="Phone">Telefono:</abbr> (01) 6364677
    		</address>
			  © 2018 San Francisco. 
    	</div>
    </div>
	 </div>
</div>
</footer>
<!-- Footer section --> 
<!-- JS FILES --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.flexslider-min.js"></script> 
<script src="js/jquery.fancybox.pack.js"></script>  
<script src="js/modernizr.js"></script> 
<script src="js/main.js"></script> 
<script type="text/javascript" src="js/jquery.contact.js"></script> 
<script type="text/javascript" src="js/jquery.devrama.slider.min-0.9.4.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$('.slider-banner').DrSlider({
				'transition': 'fade',
				showNavigation: false,
				progressColor: "#03A9F4"
			});
		});
	</script> 
</body>
</html>