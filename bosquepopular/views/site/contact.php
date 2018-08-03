<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'SIGUL - Contáctenos';
$this->params['breadcrumbs'][] = $this->title;
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

<div class="site-contact">
    <div class="container">
        <h1><?= Html::encode($this->title) ?><img src="<?php echo Yii::$app->request->hostInfo . Yii::$app->request->baseUrl ?>/img/logo.fw.png"/></h1> 

        <p>
            Tu opinion es importante para mejorar día a día el sistema, por favor comentanos tu experiencia.
        </p>

        <div class="fb-comments"  data-href="https://www.facebook.com/SIGUL-148566312247497" data-numposts="5" data-width="100%" >     

        </div>
        <div class="fb-like" data-width="100" data-href="https://www.facebook.com/SIGUL-148566312247497/" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
    </div>
        


</div>

