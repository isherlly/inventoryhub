<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $todayRevenue */
/** @var array $todayProfit */
/** @var array $monthRevenue */
/** @var array $monthProfit */
/** @var array $monthExpenses */
/** @var array $monthPurchases */
/** @var array $yearRevenue */
/** @var array $yearProfit */
/** @var array $topProducts */
/** @var int $activeAlerts */
/** @var int $totalProducts */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;

// Calculate margins
$todayMargin = $todayRevenue > 0 ? ($todayProfit / $todayRevenue) * 100 : 0;
$monthMargin = $monthRevenue > 0 ? ($monthProfit / $monthRevenue) * 100 : 0;
$yearMargin = $yearRevenue > 0 ? ($yearProfit / $yearRevenue) * 100 : 0;
?>
<div class="site-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Today's Key Metrics -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-primary text-uppercase mb-1 font-weight-bold small">Today's Revenue</div>
                    <div class="h3 mb-0">Tsh<?= number_format($todayRevenue, 2) ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-success text-uppercase mb-1 font-weight-bold small">Today's Profit</div>
                    <div class="h3 mb-0">Tsh<?= number_format($todayProfit, 2) ?></div>
                    <small class="text-muted"><?= number_format($todayMargin, 1) ?>% margin</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-warning text-uppercase mb-1 font-weight-bold small">Active Alerts</div>
                    <div class="h3 mb-0"><?= $activeAlerts ?></div>
                    <a href="<?= Html::encode(Yii::$app->urlManager->createUrl(['alerts/index'])) ?>" class="small">View Alerts →</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-info text-uppercase mb-1 font-weight-bold small">Total Products</div>
                    <div class="h3 mb-0"><?= $totalProducts ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly & Annual Summary -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h6 class="m-0 font-weight-bold">This Month Performance</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="mb-3">
                                <small class="text-muted">Revenue</small>
                                <div class="h5">Tsh<?= number_format($monthRevenue, 2) ?></div>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">Purchases</small>
                                <div class="h5">Tsh<?= number_format($monthPurchases, 2) ?></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <small class="text-muted">Profit</small>
                                <div class="h5 text-success">Tsh<?= number_format($monthProfit, 2) ?></div>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">Expenses</small>
                                <div class="h5 text-danger">Tsh<?= number_format($monthExpenses, 2) ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-info mb-0">
                        <small><strong>Profit Margin:</strong> <?= number_format($monthMargin, 1) ?>%</small>
                    </div>
                    <a href="<?= Html::encode(Yii::$app->urlManager->createUrl(['reports/monthly'])) ?>" class="btn btn-primary btn-sm mt-3">View Detailed Report</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white py-3">
                    <h6 class="m-0 font-weight-bold">This Year Performance</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="mb-3">
                                <small class="text-muted">Revenue</small>
                                <div class="h5">Tsh<?= number_format($yearRevenue, 2) ?></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <small class="text-muted">Profit</small>
                                <div class="h5 text-success">Tsh<?= number_format($yearProfit, 2) ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-info mb-0">
                        <small><strong>Profit Margin:</strong> <?= number_format($yearMargin, 1) ?>%</small>
                    </div>
                    <a href="<?= Html::encode(Yii::$app->urlManager->createUrl(['reports/yearly'])) ?>" class="btn btn-success btn-sm mt-3">View Detailed Report</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Report Links -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white py-3">
                    <h6 class="m-0 font-weight-bold">Quick Reports</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="<?= Html::encode(Yii::$app->urlManager->createUrl(['reports/daily'])) ?>" class="btn btn-outline-primary btn-block mb-2">📅 Daily Report</a>
                        </div>
                        <div class="col-md-3">
                            <a href="<?= Html::encode(Yii::$app->urlManager->createUrl(['reports/weekly'])) ?>" class="btn btn-outline-primary btn-block mb-2">📊 Weekly Report</a>
                        </div>
                        <div class="col-md-3">
                            <a href="<?= Html::encode(Yii::$app->urlManager->createUrl(['reports/product-analysis'])) ?>" class="btn btn-outline-primary btn-block mb-2">📦 Product Analysis</a>
                        </div>
                        <div class="col-md-3">
                            <a href="<?= Html::encode(Yii::$app->urlManager->createUrl(['alerts/index'])) ?>" class="btn btn-outline-warning btn-block mb-2">⚠️ View All Alerts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Products Section -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-dark text-white py-3">
                    <h6 class="m-0 font-weight-bold">🏆 Top 5 Products by Profit</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($topProducts)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th class="text-right">Total Profit</th>
                                        <th class="text-center">Current Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; foreach ($topProducts as $item): ?>
                                        <tr>
                                            <td><span class="badge badge-primary"><?= $i++ ?></span></td>
                                            <td><?= Html::encode($item['product']->product_name) ?></td>
                                            <td class="text-right text-success font-weight-bold">Tsh<?= number_format($item['totalProfit'], 2) ?></td>
                                            <td class="text-center">
                                                <?php if ($item['product']->stock_quantity <= 5): ?>
                                                    <span class="badge badge-danger"><?= $item['product']->stock_quantity ?></span>
                                                <?php elseif ($item['product']->stock_quantity <= 20): ?>
                                                    <span class="badge badge-warning"><?= $item['product']->stock_quantity ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-success"><?= $item['product']->stock_quantity ?></span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info mb-0">No sales data available yet.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS for card borders -->
    <style>
        .border-left-primary {
            border-left: 4px solid #007bff !important;
        }
        .border-left-success {
            border-left: 4px solid #28a745 !important;
        }
        .border-left-warning {
            border-left: 4px solid #ffc107 !important;
        }
        .border-left-info {
            border-left: 4px solid #17a2b8 !important;
        }
        .text-primary { color: #007bff; }
        .text-success { color: #28a745; }
        .text-warning { color: #ffc107; color: #000; }
        .text-info { color: #17a2b8; }
        .text-danger { color: #dc3545; }
    </style>
