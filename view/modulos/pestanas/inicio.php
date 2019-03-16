<?php
if (isset($_SESSION["Tipo"])) {
    $user = unserialize($_SESSION['Tipo']);
} else {
    header("Location:errorpage");
}
?>

<div id="vista_inicio">
    <?php
        if($user != "Administrador"){
            echo '<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100 imagenCarrusel" src="https://ww2.ufps.edu.co/public/archivos/elementos_corporativos/LOGO_COMPROMETIDOS.png" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 imagenCarrusel" src="https://i1.wp.com/www.srg.com.co/wp-content/uploads/2017/12/UFPS-CUCUTA.png?resize=1200%2C439&ssl=1" alt="Second slide" >
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 imagenCarrusel" src="https://www.laopinion.com.co/sites/default/files/styles/640x370/public/2016/04/15/imagen/estudiantesufps.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>';
        }else{
            echo '<div class="row mt-4 mr-5 ml-5" id="totalesAdmin">
                    <div class="col-md-2 card border-primary mr-3 ml-3 mb-2">
                        <div class="card-body text-primary">
                          <h5 class="card-title">Dependencias</h5>
                          <div class="row">
                            <ion-icon name="business" style="font-size:4em;float:left;margin-right:1em;"></ion-icon><h1 id="totalDep"><h1>
                          </div>
                        </div>
                      </div>
                      <div class="card border-success col-md-2 mr-3 ml-3 mb-2">
                        <div class="card-body text-success">
                          <h5 class="card-title">Funcionarios</h5>
                          <div class="row">
                            <ion-icon name="people" style="font-size:4em;float:left;margin-right:1em;"></ion-icon><h1 id="totalFun"><h1>
                          </div>
                        </div>
                      </div>
                      <div class="card border-danger col-md-2 mr-3 ml-3 mb-2">
                          <div class="card-body text-danger">
                            <h5 class="card-title">Noticias</h5>
                            <div class="row">
                            <ion-icon name="chatboxes" style="font-size:4em;float:left;margin-right:1em;"></ion-icon><h1 id="totalNot"><h1>
                          </div>
                          </div>
                        </div>
                      <div class="card border-warning col-md-2 mr-3 ml-3 mb-2">
                          <div class="card-body text-warning">
                            <h5 class="card-title">Usuarios</h5>
                            <div class="row">
                            <ion-icon name="person" style="font-size:4em;float:left;margin-right:1em;"></ion-icon><h1 id="totalUsu"><h1>
                          </div>
                          </div>
                        </div>
                  </div>';
        }
    ?>
    
    <h1>Inicio</h1>    
    <div id="carouselExampleSlidesOnly" class="carousel slide panel" data-ride="carousel">
        <div class="carousel-inner">
            <h4 class="mt-3" style="text-align:center;">Noticias Más Recientes</h4>
            <hr>
            <div class="row" id="panelNoticias">

            </div>
            <a style="padding:2%;float:right;" href="" title="Ver más noticias">Ver más...</a>
        </div>
    </div>
</div>
<br>