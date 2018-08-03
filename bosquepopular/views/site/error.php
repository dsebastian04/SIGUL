<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="container">
<div class="site-error">
    
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        El error anterior ocurrio cuando servidor procesaba tu peticion.
    </p>
    <p>
        por favor contactanos si piensas que es error del servidor, gracias.
    </p>
</div>
</div>
