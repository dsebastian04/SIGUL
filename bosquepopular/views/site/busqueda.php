<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$url = Yii::$app->request->baseUrl . '/assets/Js_per/';
echo Html::jsFile($url . 'grafo.js');
echo Html::jsFile($url . 'listaDijkstra.js');
echo Html::jsFile($url . 'dijkstra.js');
echo Html::jsFile($url . 'arrayPers.js');
echo Html::jsFile($url . 'busquedaDijkstra.js');

$this->title = 'Buscar Destino';
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=663421010489731";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
    var url = '<?php echo Yii::$app->request->hostInfo . Yii::$app->request->baseUrl; ?>';

    var puntos = [];
    function busq() {
        var listaO = document.getElementById('busqueda-origen');
        var listaD = document.getElementById('busqueda-destino');
        var indiceO = listaO.selectedIndex;
        var OpcionO = listaO.options[indiceO].value;
        var indiceD = listaD.selectedIndex;
        var OpcionD = listaD.options[indiceD].value;
        if (indiceO !== 0 && indiceD !== 0 && indiceD !== indiceO) {
            $('#buscando').modal('show');
            var matriz = '<?php echo $model->setCookie(); ?>';
            var datosSig = new DatosSIG();
            var arrayRuta = [];
            arrayRuta = datosSig.buscar(OpcionO, OpcionD, matriz);
            initMap();
            var lineSymbol = {
                path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
            };
            arrayRuta = JSON.stringify(arrayRuta);

            $.post(url + '/index.php?r=site%2Fpedirgeo', {ruta: arrayRuta}, function (response) {
                puntos = JSON.parse(response);
                var markerO, markerD, imgO, imgD;
                imgO = {url: 'img/ini.png',
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(0, 45)
                };
                imgD = {url: 'img/end.png',
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(0, 45)
                };
                markerO = new google.maps.Marker({
                    map: map,
                    animation: google.maps.Animation.DROP,
                    position: puntos[0], //origen
                    icon: imgO,
                    draggable: false,
                });
                markerD = new google.maps.Marker({
                    map: map,
                    animation: google.maps.Animation.DROP,
                    position: puntos[puntos.length - 1], //Destino
                    icon: imgD,
                    draggable: false,
                });
                var bounds = new google.maps.LatLngBounds();
                var coorOrig = new google.maps.LatLng(puntos[0]);
                bounds.extend(coorOrig);
                var coorDest = new google.maps.LatLng(puntos[puntos.length - 1]);
                bounds.extend(coorDest);
                map.fitBounds(bounds);
                var lineSymbol = {
                    path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
                    scale: 4,
                    fillColor: '#393',
                    fillOpacity: 1,
                    strokeColor: '#393',
                    strokeOpacity: 1,
                };
                var flightPath = new google.maps.Polyline({
                    path: puntos,
                    geodesic: true,
                    strokeColor: '#FF0000',
                    strokeOpacity: 1.0,
                    strokeWeight: 2,
                    icons: [{
                            icon: lineSymbol,
                            offset: '100%'
                        }],
                    map: map
                });
                animateTravel(flightPath);

                document.getElementById("distancia").innerHTML = "Tienes que caminar aproximadamente " + datosSig.distancia(OpcionD) + " metros";
                flightPath.setMap(map);
                cerrare();
                
            });

        }

    }

    function cerrare() {
        $('#buscando').modal('hide');
    }

    
</script>

<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row" >
        <div class="row col-md-6 col-xs-12">
            <?php
            Pjax::begin();
            $form = ActiveForm::begin(['id' => 'busqueda', 'method' => 'post',
                        'enableClientValidation' => true,
                        'options' => ['data' => ['pjax' => true]],
                    ])
            ?>
            <div class="row ">
                <div class="col-md-1 col-xs-1" >
                    <?= Html::img('@web/img/ini.png', ['alt' => 'My logo']); ?>
                </div>
                <div class="col-xs-11" >
                    <?= $form->field($model, 'origen')->dropDownList($model->listaPuntos(), ['prompt' => '- Seleccionar Origen -']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1 col-xs-1">
                    <?= Html::img('@web/img/end.png', ['alt' => 'My logo']) ?>
                </div><div class=" col-xs-11" >
                    <?= $form->field($model, 'destino')->dropDownList($model->listaPuntos(), ['prompt' => '- Seleccionar Destino -']); ?>
                </div>  
            </div>
            <div class="row">
                <div class=" col-xs-11 col-xs-offset-1" >
                    <?= Html::SubmitButton('Buscar', ['class' => 'btn btn-danger', 'name' => 'login-button', 'onclick' => "busq()"]);
                    ?>
                </div>
                <?php
                ActiveForm::end();
                Pjax::end();
                ?>
            </div>
            <div class="row">
                <div class=" col-xs-11 col-xs-offset-1" >
                    <div style="color:#999;margin:1em 0" >
                        ¿Necesitas ayuda? Mira la <a href="<?php echo Yii::$app->request->hostInfo . Yii::$app->request->baseUrl . "/index.php?r=site/index#explica1"; ?>">Guia de uso</a>
                    </div>
                    <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <h3 id="distancia"></h3>
                </div>
            </div>
        </div>

        <div class=" col-md-6 col-xs-11 col-xs-offset-1 col-sm-12 col-sm-offset-1" id="map" style="height:300px;  margin-left: 10px;">
        </div>
    </div>


<div class="modal fade bs-example-modal-sm" id="buscando" tabindex="-1"
     role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span class="glyphicon glyphicon-time">
                    </span>Cargando... 
                </h4><br> <h4>Buscando la ruta más corta</h4>
            </div>
            <div class="modal-body">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active"
                         style="width: 100%">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>














<script type="text/javascript">

    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 4.6652904, lng: -74.1016647},
            zoom: 18,
            mapTypeId: google.maps.MapTypeId.SATELLITE,
            disableDefaultUI: true,
            zoomControl: true
        });


        // Try HTML5 geolocation.


    }
    function animateTravel(line) {
        var count = 0;
        var velocidad = 0.5; // la velocidad con la que se desplaza el icon
        var listener = window.setInterval(function () {

            count = (count + velocidad) % 200;

            var icons = line.get('icons');
            icons[0].offset = (count / 2) + '%';
            line.set('icons', icons);
            // if (count == 199) clearInterval(listener); // activar si solo se quiere mostrar una vez el recorrido
        }, 20);
    }
   

   



</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDme-fQrOEOJw_u7T1NIgJZZOy-rlJT3Pk&callback=initMap&language=es" ></script>

</div>