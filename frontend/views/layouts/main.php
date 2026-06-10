<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
        }
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        main {
            margin-top: 80px;
            min-height: calc(100vh - 180px);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        .footer {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            margin-top: auto;
        }
        .footer a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
        }
        .footer a:hover {
            color: white;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => '📊 ' . Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => '🏠 Home', 'url' => ['/site/index']],
        ['label' => 'ℹ️ About', 'url' => ['/site/about']],
        ['label' => '💬 Contact', 'url' => ['/site/contact']],
    ];
    
    if (!Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '📋 Orders', 'url' => ['/orders/index']];
    }
    
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '🚀 Sign Up', 'url' => ['/site/signup']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div', 
            Html::a('🔐 Login', ['/site/login'], 
                ['class' => 'btn btn-outline-light btn-sm ms-2']),
            ['class' => 'd-flex align-items-center']
        );
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                '👤 ' . Yii::$app->user->identity->username . ' (Logout)',
                ['class' => 'btn btn-outline-light btn-sm ms-2']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-4 text-center text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <h6>📊 Business Management System</h6>
                <small>Complete business solution for inventory & sales</small>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <h6>Quick Links</h6>
                <small>
                    <?= Html::a('Home', ['/site/index'], ['class' => 'text-white me-2']) ?>
                    <?= Html::a('About', ['/site/about'], ['class' => 'text-white me-2']) ?>
                    <?= Html::a('Contact', ['/site/contact'], ['class' => 'text-white']) ?>
                </small>
            </div>
            <div class="col-md-4">
                <h6>Backend Access</h6>
                <small>
                    <?= Html::a('📈 Dashboard', 'http://localhost/karume-yii2/backend', 
                        ['class' => 'text-white', 'target' => '_blank']) ?>
                </small>
            </div>
        </div>
        <hr class="my-3" style="border-color: rgba(255,255,255,0.2);">
        <p class="mb-0">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?> | All rights reserved</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
