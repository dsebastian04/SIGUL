<?php
/* @var $this yii\web\View */

use dosamigos\chartjs\ChartJs;

$this->title = 'Estadisticas de Uso - SIGUL';
?>
<div style="min-height: 1000px;" >
    
    <?=
    ChartJs::widget([
        'type' => 'line',
        'options' => [

            'width' => 400
        ],
        'data' => [
            'labels' => $graficaMensual->etiquetas,
            'datasets' => [
                [
                    'label' => 'últimos 12 meses*',
                  
            'lineTension'=> 0.1,
            'backgroundColor'=> "rgba(75,192,192,0.4)",
            'borderColor'=> "rgba(75,192,192,1)",
            'borderCapStyle'=> 'butt',
            'borderDash'=> [],
            'borderDashOffset'=> 0.0,
            'borderJoinStyle'=> 'miter',
            'pointBorderColor'=> "rgba(75,192,192,1)",
            'pointBackgroundColor'=> "#fff",
            'pointBorderWidth'=> 1,
            'pointHoverRadius'=> 5,
            'pointHoverBackgroundColor'=> "rgba(75,192,192,1)",
            'pointHoverBorderColor'=> "rgba(220,220,220,1)",
            'pointHoverBorderWidth'=> 2,
            'pointRadius'=> 1,
            'pointHitRadius'=> 10,
                    'borderWidth' => 1,
                    'pointStrokeColor' => "#fff",
                    'data' => $graficaMensual->valores
                ]
            ]]
    ]);
    ?>
    <?=
    ChartJs::widget([
        'type' => 'line',
        'options' => [

            'width' => 400
        ],
        'data' => [
            'labels' => $graficaDia->etiquetas,
            'datasets' => [
                [
                    'label' => 'últimos 30 días*',
                    
            'lineTension'=> 0.1,
            'backgroundColor'=> "rgba(75,192,192,0.4)",
            'borderColor'=> "rgba(75,192,192,1)",
            'borderCapStyle'=> 'butt',
            'borderDash'=> [],
            'borderDashOffset'=> 0.0,
            'borderJoinStyle'=> 'miter',
            'pointBorderColor'=> "rgba(75,192,192,1)",
            'pointBackgroundColor'=> "#fff",
            'pointBorderWidth'=> 1,
            'pointHoverRadius'=> 5,
            'pointHoverBackgroundColor'=> "rgba(75,192,192,1)",
            'pointHoverBorderColor'=> "rgba(220,220,220,1)",
            'pointHoverBorderWidth'=> 2,
            'pointRadius'=> 1,
            'pointHitRadius'=> 10,
                    'borderWidth' => 1,
                    'pointStrokeColor' => "#fff",
                    'data' => $graficaDia->valores
                ]
            ]]
    ]);
    ?>
    <?=
    ChartJs::widget([
        'type' => 'line',
        'options' => [
            
            'width' => 400
        ],
        'data' => [
            'labels' => $graficaHora->etiquetas,
            'datasets' => [
                [
                    'label' => 'últimas 24 horas*',
                    
            'lineTension'=> 0.1,
            'backgroundColor'=> "rgba(75,192,192,0.4)",
            'borderColor'=> "rgba(75,192,192,1)",
            'borderCapStyle'=> 'butt',
            'borderDash'=> [],
            'borderDashOffset'=> 0.0,
            'borderJoinStyle'=> 'miter',
            'pointBorderColor'=> "rgba(75,192,192,1)",
            'pointBackgroundColor'=> "#fff",
            'pointBorderWidth'=> 1,
            'pointHoverRadius'=> 5,
            'pointHoverBackgroundColor'=> "rgba(75,192,192,1)",
            'pointHoverBorderColor'=> "rgba(220,220,220,1)",
            'pointHoverBorderWidth'=> 2,
            'pointRadius'=> 1,
            'pointHitRadius'=> 10,
                    'borderWidth' => 1,
                    'pointStrokeColor' => "#fff",
                    'data' => $graficaHora->valores
                ]
            ]]
    ]);
    ?>
    <p>* se representan las consultas almacendas, por lo cual si no aparecen datos se debe a la falta de consultas en el aplicativo</p>
</div>