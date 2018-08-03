<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Registro de administradores';
?>

<?= $msg ?>

<h1>Registrar Administrador</h1>
<?php
$form = ActiveForm::begin([
            'id' => 'formulario',
            'method' => 'post',
            'enableClientValidation' => true,
            'enableAjaxValidation' => false,
        ]);
?>
<div class="form-group">
    <?= $form->field($model, "us_cuenta_id")->input("number") ?>   
</div>
<div class="form-group">
    <?= $form->field($model, "us_nombre")->input("text") ?>   
</div>
<div class="form-group">
    <?= $form->field($model, "us_nombre_medio")->input("text") ?>   
</div>
<div class="form-group">
    <?= $form->field($model, "us_apellido")->input("text") ?>   
</div>

<div class="form-group">
    <?= $form->field($model, "us_correo")->input("email") ?>   
</div>

<div class="form-group">
    <?= $form->field($model, "password")->input("password") ?>   
</div>

<div class="form-group">
    <?= $form->field($model, "password_repeat")->input("password") ?>   
</div>

<?= Html::submitButton("Registrar", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>