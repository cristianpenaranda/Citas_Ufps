<?php
if (isset($_SESSION["Tipo"])) {
    $user = unserialize($_SESSION['Tipo']);
} else {
    header("Location:ErrorPage");
}
?>

<div id="vista_inicio">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="https://ww2.ufps.edu.co/public/archivos/elementos_corporativos/LOGO_COMPROMETIDOS.png" alt="First slide" style="width:100%;height:500px;">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://i1.wp.com/www.srg.com.co/wp-content/uploads/2017/12/UFPS-CUCUTA.png?resize=1200%2C439&ssl=1" alt="Second slide" style="width:100%;height:500px;">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://www.laopinion.com.co/sites/default/files/styles/640x370/public/2016/04/15/imagen/estudiantesufps.jpg" alt="Third slide" style="width:100%;height:500px;">
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
    </div>
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
