<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $todayRevenue */
/** @var array $todayProfit */
/** @var array $monthRevenue */
/** @var array $monthProfit */
/** @var array $yearRevenue */
/** @var array $yearProfit */
/** @var array $topProducts */
/** @var int $activeAlerts */
/** @var int $totalProducts */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Today's Revenue</h5>
                    <p class="card-text">₦<?= number_format($todayRevenue, 2) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Today's Profit</h5>
                    <p class="card-text">₦<?= number_format($todayProfit, 2) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Active Alerts</h5>
                    <p class="card-text"><?= $activeAlerts ?> Products</p>
                    <a href="<?= Html::encode(Yii::$app->urlManager->createUrl(['alerts/index'])) ?>">View Alerts</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text"><?= $totalProducts ?></p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-4">
            <h3>This Month</h3>
            <table class="table">
                <tr>
                    <th>Revenue</th>
                    <td>Tsh<?= number_format($monthRevenue, 2) ?></td>
                </tr>
                <tr>
                    <th>Profit</th>
                    <td>Tsh<?= number_format($monthProfit, 2) ?></td>
                </tr>
            </table>
            <a href="<?= Html::encode(Yii::$app->urlManager->createUrl(['reports/monthly'])) ?>" class="btn btn-primary btn-sm">View Report</a>
        </div>

        <div class="col-md-4">
            <h3>This Year</h3>
            <table class="table">
                <tr>
                    <th>Revenue</th>
                    <td>Tsh<?= number_format($yearRevenue, 2) ?></td>
                </tr>
                <tr>
                    <th>Profit</th>
                    <td>Tsh<?= number_format($yearProfit, 2) ?></td>
                </tr>
            </table>
            <a href="<?= Html::encode(Yii::$app->urlManager->createUrl(['reports/yearly'])) ?>" class="btn btn-primary btn-sm">View Report</a>
        </div>

        <div class="col-md-4">
            <h3>Other Reports</h3>
            <ul class="list-group">
                <li class="list-group-item"><a href="<?= Html::encode(Yii::$app->urlManager->createUrl(['reports/daily'])) ?>">Daily Report</a></li>
                <li class="list-group-item"><a href="<?= Html::encode(Yii::$app->urlManager->createUrl(['reports/weekly'])) ?>">Weekly Report</a></li>
                <li class="list-group-item"><a href="<?= Html::encode(Yii::$app->urlManager->createUrl(['reports/product-analysis'])) ?>">Product Analysis</a></li>
            </ul>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <h3>Top Products by Profit</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Total Profit</th>
                        <th>Current Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($topProducts as $item): ?>
                        <tr>
                            <td><?= $item['product']->product_name ?></td>
                            <td>Tsh<?= number_format($item['totalProfit'], 2) ?></td>
                            <td><?= $item['product']->stock_quantity ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
