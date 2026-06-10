<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var string $date */
/** @var array $sales */
/** @var float $totalRevenue */
/** @var float $totalProfit */

$this->title = 'Daily Report - ' . date('Y-m-d', strtotime($date));
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['dashboard']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-daily">

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
                    <h5 class="card-title">Total Sales</h5>
                    <p class="card-text"><?= count($sales) ?></p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <h3>Sales Details</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Sale ID</th>
                <th>Product</th>
                <th>Customer</th>
                <th>Quantity</th>
                <th>Revenue</th>
                <th>Profit</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sales as $sale): ?>
                <tr>
                    <td><?= $sale->sale_id ?></td>
                    <td><?= $sale->product->product_name ?? 'N/A' ?></td>
                    <td><?= $sale->customer_name ?></td>
                    <td><?= $sale->quantity_sold ?></td>
                    <td>₦<?= number_format($sale->total_sale_price, 2) ?></td>
                    <td>₦<?= number_format($sale->profit, 2) ?></td>
                    <td><?= date('H:i:s', strtotime($sale->sale_date)) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
