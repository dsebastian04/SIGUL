<?php
/* @var $this yii\web\View */

use dosamigos\chartjs\ChartJs;
use yii\grid\GridView;


$this->title = 'Administración SIGUL';
?>
<div class='site-index' style="min-height: 500px; ">

    <div class="col-lg-4" ><p>Tu acceso anterior fue: <span style="font-weight: bold">  <?php echo $log[1]['mes'] ?> </span></p></div>

    <div class="col-lg-3">
        <p>los últimos 5 ingresos al sistema fueron estos: </p>
        <?=
        GridView::widget([
            'dataProvider' => $dp,
            'summary' => ''
        ]);
        ?>
    </div>
    <div class="col-lg-4 col-lg-offset-1">
        <p>ingresos mensuales al sistema: </p>
        <?php
        
        echo ChartJs::widget([
            'type' => 'doughnut',
            'options' => [
                'height' => 400,
                'width' => 400
            ],
            'data' => [
                'labels' => $grafica->etiquetas,
                'datasets' => [
                    [
                        'label' => 'ingresos al sistema administrativo',
                        'fillColor' => "rgba(220,220,220,0.5)",
                        'backgroundColor' => [
                            "#078BE3",
                            "#D60000",
                            "#740CED",
                            "#E3E039",
                            "#ED8E0C"],
                        'borderWidth' => 1,
                        'pointStrokeColor' => "#fff",
                        'data' => $grafica->valores
                    ]
                ]]
        ]);
        ?>
    </div>
    </br>
    </br>
    </br>
</div>
