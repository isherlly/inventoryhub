<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $historicalSales */
/** @var float $totalRevenue */
/** @var float $totalProfit */
/** @var float $averageDailyRevenue */
/** @var float $averageDailyProfit */
/** @var float $forecastedRevenue */
/** @var float $forecastedProfit */
/** @var array $weeklyForecast */
/** @var int $forecastDays */

$this->title = 'Sales Forecast (Next 30 Days)';
$this->params['breadcrumbs'][] = ['label' => 'Forecasting', 'url' => ['forecasting/sales-forecast']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forecast-sales">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="lead">Based on your last 60 days of sales, here's what you can expect in the next 30 days.</p>

    <div class="row">
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title">Avg Daily Revenue (60 days)</h5>
                    <p class="card-text text-primary">₦<?= $averageDailyRevenue ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-body">
                    <h5 class="card-title">Avg Daily Profit (60 days)</h5>
                    <p class="card-text text-success">₦<?= $averageDailyProfit ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info">
                <div class="card-body">
                    <h5 class="card-title">Forecasted Revenue (30 days)</h5>
                    <p class="card-text text-info">₦<?= $forecastedRevenue ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-body">
                    <h5 class="card-title">Forecasted Profit (30 days)</h5>
                    <p class="card-text text-warning">₦<?= $forecastedProfit ?></p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <h3>Historical Performance (Last 60 Days)</h3>
    <table class="table table-striped table-sm">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Revenue</th>
                <th>Profit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($historicalSales as $sale): ?>
                <tr>
                    <td><?= date('M d', strtotime($sale['date'])) ?></td>
                    <td>₦<?= number_format($sale['revenue'], 2) ?></td>
                    <td class="text-success">₦<?= number_format($sale['profit'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <hr>

    <h3>Weekly Forecast Breakdown</h3>
    <div class="row">
        <?php foreach ($weeklyForecast as $week): ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Week <?= $week['week'] ?></h5>
                        <p><strong>Revenue:</strong> ₦<?= $week['forecastedRevenue'] ?></p>
                        <p><strong>Profit:</strong> ₦<?= $week['forecastedProfit'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
