<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
//Register class
if (class_exists('rce\material\Assets')) {
    rce\material\Assets::register($this);
}
use rce\material\widgets\Menu as RCEmenu;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
  echo  $menu = RCEmenu::widget(
              [
                  'items' => [
                      ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/site/index']],
                      [
                          'label' => 'Multi Level Collapse',
                          'icon' => 'swap_vertical_circle',
                          'url' => '#',
                          'items' => [
                              ['label' => 'Level One', 'url' => '#',],
                              [
                                  'label' => 'Level Two',
                                  'icon' => 'swap_vertical_circle',
                                  'url' => '#',
                                  'items' => [
                                      ['label' => 'Level Three', 'url' => '#',],
                                      ['label' => 'Level Three', 'url' => '#',],
                                  ],
                              ],
                          ],
                      ],
                      [
                          'label' => 'Some tools',
                          'icon' => 'build',
                          'url' => '#',
                          'items' => [
                              ['label' => 'Gii', 'icon' => 'settings_input_composite', 'url' => ['/gii'],],
                              ['label' => 'Debug', 'icon' => 'bug_report', 'url' => ['/debug'],],
                          ],
                      ],
                  ],
              ]
          );
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
