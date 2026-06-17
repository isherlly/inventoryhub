<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = ' Inventory Control System - Smart Stock Management';
?>
<div class="site-index">

    <!-- Hero Section -->
    <div class="p-5 mb-5 hero-banner rounded-lg shadow-sm">
        <div class="container-fluid py-5">
            <div class="text-center">
                <h1 class="display-3 fw-bold mb-3">📊 Inventory Control System</h1>
                <p class="fs-5 fw-light mb-4">Smart stock tracking, real-time alerts, and complete inventory control at your fingertips</p>
                <?php if (Yii::$app->user->isGuest): ?>
                    <p>
                        <?= Html::a('🚀 Get Started', ['/site/signup'], ['class' => 'btn btn-light btn-lg me-2']) ?>
                        <?= Html::a('📚 Learn More', ['/site/about'], ['class' => 'btn btn-outline-light btn-lg']) ?>
                    </p>
                <?php else: ?>
                    <p>
                        <?= Html::a('📊 Go to Dashboard', 'http://localhost/inventory-yii2/backend/web/index.php?r=reports%2Fdashboard', ['class' => 'btn btn-light btn-lg']) ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container-fluid py-5">
        <h2 class="text-center mb-5 fw-bold">✨ Key Features</h2>
        
        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="display-5 mb-3">📦</div>
                        <h5 class="card-title fw-bold">Inventory Management</h5>
                        <p class="card-text text-muted">Track products, stock levels, and automated alerts for low inventory</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="display-5 mb-3">💰</div>
                        <h5 class="card-title fw-bold">Sales Tracking</h5>
                        <p class="card-text text-muted">Record sales with automatic profit calculation and history</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="display-5 mb-3">📊</div>
                        <h5 class="card-title fw-bold">Analytics & Reports</h5>
                        <p class="card-text text-muted">8 different report types for business insights and trends</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="display-5 mb-3">🔮</div>
                        <h5 class="card-title fw-bold">Forecasting</h5>
                        <p class="card-text text-muted">Predict demand, revenue, and stock levels for planning</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="display-5 mb-3">🤝</div>
                        <h5 class="card-title fw-bold">Supplier Management</h5>
                        <p class="card-text text-muted">Manage suppliers and track purchase history</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="display-5 mb-3">💳</div>
                        <h5 class="card-title fw-bold">Expense Tracking</h5>
                        <p class="card-text text-muted">Record and monitor all business expenses</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="display-5 mb-3">👥</div>
                        <h5 class="card-title fw-bold">Staff Management</h5>
                        <p class="card-text text-muted">Manage employee records and payroll information</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="display-5 mb-3">⚡</div>
                        <h5 class="card-title fw-bold">Real-time Alerts</h5>
                        <p class="card-text text-muted">Get notifications for low stock and critical events</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="bg-light py-5 my-5">
        <div class="container-fluid">
            <h2 class="text-center mb-5 fw-bold">📈 System Status</h2>
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <h3 class="display-5 fw-bold text-primary">9</h3>
                    <p class="text-muted fs-5">Core Modules</p>
                </div>
                <div class="col-md-3">
                    <h3 class="display-5 fw-bold text-success">8</h3>
                    <p class="text-muted fs-5">Report Types</p>
                </div>
                <div class="col-md-3">
                    <h3 class="display-5 fw-bold text-info">3</h3>
                    <p class="text-muted fs-5">Forecasting Models</p>
                </div>
                <div class="col-md-3">
                    <h3 class="display-5 fw-bold text-warning">100%</h3>
                    <p class="text-muted fs-5">Production Ready</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="container-fluid py-5 text-center">
        <h2 class="mb-4 fw-bold">Ready to Transform Your Business?</h2>
        <p class="fs-5 text-muted mb-4">Take control of your inventory with advanced tracking, automated alerts, and powerful insights</p>
        <?php if (Yii::$app->user->isGuest): ?>
            <p>
                <?= Html::a('Sign Up Now', ['/site/signup'], ['class' => 'btn btn-primary btn-lg me-2']) ?>
                <?= Html::a('Contact Us', ['/site/contact'], ['class' => 'btn btn-outline-primary btn-lg']) ?>
            </p>
        <?php else: ?>
            <p>
                <?= Html::a('View My Orders', ['/orders/index'], ['class' => 'btn btn-primary btn-lg me-2']) ?>
                <?= Html::a('Backend Dashboard', 'http://localhost/inventory-yii2/backend/web/index.php', ['class' => 'btn btn-outline-primary btn-lg']) ?>
            </p>
        <?php endif; ?>
    </div>

    <style>
        .hero-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: #ffffff !important;
        }
        .hero-banner h1,
        .hero-banner p {
            color: #ffffff !important;
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
        }
    </style>

</div>
