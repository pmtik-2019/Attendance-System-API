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
      <title>
         <?= Html::encode($this->title) ?>
      </title>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
      <?php $this->head() ?>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                    '<li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="glyphicon glyphicon-bell"></i>
                      <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header header-notification">Daftar Notifikasi</li>
                      <li>
                        
                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                          <li>
                            <a href="#">
                              <i class="glyphicon glyphicon-envelope"></i> 5 new members joined today
                            </a>
                          </li>
                        </ul><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                      </li>
                      <li class="footer footer-notification"><a href="#">View all</a></li>
                    </ul>
                  </li>',
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
                      echo SideNav::widget([
                        'type' =>SideNav::TYPE_DEFAULT,
                        'encodeLabels' => false,
                        'heading' => 'Dashboard',
                        'items' => $this->context->sidebar_items,
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
            <p class="pull-left">&copy; Maganger SAT TIK
               <?= date('Y') ?>
            </p>
            <p class="pull-right">
               <?= Yii::powered() ?>
            </p>
         </div>
      </footer>
      <?php $this->endBody() ?>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   </body>
</html>
<?php $this->endPage() ?>