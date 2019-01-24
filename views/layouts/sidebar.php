<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\sidenav\SideNav;
use yii\helpers\Url;

AppAsset::register($this);
$this->title = 'Sistem Informasi Presensi Magang UPT. TIK UNS';
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        
        <div class="row">

            <div class="col-lg-3">

                <?php
                    $item = $this->context->action->id;
                     echo SideNav::widget([
                    'type' =>SideNav::TYPE_DEFAULT,
                    'encodeLabels' => false,
                    'heading' => 'Dashboard',
                    'items' => [
                        [
                                'url' => Url::to(['/user/index']),
                                'label' => 'Home',
                                'icon' => 'home',
                                'active' => ($item == 'index')
                        ]
                        ,[
                                'url' => Url::to(['/user/laporan']),
                                'label' => 'Laporan',
                                'icon' => 'book',
                                'active' => ($item == 'laporan')
                        ]
                        ],
                ]);
                ?>
            </div> 
            <div class="col-lg-9">
                <?= $content ?>
            </div>       
        </div>  
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Maganger SAT TIK <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
