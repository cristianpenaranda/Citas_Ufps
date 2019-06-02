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
                    <div class="carousel-inner" id="carousel-inner">
                    
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
                        <a class="card-body text-primary" style="cursor:pointer;" title="Ir a Dependencias" href="administrador_dependencias">
                          <h5 class="card-title">Dependencias</h5>
                          <div class="row">
                            <ion-icon name="business" style="font-size:4em;float:left;margin-right:25px;"></ion-icon><h1 id="totalDep"><h1>
                          </div>
                        </a>
                      </div>
                      <div class="card border-success col-md-2 mr-3 ml-3 mb-2">
                        <a class="card-body text-success" style="cursor:pointer;" title="Ir a Funcionarios" href="administrador_funcionarios">
                          <h5 class="card-title">Funcionarios</h5>
                          <div class="row">
                            <ion-icon name="people" style="font-size:4em;float:left;margin-right:25px;"></ion-icon><h1 id="totalFun"><h1>
                          </div>
                        </a>
                      </div>
                      <div class="card border-danger col-md-2 mr-3 ml-3 mb-2">
                          <a class="card-body text-danger" style="cursor:pointer;" title="Ir a Noticias" href="administrador_noticias">
                            <h5 class="card-title">Noticias</h5>
                            <div class="row">
                            <ion-icon name="chatboxes" style="font-size:4em;float:left;margin-right:25px;"></ion-icon><h1 id="totalNot"><h1>
                          </div>
                          </a>
                        </div>
                        <div class="card border-warning col-md-2 mr-3 ml-3 mb-2">
                            <a class="card-body text-warning" style="cursor:pointer;" title="Total de usuarios registrados en el sistema">
                              <h5 class="card-title">Usuarios</h5>
                              <div class="row">
                              <ion-icon name="person" style="font-size:4em;float:left;margin-right:25px;"></ion-icon><h1 id="totalUsu"><h1>
                            </div>
                            </a>
                          </div>
                          <div class="card border-dark col-md-2 mr-3 ml-3 mb-2">
                              <a class="card-body text-dark" style="cursor:pointer;" title="Total de imágenes de inicio guardadas" href="administrador_imagenes">
                                <h5 class="card-title">Imágenes</h5>
                                <div class="row">
                                <ion-icon name="photos" style="font-size:4em;float:left;margin-right:25px;"></ion-icon><h1 id="totalIma"><h1>
                              </div>
                              </a>
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