<?php

include('admin/bd.php');


//seleccionamos registros de servicios
$sentencia=$conexion->prepare("SELECT * FROM `tbl_servicios`");
$sentencia->execute();
$lista_servicios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//seleccionamos registros de portafolio
$sentencia=$conexion->prepare("SELECT * FROM `tbl_portafolio`");
$sentencia->execute();
$lista_portfolio=$sentencia->fetchAll(PDO::FETCH_ASSOC);


//seleccionamos registros de entradas
$sentencia=$conexion->prepare("SELECT * FROM `tbl_entradas`");
$sentencia->execute();
$lista_entradas=$sentencia->fetchAll(PDO::FETCH_ASSOC);


//seleccionamos registros de equipo
$sentencia=$conexion->prepare("SELECT * FROM `tbl_equipo`");
$sentencia->execute();
$lista_equipo=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//seleccionamos registros de CONFIGURACION
$sentencia=$conexion->prepare("SELECT * FROM `tbl_configuraciones`");
$sentencia->execute();
$lista_configuraciones=$sentencia->fetchAll(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Agency - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <!--<a class="navbar-brand" href="#page-top"><img src="assets/img/navbar-logo.svg" /></a>-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase text-bold ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">Servicios</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portafolio</a></li>
                       <!-- <li class="nav-item"><a class="nav-link" href="#about">Nosotros</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">Equipo</a></li>-->
                        <li class="nav-item"><a class="nav-link" href="#contact">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading text-warning"><?php echo $lista_configuraciones [0]['valor'];?></div>
                <div class="masthead-subheading text-uppercase text-bold text-warning"><?php echo $lista_configuraciones [1]['valor'];?></div>

                <a class="btn btn-primary btn-xl text-uppercase text-bold  text-black" href="<?php echo $lista_configuraciones [3]['valor'];?>">
                <?php echo $lista_configuraciones [2]['valor'];?></a>

            </div>
        </header>

        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones [4]['valor'];?></h2>
                    <h3 class="section-subheading text-bold text-danger ">Todos nuestros servicios , para una mejor atencion</h3>
                </div>

                <div class="row text-center">

                    <?php foreach($lista_servicios as $registros) { ?>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas <?php echo $registros['icono'];?> fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3"><?php echo $registros['titulo'];?></h4>
                        <p class="text-bold text-danger"><?php echo $registros['descripcion'];?></p>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </section>


        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones [5]['valor'];?></h2>
                    <h3 class="section-subheading text-muted"><?php echo $lista_configuraciones [6]['valor'];?></h3>
                </div>

                <div class="row">

                <?php foreach($lista_portfolio as $registros) { ?>

                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 1-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal<?php echo $registros['ID'];?>">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/<?php echo $registros['imagen'];?>" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading"><?php echo $registros['titulo'];?></div>
                                <div class="portfolio-caption-subheading text-muted"><?php echo $registros['subtitulo'];?></div>
                            </div>
                        </div>
                    </div>

                    <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $registros['ID'];?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase"><?php echo $registros['titulo'];?></h2>
                                    <p class="item-intro text-muted"><?php echo $registros['subtitulo'];?></p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/<?php echo $registros['imagen'];?>" alt="..." />
                                    <p><?php echo $registros['descripcion'];?></p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            <?php echo $registros['cliente'];?>
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            <?php echo $registros['categoria'];?>
                                        </li>

                                        <li>
                                            <strong>URL:</strong>
                                           <a href="<?php echo $registros['url'];?>"><?php echo $registros['url'];?></a>
                                        </li>
                                    </ul>
                                    <button class="btn btn-success btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        CERRAR
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    
                    <?php } ?>


                </div>
            </div>
        </section>


        <!-- About-->
        <!--<section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones [10]['valor'];?></h2>
                    <h3 class="section-subheading text-muted"><?php echo $lista_configuraciones [11]['valor'];?></h3>
                </div>
                <ul class="timeline">

                <?php $contador=1;
                foreach($lista_entradas as $registros) { ?>
                    
                <li <?php echo (($contador % 2) == 0)?'class="timeline-inverted"':"";?>>
                        <div class="timeline-image"><img class="rounded-circle img-fluid"
                         src="assets/img/about/<?php echo $registros['imagen'];?>" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4><?php echo $registros['fecha'];?></h4>
                                <h4 class="subheading"><?php echo $registros['titulo'];?></h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted"><?php echo $registros['descripcion'];?></p></div>
                        </div>
                    </li>

                    <?php 
                    $contador++; } ?>

                  
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4><?php echo $lista_configuraciones [12]['valor'];?></h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>


         Team
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones [7]['valor'];?></h2>
                    <h3 class="section-subheading text-muted"><?php echo $lista_configuraciones [8]['valor'];?></h3>
                </div>
                <div class="row">
                <?php foreach($lista_equipo as $registros) { ?>

                <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/<?php echo $registros['imagen'];?>" alt="..." />
                            <h4><?php echo $registros['nombrecompleto'];?></h4>
                            <p class="text-muted"><?php echo $registros['puesto'];?></p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    
                    </div>
                    <?php } ?>



                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center"><p class="large text-muted"><?php echo $lista_configuraciones [9]['valor'];?>   Nuestra dedicacion ,se demuestra en la eleccion 
                        del mejor personal para la creacion de software. </p></div>
                </div>
            </div>-->
        </section>
        <!-- Clients-->
        <div class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/microsoft.svg" alt="..." aria-label="Microsoft Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/google.svg" alt="..." aria-label="Google Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/facebook.svg" alt="..." aria-label="Facebook Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/ibm.svg" alt="..." aria-label="IBM Logo" /></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones [16]['valor'];?></h2>
                    <h3 class="section-subheading  text-white"><?php echo $lista_configuraciones [17]['valor'];?></h3>
                </div>
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <!-- * * * * * * * * * * * * * * *-->
                <!-- This form is pre-integrated with SB Forms.-->
                <!-- To make this form functional, sign up at-->
                <!-- https://startbootstrap.com/solution/contact-forms-->
                <!-- to get an API token!-->

            </div>
        </section>
        <!-- Footer-->
        
        
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start text-danger text-bold text-uppercase">Copyright &copy;2024</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="<?php echo $lista_configuraciones [13]['valor'];?>" 
                        aria-label="Twitter"><i class="fa fa-volume-control-phone" aria-hidden="true"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="<?php echo $lista_configuraciones [14]['valor'];?>"
                         aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="<?php echo $lista_configuraciones [15]['valor'];?>" aria-label="LinkedIn">
                        <i class="fa fa-envelope-open" aria-hidden="true"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none text-bold text-danger text-uppercase me-3" href="#!">Todos los derechos reservados;danidtigre.</a>
                        
                    </div>
                </div>
            </div>
        </footer>
   
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
