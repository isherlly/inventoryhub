<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

    <!-- About Section -->
    <div class="row mb-5">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 p-4">
                <h3 class="mb-3">About Inventory Control System</h3>
                <p class="text-muted">
                    Our advanced Inventory Control System is designed to help businesses of all sizes manage their stock efficiently 
                    streamline their operations, track inventory, manage sales, and make data-driven decisions.
                </p>

                <h5 class="mt-4 mb-3">🎯 Our Mission</h5>
                <p class="text-muted">
                    To empower businesses with intelligent tools for inventory management, sales tracking, and business 
                    analytics, enabling them to grow and succeed in today's competitive marketplace.
                </p>

                <h5 class="mt-4 mb-3">💡 Why Choose Us?</h5>
                <ul class="text-muted">
                    <li>✅ <strong>Complete Solution:</strong> All-in-one platform for your business needs</li>
                    <li>✅ <strong>Easy to Use:</strong> Intuitive interface designed for all users</li>
                    <li>✅ <strong>Real-time Analytics:</strong> Instant insights into your business performance</li>
                    <li>✅ <strong>Automated Alerts:</strong> Never run out of stock unexpectedly</li>
                    <li>✅ <strong>Forecasting:</strong> Predict trends and plan ahead</li>
                    <li>✅ <strong>Multi-module Support:</strong> Sales, purchases, expenses, staff management, and more</li>
                </ul>

                <h5 class="mt-4 mb-3">📊 Core Features</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted">
                            <strong>Inventory Management:</strong><br>
                            Track products with real-time stock levels and automated low-stock alerts
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted">
                            <strong>Sales & Profit Tracking:</strong><br>
                            Record sales with automatic profit calculation and comprehensive history
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted">
                            <strong>Supplier Management:</strong><br>
                            Manage suppliers, track purchases, and optimize procurement
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted">
                            <strong>Business Analytics:</strong><br>
                            8 comprehensive report types for better business insights
                        </p>
                    </div>
                </div>

                <h5 class="mt-4 mb-3">📈 System Capabilities</h5>
                <p class="text-muted">
                    Our system includes advanced forecasting algorithms that analyze historical data to predict:
                </p>
                <ul class="text-muted">
                    <li>Customer demand for the next 30-60 days</li>
                    <li>Revenue projections based on trends</li>
                    <li>Stock level predictions to prevent stockouts</li>
                </ul>

                <h5 class="mt-4 mb-3">👥 Who Should Use This?</h5>
                <p class="text-muted">
                    Perfect for retail stores, trading companies, wholesale businesses, and any enterprise that needs 
                    to manage inventory, track sales, and monitor expenses efficiently.
                </p>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-4 mb-4">
                <h5 class="mb-3 fw-bold">📊 System Stats</h5>
                <div class="mb-3">
                    <p class="text-muted mb-1">Modules</p>
                    <h3 class="text-primary">9</h3>
                </div>
                <div class="mb-3">
                    <p class="text-muted mb-1">Report Types</p>
                    <h3 class="text-success">8</h3>
                </div>
                <div class="mb-3">
                    <p class="text-muted mb-1">Forecasting Models</p>
                    <h3 class="text-info">3</h3>
                </div>
                <div class="mb-3">
                    <p class="text-muted mb-1">Database Tables</p>
                    <h3 class="text-warning">9</h3>
                </div>
            </div>

            <div class="card shadow-sm border-0 p-4">
                <h5 class="mb-3 fw-bold">🚀 Getting Started</h5>
                <p class="text-muted small">
                    Ready to streamline your inventory? 
                    <?= Html::a('Create an account', ['/site/signup'], ['class' => 'text-decoration-none']) ?> 
                    to get started with our system.
                </p>
                <p class="text-muted small mt-3">
                    Have questions? 
                    <?= Html::a('Contact us', ['/site/contact'], ['class' => 'text-decoration-none']) ?> 
                    for more information.
                </p>
            </div>
        </div>
    </div>

</div>
