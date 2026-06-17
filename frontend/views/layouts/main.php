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
        footer.footer {
            --bs-heading-color: #ffffff;
            --bs-secondary-color: #ffffff;
            --bs-link-color: #ffffff;
            background-color: #231146 !important;
            background: linear-gradient(90deg, #434190 0%, #5a3d8a 100%) !important;
            color: #ffffff !important;
            margin-top: auto;
            padding-bottom: 8.5rem !important;
        }
        footer.footer,
        footer.footer h6,
        footer.footer p,
        footer.footer small,
        footer.footer a,
        footer.footer .footer-desc,
        footer.footer .footer-copyright {
            color: #ffffff !important;
            opacity: 1 !important;
            -webkit-text-fill-color: #ffffff !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.35);
        }
        footer.footer a {
            text-decoration: underline;
            text-underline-offset: 2px;
            font-weight: 500;
        }
        footer.footer a:hover {
            color: #f8f9fa !important;
            -webkit-text-fill-color: #1e4974 !important;
        }
        footer.footer h6 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        footer.footer .footer-desc {
            font-size: 0.95rem;
            line-height: 1.5;
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
    
    ];
    
    if (!Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => '📊 Dashboard', 'url' => ['/site/dashboard']];
    $menuItems[] = ['label' => '📦 Products', 'url' => ['/products/index']];
    $menuItems[] = ['label' => '🛒 Sales', 'url' => ['/sales/index']];
    $menuItems[] = ['label' => '🚚 Purchases', 'url' => ['/purchases/index']];
    $menuItems[] = ['label' => '🏢 Suppliers', 'url' => ['/suppliers/index']];
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

<footer class="footer mt-auto py-4 text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-3 mb-md-0">
                <h6>📊 Inventory Control System</h6>
                <p class="footer-desc mb-0">Smart inventory management for modern businesses</p>
            </div>
            <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->username === 'admin'): ?>
            <div class="col-md-12 mt-2">
                <p class="footer-desc mb-0">
                    <?= Html::a('📈 Admin Backend', 'http://localhost/inventory-yii2/backend/web/', ['target' => '_blank']) ?>
                </p>
            </div>
            <?php endif; ?>
        </div>
        <hr class="my-3 border-light opacity-50">
        <p class="footer-copyright mb-0">&copy; 2026 Inventory Control System. All rights reserved</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
