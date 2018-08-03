<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'SIGUL - Recorrido virtual';
?>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '663421010489731',
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

<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <div style="color:#999;margin:1em 0">
        ¿Necesitas ayuda? Mira la <a href="<?php echo Yii::$app->request->hostInfo . Yii::$app->request->baseUrl . "/index.php?r=site/index#explica2"; ?>">Guia de uso</a>
    </div>


    <div class="embed-responsive embed-responsive-4by3" style="height: 400px;">
         <iframe class="embed-responsive-item"  src="https://round.me/embed/24412/59049" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
    </div>

    <div class="fb-like" data-width="100" data-href="https://www.facebook.com/SIGUL-148566312247497/" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
</div>
