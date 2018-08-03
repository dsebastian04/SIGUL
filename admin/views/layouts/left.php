<aside class="main-sidebar">

    <section class="sidebar">

        
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php echo Yii::$app->user->identity->us_nombre.' '.Yii::$app->user->identity->us_nombre_medio.' '.Yii::$app->user->identity->us_apellido  ?></p>

                
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menú', 'options' => ['class' => 'header']],
                    ['label' => 'Registrar Administrador', 'icon' => 'fa fa-plus', 'url' => ['site/registrar']],
                    ['label' => 'Estadisticas de busqueda', 'icon' => 'fa fa-bar-chart', 'url' => '#',
                        'items' => [
                                    ['label' => 'Puntos Geográficos', 'icon' => 'glyphicon glyphicon-globe', 'url' => ['site/estadisticasg'],],
                                    ['label' => 'Uso del Sistema', 'icon' => 'glyphicon glyphicon-hdd', 'url' => ['site/estadisticass'],],
                            ]
                        ],
                    
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    
                ],
            ]
        ) ?>

    </section>

</aside>
