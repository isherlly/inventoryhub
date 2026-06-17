<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-dashboard">
    <div class="container-fluid mt-5">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading">👋 Welcome, <?= Yii::$app->user->identity->username ?>!</h4>
                    <p>You have successfully logged into the Inventory Control System. Use the navigation menu or dashboard cards below to manage your business operations.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="row">
            <!-- Sales Card -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="display-4 text-success mb-3">💰</div>
                        <h5 class="card-title fw-bold">Sales</h5>
                        <p class="card-text text-muted">Manage your sales transactions</p>
                        <?= Html::a('View Sales', ['sales/index'], ['class' => 'btn btn-success btn-sm']) ?>
                    </div>
                </div>
            </div>

            <!-- Purchases Card -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="display-4 text-warning mb-3">📦</div>
                        <h5 class="card-title fw-bold">Purchases</h5>
                        <p class="card-text text-muted">Manage purchase orders</p>
                        <?= Html::a('View Purchases', ['purchases/index'], ['class' => 'btn btn-warning btn-sm']) ?>
                    </div>
                </div>
            </div>

            <!-- Products Card -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="display-4 text-primary mb-3">🛍️</div>
                        <h5 class="card-title fw-bold">Products</h5>
                        <p class="card-text text-muted">Manage product inventory</p>
                        <?= Html::a('View Products', ['products/index'], ['class' => 'btn btn-primary btn-sm']) ?>
                    </div>
                </div>
            </div>

            <!-- Suppliers Card -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="display-4 text-danger mb-3">🏭</div>
                        <h5 class="card-title fw-bold">Suppliers</h5>
                        <p class="card-text text-muted">Manage supplier information</p>
                        <?= Html::a('View Suppliers', ['suppliers/index'], ['class' => 'btn btn-danger btn-sm']) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Section -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h5 class="fw-bold mb-3">Quick Actions</h5>
                <div class="btn-group-vertical w-100" role="group">
                    <div class="d-grid gap-2 d-sm-flex">
                        <?= Html::a('➕ New Sale', ['sales/create'], ['class' => 'btn btn-outline-success']) ?>
                        <?= Html::a('➕ New Purchase', ['purchases/create'], ['class' => 'btn btn-outline-warning']) ?>
                        <?= Html::a('➕ New Product', ['products/create'], ['class' => 'btn btn-outline-primary']) ?>
                        <?= Html::a('➕ New Supplier', ['suppliers/create'], ['class' => 'btn btn-outline-danger']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
