<?php
/* @var $this yii\web\View */

use dosamigos\chartjs\ChartJs;

$this->title = 'Estadisticas Geográficas - SIGUL';
?>
<div style="min-height: 1000px;" >


    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Origen más frecuente</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <?=
            ChartJs::widget([
                'type' => 'doughnut',
                'options' => [

                    'width' => 400
                ],
                'data' => [
                    'labels' => $graficaOF->etiquetas,
                    'datasets' => [
                        [
                            'label' => 'ingresos al sistema administrativo',
                            'fillColor' => "rgba(220,220,220,0.5)",
                            'backgroundColor' => [
                                "#18A32A",
                                "#D6360A",
                                "#41DB81",
                                "#A35E18",
                                "#705132"],
                            'borderWidth' => 1,
                            'pointStrokeColor' => "#fff",
                            'data' => $graficaOF->valores
                        ]
                    ]]
            ]);
            ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->


    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Destino más frecuente</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <?=
            ChartJs::widget([
                'type' => 'polarArea',
                'options' => [
                    'width' => 400
                ],
                'data' => [
                    'labels' => $graficaDF->etiquetas,
                    'datasets' => [
                        [
                            
                            'fillColor' => "rgba(220,220,220,0.5)",
                            'backgroundColor' => [
                                "#078BE3",
                                "#D60000",
                                "#740CED",
                                "#E3E039",
                                "#ED8E0C"],
                            'borderWidth' => 1,
                            'pointStrokeColor' => "#fff",
                            'data' => $graficaDF->valores
                        ]
                    ]]
            ]);
            ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->




    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Ruta más frecuente</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <?=
            ChartJs::widget([
                'type' => 'pie',
                'options' => [

                    'width' => 400
                ],
                'data' => [
                    'labels' => $graficaCF->etiquetas,
                    'datasets' => [
                        [
                            'label' => 'ingresos al sistema administrativo',
                            'fillColor' => "rgba(220,220,220,0.5)",
                            'backgroundColor' => [
                                "#1F5489",
                                "#DD2215",
                                "#3586D6",
                                "#95A318",
                                "#ED6121"],
                            'borderWidth' => 1,
                            'pointStrokeColor' => "#fff",
                            'data' => $graficaCF->valores
                        ]
                    ]]
            ]);
            ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->


    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Lugar de mayor frecuencia</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <?=
            ChartJs::widget([
                'type' => 'bar',
                'options' => [

                    'width' => 400
                ],
                'data' => [
                    'labels' => $graficaLF->etiquetas,
                    'datasets' => [
                        [
                            'label' => 'lugares de mayor frecuencia',
                            'fillColor' => "rgba(220,220,220,0.5)",
                            'backgroundColor' => [
                                "#003D56",
                                "#42AFDD",
                                "#0097D6",
                                "#0C4156",
                                "#0073A3"],
                            'borderWidth' => 1,
                            'pointStrokeColor' => "#fff",
                            'data' => $graficaLF->valores
                        ]
                    ]]
            ]);
            ?>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

</div>