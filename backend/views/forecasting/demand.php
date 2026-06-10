<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $productForecasts */
/** @var int $forecastDays */

$this->title = 'Demand Forecast (Next 30 Days)';
$this->params['breadcrumbs'][] = ['label' => 'Forecasting', 'url' => ['forecasting/demand']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forecast-demand">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="lead">This forecast shows how much of each product will likely be sold in the next <?= $forecastDays ?> days based on your sales history.</p>

    <div class="alert alert-info">
        <strong>How to use this:</strong> 
        <ul>
            <li>Check "Days of Stock Remaining" - if it's low, you need to restock soon</li>
            <li>"Recommended Restock Quantity" tells you how much more to buy</li>
            <li>"Status" shows urgency level</li>
        </ul>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Current Stock</th>
                    <th>Avg Daily Demand</th>
                    <th>Forecasted Demand (30 Days)</th>
                    <th>Days of Stock Remaining</th>
                    <th>Recommended Restock</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productForecasts as $forecast): ?>
                    <tr>
                        <td><strong><?= $forecast['product']->product_name ?></strong></td>
                        <td><?= $forecast['currentStock'] ?> units</td>
                        <td><?= $forecast['averageDailyDemand'] ?> units/day</td>
                        <td><?= $forecast['forecastedDemand30Days'] ?> units</td>
                        <td>
                            <?php if ($forecast['daysOfStockRemaining'] > 30): ?>
                                <span class="badge badge-success"><?= $forecast['daysOfStockRemaining'] ?> days</span>
                            <?php elseif ($forecast['daysOfStockRemaining'] > 7): ?>
                                <span class="badge badge-warning"><?= $forecast['daysOfStockRemaining'] ?> days</span>
                            <?php else: ?>
                                <span class="badge badge-danger"><?= $forecast['daysOfStockRemaining'] ?> days</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $forecast['recommendedRestockQuantity'] ?> units</td>
                        <td>
                            <?php if ($forecast['status'] === 'Urgent Restock'): ?>
                                <span class="badge badge-danger">🔴 <?= $forecast['status'] ?></span>
                            <?php elseif ($forecast['status'] === 'Restock Soon'): ?>
                                <span class="badge badge-warning">🟡 <?= $forecast['status'] ?></span>
                            <?php else: ?>
                                <span class="badge badge-success">🟢 <?= $forecast['status'] ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
