<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $salesByDay */
/** @var float $totalRevenue */
/** @var float $totalProfit */
/** @var float $averageDailyRevenue */
/** @var float $averageDailyProfit */

$this->title = 'Sales Trends Report (Last 30 Days)';
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['dashboard']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-sales-trends">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="card-text">₦<?= number_format($totalRevenue, 2) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Profit</h5>
                    <p class="card-text">₦<?= number_format($totalProfit, 2) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Avg Daily Revenue</h5>
                    <p class="card-text">₦<?= number_format($averageDailyRevenue, 2) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Avg Daily Profit</h5>
                    <p class="card-text">₦<?= number_format($averageDailyProfit, 2) ?></p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <h3>Daily Breakdown</h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Date</th>
                    <th>Sales Count</th>
                    <th>Quantity Sold</th>
                    <th>Revenue</th>
                    <th>Profit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($salesByDay as $day): ?>
                    <tr>
                        <td><strong><?= date('D, M d', strtotime($day['date'])) ?></strong></td>
                        <td><?= $day['salesCount'] ?></td>
                        <td><?= $day['quantity'] ?> units</td>
                        <td>₦<?= number_format($day['revenue'], 2) ?></td>
                        <td class="text-success"><strong>₦<?= number_format($day['profit'], 2) ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
