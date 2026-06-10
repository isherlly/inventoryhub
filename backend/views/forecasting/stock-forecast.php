<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $stockForecasts */
/** @var int $forecastDays */

$this->title = 'Stock Forecast (What Will Run Out Soon)';
$this->params['breadcrumbs'][] = ['label' => 'Forecasting', 'url' => ['forecasting/stock-forecast']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forecast-stock">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="lead">This shows which products will run out of stock soon based on your sales patterns.</p>

    <div class="alert alert-danger">
        <strong>⚠️ URGENT ATTENTION:</strong> Items marked as "URGENT!" will run out very soon - restock immediately!
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Current Stock</th>
                    <th>Avg Daily Consumption</th>
                    <th>Days Until Stockout</th>
                    <th>Forecasted Stock (30 Days)</th>
                    <th>Recommended Restock Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stockForecasts as $forecast): ?>
                    <tr class="<?= $forecast['status'] === 'URGENT!' ? 'table-danger' : ($forecast['status'] === 'Soon' ? 'table-warning' : '') ?>">
                        <td><strong><?= $forecast['product']->product_name ?></strong></td>
                        <td><?= $forecast['currentStock'] ?> units</td>
                        <td><?= $forecast['averageDailyConsumption'] ?> units/day</td>
                        <td>
                            <?php if ($forecast['daysUntilStockout'] > 30): ?>
                                <span class="badge badge-success"><?= $forecast['daysUntilStockout'] ?> days</span>
                            <?php elseif ($forecast['daysUntilStockout'] > 7): ?>
                                <span class="badge badge-warning"><?= $forecast['daysUntilStockout'] ?> days</span>
                            <?php else: ?>
                                <span class="badge badge-danger"><?= $forecast['daysUntilStockout'] ?> days</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $forecast['forecastedStockLevel'] ?> units</td>
                        <td>
                            <?php if ($forecast['recommendedRestockDate']): ?>
                                <strong class="text-danger"><?= $forecast['recommendedRestockDate'] ?></strong>
                            <?php else: ?>
                                <span class="text-success">No urgent restock needed</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($forecast['status'] === 'URGENT!'): ?>
                                <span class="badge badge-danger">🔴 <?= $forecast['status'] ?></span>
                            <?php elseif ($forecast['status'] === 'Soon'): ?>
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
