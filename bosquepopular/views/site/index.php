<?php
/* @var $this yii\web\View */

$this->title = 'SIGUL - Inicio';
?>
<style>
    body{
        background-image: url(img/1.jpg);
        background-attachment: fixed;
    }
    footer{
        background-color: white;

    }
</style>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '1119755924783515',
            xfbml: true,
            version: 'v2.7'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/es_CO/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div class="site-index">
    <div class="container-fluid" >
        <div class="row">
            <div  style="padding: 0px; margin-top: 50px; margin-left: auto; margin-right: auto;">
                <!-- Slider -->
                <div class="carousel slide auto" id="carousel-home" data-ride="carousel" data-interval="3000" >
                    <ol class="carousel-indicators">
                        <!-- Indicators -->
                        <li data-target="#carousel-home" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-home" data-slide-to="1" class=""></li>
                        <li data-target="#carousel-home" data-slide-to="2" class=""></li>
                        <!-- End Indicators -->
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">

                            <img src="img/2.jpg">
                            <div class="carousel-caption ">
                                <h2>¿Cómo se Usa?</h2>
                                <p>lee nuestras Guias de uso <br>
                                    <a class="linkg" href="#explica1">Busqueda</a> y <a class="linkg" href="#explica2">Recorridos</a>
                                </p>
                            </div>

                        </div>
                        <div class="item">
                            <a href="<?php echo Yii::$app->request->hostInfo . Yii::$app->request->baseUrl . "/index.php?r=site/busqueda"; ?>">
                                <img src="img/2.jpg">
                                <div class="carousel-caption ancho">
                                    <h2>¿Vas a alguna parte dentro de la Universidad?</h2>
                                    <p>Nosotros te ayudamos</p>
                                </div>
                            </a>

                        </div>
                        <div class="item">
                            <a href="<?php echo Yii::$app->request->hostInfo . Yii::$app->request->baseUrl . "/index.php?r=site/tour"; ?>">
                                <img src="img/3.jpg">
                                <div class="carousel-caption">
                                    <h2>Recorre la Universidad desde tu casa</h2>
                                    <p></p>
                                </div>  
                            </a>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-home" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-home" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </div>
            </div>
        </div>
        <div  class="row index-white">
            <div class="col-md-6 col-md-offset-3 "> <a name="explica1" ><h1 class="text-center ">Guia de Uso - Buscar Destino</h1></a>
            </div>
            <div>

                <div class="col-md-10 col-md-offset-2">
                    <ol>                
                        <div class="row">
                            <div class="col-md-3">
                                <li>Elige tu Origen a partir de la lista.</li>
                            </div>
                            <div class="col-md-9">
                                <img src="img/origen.jpg" class="img-responsive" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <li>Elige tu Destino a partir de la lista.</li>
                            </div>
                            <div class="col-md-9">
                                <img src="img/destino.jpg" class="img-responsive" />

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <li>Busca tu ruta.</li>
                            </div>
                            <div class="col-md-9">
                                <img src="img/boton.jpg" class="img-responsive" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <li>Espera a que busque la ruta más corta.</li>
                            </div>
                            <div class="col-md-9">
                                <img src="img/buscando.jpg" class="img-responsive" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <li>se mostrará la ruta más corta entre el origen y destino que seleccionaste.</li>
                            </div>
                            <div class="col-md-9">
                                <img src="img/resultado.jpg" class="img-responsive" />
                            </div>
                        </div>
                    </ol>
                </div>

            </div>
        </div>
        <div class="row ">
            <div class="col-md-6 col-md-offset-3 "> <a name="explica2" ><h1 class="text-center titulo">Guia de Uso - Recorrido Virtual</h1><br> <br></a>
            </div>
            <div class="col-md-10 col-md-offset-2">
                <ol class="esp">                
                    <div class="row">
                        <div class="col-md-3">
                            <li>Haz click en cualquier parte de la aplicación.</li>
                        </div>
                        <div class="col-md-9">
                            <img src="img/pantalla.jpg" class="img-responsive" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <li>Espera a que cargue.</li>
                        </div>
                        <div class="col-md-9">
                            <img src="img/cargandoR.jpg" class="img-responsive" />

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <li>Desplazate por la imagen haciendo click y desplazando el cursor.</li>
                        </div>
                        <div class="col-md-9">
                            <iframe class="responsive-video" height="100" src="https://www.youtube.com/embed/cqHWYRBvh2A" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <li>Avanza po el recorrido haciendo click en los globos.</li>
                        </div>
                        <div class="col-md-9">
                            <img src="img/globo.png" class="img-responsive" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <li>Avanza a cualquier punto del recorrido haciendo click en la brújula y seleccionando la foto que desees.</li>
                        </div>
                        <div class="col-md-9">
                            <img src="img/brujula.jpg" class="img-responsive" />
                        </div>
                    </div>
                    <br>
                </ol>
                <h3 style="    font-size: 25px;
                    color: white;
                    font-family: Verdana, Geneva, sans-serif;
                    background-color: rgba(3,2,255,0.6);"
                    >Tips</h3>
                <br>
                <ul class="esp">
                    <div class="row">
                        <div class="col-md-12">
                            <li>Agranda la pantalla haciendo doble click sobre la aplicación.</li>
                        </div>
                        <div class="col-md-12">
                            <li>En la versión movil funciona el giroscopio.</li>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <li>Oculta los globos y las opciones dando un click en la imagen, y con otro click los harás reaparecer.</li>
                        </div>
                        <div class="col-md-9">
                            <img src="img/a-b.jpg" class="img-responsive" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <li>Puedes cambiar el tipo de mapa en la vista de la brújula.</li>
                        </div>
                        <div class="col-md-9">
                            <img src="img/mapas.jpg" class="img-responsive" />
                        </div>
                        
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <li>Puedes configurar las opciones de la aplicación en los 3 puntos de la parte superior.</li>
                        </div>
                        <div class="col-md-9">
                            <img src="img/configuracion.jpg" class="img-responsive" />
                        </div>
                    </div>
                </ul>
            </div>

        </div>
    </div>





    <!--        <div class="fb-like" data-href="https://www.facebook.com/SIGUL-1108867875817883" data-colorscheme="dark" data-layout="button" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>-->

</div>
